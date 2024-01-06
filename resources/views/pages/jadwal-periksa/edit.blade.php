@extends('app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Jadwal Periksa</h1>
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
                                <h3 class="card-title">Edit Jadwal Periksa</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{route('jadwal-periksa.update',$data->id)}}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="hari">Nama Dokter</label>
                                                    <select name="hari" id="hari"
                                                            class="form-control @error('hari') is-invalid @enderror">
                                                        <option value="">Pilih Hari</option>
                                                        <option
                                                            value="Senin" {{$data->hari === 'Senin' ? 'selected':''}}>
                                                            Senin
                                                        </option>
                                                        <option
                                                            value="Selasa" {{$data->hari === 'Selasa' ? 'selected':''}}>
                                                            Selasa
                                                        </option>
                                                        <option value="Rabu" {{$data->hari === 'Rabu' ? 'selected':''}}>
                                                            Rabu
                                                        </option>
                                                        <option
                                                            value="Kamis" {{$data->hari === 'Kamis' ? 'selected':''}}>
                                                            Kamis
                                                        </option>
                                                        <option
                                                            value="Jumat" {{$data->hari === 'Jumat' ? 'selected':''}}>
                                                            Jumat
                                                        </option>
                                                        <option
                                                            value="Sabtu" {{$data->hari === 'Sabtu' ? 'selected':''}}>
                                                            Sabtu
                                                        </option>
                                                        <option
                                                            value="Minggu" {{$data->hari === 'Minggu' ? 'selected':''}}>
                                                            Minggu
                                                        </option>
                                                    </select>
                                                    @error('hari')
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
                                                    <label for="jam_mulai">Jam Mulai</label>
                                                    <input type="time"
                                                           class="form-control @error('jam_mulai') is-invalid @enderror"
                                                           id="jam_mulai"
                                                           name="jam_mulai" placeholder="Jam Mulai"
                                                           value="{{$data->jam_mulai}}">
                                                    @error('jam_mulai')
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
                                                    <label for="jam_selesai">Jam Selesai</label>
                                                    <input type="time"
                                                           class="form-control @error('jam_selesai') is-invalid @enderror"
                                                           id="jam_selesai"
                                                           name="jam_selesai" placeholder="Jam Selesai"
                                                           value="{{$data->jam_selesai}}">
                                                    @error('jam_selesai')
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
