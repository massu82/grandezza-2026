<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();

        return view('admin.settings.index', [
            'settings' => $settings,
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->only(['telefono', 'email', 'direccion', 'horarios']);

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        cache()->forget('app_settings');

        return redirect()->back()->with('success', 'Ajustes guardados.');
    }
}
