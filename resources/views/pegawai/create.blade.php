@extends('template.app')
@section('konten')


<div class="col-12 grid-margin stretch-card">
    
    <div class="card">
      <div class="card-body">
        <h3>Tambah Pegawai</h3>
        <p class="card-description">
          Puskesmas Sukabumi
        </p>
        <a href="{{route('pegawai')}}">
        <button type="button" class="btn btn-sm btn-success">
           <i class="mdi mdi-arrow-left-bold-circle"></i> Kembali
        </button></a>
        <form class="forms-sample mt-5"  enctype="multipart/form-data"  method="POST" action="{{ route('pegawai.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-6">         
                    <div class="form-group">
                    <label for="exampleInputName1">Nama</label>
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
                   <label for="exampleInputName1">NPWP</label>
                   <input type="text" name="npwp" value="{{ old('npwp')}}" class="form-control {{ $errors->first('npwp') ? "is-invalid" :""}}" id="exampleInputName1" placeholder="NPWP">
                  </div>
                   @error('npwp')
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
                    <option hidden>-Pilih Gender-</option>
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
                   <label for="exampleInputName1">No Telepon</label>
                   <input type="text" name="telepon" value="{{ old('telepon')}}" class="form-control {{ $errors->first('telepon') ? "is-invalid" :""}}" id="exampleInputName1" placeholder="No Telepon">
                  </div>
                  @error('telepon')
                  <div class="alert alert-danger">
                    {{ $message }}
                  </div>
                  @enderror
                 </div>

 

                 <div class="col-md-6">         
                    <div class="form-group">
                   <label for="exampleInputName1">Tanggal Lahir</label>
                   <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir')}}" class="form-control {{ $errors->first('tgl_lahir') ? "is-invalid" :""}}" id="exampleInputName1" placeholder="Tanggal Lahir">
                   @error('tgl_lahir')
                   <div class="alert alert-danger">
                     {{ $message }}
                   </div>
                   @enderror
                  </div>


                 </div>

                 <div class="col-md-6">         
                    <div class="form-group">
                   <label for="exampleInputName1">Jabatan</label>
                   <input type="text" name="jabatan" value="{{ old('jabatan')}}" class="form-control {{ $errors->first('jabatan') ? "is-invalid" :""}}" id="exampleInputName1" placeholder="Jabatan">
                    </div>
                   @error('jabatan')
                   <div class="alert alert-danger">
                     {{ $message }}
                   </div>
                   @enderror
                  </div>



               
                  <div class="col-md-6">         
                    <div class="form-group">
                   <label for="exampleInputName1">Bidang</label>
                   <input type="text" name="bidang" value="{{ old('bidang')}}" class="form-control {{ $errors->first('bidang') ? "is-invalid" :""}}" id="exampleInputName1" placeholder="Bidang">
                 </div>

                 @error('bidang')
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
                   @foreach ($puskesmas as $item)
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
                   @foreach ($id_puskesmas as $item)
                   <option value="{{ $item->id_puskesmas }}" hidden selected>{{ $item->nama }}</option>
                   @endforeach
                 </select>
               </div>
                 </div>

                 @endif


                <div class="col-md-6">         
                     <div class="form-group">
                    <label>Upload Gambar</label>
                   <input type="file" name="avatar" class="form-control {{ $errors->first('avatar') ? "is-invalid" :""}}">
                     </div>

                  {{-- tampil error opsi 2 --}}
                  @error('avatar')
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