<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset cahced roles and permission
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        // Permission::create(['name' => 'permission', 'guard_name' => 'siemas']);

        //create roles and assign existing permissions
        $superadminRole = Role::create(['name' => 'SUPER ADMIN', 'guard_name' => 'siemas']);
        // $superadminRole->givePermissionTo('permission');

        $provinsiRole = Role::create(['name' => 'ADMIN PROVINSI', 'guard_name' => 'siemas']);
        $kabkotRole = Role::create(['name' => 'ADMIN KABKOT', 'guard_name' => 'siemas']);
        $supervisorRole = Role::create(['name' => 'SUPERVISOR', 'guard_name' => 'siemas']);
        $pengawasRole = Role::create(['name' => 'PENGAWAS', 'guard_name' => 'siemas']);
        $pencacahRole = Role::create(['name' => 'PENCACAH', 'guard_name' => 'siemas']);

        // create users
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '00'
        ]);
        $user->assignRole($superadminRole);

        $user = User::create([
            'name' => 'admin 01',
            'email' => 'admin01@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '01'
        ]);
        $user->assignRole($kabkotRole);

        $user = User::create([
            'name' => 'pml 01',
            'email' => 'pml01@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '01'
        ]);
        $user->assignRole($pengawasRole);

        $user = User::create([
            'name' => 'pcl 01',
            'email' => 'pcl01@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '01'
        ]);
        $user->assignRole($pencacahRole);

        $user = User::create([
            'name' => 'admin 02',
            'email' => 'admin02@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '02'
        ]);
        $user->assignRole($kabkotRole);

        $user = User::create([
            'name' => 'pml 02',
            'email' => 'pml02@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '02'
        ]);
        $user->assignRole($pengawasRole);

        $user = User::create([
            'name' => 'pcl 02',
            'email' => 'pcl02@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '02'
        ]);
        $user->assignRole($pencacahRole);

        $user = User::create([
            'name' => 'admin 03',
            'email' => 'admin03@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '03'
        ]);
        $user->assignRole($kabkotRole);

        $user = User::create([
            'name' => 'pml 03',
            'email' => 'pml03@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '03'
        ]);
        $user->assignRole($pengawasRole);

        $user = User::create([
            'name' => 'pcl 03',
            'email' => 'pcl03@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '03'
        ]);
        $user->assignRole($pencacahRole);

        $user = User::create([
            'name' => 'admin 04',
            'email' => 'admin04@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '04'
        ]);
        $user->assignRole($kabkotRole);

        $user = User::create([
            'name' => 'pml 04',
            'email' => 'pml04@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '04'
        ]);
        $user->assignRole($pengawasRole);

        $user = User::create([
            'name' => 'pcl 04',
            'email' => 'pcl04@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '04'
        ]);
        $user->assignRole($pencacahRole);

        $user = User::create([
            'name' => 'admin 05',
            'email' => 'admin05@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '05'
        ]);
        $user->assignRole($kabkotRole);

        $user = User::create([
            'name' => 'pml 05',
            'email' => 'pml05@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '05'
        ]);
        $user->assignRole($pengawasRole);

        $user = User::create([
            'name' => 'pcl 05',
            'email' => 'pcl05@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '05'
        ]);
        $user->assignRole($pencacahRole);

        $user = User::create([
            'name' => 'admin 06',
            'email' => 'admin06@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '06'
        ]);
        $user->assignRole($kabkotRole);

        $user = User::create([
            'name' => 'pml 06',
            'email' => 'pml06@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '06'
        ]);
        $user->assignRole($pengawasRole);

        $user = User::create([
            'name' => 'pcl 06',
            'email' => 'pcl06@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '06'
        ]);
        $user->assignRole($pencacahRole);

        $user = User::create([
            'name' => 'admin 07',
            'email' => 'admin07@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '07'
        ]);
        $user->assignRole($kabkotRole);

        $user = User::create([
            'name' => 'pml 07',
            'email' => 'pml07@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '07'
        ]);
        $user->assignRole($pengawasRole);

        $user = User::create([
            'name' => 'pcl 07',
            'email' => 'pcl07@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '07'
        ]);
        $user->assignRole($pencacahRole);

        $user = User::create([
            'name' => 'admin 08',
            'email' => 'admin08@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '08'
        ]);
        $user->assignRole($kabkotRole);

        $user = User::create([
            'name' => 'pml 08',
            'email' => 'pml08@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '08'
        ]);
        $user->assignRole($pengawasRole);

        $user = User::create([
            'name' => 'pcl 08',
            'email' => 'pcl08@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '08'
        ]);
        $user->assignRole($pencacahRole);

        $user = User::create([
            'name' => 'admin 09',
            'email' => 'admin09@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '09'
        ]);
        $user->assignRole($kabkotRole);

        $user = User::create([
            'name' => 'pml 09',
            'email' => 'pml09@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '09'
        ]);
        $user->assignRole($pengawasRole);

        $user = User::create([
            'name' => 'pcl 09',
            'email' => 'pcl09@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '09'
        ]);
        $user->assignRole($pencacahRole);

        $user = User::create([
            'name' => 'admin 10',
            'email' => 'admin10@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '10'
        ]);
        $user->assignRole($kabkotRole);

        $user = User::create([
            'name' => 'pml 10',
            'email' => 'pml10@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '10'
        ]);
        $user->assignRole($pengawasRole);

        $user = User::create([
            'name' => 'pcl 10',
            'email' => 'pcl10@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '10'
        ]);
        $user->assignRole($pencacahRole);

        $user = User::create([
            'name' => 'admin 11',
            'email' => 'admin11@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '11'
        ]);
        $user->assignRole($kabkotRole);

        $user = User::create([
            'name' => 'pml 11',
            'email' => 'pml11@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '11'
        ]);
        $user->assignRole($pengawasRole);

        $user = User::create([
            'name' => 'pcl 11',
            'email' => 'pcl11@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '11'
        ]);
        $user->assignRole($pencacahRole);

        $user = User::create([
            'name' => 'admin 12',
            'email' => 'admin12@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '12'
        ]);
        $user->assignRole($kabkotRole);

        $user = User::create([
            'name' => 'pml 12',
            'email' => 'pml12@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '12'
        ]);
        $user->assignRole($pengawasRole);

        $user = User::create([
            'name' => 'pcl 12',
            'email' => 'pcl12@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '12'
        ]);
        $user->assignRole($pencacahRole);

        $user = User::create([
            'name' => 'admin 13',
            'email' => 'admin13@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '13'
        ]);
        $user->assignRole($kabkotRole);

        $user = User::create([
            'name' => 'pml 13',
            'email' => 'pml13@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '13'
        ]);
        $user->assignRole($pengawasRole);

        $user = User::create([
            'name' => 'pcl 13',
            'email' => 'pcl13@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '13'
        ]);
        $user->assignRole($pencacahRole);

        $user = User::create([
            'name' => 'admin 71',
            'email' => 'admin71@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '71'
        ]);
        $user->assignRole($kabkotRole);

        $user = User::create([
            'name' => 'pml 71',
            'email' => 'pml71@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '71'
        ]);
        $user->assignRole($pengawasRole);

        $user = User::create([
            'name' => 'pcl 71',
            'email' => 'pcl71@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '71'
        ]);
        $user->assignRole($pencacahRole);

        $user = User::create([
            'name' => 'admin 72',
            'email' => 'admin72@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '72'
        ]);
        $user->assignRole($kabkotRole);

        $user = User::create([
            'name' => 'pml 72',
            'email' => 'pml72@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '72'
        ]);
        $user->assignRole($pengawasRole);

        $user = User::create([
            'name' => 'pcl 72',
            'email' => 'pcl72@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '72'
        ]);
        $user->assignRole($pencacahRole);

        $user = User::create([
            'name' => 'admin 73',
            'email' => 'admin73@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '73'
        ]);
        $user->assignRole($kabkotRole);

        $user = User::create([
            'name' => 'pml 73',
            'email' => 'pml73@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '73'
        ]);
        $user->assignRole($pengawasRole);

        $user = User::create([
            'name' => 'pcl 73',
            'email' => 'pcl73@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '73'
        ]);
        $user->assignRole($pencacahRole);

        $user = User::create([
            'name' => 'admin 74',
            'email' => 'admin74@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '74'
        ]);
        $user->assignRole($kabkotRole);

        $user = User::create([
            'name' => 'pml 74',
            'email' => 'pml74@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '74'
        ]);
        $user->assignRole($pengawasRole);

        $user = User::create([
            'name' => 'pcl 74',
            'email' => 'pcl74@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '74'
        ]);
        $user->assignRole($pencacahRole);
    }
}
