<?php

namespace Pterodactyl\Services\Themes;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Pterodactyl\Contracts\Repository\SettingsRepositoryInterface;

class ThemeManager
{
    public const KEY = 'themes::catalog';
    public const ACTIVE = 'themes::active';

    public function __construct(private SettingsRepositoryInterface $settings) {}

    public static function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:60'],
            'accent' => ['required', 'regex:/^#[0-9a-fA-F]{6}$/'],
            'background' => ['required', 'regex:/^#[0-9a-fA-F]{6}$/'],
            'surface' => ['required', 'regex:/^#[0-9a-fA-F]{6}$/'],
            'text' => ['required', 'regex:/^#[0-9a-fA-F]{6}$/'],
            'muted' => ['required', 'regex:/^#[0-9a-fA-F]{6}$/'],
            'radius' => ['required', 'integer', 'between:0,24'],
            'font' => ['required', Rule::in(['system', 'sans', 'mono'])],
            'logo' => ['nullable', 'string', 'max:1024', 'url:https'],
        ];
    }

    public function presets(): array
    {
        $base = ['radius' => 12, 'font' => 'system', 'logo' => ''];
        return [
            'stock' => ['name' => 'Pterodactyl original', 'accent' => '#3b82f6', 'background' => '#33404d', 'surface' => '#1f2933', 'text' => '#d9e2ec', 'muted' => '#9aa5b1'] + $base,
            'midnight' => ['name' => 'Midnight', 'accent' => '#7699f5', 'background' => '#0c111a', 'surface' => '#151d29', 'text' => '#edf2fa', 'muted' => '#a1aec3'] + $base,
            'forest' => ['name' => 'Forest', 'accent' => '#58c5a0', 'background' => '#101614', 'surface' => '#19231f', 'text' => '#edf5f0', 'muted' => '#a6b9b0'] + $base,
            'daylight' => ['name' => 'Daylight', 'accent' => '#2559c7', 'background' => '#edf1f7', 'surface' => '#ffffff', 'text' => '#182338', 'muted' => '#52637c'] + $base,
        ];
    }

    public function custom(): array
    {
        return json_decode($this->settings->get(self::KEY, '{}'), true) ?: [];
    }

    public function all(): array { return $this->presets() + $this->custom(); }

    public function activeId(): string
    {
        $id = $this->settings->get(self::ACTIVE, 'stock');
        return array_key_exists($id, $this->all()) ? $id : 'stock';
    }

    public function active(): ?array
    {
        return $this->activeId() === 'stock' ? null : $this->all()[$this->activeId()];
    }

    public function save(array $data): string
    {
        $data = Validator::make($data, self::rules())->validate();
        $catalog = $this->custom();
        if (count($catalog) >= 50) {
            throw ValidationException::withMessages(['theme' => 'Remove a custom theme before adding another (maximum 50).']);
        }
        $id = 'custom-' . bin2hex(random_bytes(8));
        $catalog[$id] = $data;
        $this->settings->set(self::KEY, json_encode($catalog, JSON_THROW_ON_ERROR));
        return $id;
    }

    public function activate(string $id): void
    {
        abort_unless(array_key_exists($id, $this->all()), 404);
        $this->settings->set(self::ACTIVE, $id);
    }

    public function remove(string $id): void
    {
        $catalog = $this->custom();
        abort_unless(isset($catalog[$id]), 404);
        if ($this->activeId() === $id) { $this->activate('stock'); }
        unset($catalog[$id]);
        $this->settings->set(self::KEY, json_encode($catalog, JSON_THROW_ON_ERROR));
    }

    public function import(string $path): string
    {
        $zip = new \ZipArchive();
        if ($zip->open($path) !== true) {
            throw ValidationException::withMessages(['package' => 'This is not a valid ZIP theme package.']);
        }
        try {
            // Packages contain data only. Never extract paths or execute theme code.
            $stat = $zip->statIndex(0);
            if ($zip->numFiles !== 1 || !$stat || $stat['name'] !== 'theme.json' || $stat['size'] > 16384) {
                throw ValidationException::withMessages(['package' => 'The ZIP must contain only theme.json (maximum 16 KiB).']);
            }
            $data = json_decode($zip->getFromIndex(0, 16385), true);
            if (!is_array($data) || ($data['format'] ?? null) !== 1 || !is_array($data['theme'] ?? null)) {
                throw ValidationException::withMessages(['package' => 'Expected format 1 and a theme object.']);
            }
            return $this->save($data['theme']);
        } finally { $zip->close(); }
    }
}
