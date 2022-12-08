@extends('template.app')
@section('konten')


<div class="col-12 grid-margin stretch-card">
    
    <div class="card">
      <div class="card-body">
        <h3>Tambah Pasien</h3>
        <p class="card-description">
          Puskesmas Sukabumi
        </p>
        <a href="{{route('categories')}}">
        <button type="button" class="btn btn-sm btn-success">
           <i class="mdi mdi-arrow-left-bold-circle"></i> Kembali
        </button></a>
        <form class="forms-sample mt-5"  enctype="multipart/form-data"  method="POST" action="{{ route('categories.store') }}">
          @csrf
          <div class="row">
              <div class="col-md-6">         
                   <div class="form-group">
                  <label for="exampleInputName1">Name</label>
                  <input type="text" name="nama" value="{{ old('nama')}}" class="form-control {{ $errors->first('nama') ? "is-invalid" :""}}" id="exampleInputName1" placeholder="Name">
                </div>

                {{-- tampil error opsi 2 --}}
                @error('nama')
                <div class="alert alert-danger">
                  {{ $message }}
                </div>
                @enderror
              </div>

              <div class="col-md-6">         
                <div class="form-group">
               <label for="exampleInputName1">NIK</label>
               <input type="text" name="nik" value="{{ old('nik')}}" class="form-control {{ $errors->first('nik') ? "is-invalid" :""}}" id="exampleInputName1" placeholder="NIK">
             </div>

             {{-- tampil error opsi 2 --}}
             @error('nik')
             <div class="alert alert-danger">
               {{ $message }}
             </div>
             @enderror
           </div>

              <div class="col-md-6">         
                <div class="form-group">
               <label for="exampleInputName1">Jenis Kelamin</label><br>
               <select name="gender" id="gender" class="{{ $errors->first('nama') ? "is-invalid" :""}} custom-select">
              <option hidden>Pilih</option>
                 <option value="L">Laki-laki</option>
                 <option value="P">Perempuan</option>
               </select>
               {{-- <input type="text" name="nama" value="{{ old('nama')}}" class="form-control {{ $errors->first('nama') ? "is-invalid" :""}}" id="exampleInputName1" placeholder="Name"> --}}
             </div>

             {{-- tampil error opsi 2 --}}
             @error('gender')
             <div class="alert alert-danger">
               {{ $message }}
             </div>
             @enderror
           </div>

           <div class="col-md-6">         
            <div class="form-group">
           <label for="exampleInputName1">Alamat</label>
           <input type="text" name="alamat" value="{{ old('alamat')}}" class="form-control {{ $errors->first('alamat') ? "is-invalid" :""}}" id="exampleInputName1" placeholder="Alamat">
         </div>

         {{-- tampil error opsi 2 --}}
         @error('alamat')
         <div class="alert alert-danger">
           {{ $message }}
         </div>
         @enderror
       </div>

            <div class="col-md-6">         
              <div class="form-group">
            <label for="exampleInputName1">Tanggal Kunjungan</label>
            <input type="date" name="tgl_kunjungan" value="{{ old('tgl_kunjungan')}}" class="form-control {{ $errors->first('tgl_kunjungan') ? "is-invalid" :""}}" id="exampleInputName1" placeholder="tanggal Kunjungan">
          </div>

          {{-- tampil error opsi 2 --}}
          @error('tgl_kunjungan')
          <div class="alert alert-danger">
            {{ $message }}
          </div>
          @enderror
        </div>

        <div class="col-md-6">         
          <div class="form-group">
        <label for="jam_kunjungan">Jam Kunjungan</label>
        <input type="time" name="jam_kunjungan" value="{{ old('jam_kunjungan')}}" class="form-control {{ $errors->first('jam_kunjungan') ? "is-invalid" :""}}" id="jam_kunjungan" placeholder="tanggal Kunjungan">
      </div>

      {{-- tampil error opsi 2 --}}
      @error('jam_kunjungan')
      <div class="alert alert-danger">
        {{ $message }}
      </div>
      @enderror
    </div>


    <div class="col-md-6">         
      <div class="form-group">
    <label for="exampleInputName1">Puskesmas & Poli</label><br>
    <select name="puskesmas_id" id="puskesmas_id" class="custom-select" onclick="puskesmas()">Nama Poli
      <option hidden>-Pilih Puskesmas-</option>
      @foreach ($puskesmas as $data)

      {{-- @foreach ($puskesmas as $item) --}}

      <option value="{{ $data->id }}">
       {{-- <input type="text" value="{{ $data->nama }}" id="puskesmas"> --}}
       {{ $data->nama }}  - 
       {{ $data->nama_poli }}
       {{-- @endforeach --}}
 

     </option>
       @endforeach 
   </select>
  </div>
    {{-- {{  $id_puskesmas->id_puskesmas  }}
    <div class="col-md-6">         
      <div class="form-group">
        <label for="exampleInputName1">Puskesmas & Poli</label><br>
        <input type="text" name="puskesmas_id" value="{{ $id_puskesmas->id_puskesmas }}">
      </div>
    </div> --}}

           

          {{-- tampil error opsi 2 --}}
          @error('puskesmas_id')
          <div class="alert alert-danger">
            {{ $message }}
          </div>
          @enderror
        </div>

          <div class="col-md-6">         
            <div class="form-group">
          <label for="status_bayar">Status Bayar</label>
          <br>
          <select name="status_bayar" id="status_bayar" class="custom-select">
            <option hidden>Pilih</option>
            <option value="Bayar">Bayar</option>
            <option value="BPJS">BPJS</option>
          </select>
          </div>

            {{-- tampil error opsi 2 --}}
            @error('status_bayar')
            <div class="alert alert-danger">
            {{ $message }}
            </div>
            @enderror
            </div>

            <div class="col-md-6">         
              <div class="form-group">
             <label for="exampleInputName1">No BPJS</label>
             <input type="text" name="no_bpjs" value="{{ old('no_bpjs')}}" class="form-control {{ $errors->first('no_bpjs') ? "is-invalid" :""}}" id="exampleInputName1" placeholder="No BPJS">
           </div>

           {{-- tampil error opsi 2 --}}
           @error('no_bpjs')
           <div class="alert alert-danger">
             {{ $message }}
           </div>
           @enderror
         </div>
         <input type="hidden" name="status_antrian" value="Antri" class="form-control">
         <input type="hidden" name="no_antrian" value="" class="form-control">

         {{-- tambah ini --}}
         @if (Route::has('login'))
             @auth
         <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" class="form-control">
                 
             
         @else
         <input type="hidden" name="user_id" value="" class="form-control">

         @endauth
         @endif
         



              <div class="col-md-6">         
                   <div class="form-group">
                  <label>Upload Gambar</label>
                 <input type="file" name="image" class="form-control {{ $errors->first('image') ? "is-invalid" :""}}">
                 {{-- tampil error opsi 1--}}
                 {{-- <div class="invalid-feedback">
                  {{ $errors->first('image') }}
                </div> --}}

                {{-- tampil error opsi 2 --}}
                @error('image')
                <script>
                  alert("Gagal membuat antrian")
                </script>
                <div class="alert alert-danger mt-2">
                  {{ $message }}
                </div>
                @enderror
                </div>
                <small class="text-muted">*Gambar tidak boleh dikosongkan</small>

           </div>
        </div>
         <center>
          {{-- <a style="text-decoration: none" href="{{route('antrian.show',$item->id)}}"> --}}
          <button type="submit" class="btn btn-sm btn-primary mr-2 mt-4">
             <i class="mdi mdi-checkbox-marked"></i> Daftar
          </button>
          {{-- </a> --}}
         </center>
      </form>
      </div>
    </div>
  </div>
@endsection