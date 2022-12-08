@extends('template.app')
@section('konten')


<div class="col-12 grid-margin stretch-card">
    
    <div class="card">
      <div class="card-body">
        <h3>Edit Obat</h3>
        <p class="card-description">
          Puskesmas Sukabumi
        </p>
        <a href="{{route('jadwal-dokter')}}">
        <button type="button" class="btn btn-sm btn-success">
           <i class="mdi mdi-arrow-left-bold-circle"></i> Kembali
        </button></a>
        <form class="forms-sample mt-5" enctype="multipart/form-data" method="POST" action="{{ route('jadwal-dokter.update',$dataJadwal['id']) }}">
            @csrf
            <div class="row">
              <div class="col-md-6">         
                <div class="form-group">
               <label for="dokter_id"> Nama Dokter </label>
               
               <select name="dokter_id" id="dokter_id" class="custom-select">Nama Dokter
                <option  hidden>{{$dataJadwal['dokter_id']}}</option>
                @foreach ($dataDokter as $item)
                <option value="{{ $item['id'] }}">{{ $item['nama_dokter'] }}</option>
                @endforeach
             </select>
             </div>

             {{-- tampil error opsi 2 --}}
             @error('dokter_id')
             <div class="alert alert-danger">
               {{ $message }}
             </div>
             @enderror
           </div>

                <div class="col-md-6">         
                     <div class="form-group">
                    <label for="hari">Hari</label>
                    <select name="hari" id="hari" class="custom-select">Hari
                      <option hidden value="{{ $dataJadwal['hari'] }}">{{ $dataJadwal['hari'] }}</option>
                      @foreach ($hari as $day)
                      <option value="{{ $day }}">{{ $day }}
                      </option>
                      @endforeach
                 </select>
                  </div>

                  {{-- tampil error opsi 2 --}}
                  @error('hari')
                  <div class="alert alert-danger">
                    {{ $message }}
                  </div>
                  @enderror
                </div>






           <div class="col-md-6">         
            <div class="form-group">
           <label for="jam_masuk">Jam Masuk</label>
           <input type="time" name="jam_masuk" value="{{$dataJadwal['jam_masuk']}}" class="form-control {{ $errors->first('jam_masuk') ? "is-invalid" :""}}" id="jam_masuk" placeholder="jam_masuk">
            </div>
           @error('jam_masuk')
           <div class="alert alert-danger">
             {{ $message }}
           </div>
           @enderror
          </div>


          <div class="col-md-6">         
            <div class="form-group">
           <label for="jam_keluar">Jam Keluar</label>
           <input type="time" name="jam_keluar" value="{{$dataJadwal['jam_keluar']}}" class="form-control {{ $errors->first('jam_keluar') ? "is-invalid" :""}}" id="jam_keluar" placeholder="jam_keluar">
            </div>
           @error('jam_keluar')
           <div class="alert alert-danger">
             {{ $message }}
           </div>
           @enderror
          </div>

          <div class="col-md-12">         
            <div class="form-group">
           <label for="puskesmas_id">Puskesmas & Poli</label>
           <select name="puskesmas_id" id="puskesmas_id" class="custom-select">
            <option hidden value="{{ $dataJadwal['puskesmas_id'] }}">{{ $dataJadwal['puskesmas_id'] }}</option>
            @foreach ($puskesmas as $data)
            <option value="{{ $data->id }}">
              {{ $data->nama }}  - 
              {{ $data->nama_poli }}
            </option>
            @endforeach
       </select>
           {{-- <input type="text" name="puskesmas_id" value="{{ old('puskesmas_id')}}" class="form-control {{ $errors->first('puskesmas_id') ? "is-invalid" :""}}" id="nama" placeholder="Nama Obat"> --}}
         </div>

         {{-- tampil error opsi 2 --}}
         @error('puskesmas_id')
         <div class="alert alert-danger">
           {{ $message }}
         </div>
         @enderror
       </div>

          </div>
           <center>
            <button type="submit" class="btn btn-sm btn-primary mr-2 mt-4">
               <i class="mdi mdi-checkbox-marked"></i> Update
            </button>
           </center>
        </form>
      </div>
    </div>
  </div>
@endsection