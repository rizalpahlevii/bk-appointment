@php use App\Models\Poli; @endphp
@extends('app-fe')

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card mt-5">
                <div class="card-header">
                    Pendaftaran Poli
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Sukses!</strong> {{session('success')}}<br><br>

                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Whoops!</strong> Terjadi kesalahan saat input data.<br><br>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>

                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{route('daftar-poli.store')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="no_rm">Nomor Rekam Medis</label>
                                            <input type="text" class="form-control" id="no_rm" required
                                                   name="no_rm" placeholder="Nomor Rekam Medis">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="poli_id">Poli</label>
                                            <select name="poli_id" id="poli_id" class="form-control">
                                                <option value="">Pilih Poli</option>
                                                @foreach(Poli::get() as $poli)
                                                    <option value="{{$poli->id}}">{{$poli->nama_poli}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="jadwal_id">Jadwal</label>
                                            <select name="jadwal_id" id="jadwal_id" class="form-control">
                                                <option value="">Pilih Jadwal</option>
                                                <option value="1">Senin, 08.00 - 10.00</option>
                                                <option value="2">Selasa, 08.00 - 10.00</option>
                                                <option value="3">Rabu, 08.00 - 10.00</option>
                                                <option value="4">Kamis, 08.00 - 10.00</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="keluhan">Keluhan</label>
                                            <input type="text" class="form-control" id="keluhan" required
                                                   name="keluhan" placeholder="Keluhan">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <input type="submit" value="Simpan" class="btn btn-sm btn-primary">
                                        <a href="{{route('login',['type'=>'pasien'])}}" class="btn btn-sm btn-success">
                                            Sudah punya akun? Login
                                        </a>
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
