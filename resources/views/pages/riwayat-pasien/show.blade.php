@extends('app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Riwayat Pasien {{$pasien->nama}}</h1>
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
                                <h3 class="card-title">Data Riwayat Pasien</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-striped table-hover ">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal Periksa</th>
                                            <th>Nama Pasien</th>
                                            <th>Nama Dokter</th>
                                            <th>Keluhan</th>
                                            <th>Catatan</th>
                                            <th>Obat</th>
                                            <th>Biaya</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($riwayat as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->tgl_periksa }}</td>
                                                <td>{{ $pasien->nama }}</td>
                                                <td>{{ $dokter->nama }}</td>
                                                <td>{{ $item->daftarPoli->keluhan }}</td>
                                                <td>{{ $item->catatan }}</td>
                                                <td>
                                                    @foreach($item->detailPeriksa as $detail)
                                                        <li>{{$detail->obat?->nama_obat}}
                                                            {{$detail->obat?->kemasan}} </li>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    {{number_format($item->total_biaya, 0, ',', '.')}}
                                                </td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{$riwayat->links()}}
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
