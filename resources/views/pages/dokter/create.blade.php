@extends('app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dokter</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Tambah Dokter</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{route('dokter.store')}}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nama">Nama Dokter</label>
                                                    <input type="text"
                                                           class="form-control @error('nama') is-invalid @enderror"
                                                           id="nama"
                                                           name="nama" placeholder="Nama Dokter">
                                                    @error('nama')
                                                    <span class="invalid-feedback">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="no_hp">No HP</label>
                                                    <input type="text"
                                                           class="form-control @error('no_hp') is-invalid @enderror"
                                                           id="no_hp"
                                                           name="no_hp" placeholder="No HP">
                                                    @error('no_hp')
                                                    <span class="invalid-feedback">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="alamat">Alamat</label>
                                                    <input type="text"
                                                           class="form-control @error('alamat') is-invalid @enderror"
                                                           id="alamat"
                                                           name="alamat" placeholder="Alamat">
                                                    @error('alamat')
                                                    <span class="invalid-feedback">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="id_poli">Poli</label>
                                                    <select name="id_poli" id="id_poli"
                                                            class="form-control @error('id_poli') is-invalid @enderror">
                                                        <option value="">Pilih Poli</option>
                                                        @foreach($poli as $row)
                                                            <option value="{{$row->id}}">{{$row->nama_poli}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('id_poli')
                                                    <span class="invalid-feedback">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password"
                                                           class="form-control @error('password') is-invalid @enderror"
                                                           id="password"
                                                           name="password" placeholder="Password">
                                                    @error('password')
                                                    <span class="invalid-feedback">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="password_konfirmasi">Password Konfirmasi</label>
                                                    <input type="password"
                                                           class="form-control @error('password_konfirmasi') is-invalid @enderror"
                                                           id="password_konfirmasi"
                                                           name="password_konfirmasi" placeholder="Password Konfirmasi">
                                                    @error('password_konfirmasi')
                                                    <span class="invalid-feedback">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="submit" value="Simpan" class="btn btn-sm btn-primary">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
