<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AccountController extends Controller
{
    public function account(Request $request)
    {
        $user = Auth::user();
        if (config('app.layout_admin') == 'v1') {
            return view('frontend.account.index',compact('user'));
        }

        return view('frontend.v2.user.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        try{
            $user = User::find(Auth::user()->id);
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->birthday = $request->birthday;
            $user->updated_at = Carbon::now();

            if ($request->avatar){
                $file = upload_image('avatar');
                if (isset($file['code']) && $file['code'] == 1) $user->avatar = $file['name'];
            }

            $user->save();
            toastr()->success('Cập nhật thành công!', 'Thông báo');
        }catch (\Exception $exception) {
            toastr()->error('Cập nhật thất bại!', 'Thông báo');
            Log::error("ERROR => ProfileController@updateProfile => ". $exception->getMessage());
        }
        return redirect()->back();
    }

    public function updatePassword()
    {
        $user = Auth::user();
        if (config('app.layout_admin') == 'v1') {
            return view('frontend.account.index',compact('user'));
        }

        return view('frontend.v2.user.update_password', compact('user'));
    }

    public function processUpdatePassword(UpdatePasswordRequest $request)
    {
        $user             = Auth::user();
        $user->password   = bcrypt($request->password);
        $user->updated_at = Carbon::now();
        $user->save();
        toastr()->success('Cập nhật thành công!', 'Thông báo');
        return redirect()->back();
    }
}
