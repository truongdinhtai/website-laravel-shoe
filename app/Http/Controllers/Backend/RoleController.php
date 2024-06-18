<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::orderByDesc('id')
            ->paginate(20);

        $viewData = [
            'roles' => $roles
        ];

        return view('backend.role.index', $viewData);
    }

    public function create()
    {
        $permissions = Permission::all();
        $permissionActive = [];
        return view('backend.role.create', compact('permissions','permissionActive'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->except('_token','permissions');
            $data['created_at'] = Carbon::now();

            $role = Role::create($data);
            if ($role && !empty($request->permissions))
                $role->givePermissionTo($request->permissions);

        }catch (\Exception $exception) {
            Log::error("ERROR => RoleController@store => ". $exception->getMessage());
            toastr()->error('Thêm mới thất bại!', 'Thông báo');
            return redirect()->route('get_admin.role.create');
        }

        toastr()->success('Thêm mới thành công!', 'Thông báo');
        return redirect()->route('get_admin.role.index');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $permissionActive = DB::table('role_has_permissions')->where('role_id', $id)->pluck('permission_id')->toArray();
        return view('backend.role.update', compact('role','permissions','permissionActive'));
    }

    public function update(CategoryRequest $request, $id) {
        try {
            $data = $request->except('_token','permissions');
            $data['updated_at'] = Carbon::now();

            $update = Role::find($id)->update($data);
            if ($update && !empty($request->permissions))
            {
                $role = Role::find($id);

                $permissionActive = DB::table('role_has_permissions')->where('role_id', $id)->pluck('permission_id')->toArray();
                if ($permissionActive) {
                    foreach ($permissionActive as $item)
                        $role->revokePermissionTo($item);
                }

                $role->givePermissionTo($request->permissions);
            }

        }catch (\Exception $exception) {
            Log::error("ERROR => RoleController@store => ". $exception->getMessage());
            toastr()->error('Update thất bại!', 'Thông báo');
            return redirect()->route('get_admin.role.update', $id);
        }

        toastr()->success('Update thành công!', 'Thông báo');
        return redirect()->route('get_admin.role.index');
    }

    public function delete(Request $request, $id) {
        try {
            $role = Role::findOrFail($id);
            if ($role) $role->delete();

        }catch (\Exception $exception) {
            toastr()->error('Update thất bại!', 'Thông báo');
            Log::error("ERROR => RoleController@delete => ". $exception->getMessage());
        }
        toastr()->success('Update thành công!', 'Thông báo');
        return redirect()->route('get_admin.role.index');
    }
}
