@php
    $panelTheme = app(\Pterodactyl\Services\Themes\ThemeManager::class)->active();
    $themeFonts = ['system' => 'system-ui, sans-serif', 'sans' => 'Arial, sans-serif', 'mono' => 'ui-monospace, monospace'];
@endphp
@if($panelTheme)
<style id="panel-theme-tokens">
:root {
    @php
        $rgb = fn ($hex) => implode(' ', array_map('hexdec', str_split(ltrim($hex, '#'), 2)));
        $shadeKeys = [50 => 'text', 100 => 'text', 200 => 'text', 300 => 'muted', 400 => 'muted', 500 => 'muted', 600 => 'surface', 700 => 'surface', 800 => 'background', 900 => 'surface'];
    @endphp
    --theme-rgb-accent: {{ $rgb($panelTheme['accent']) }};
    --theme-rgb-background: {{ $rgb($panelTheme['background']) }};
    @foreach($shadeKeys as $shade => $key)
    --theme-rgb-gray-{{ $shade }}: {{ $rgb($panelTheme[$key]) }};
    @endforeach
    --theme-accent: {{ $panelTheme['accent'] }};
    --theme-background: {{ $panelTheme['background'] }};
    --theme-surface: {{ $panelTheme['surface'] }};
    --theme-text: {{ $panelTheme['text'] }};
    --theme-muted: {{ $panelTheme['muted'] }};
    --theme-radius: {{ (int)$panelTheme['radius'] }}px;
    --theme-font: {{ $themeFonts[$panelTheme['font']] }};
    --theme-black: {{ $panelTheme['background'] }};
    --theme-gray-50: {{ $panelTheme['text'] }};
    --theme-gray-100: {{ $panelTheme['text'] }};
    --theme-gray-200: {{ $panelTheme['text'] }};
    --theme-gray-300: {{ $panelTheme['muted'] }};
    --theme-gray-400: {{ $panelTheme['muted'] }};
    --theme-gray-500: color-mix(in srgb, {{ $panelTheme['muted'] }} 45%, {{ $panelTheme['surface'] }});
    --theme-gray-600: color-mix(in srgb, {{ $panelTheme['muted'] }} 20%, {{ $panelTheme['surface'] }});
    --theme-gray-700: {{ $panelTheme['surface'] }};
    --theme-gray-800: {{ $panelTheme['background'] }};
    --theme-gray-900: {{ $panelTheme['surface'] }};
}
body, body p, body h1, body h2, body h3, body h4, body input, body select, body textarea, body button { font-family: var(--theme-font) !important; }
body { background: var(--theme-background) !important; color: var(--theme-text) !important; }
body .box, body .modal-content, body input:not([type=checkbox]):not([type=radio]), body select, body textarea, body .btn { border-radius: var(--theme-radius); }
body.skin-blue .wrapper, body.skin-blue .content-wrapper, body.skin-blue .main-footer { background: var(--theme-background); color: var(--theme-text); }
body.skin-blue .main-sidebar, body.skin-blue .box, body.skin-blue .box-footer, body.skin-blue .modal-content, body.skin-blue .main-header .navbar, body.skin-blue .main-header .logo, body.skin-blue .sidebar-menu>li.header { background: var(--theme-surface); color: var(--theme-text); }
body.skin-blue .sidebar-menu>li>a, body.skin-blue .box-title, body.skin-blue .form-control, body.skin-blue .table { color: var(--theme-text); }
body.skin-blue .sidebar-menu>li.active>a, body.skin-blue .sidebar-menu>li>a:hover { background:var(--theme-background); border-left-color:var(--theme-accent); }
body.skin-blue .form-control, body.skin-blue .table-striped>tbody>tr:nth-of-type(odd), body.skin-blue .table-hover>tbody>tr:hover, body.skin-blue .well { background:var(--theme-background); }
body.skin-blue .text-muted, body.skin-blue .help-block, body.skin-blue .content-header small { color:var(--theme-muted); }
body.skin-blue .btn-primary { background:var(--theme-accent); border-color:var(--theme-accent); color:#fff; }
body.skin-blue .box, body.skin-blue .box-header, body.skin-blue .box-footer, body.skin-blue .table td, body.skin-blue .table th, body.skin-blue .form-control { border-color:var(--theme-gray-500); }
.panel-theme-logo { max-height:30px; max-width:160px; object-fit:contain; vertical-align:middle; margin-right:10px; }
</style>
@endif
