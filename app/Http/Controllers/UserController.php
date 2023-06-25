<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use App\Models\Dsbs;
use App\Models\Dsrt;
use App\Models\Kabs;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $periode = Periode::first();
        $auth = Auth::user();
        $data_roles = Role::all();
        $data_pengawas = [];
        if ($auth->hasAnyRole(['SUPER ADMIN', 'ADMIN PROVINSI'])) {
            $kab = $request->kab_filter;
            $kabs = Kabs::all();
        } else {
            $kab = $auth->kd_kab;
            $kabs = Kabs::where('id_kab', $kab)->get();
        }

        $data = User::where('kd_kab', 'LIKE', '%' . $kab . '%')
            ->where('name', 'LIKE', '%' . $request->nama_filter  . '%');
        if (!empty($request->role_filter)) {
            $data->role($request->role_filter);
        }
        $data = $data->paginate(15);
        $data->appends($request->all());
        return view('user.index', compact('data', 'data_roles', 'auth', 'kabs', 'request', 'periode'));
    }

    public function create()
    {
        $periode = Periode::first();
        $auth = Auth::user();
        $data = new User();
        if ($auth->hasRole(['SUPER ADMIN', 'ADMIN PROVINSI'])) {
            $kabs = Kabs::all();
            $roles = Role::whereNotIn('name', ['SUPER ADMIN'])->get();
        } else {
            $kabs = Kabs::where('id_kab', $auth->kd_kab)->get();
            $roles = Role::whereNotIn('name', ['SUPER ADMIN', 'ADMIN PROVINSI'])->get();
        }
        // dd($auth->roles);
        return view('user.create', compact('data', 'auth', 'kabs', 'periode', 'roles'));
    }

    public function store(Request $request)
    {
        $auth = Auth::user();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'kd_kab' => $request->kd_kab,
                'created_by' => $auth->id,
            ]);

            $user->syncRoles($request->roles);
            return redirect('users')->with('message', 'Berhasil Disimpan');
        } catch (QueryException $ex) {
            return redirect('users\create')->withInput()->with('error', $ex->getMessage());
        }
    }

    public function show($id)
    {
        $periode = Periode::first();
        $auth = Auth::user();
        $real_id = Crypt::decryptString($id);
        $data = User::where('id', $real_id)->first();
        // $kabs = Kabs::all();
        if ($auth->hasRole(['SUPER ADMIN', 'ADMIN PROVINSI'])) {
            $kabs = Kabs::all();
            $roles = Role::whereNotIn('name', ['SUPER ADMIN'])->get();
        } else {
            $kabs = Kabs::where('id_kab', $auth->kd_kab)->get();
            $roles = Role::whereNotIn('name', ['SUPER ADMIN', 'ADMIN PROVINSI'])->get();
        }
        return view('user.show', compact('data', 'real_id', 'id', 'auth', 'kabs', 'roles', 'periode'));
    }

    public function update($id, Request $request)
    {
        $real_id = Crypt::decryptString($id);
        $auth = Auth::user();
        try {
            User::where('id', $real_id)
                ->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'kd_kab' => $request->kd_kab,
                    'updated_by' =>  $auth->id,
                ]);
            $user = User::find($request->real_id);
            if (!empty($request->roles)) {
                $user = User::find($request->real_id);
                $user->syncRoles($request->roles);
            }
            return redirect()->back()->with('success', 'Berhasil Disimpan');
        } catch (QueryException $ex) {
            return redirect('users\create')->withInput()->with('error', $ex->getMessage());
        }
    }

    public function destroy($id)
    {
        $data = User::where('id', $id)->delete();
        if ($data > 0) {
            return redirect()->back()->with('success', 'Berhasil Dihapus');
        } else {
            return redirect()->back()->with('error', 'Gagal Dihapus');
        }
    }

    public function user_import(Request $request)
    {
        if ($request->file('import_file')) {
            Excel::import(new UsersImport, request()->file('import_file'));
            return redirect()->back()->with('success', 'Berhasil Memasukkan data');
        } else {

            return redirect()->back()->with('error', 'Kesalahan File');
        }
    }

    public function roles()
    {
        $periode = Periode::first();
        $auth = Auth::user();
        $data_roles = [];
        $roles = Role::all();
        foreach ($roles as $role) {
            $permissions = $role->permissions()->get();
            $data_role = [
                'id' => $role->id,
                'name' => $role->name,
                'guard_name' => $role->guard_name,
                'created_at' => $role->created_at,
                'updated_at' => $role->updated_at,
                'permissions' => $permissions
            ];
            array_push($data_roles, $data_role);
        }
        $data_permission = Permission::all();
        return view('user/roles', compact('data_roles', 'data_permission', 'auth', 'periode'));
    }

    public function roles_add(Request $request)
    {
        $role = Role::create(['name' => $request->name, 'guard_name' => $request->guard_name]);
        $role->givePermissionTo($request->permissions);
        return redirect()->back()->with('message', 'Berhasil Disimpan');
    }

    public function roles_edit(Request $request)
    {
        $role =  Role::find($request->id);
        Role::where('id', $request->id)->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions);
        return redirect()->back()->with('message', 'Berhasil Disimpan');
    }

    public function roles_delete(Request $request)
    {
        Role::where('id', $request->id)->delete();
        return redirect()->back()->with('message', 'Berhasil Disimpan');
    }

    public function permissions()
    {
        $periode = Periode::first();
        $auth = Auth::user();
        $permission = Permission::paginate(15);
        return view('user/permissions', compact('permission', 'auth', 'periode'));
    }

    public function permissions_add(Request $request)
    {
        Permission::create(['name' => $request->name, 'guard_name' => $request->guard_name]);
        return redirect()->back()->with('message', 'Berhasil Disimpan');
    }

    public function permissions_delete(Request $request)
    {
        $affectedRows = Permission::where('id', $request->id)->delete();
        if ($affectedRows > 0) {
            return redirect()->back()->with('message', 'Berhasil Disimpan');
        } else {
            return redirect()->back()->with('error', 'Gagal Disimpan');
        }
    }
}
