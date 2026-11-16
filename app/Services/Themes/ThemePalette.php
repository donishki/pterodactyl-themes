<?php

namespace Pterodactyl\Services\Themes;

/** Shared, deterministic color roles for Blade, Tailwind and third-party widgets. */
class ThemePalette
{
    public static function rgb(string $hex): array
    {
        return array_map('hexdec', str_split(ltrim($hex, '#'), 2));
    }

    public static function mix(array $a, array $b, float $weight): array
    {
        return array_map(fn ($x, $y) => (int) round($x * (1 - $weight) + $y * $weight), $a, $b);
    }

    public static function luminance(array $rgb): float
    {
        $linear = array_map(function ($value) {
            $value /= 255;
            return $value <= 0.04045 ? $value / 12.92 : (($value + 0.055) / 1.055) ** 2.4;
        }, $rgb);

        return $linear[0] * 0.2126 + $linear[1] * 0.7152 + $linear[2] * 0.0722;
    }

    public static function contrast(array $a, array $b): float
    {
        $a = self::luminance($a);
        $b = self::luminance($b);
        return (max($a, $b) + 0.05) / (min($a, $b) + 0.05);
    }

    public static function tokens(array $theme): array
    {
        $background = self::rgb($theme['background']);
        $surface = self::rgb($theme['surface']);
        $text = self::rgb($theme['text']);
        $muted = self::rgb($theme['muted']);
        $accent = self::rgb($theme['accent']);
        $white = [255, 255, 255];
        $black = [0, 0, 0];
        $button = $accent;
        // Keep white button labels readable even when a custom accent is very pale.
        while (self::contrast($button, $white) < 4.8) {
            $button = self::mix($button, $black, 0.08);
        }
        $gray = [
            50 => $text,
            100 => self::mix($text, $surface, 0.04),
            200 => self::mix($text, $surface, 0.12),
            300 => $muted,
            400 => self::mix($muted, $surface, 0.15),
            500 => self::mix($surface, $text, 0.18),
            600 => self::mix($surface, $text, 0.06),
            700 => $surface,
            800 => $background,
            900 => self::mix($surface, $background, 0.55),
        ];
        $blue = [];
        foreach ([50 => 0.96, 100 => 0.9, 200 => 0.75, 300 => 0.55, 400 => 0.3] as $shade => $weight) {
            $blue[$shade] = self::mix($button, $white, $weight);
        }
        $blue[500] = $button;
        foreach ([600 => 0.1, 700 => 0.22, 800 => 0.35, 900 => 0.5, 950 => 0.65] as $shade => $weight) {
            $blue[$shade] = self::mix($button, $black, $weight);
        }
        $tokens = [
            'background' => $background, 'surface' => $surface, 'text' => $text,
            'muted' => $muted, 'accent' => $accent, 'button' => $button,
            'button-hover' => $blue[600], 'border' => self::mix($surface, $text, 0.13),
            'raised' => $gray[600], 'input' => self::mix($surface, $background, 0.45),
            'accent-soft' => self::mix($surface, $accent, 0.12),
        ];
        foreach ($gray as $shade => $rgb) { $tokens['gray-' . $shade] = $rgb; }
        foreach ($blue as $shade => $rgb) { $tokens['blue-' . $shade] = $rgb; }
        return $tokens;
    }
}
