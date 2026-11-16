"""Run only on a disposable test panel. Requires requests and THEME_TEST_* env vars."""
import io
import json
import os
import re
import uuid
import zipfile

import requests

base = os.environ['THEME_TEST_URL'].rstrip('/')
assert base.startswith('https://'), 'Use an HTTPS test panel'
s = requests.Session()
r = s.get(base + '/auth/login', timeout=20)
r.raise_for_status()
s.headers.update({'X-CSRF-TOKEN': re.search(r'name="csrf-token" content="([^"]+)"', r.text)[1], 'Accept': 'application/json', 'Referer': base})
r = s.post(base + '/auth/login', json={'user': os.environ['THEME_TEST_USERNAME'], 'password': os.environ['THEME_TEST_PASSWORD']}, timeout=20)
r.raise_for_status()
assert r.json()['data']['complete'], 'Use a dedicated test admin without a 2FA challenge'
r = s.get(base + '/admin/themes', timeout=20)
r.raise_for_status()
s.headers['X-CSRF-TOKEN'] = re.search(r'name="_token" content="([^"]+)"', r.text)[1]
ids = lambda html: set(re.findall(r'/admin/themes/(custom-[a-f0-9]+)/export', html))
before = ids(r.text)
active_match = re.search(r'<span class="[^"]*theme-active-label[^"]*">Active</span>.*?/admin/themes/([^/]+)/activate', r.text, re.S)
assert active_match, 'Could not determine active theme'
previous = active_match[1]
theme = {'name': 'Smoke ' + uuid.uuid4().hex[:8], 'accent': '#5566cc', 'background': '#10121b', 'surface': '#1b1f2f', 'text': '#edf0fa', 'muted': '#a5adc5', 'radius': '12', 'font': 'system', 'logo': ''}
try:
    assert requests.get(base + '/admin/themes', allow_redirects=False, timeout=20).status_code in (302, 307, 401, 403)
    for patch in [{'accent': '</style><script>alert(1)</script>'}, {'logo': 'javascript:alert(1)'}, {'radius': 99}, {'font': 'x; color:red'}]:
        assert s.post(base + '/admin/themes', data={**theme, **patch}, allow_redirects=False, timeout=20).status_code == 422
    assert s.post(base + '/admin/themes', data=theme, allow_redirects=False, timeout=20).status_code == 302
    html = s.get(base + '/admin/themes', timeout=20).text
    added = ids(html) - before
    assert len(added) == 1
    custom = added.pop()
    assert '--theme-rgb-accent: 85 102 204' in s.get(base + '/', timeout=20).text
    r = s.get(base + '/admin/themes/' + custom + '/export', timeout=20)
    r.raise_for_status()
    with zipfile.ZipFile(io.BytesIO(r.content)) as z:
        assert z.namelist() == ['theme.json']
        assert json.loads(z.read('theme.json'))['theme']['name'] == theme['name']
    assert s.post(base + '/admin/themes/upload', files={'package': ('theme.zip', r.content, 'application/zip')}, allow_redirects=False, timeout=20).status_code == 302
    for files in [[('../theme.json', '{}')], [('theme.json', '{}'), ('shell.php', '<?php echo 1;')], [('theme.json', 'x' * 20000)], [('theme.json', 'not JSON')]]:
        buf = io.BytesIO()
        with zipfile.ZipFile(buf, 'w', zipfile.ZIP_DEFLATED) as z:
            for name, content in files:
                z.writestr(name, content)
        assert s.post(base + '/admin/themes/upload', files={'package': ('bad.zip', buf.getvalue(), 'application/zip')}, allow_redirects=False, timeout=20).status_code == 422
    print('PASS: fields, activation, ZIP roundtrip, archive validation and anonymous access')
finally:
    for custom in ids(s.get(base + '/admin/themes', timeout=20).text) - before:
        assert s.delete(base + '/admin/themes/' + custom, allow_redirects=False, timeout=20).status_code == 302
    assert s.post(base + '/admin/themes/' + previous + '/activate', allow_redirects=False, timeout=20).status_code == 302
