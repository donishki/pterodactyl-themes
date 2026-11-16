# Pterodactyl Themes

A Pterodactyl Panel v1.15.2 fork with an **Admin → Themes** section. The upstream MIT license and attribution remain intact. This is an independent project, not an official Pterodactyl release.

## Features

- Original, Midnight, Forest and Daylight presets.
- Editable accent, background, surface, text and muted colors.
- System, Arial and monospace font choices; corner radius from 0–24 px.
- Optional HTTPS logo URL for the admin and user navigation.
- A live editor preview and save-as-new customization.
- ZIP theme import/export, with up to 50 custom themes stored in the database.
- One-click restoration of the original panel appearance.

Themes affect the admin, login and user interfaces. Colors are integrated into the frontend's Tailwind tokens, including opacity modifiers. Terminal output and semantic error/success colors retain their meaning. Presets are never overwritten; Customize saves a new copy. Deleting an active custom theme restores the original appearance.

## Theme package format

A ZIP must contain exactly one root-level file named `theme.json`, no larger than 16 KiB uncompressed. Uploads are limited to 256 KiB. An example package is in `themes/examples`.

```json
{
  "format": 1,
  "theme": {
    "name": "Ocean",
    "accent": "#238fb8",
    "background": "#101c28",
    "surface": "#1c3042",
    "text": "#ecf5fa",
    "muted": "#adc4d4",
    "radius": 10,
    "font": "system",
    "logo": ""
  }
}
```

Colors must be six-digit hex values. A logo may be blank or an HTTPS URL. Remote logo requests are made by the browser, so use an image host you trust. Packages contain settings only: arbitrary CSS, HTML, JavaScript, PHP, ZIP assets, Blueprint extensions and other third-party theme formats are not supported. No archive paths are extracted or executed.

## Build and install

Use Pterodactyl's normal PHP, database, Redis and web-server requirements for v1.15.2. Build assets with Node.js 22 and Yarn:

```sh
yarn install --frozen-lockfile
yarn build:production
yarn tsc --noEmit
composer install --no-dev --optimize-autoloader
php artisan optimize:clear
```

The included upstream Dockerfile builds the full application with the theme changes. For an isolated deployment, create separate database/Redis services, app key, session cookie, persistent directories and Wings credentials. Use unique database/cache hostnames if joining a shared Docker proxy network. Never point a test panel at a production database or production Wings node. Docker Wings also requires `/run/wings:/run/wings` alongside the usual socket, configuration and game-data mounts.

The theme settings live in the existing settings table, under `themes::catalog` and `themes::active`; no additional schema migration is required. Back up that database with your usual panel backups. Rebuild the custom image when updating the code; do not replace it with an upstream image if you want to retain the theme feature.

## Verification

Production frontend compilation and TypeScript checks passed on the v1.15.2 base. HTTP integration checks covered saving, activation, deletion/reset, ZIP roundtrip, invalid field values, path traversal, executable extra files, oversized JSON, malformed JSON, and denial of all six endpoints to a non-admin account.

Run `python tests/themes_http_smoke.py` against a disposable panel with `requests` installed and `THEME_TEST_URL`, `THEME_TEST_USERNAME`, and `THEME_TEST_PASSWORD` set. It temporarily changes the active theme, deletes only the themes it creates, and restores the previous selection. Do not run against a panel in active use.

## Upstream updates

Keep `upstream` pointing to `https://github.com/pterodactyl/panel.git`. Review and test upstream updates in an isolated environment before merging. The v2 beta uses a different customization architecture; these changes target v1.15.2 and are not a v2 theme extension.
