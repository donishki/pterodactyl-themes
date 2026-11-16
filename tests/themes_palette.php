<?php

// No framework or database required: php tests/themes_palette.php
require __DIR__ . '/../app/Services/Themes/ThemePalette.php';

use Pterodactyl\Services\Themes\ThemePalette;

$base = ['background' => '#0c111a', 'surface' => '#151d29', 'text' => '#edf2fa', 'muted' => '#a1aec3'];
$checks = 0;
foreach (['#7699f5', '#58c5a0', '#2559c7', '#ffffff', '#ffff00', '#000000', '#5566cc'] as $accent) {
    $tokens = ThemePalette::tokens($base + ['accent' => $accent]);
    foreach (['blue-500', 'blue-600'] as $role) {
        if (ThemePalette::contrast($tokens[$role], $tokens['blue-50']) < 4.5) {
            throw new RuntimeException("Button contrast regression: $accent / $role");
        }
        $checks++;
    }
    if ($tokens['gray-600'] === $tokens['gray-700'] || $tokens['gray-700'] === $tokens['gray-800'] || $tokens['gray-800'] === $tokens['gray-900']) {
        throw new RuntimeException('Distinct surface roles collapsed');
    }
    foreach ($tokens as $color) {
        if (count($color) !== 3 || min($color) < 0 || max($color) > 255) {
            throw new RuntimeException('Invalid RGB token');
        }
    }
}
if (ThemePalette::contrast(ThemePalette::rgb($base['muted']), ThemePalette::rgb($base['surface'])) < 4.5) {
    throw new RuntimeException('Muted text contrast regression');
}
echo "PASS: $checks button contrast checks, distinct surfaces, valid RGB and muted text contrast\n";

require __DIR__ . '/../app/Services/Themes/ThemePresets.php';
foreach (\Pterodactyl\Services\Themes\ThemePresets::community() as $id => $preset) {
    $tokens = ThemePalette::tokens($preset);
    foreach (['background', 'surface', 'raised', 'input'] as $surface) {
        foreach (['text', 'muted'] as $label) {
            if (ThemePalette::contrast($tokens[$label], $tokens[$surface]) < 4.5) {
                throw new RuntimeException("Preset contrast regression: $id / $label on $surface");
            }
        }
    }
    if (ThemePalette::contrast($tokens['blue-50'], $tokens['blue-500']) < 4.5) {
        throw new RuntimeException("Preset button contrast regression: $id");
    }
}
echo "PASS: all community presets meet text, muted and button contrast checks\n";
