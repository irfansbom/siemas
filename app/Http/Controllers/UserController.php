<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use App\Models\Dsbs;
use App\Models\Dsrt;
use App\Models\Kabs;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    //

    public function index(Request $request)
    {
        Paginator::useBootstrap();
        $auth = Auth::user();
        $data_pengawas = [];
        $kab = '';
        if ($auth->kd_wilayah == '00') {
            if ($request->kab_filter) {
                $kab = $request->kab_filter;
            }
            $kabs = Kabs::all();
            $data_pengawas = User::role('pengawas')->get();
        } else {
            $kab = $auth->kd_wilayah;
            $kabs = Kabs::where('id_kab', $auth->kd_wilayah)->get();
            $data_pengawas = User::where('kd_wilayah', $auth->kd_wilayah)->role('pengawas')->get();
        }

        if ($auth->hasRole('SUPER ADMIN')) {
            $data_roles = Role::all();
        } else {
            $data_roles = Role::where('name', '!=', 'SUPER ADMIN')->where('name', '!=', 'ADMIN PROVINSI')->get();
        }

        if ($request->role_filter) {
            $user = User::where('kd_wilayah', 'LIKE', '%' . $kab . '%')
                ->where('name', 'LIKE', '%' . $request->nama_filter  . '%')
                ->role($request->role_filter)
                ->paginate(15);
        } else {
            $user = User::where('kd_wilayah', 'LIKE', '%' . $kab . '%')
                ->where('name', 'LIKE', '%' . $request->nama_filter  . '%')
                ->paginate(15);
        }
        $user->appends($request->all());
        return view('user.index', compact('user', 'data_roles', 'auth', 'data_pengawas', 'kabs', 'request'));
    }

    public function create()
    {
        $auth = Auth::user();
        $user = new User();
        $data_pengawas = [];

        if ($auth->kd_wilayah == '00') {
            $kabs = Kabs::all();
            $data_pengawas = Role::all();
        } else {
            $kabs = Kabs::where('id_kab', $auth->kd_wilayah)->get();
            $data_pengawas = User::role('pengawas')->get();
        }
        return view('user.create', compact('user', 'auth', 'kabs', 'data_pengawas'));
    }


    public function store(Request $request)
    {
        $auth = Auth::user();
        try {
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'kd_wilayah' => $request->kd_wilayah,
                'created_by' => $auth->id,
            ]);
            return redirect('users')->with('message', 'Berhasil Disimpan');
        } catch (QueryException $ex) {
            return redirect('users\create')->withInput()->with('error', $ex->getMessage());
        }
    }

    public function show($id)
    {
        $auth = Auth::user();
        $id = Crypt::decryptString($id);
        $user = User::where('id', $id)->first();
        $kabs = Kabs::all();
        return view('user.show', compact('user', 'id', 'auth', 'kabs'));
    }

    public function update(Request $request)
    {
        $auth = Auth::user();
        User::where('id', $request->id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'kd_wilayah' => $request->kd_wilayah,
                'password' => Hash::make($request->password),
                'updated_by' =>  $auth->id,
            ]);
        return redirect()->back()->with('success', 'Berhasil Disimpan');
    }

    public function delete(Request $request)
    {
        User::where('id', $request->user_id)->delete();
        return redirect()->back()->with('success', 'Berhasil Dihapus');
    }


    public function ubahpassword(Request $request)
    {
        User::where('id', $request->id)
            ->update([
                'password' => Hash::make($request->password),
            ]);
        return redirect()->back()->with('success', 'Berhasil Disimpan');
    }

    public function user_pengawas(Request $request)
    {
        $user = User::find($request->user_id);
        $user->pengawas = $request->pengawas;
        $user->save();
        $dsbs = Dsbs::where('pengawas', $request->pengawas)->update(['pengawas' => $request->pengawas]);
        $dsrt = Dsrt::where('pengawas', $request->pengawas)->update(['pengawas' => $request->pengawas]);
        return redirect('users/')->with('success', 'User berhasil diperbaharui.');
    }

    public function user_roles(Request $request)
    {
        $user = User::find($request->user_id);
        $user->syncRoles([$request->roles]);
        return redirect('users/')->with('success', 'User berhasil diperbaharui.');
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
        return view('user/roles', compact('data_roles', 'data_permission', 'auth'));
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
        $auth = Auth::user();
        $permission = Permission::paginate(15);
        return view('user/permissions', compact('permission', 'auth'));
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
