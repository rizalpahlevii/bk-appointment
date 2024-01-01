@extends('app-fe')

@section('content')
    <div class="row mb-2">
        <div class="col-md-6 offset-md-3">
            <div class="card mt-5">
                <div class="card-header">
                    Pendaftaran
                </div>
                <div class="card-body">
                    <div class="row">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{route('daftar.store')}}" method="post">
                                @csrf

                                <div class="mb-1">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                           id="nama" placeholder="Nama" name="nama">
                                    @error('nama')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-1">
                                    <label for="no_hp" class="form-label">No HP</label>
                                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                           id="no_hp" placeholder="No HP" name="no_hp">
                                    @error('no_hp')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-1">
                                    <label for="no_ktp" class="form-label">No KTP</label>
                                    <input type="text" class="form-control @error('no_ktp') is-invalid @enderror"
                                           id="no_ktp" placeholder="No KTP" name="no_ktp">
                                    @error('no_ktp')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-1">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                           id="alamat" placeholder="Alamat" name="alamat">
                                    @error('alamat')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-1">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                           id="password" placeholder="Password" name="password">
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-1">
                                    <label for="password_konfirmasi" class="form-label">Password</label>
                                    <input type="password"
                                           class="form-control @error('password_konfirmasi') is-invalid @enderror"
                                           id="password_konfirmasi" placeholder="Password Konfirmasi"
                                           name="password_konfirmasi">
                                    @error('password_konfirmasi')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <input type="submit" value="Daftar" class="btn btn-sm btn-primary">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
