@extends('template.app')
@section('konten')
    
<div class="col-12 grid-margin stretch-card">
    
    <div class="card">
      <div class="card-body">
        <h3>Tambah dokter</h3>
        <p class="card-description">
          Puskesmas Sukabumi
        </p>
        <a href="{{route('dokter')}}">
        <button type="button" class="btn btn-sm btn-success">
           <i class="mdi mdi-arrow-left-bold-circle"></i> Kembali
        </button></a>
        <form class="forms-sample mt-5"  enctype="multipart/form-data"  method="POST" action="{{ route('dokter.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-6">         
                     <div class="form-group">
                    <label for="kode_dokter">Kode dokter</label>
                    <input type="text" name="kode_dokter" value="{{ old('kode_dokter')}}" class="form-control {{ $errors->first('kode_dokter') ? "is-invalid" :""}}" id="kode_dokter" placeholder="Kode dokter">
                  </div>

                  {{-- tampil error opsi 2 --}}
                  @error('kode_dokter')
                  <div class="alert alert-danger">
                    {{ $message }}
                  </div>
                  @enderror
                </div>


               <div class="col-md-6">         
                <div class="form-group">
               <label for="nama">Nama dokter</label>
               <input type="text" name="nama_dokter" value="{{ old('nama_dokter')}}" class="form-control {{ $errors->first('nama_dokter') ? "is-invalid" :""}}" id="nama" placeholder="Nama dokter">
             </div>

             {{-- tampil error opsi 2 --}}
             @error('nama_dokter')
             <div class="alert alert-danger">
               {{ $message }}
             </div>
             @enderror
           </div>

           <div class="col-md-6">         
            <div class="form-group">
           <label for="alamat">Alamat</label>
           <input type="text" name="alamat" value="{{ old('alamat')}}" class="form-control {{ $errors->first('alamat') ? "is-invalid" :""}}" id="alamat" placeholder="Jenis dokter">
            </div>

         {{-- tampil error opsi 2 --}}
            @error('alamat')
            <div class="alert alert-danger">
            {{ $message }}
            </div>
            @enderror
        </div>

        <div class="col-md-6">     
                  
          <label for="gender">
            Jenis Kelamin
          </label><br> 

          <div class="form-select">
          <select name="gender" id="gender1" class="custom-select">
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
          </select>
          </div>

            @error('gender')
            <div class="alert alert-danger">
              {{ $message }}
            </div>
            @enderror
         </div>

        <div class="col-md-6">         
            <div class="form-group">
           <label for="no_induk">No Induk Dokter</label>
           <input type="number" min="0" name="no_induk" value="{{ old('no_induk')}}" class="form-control {{ $errors->first('no_induk') ? "is-invalid" :""}}" id="no_induk" placeholder="Minimal Stok">
            </div>

         {{-- tampil error opsi 2 --}}
            @error('no_induk')
            <div class="alert alert-danger">
            {{ $message }}
            </div>
            @enderror
        </div>

       
       <div class="col-md-6">         
        <div class="form-group">
       <label for="tmpt_lahir">Tempat Lahir</label>
       <input type="text" name="tmpt_lahir" value="{{ old('tmpt_lahir')}}" class="form-control {{ $errors->first('tmpt_lahir') ? "is-invalid" :""}}" id="tmpt_lahir" placeholder="Alamat">
        </div>

     {{-- tampil error opsi 2 --}}
        @error('tmpt_lahir')
        <div class="alert alert-danger">
        {{ $message }}
        </div>
        @enderror
    </div>


    <div class="col-md-6">         
        <div class="form-group">
       <label for="dosis">Tanggal Lahir</label>
       <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir')}}" class="form-control {{ $errors->first('tgl_lahir') ? "is-invalid" :""}}" id="exampleInputName1" placeholder="Name">
       
     </div>

     {{-- tampil error opsi 2 --}}
     @error('tgl_lahir')
     <div class="alert alert-danger">
       {{ $message }}
     </div>
     @enderror
   </div>

   @if (Auth::user()->roles == '["ADMIN"]')
   <div class="col-md-6">         
    <div class="form-group">
   <label for="puskesmas">Puskesmas</label>
   <select name="puskesmas_id" id="puskesmas" class="custom-select">
     <option hidden>-Pilih Puskesmas-</option>
     @foreach ($puskesmas_admin as $item)
     <option value="{{ $item->id }}">{{ $item->nama }}</option>
     @endforeach
   </select>
 </div>
   </div>

 @error('puskesmas_id')
 <div class="alert alert-danger">
   {{ $message }}
 </div>
 @enderror
 </div>    

   @else

   <div class="col-md-6">         
    <div class="form-group">
   <label for="puskesmas">Puskesmas</label>
   <select name="puskesmas_id" id="puskesmas" class="custom-select">
     @foreach ($puskesmas as $item)
     <option value="{{ $item->id_puskesmas }}" hidden selected>{{ $item->nama }}</option>
     @endforeach
   </select>
 </div>
   </div>

   @endif

            <div class="col-md-6">         
              <div class="form-group">
            <label>Upload Gambar</label>
            <input type="file" name="image" class="form-control {{ $errors->first('image') ? "is-invalid" :""}}">
              </div>

          {{-- tampil error opsi 2 --}}
          @error('image')
          <div class="alert alert-danger mt-2">
            {{ $message }}
          </div>
          @enderror
          </div>


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