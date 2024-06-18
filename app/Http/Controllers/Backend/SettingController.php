<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $setting = Setting::first();

        return view('backend.setting.index', compact('setting'));
    }

    public function createOrUpdate(Request $request)
    {
        $setting = Setting::first();
        if (!$setting) $setting = new Setting();
        $setting->name = $request->name;
        $setting->email = $request->email;
        $setting->phone = $request->phone;
        $setting->address = $request->address;
        $setting->description = $request->description;

        if ($request->avatar) {
            $file = upload_image('avatar');
            if (isset($file['code']) && $file['code'] == 1) $setting->logo = $file['name'];
        }

        $setting->save();

        toastr()->success('Xử lý thành công', 'Thông báo');
        return redirect()->back();
    }
}
