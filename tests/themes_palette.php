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
