@extends('template.app')
@section('konten')
<script>
  function puskesmas(){
    let puskesmas = document.getElementById('puskesmas_id').value
    let text =  document.getElementById('text')

    text.innerHTML = puskesmas
  }
 </script>
<div class="col-12 grid-margin stretch-card">
    
    <div class="card">
      <div class="card-body">
        <h3>Tambah Jadwal Dokter</h3>
        <p class="card-description">
          Puskesmas Sukabumi
        </p>
        <a href="{{route('jadwal-dokter')}}">
        <button type="button" class="btn btn-sm btn-success">
           <i class="mdi mdi-arrow-left-bold-circle"></i> Kembali
        </button></a>
        <form class="forms-sample mt-5"  enctype="multipart/form-data"  method="POST" action="{{ route('jadwal-dokter.store') }}">
            @csrf
            <div class="row">

              <div class="col-md-6">         
                <div class="form-group">
               <label for="dokter_id">Nama Dokter</label>
               <select name="dokter_id" id="dokter_id" class="custom-select">Nama Dokter
                 <option hidden>-Pilih Dokter-</option>
                 @foreach ($dataDokter as $item)
                 <option value="{{ $item['id'] }}">{{ $item['nama_dokter'] }}</option>
                 @endforeach
              </select>
             {{-- <input type="text" name="dokter_id" value="{{ old('dokter_id')}}" class="form-control {{ $errors->first('dokter_id') ? "is-invalid" :""}}" id="dokter_id" placeholder="Jenis jadwal-dokter"> --}}

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
               <option hidden>-Pilih Hari-</option>
               @foreach ($hari as $item)
               <option value="{{ $item}}">{{ $item }}</option>
               @endforeach
            </select>
           {{-- <input type="text" name="hari" value="{{ old('hari')}}" class="form-control {{ $errors->first('hari') ? "is-invalid" :""}}" id="hari" placeholder="Hari"> --}}

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
           <input type="time" name="jam_masuk" value="{{ old('jam_masuk')}}" class="form-control {{ $errors->first('jam_masuk') ? "is-invalid" :""}}" id="jam_masuk" placeholder="Jenis jadwal-dokter">
            </div>

         {{-- tampil error opsi 2 --}}
            @error('jam_masuk')
            <div class="alert alert-danger">
            {{ $message }}
            </div>
            @enderror
        </div>

  
        <div class="col-md-6">         
          <div class="form-group">
         <label for="jam_keluar">Jam Keluar</label>
         <input type="time" name="jam_keluar" value="{{ old('jam_keluar')}}" class="form-control {{ $errors->first('jam_keluar') ? "is-invalid" :""}}" id="jam_keluar" placeholder="Jenis jadwal-dokter">
          </div>

       {{-- tampil error opsi 2 --}}
          @error('jam_keluar')
          <div class="alert alert-danger">
          {{ $message }}
          </div>
          @enderror
      </div>

      <div class="col-md-6">         
        <div class="form-group">
       <label for="puskesmas_id">Puskesmas & Poli</label>
       <select name="puskesmas_id" id="puskesmas_id" class="custom-select" onclick="puskesmas()">Nama Poli
         <option hidden>-Pilih Puskesmas-</option>
         @foreach ($puskesmas as $data)
         <option value="{{ $data->id }}">
          
          {{ $data->nama }}  - 
          {{ $data->nama_poli }}

        </option>

         @endforeach 

         
      </select>
      {{-- <span id="text">tes</span> --}}
     </div>

     {{-- <input type="text" name="puskesmas_id" value="{{ old('puskesmas_id')}}" class="form-control {{ $errors->first('puskesmas_id') ? "is-invalid" :""}}" id="jam_keluar" placeholder="Jenis jadwal-dokter"> --}}
     

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
               <i class="mdi mdi-checkbox-marked"></i> Simpan
            </button>
           </center>
        </form>
      </div>
    </div>
  </div>
@endsection