@extends('layouts.admin')
@section('title', 'Themes')
@section('content-header')
    <h1>Themes <small>Make this panel your own.</small></h1>
@endsection
@section('content')
@if(session('theme_status'))<div class="alert alert-success">{{ session('theme_status') }}</div>@endif
<p>Apply a preset, customize your colors and branding, or install a theme package. Changes apply to the admin, login and user panels. Choose Pterodactyl original to restore the default appearance.</p>
<div class="row">
@foreach($themes as $id => $theme)
<div class="col-sm-6 col-lg-3"><div class="box" style="border-top-color: {{ $theme['accent'] }}">
    <div class="box-header"><h3 class="box-title">{{ $theme['name'] }}</h3> @if($active === $id)<span class="label label-success">Active</span>@endif</div>
    <div class="box-body">
        <div style="padding:20px;background:{{ $theme['background'] }};color:{{ $theme['text'] }};border-radius:{{ (int)$theme['radius'] }}px;margin-bottom:16px">
            <strong>Server dashboard</strong><div style="padding:12px;margin-top:10px;background:{{ $theme['surface'] }};border-left:3px solid {{ $theme['accent'] }}">ET:Legacy <span style="color:{{ $theme['muted'] }}">• Console</span></div>
        </div>
        <form method="POST" action="{{ route('admin.themes.activate', $id) }}" style="display:inline">@csrf<button class="btn btn-primary btn-sm">Apply</button></form>
        <button class="btn btn-default btn-sm theme-edit" data-theme="{{ json_encode($theme) }}">Customize</button>
        <a class="btn btn-default btn-sm" href="{{ route('admin.themes.export', $id) }}">Export</a>
        @if(str_starts_with($id, 'custom-'))
        <form method="POST" action="{{ route('admin.themes.destroy', $id) }}" style="display:inline" onsubmit="return confirm('Delete this theme? If active, the original appearance will be restored.')">@csrf @method('DELETE')<button class="btn btn-danger btn-sm">Delete</button></form>
        @endif
    </div>
</div></div>
@endforeach
</div>
<div class="row"><div class="col-md-8"><div class="box">
    <div class="box-header"><h3 class="box-title">Customize a theme</h3></div>
    <form method="POST" action="{{ route('admin.themes.store') }}" id="theme-editor">@csrf
    <div class="box-body"><div class="row">
        <div class="form-group col-sm-12"><label for="theme-name">Name</label><input id="theme-name" class="form-control" name="name" required maxlength="60" value="{{ old('name', 'My theme') }}"></div>
        @foreach(['accent', 'background', 'surface', 'text', 'muted'] as $field)
        <div class="form-group col-sm-4"><label for="theme-{{ $field }}">{{ ucfirst($field) }}</label><input id="theme-{{ $field }}" class="form-control" type="color" name="{{ $field }}" value="{{ old($field, $themes[$active][$field]) }}" required></div>
        @endforeach
        <div class="form-group col-sm-4"><label for="theme-radius">Corner radius</label><input id="theme-radius" class="form-control" type="number" name="radius" min="0" max="24" value="{{ old('radius', 10) }}" required></div>
        <div class="form-group col-sm-6"><label for="theme-font">Font</label><select id="theme-font" name="font" class="form-control">@foreach(['system' => 'System', 'sans' => 'Arial', 'mono' => 'Monospace'] as $value => $label)<option value="{{ $value }}" @selected(old('font', 'system') === $value)>{{ $label }}</option>@endforeach</select></div>
        <div class="form-group col-sm-6"><label for="theme-logo">Logo URL (HTTPS, optional)</label><input id="theme-logo" class="form-control" type="url" name="logo" value="{{ old('logo') }}" maxlength="1024" placeholder="https://example.com/logo.png"></div>
    </div><div id="theme-preview" style="padding:24px"><strong>Live preview</strong><div id="theme-preview-card" style="padding:16px;margin-top:12px">ET:Legacy test server <span id="theme-preview-muted">• Ready</span></div></div></div>
    <div class="box-footer"><button class="btn btn-primary">Save as new theme &amp; apply</button><span class="text-muted"> Existing presets are preserved.</span></div>
    </form>
</div></div><div class="col-md-4"><div class="box">
    <div class="box-header"><h3 class="box-title">Install theme package</h3></div>
    <form method="POST" action="{{ route('admin.themes.upload') }}" enctype="multipart/form-data">@csrf
    <div class="box-body"><p>Upload a ZIP exported from this panel, containing only <code>theme.json</code>. Packages include colors, fonts, corner radius and a logo URL. PHP, JavaScript and third-party theme frameworks are not supported.</p><label for="theme-package">ZIP file (up to 256 KiB)</label><input id="theme-package" type="file" name="package" accept=".zip" required></div>
    <div class="box-footer"><button class="btn btn-primary">Install theme</button></div></form>
</div></div></div>
@endsection
@section('footer-scripts')
@parent
<script>
(function () {
    const form = document.getElementById('theme-editor');
    function preview() {
        const p = document.getElementById('theme-preview'), card = document.getElementById('theme-preview-card');
        p.style.background = form.elements.background.value; p.style.color = form.elements.text.value;
        p.style.borderRadius = form.elements.radius.value + 'px';
        p.style.fontFamily = {system:'system-ui, sans-serif', sans:'Arial, sans-serif', mono:'monospace'}[form.elements.font.value];
        card.style.background = form.elements.surface.value; card.style.borderLeft = '3px solid ' + form.elements.accent.value;
        document.getElementById('theme-preview-muted').style.color = form.elements.muted.value;
    }
    form.addEventListener('input', preview);
    document.querySelectorAll('.theme-edit').forEach(function (button) { button.addEventListener('click', function () {
        const data = JSON.parse(button.dataset.theme);
        Object.keys(data).forEach(function (key) { if(form.elements[key]) form.elements[key].value = data[key] || ''; });
        form.elements.name.value += ' custom'; preview(); form.scrollIntoView({behavior:'smooth'});
    }); }); preview();
})();
</script>
@endsection
