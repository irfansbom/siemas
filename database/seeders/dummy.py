for i in ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '71', '72', '73', '74']:
    print(f'''
        $user = User::create([
            'name' => 'admin {i}',
            'email' => 'admin{i}@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '{i}'
        ]);
        $user->assignRole($kabkotRole);

        $user = User::create([
            'name' => 'pml {i}',
            'email' => 'pml{i}@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '{i}'
        ]);
        $user->assignRole($pengawasRole);

        $user = User::create([
            'name' => 'pcl {i}',
            'email' => 'pcl{i}@bpssumsel.com',
            'password' => Hash::make('123456'),
            'kd_kab' => '{i}'
        ]);
        $user->assignRole($pencacahRole);
    ''')