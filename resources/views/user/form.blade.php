<fieldset class="">
    <input type="text" name="id" id="id" hidden value="{{ old('id', $data->id) }}">
    <div class="mb-3 row">
        <label for="name" class="col-sm-4 col-form-label">Nama User</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="name" name="name"
                value="{{ old('name', $data->name) }}" autocomplete="off" required>
        </div>
    </div>

    <div class="mb-3 row">
        <label for="email" class="col-sm-4 col-form-label">Email</label>
        <div class="col-sm-6">
            <input type="email" class="form-control" id="email" name="email"
                value="{{ old('email', $data->email) }}" autocomplete="off" required>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="password" class="col-sm-4 col-form-label">Password</label>
        <div class="col-sm-6">
            <input type="password" class="form-control" id="password" name="password"
                value="{{ old('password', $data->password) }}" required autocomplete="off">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="kd_kab" class="col-sm-4 col-form-label">Kabupaten/Kota</label>
        <div class="col-sm-6">
            <select name="kd_kab" id="kd_kab" class="form-select">
                @foreach ($kabs as $kab)
                    <option value="{{ $kab->id_kab }}" @if ($kab->id_kab == $data->kd_kab) selected @endif>
                        [{{ $kab->id_kab }}] {{ $kab->nama_kab }}
                    </option>
                @endforeach
                @if ($auth->kd_kab == '00')
                    <option value="00" @if ($data->kd_kab == '00') selected @endif>
                        [00] Provinsi Sumatera Selatan
                    </option>
                @endif
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-4 col-form-label">Roles</label>
        <div class="custom-controls-stacked col-6">
            @foreach ($roles as $role)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{ $role->name }}"
                        id="{{ 'role_' . $role->name }}" name="roles[]"
                        @if ($data->hasrole($role->name)) checked @endif>
                    <label class="form-check-label" for="{{ 'role_' . $role->name }}">
                        {{ $role->name }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>
</fieldset>
