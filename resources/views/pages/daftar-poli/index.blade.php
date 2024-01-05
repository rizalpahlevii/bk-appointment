@php use App\Models\Poli; @endphp
@extends('app-fe')

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card mt-2">
                <div class="card-header">
                    Pendaftaran Poli
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{route('daftar-poli.store')}}" method="post">
                                @csrf

                                <div class="mb-1">
                                    <label for="no_rm" class="form-label">Nomor Rekam Medis</label>
                                    <input type="text" class="form-control @error('no_rm') is-invalid @enderror"
                                           id="no_rm" placeholder="Nomor Rekam Medis" name="no_rm">
                                    @error('no_rm')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-1">
                                    <label for="id_poli" class="form-label">Poli</label>
                                    <select name="id_poli" id="id_poli"
                                            class="form-control @error('id_poli') is-invalid @enderror">
                                        <option value="">Pilih Poli</option>
                                        @foreach($poli as $_poli)
                                            <option value="{{$_poli->id}}">{{$_poli->nama_poli}}</option>
                                        @endforeach
                                    </select>
                                    @error('id_poli')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>


                                <div class="mb-1">
                                    <label for="id_jadwal" class="form-label">Jadwal</label>
                                    <select name="id_jadwal" id="id_jadwal"
                                            class="form-control @error('id_jadwal') is-invalid @enderror">
                                        <option value="">Pilih Jadwal</option>

                                    </select>
                                    @error('id_jadwal')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-1">
                                    <label for="keluhan" class="form-label">Keluhan</label>
                                    <input type="text" class="form-control @error('keluhan') is-invalid @enderror"
                                           id="keluhan" placeholder="Keluhan" name="keluhan">
                                    @error('no_rm')
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

@push('script')
    <script>
        const poliElement = document.getElementById('id_poli');
        poliElement.addEventListener('change', function (e) {
            const poliId = e.target.value;
            const jadwalElement = document.getElementById('id_jadwal');
            jadwalElement.innerHTML = '';
            if (poliId === '') {
                jadwalElement.innerHTML = '<option value="">Pilih Jadwal</option>';
                return;
            }
            let url = `{{route('json.poli.jadwal', ':id')}}`;
            url = url.replace(':id', poliId);
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    data.data.forEach(jadwal => {
                        jadwalElement.innerHTML += `<option value="${jadwal.id}">${jadwal.hari}, ${jadwal.jam_mulai} - ${jadwal.jam_selesai}</option>`;
                    });
                });
        });
    </script>
@endpush
