@php use Carbon\Carbon; @endphp
@extends('app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Periksa</h1>
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
                                <h3 class="card-title">Periksa | {{$data->pasien?->nama}}</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{route('periksa.store')}}" method="post">
                                        @csrf
                                        <div class="mb-1">
                                            <label for="nama_pasien" class="form-label">Nama Pasien</label>
                                            <input type="text"
                                                   class="form-control @error('nama_pasien') is-invalid @enderror"
                                                   id="nama_pasien" placeholder="Nama Pasien" name="nama_pasien"
                                                   readonly
                                                   value="{{$data->pasien?->nama}}">
                                            @error('nama_pasien')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-1">
                                            <label for="no_rm" class="form-label">Nomor Rekam Medis</label>
                                            <input type="text"
                                                   class="form-control @error('no_rm') is-invalid @enderror"
                                                   id="no_rm" placeholder="Nomor Rekam Medis" name="no_rm"
                                                   readonly
                                                   value="{{$data->pasien?->no_rm}}">
                                            @error('no_rm')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-1">
                                            <label for="tanggal_periksa" class="form-label">Tanggal Periksa</label>
                                            <input type="datetime-local"
                                                   class="form-control @error('tanggal_periksa') is-invalid @enderror"
                                                   id="tanggal_periksa" placeholder="Tanggal Periksa"
                                                   name="tanggal_periksa"

                                                   value="{{Carbon::now()->format('Y-m-d\TH:i')}}">
                                            @error('tanggal_periksa')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-1">
                                            <label for="catatan" class="form-label">Catatan</label>
                                            <textarea name="catatan" id="catatan"
                                                      class="form-control @error('catatan') is-invalid @enderror"
                                                      cols="30" rows="5"></textarea>
                                            @error('catatan')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-1">
                                            <label for="obat" class="form-label">Obat</label>
                                            <select name="obat[]" id="obat" class="form-control" multiple>
                                                @foreach($obat as $item)
                                                    <option value="{{$item->id}}" data-harga="{{$item->harga}}">
                                                        {{$item->nama_obat}}</option>
                                                @endforeach
                                            </select>
                                            @error('catatan')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-1">
                                            <label for="total_harga" class="form-label">Total Harga</label>
                                            <input type="text"
                                                   class="form-control @error('total_harga') is-invalid @enderror"
                                                   id="total_harga" placeholder="Nomor Rekam Medis" name="total_harga"
                                                   readonly
                                                   value="150000">
                                            @error('total_harga')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <input type="hidden" name="id_daftar_poli" value="{{$data->id}}">
                                        <div class="mb-1">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
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


@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#obat').select2();
            $('#obat').on('change', function () {
                let biaya = 150000;
                let harga = 0;
                let obat = $(this).val();
                obat.forEach(function (item) {
                    harga += parseInt($('#obat option[value=' + item + ']').data('harga'));
                });
                $('#total_harga').val(harga + biaya);
            });
        });
    </script>
@endpush
