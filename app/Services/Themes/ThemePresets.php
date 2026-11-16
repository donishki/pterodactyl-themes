<?php

namespace Pterodactyl\Services\Themes;

/** Community palette adaptations; see THEMES.md for sources and contrast adjustments. */
class ThemePresets
{
    public static function community(): array
    {
        $base = ['font' => 'system', 'logo' => ''];
        return [
            'catppuccin-mocha' => ['name' => 'Catppuccin Mocha', 'accent' => '#cba6f7', 'background' => '#1e1e2e', 'surface' => '#313244', 'text' => '#cdd6f4', 'muted' => '#bac2de', 'radius' => 14, 'description' => 'Pastel lavender on deep violet.', 'source' => 'https://catppuccin.com/palette/'] + $base,
            'catppuccin-macchiato' => ['name' => 'Catppuccin Macchiato', 'accent' => '#f5bde6', 'background' => '#24273a', 'surface' => '#363a4f', 'text' => '#cad3f5', 'muted' => '#b8c0e0', 'radius' => 14, 'description' => 'Soft pink with dusky blue surfaces.', 'source' => 'https://catppuccin.com/palette/'] + $base,
            'catppuccin-frappe' => ['name' => 'Catppuccin Frappe', 'accent' => '#8caaee', 'background' => '#303446', 'surface' => '#414559', 'text' => '#c6d0f5', 'muted' => '#b5bfe2', 'radius' => 12, 'description' => 'Muted periwinkle and warm slate.', 'source' => 'https://catppuccin.com/palette/'] + $base,
            'catppuccin-latte' => ['name' => 'Catppuccin Latte', 'accent' => '#8839ef', 'background' => '#eff1f5', 'surface' => '#e6e9ef', 'text' => '#4c4f69', 'muted' => '#5c5f77', 'radius' => 14, 'description' => 'Creamy light surfaces with mauve.', 'source' => 'https://catppuccin.com/palette/'] + $base,
            'nord' => ['name' => 'Nord', 'accent' => '#88c0d0', 'background' => '#2e3440', 'surface' => '#3b4252', 'text' => '#eceff4', 'muted' => '#d8dee9', 'radius' => 6, 'description' => 'Arctic slate with icy cyan accents.', 'source' => 'https://www.nordtheme.com/docs/colors-and-palettes/'] + $base,
            'dracula' => ['name' => 'Dracula', 'accent' => '#bd93f9', 'background' => '#282a36', 'surface' => '#343746', 'text' => '#f8f8f2', 'muted' => '#b6b8d0', 'radius' => 10, 'description' => 'Violet accents on charcoal purple.', 'source' => 'https://draculatheme.com/spec'] + $base,
            'tokyo-night' => ['name' => 'Tokyo Night', 'accent' => '#7aa2f7', 'background' => '#1a1b26', 'surface' => '#24283b', 'text' => '#c0caf5', 'muted' => '#a9b1d6', 'radius' => 8, 'description' => 'Electric blue in a deep indigo workspace.', 'source' => 'https://github.com/folke/tokyonight.nvim'] + $base,
            'tokyo-storm' => ['name' => 'Tokyo Storm', 'accent' => '#7dcfff', 'background' => '#24283b', 'surface' => '#292e42', 'text' => '#c0caf5', 'muted' => '#a9b1d6', 'radius' => 8, 'description' => 'Brighter indigo with luminous cyan.', 'source' => 'https://github.com/folke/tokyonight.nvim'] + $base,
            'rose-pine' => ['name' => 'Rose Pine', 'accent' => '#ebbcba', 'background' => '#191724', 'surface' => '#1f1d2e', 'text' => '#e0def4', 'muted' => '#a6a1bd', 'radius' => 16, 'description' => 'Dusty rose on soft ink surfaces.', 'source' => 'https://rosepinetheme.com/palette/'] + $base,
            'rose-pine-moon' => ['name' => 'Rose Pine Moon', 'accent' => '#c4a7e7', 'background' => '#232136', 'surface' => '#2a273f', 'text' => '#e0def4', 'muted' => '#aaa5c2', 'radius' => 16, 'description' => 'Moonlit purple with iris highlights.', 'source' => 'https://rosepinetheme.com/palette/'] + $base,
            'rose-pine-dawn' => ['name' => 'Rose Pine Dawn', 'accent' => '#907aa9', 'background' => '#faf4ed', 'surface' => '#fffaf3', 'text' => '#575279', 'muted' => '#6e6a86', 'radius' => 16, 'description' => 'Warm ivory with botanical purple.', 'source' => 'https://rosepinetheme.com/palette/'] + $base,
            'solarized-dark' => ['name' => 'Solarized Dark', 'accent' => '#2aa198', 'background' => '#002b36', 'surface' => '#073642', 'text' => '#eee8d5', 'muted' => '#a6b5b5', 'radius' => 4, 'description' => 'Deep teal and a restrained aqua accent.', 'source' => 'https://ethanschoonover.com/solarized/'] + $base,
            'solarized-light' => ['name' => 'Solarized Light', 'accent' => '#007f82', 'background' => '#fdf6e3', 'surface' => '#eee8d5', 'text' => '#073642', 'muted' => '#465b63', 'radius' => 4, 'description' => 'Warm parchment with precise teal details.', 'source' => 'https://ethanschoonover.com/solarized/'] + $base,
            'gruvbox-dark' => ['name' => 'Gruvbox Dark', 'accent' => '#fabd2f', 'background' => '#282828', 'surface' => '#3c3836', 'text' => '#ebdbb2', 'muted' => '#d5c4a1', 'radius' => 6, 'description' => 'Retro charcoal, amber and warm cream.', 'source' => 'https://github.com/morhetz/gruvbox'] + $base,
            'gruvbox-light' => ['name' => 'Gruvbox Light', 'accent' => '#9d4808', 'background' => '#fbf1c7', 'surface' => '#f2e5bc', 'text' => '#3c3836', 'muted' => '#665c54', 'radius' => 6, 'description' => 'Golden paper with burnt orange accents.', 'source' => 'https://github.com/morhetz/gruvbox'] + $base,
            'everforest' => ['name' => 'Everforest', 'accent' => '#a7c080', 'background' => '#2d353b', 'surface' => '#343f44', 'text' => '#d3c6aa', 'muted' => '#b4bca7', 'radius' => 10, 'description' => 'Sage green and earthy neutral surfaces.', 'source' => 'https://github.com/sainnhe/everforest'] + $base,
        ];
    }
}

