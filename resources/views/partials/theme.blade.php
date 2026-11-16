@php
    $panelTheme = app(\Pterodactyl\Services\Themes\ThemeManager::class)->active();
    $themeFonts = ['system' => 'system-ui', 'sans' => 'Arial', 'mono' => 'ui-monospace'];
@endphp
@if($panelTheme)
@php($themeTokens = \Pterodactyl\Services\Themes\ThemePalette::tokens($panelTheme))
<style id="panel-theme-tokens">
:root {
    @foreach($themeTokens as $role => $rgb)
    --theme-rgb-{{ $role }}: {{ implode(' ', $rgb) }};
    --theme-{{ $role }}: rgb({{ implode(' ', $rgb) }});
    @endforeach
    --theme-radius: {{ (int)$panelTheme['radius'] }}px;
    --theme-font: {{ $themeFonts[$panelTheme['font']] }};
    color-scheme: {{ \Pterodactyl\Services\Themes\ThemePalette::luminance($themeTokens['background']) < 0.4 ? 'dark' : 'light' }};
}
@include('partials.theme-styles')
</style>
@endif
