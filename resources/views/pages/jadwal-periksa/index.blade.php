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
                                <h3 class="card-title">Data Jadwal Periksa</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{route('jadwal-periksa.create')}}" class="btn btn-primary mb-3">Tambah</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Hari</th>
                                            <th>Jam Mulai</th>
                                            <th>Jam Selesai</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($jadwal as $row)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$row->hari}}</td>
                                                <td>{{$row->jam_mulai}}</td>
                                                <td>{{$row->jam_selesai}}</td>
                                                <td>
                                                    {{$row->aktif === 'N' ? 'Nonaktif' : 'Aktif'}}
                                                </td>
                                                <td>
                                                    @if($row->aktif === 'Y')
                                                        <form action="{{route('jadwal-periksa.switch', $row->id)}}"
                                                              method="post">
                                                            @csrf
                                                            <button class="btn btn-danger btn-sm">Nonaktifkan</button>
                                                        </form>
                                                    @else
                                                        <form action="{{route('jadwal-periksa.switch', $row->id)}}"
                                                              method="post">
                                                            @csrf
                                                            <button class="btn btn-primary btn-sm">Aktifkan</button>
                                                        </form>
                                                    @endif
                                                    <a href="{{route('jadwal-periksa.edit', $row->id)}}"
                                                       class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="{{route('jadwal-periksa.destroy', $row->id)}}"
                                                          method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>

                                    </table>
                                    {{$jadwal->links()}}
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
