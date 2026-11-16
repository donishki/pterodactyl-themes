<?php

namespace Pterodactyl\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Services\Themes\ThemeManager;

class ThemesController extends Controller
{
    public function __construct(private ThemeManager $themes) {}

    public function index()
    {
        return view('admin.themes.index', ['themes' => $this->themes->all(), 'active' => $this->themes->activeId()]);
    }

    private function change(callable $action)
    {
        // Serialize catalog changes across PHP workers so concurrent imports cannot overwrite each other.
        Cache::lock('theme-catalog-write', 10)->block(5, $action);
        return redirect()->route('admin.themes')->with('theme_status', 'Theme settings saved.');
    }

    public function store(Request $request)
    {
        $data = $request->validate(ThemeManager::rules());
        return $this->change(fn () => $this->themes->activate($this->themes->save($data)));
    }

    public function activate(string $id) { return $this->change(fn () => $this->themes->activate($id)); }
    public function destroy(string $id) { return $this->change(fn () => $this->themes->remove($id)); }

    public function upload(Request $request)
    {
        $request->validate(['package' => ['required', 'file', 'max:256']]);
        return $this->change(fn () => $this->themes->import($request->file('package')->getRealPath()));
    }

    public function export(string $id)
    {
        abort_unless(isset($this->themes->all()[$id]), 404);
        $path = tempnam(sys_get_temp_dir(), 'theme-');
        $zip = new \ZipArchive();
        if ($zip->open($path, \ZipArchive::OVERWRITE) !== true) { abort(500); }
        $zip->addFromString('theme.json', json_encode(['format' => 1, 'theme' => $this->themes->all()[$id]], JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR));
        $zip->close();
        return response()->download($path, 'theme-' . $id . '.zip')->deleteFileAfterSend();
    }
}
