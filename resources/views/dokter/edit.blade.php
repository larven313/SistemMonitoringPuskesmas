@extends('template.app')
@section('konten')


<div class="col-12 grid-margin stretch-card">
    
    <div class="card">
      <div class="card-body">
        <h3>Edit Dokter</h3>
        <p class="card-description">
          Puskesmas Sukabumi
        </p>
        <a href="{{route('dokter')}}">
        <button type="button" class="btn btn-sm btn-success">
           <i class="mdi mdi-arrow-left-bold-circle"></i> Kembali
        </button></a>
        <form class="forms-sample mt-5" enctype="multipart/form-data" method="POST" action="{{ route('dokter.update',$dataDokter['id']) }}">
            @csrf
            <div class="row">

              <div class="col-md-6">         
                <div class="form-group">
               <label for="kode_dokter">kode_dokter</label>
               <input type="text" name="kode_dokter" value="{{$dataDokter['kode_dokter']}}" class="form-control {{ $errors->first('kode_dokter') ? "is-invalid" :""}}" id="kode_dokter" placeholder="kode_dokter">
              </div>
               @error('kode_dokter')
               <div class="alert alert-danger">
                 {{ $message }}
               </div>
               @enderror
            </div>

                <div class="col-md-6">         
                    <div class="form-group">
                    <label for="exampleInputName1">Nama Dokter</label>
                    <input type="text" name="nama_dokter" value="{{$dataDokter['nama_dokter']}}" class="form-control {{ $errors->first('nama_dokter') ? "is-invalid" :""}}" id="exampleInputName1" placeholder="Name">
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
                   <input type="text" name="alamat" value="{{$dataDokter['alamat']}}" class="form-control {{ $errors->first('alamat') ? "is-invalid" :""}}" id="alamat" placeholder="alamat">
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
                    <select name="gender" id="gender" class="custom-select">
                    
                      @if ($dataDokter['gender'] == "L")
                      <option value="L" selected hidden>  {{ "Laki-laki" }}
                      </option>
                      <option value="P">  {{ "Perempuan" }}
                      </option>
                      @elseif($dataDokter['gender']  == "P")
                      <option value="P" selected hidden> {{ "Perempuan" }}
                        <option value="L">  {{ "Laki-laki" }}
                        </option>
                      @endif
                      
                    </select>

                  @error('gender')
                  <div class="alert alert-danger">
                    {{ $message }}
                  </div>
                  @enderror
                 </div>
                 </div>

                 <div class="col-md-6">         
                  <div class="form-group">
                 <label for="no_induk">No Induk</label>
                 <input type="text" name="no_induk" value="{{$dataDokter['no_induk']}}" class="form-control {{ $errors->first('no_induk') ? "is-invalid" :""}}" id="no_induk" placeholder="no_induk">
                </div>
                 @error('no_induk')
                 <div class="alert alert-danger">
                   {{ $message }}
                 </div>
                 @enderror
                </div>

                 <div class="col-md-6">         
                    <div class="form-group">
                   <label for="tmpt_lahir">Tempat Lahir</label>
                   <input type="text" name="tmpt_lahir" value="{{$dataDokter['tmpt_lahir']}}" class="form-control {{ $errors->first('tmpt_lahir') ? "is-invalid" :""}}" id="tmpt_lahir" placeholder="No tmpt_lahir">
                  </div>
                  @error('tmpt_lahir')
                  <div class="alert alert-danger">
                    {{ $message }}
                  </div>
                  @enderror
                 </div>

 

                 <div class="col-md-6">         
                    <div class="form-group">
                   <label for="tgl_lahir">Tanggal Lahir</label>
                   <input type="date" name="tgl_lahir" value="{{$dataDokter['tgl_lahir']}}" class="form-control {{ $errors->first('tgl_lahir') ? "is-invalid" :""}}" id="tgl_lahir" placeholder="Tanggal Lahir">
                   @error('tgl_lahir')
                   <div class="alert alert-danger">
                     {{ $message }}
                   </div>
                   @enderror
                  </div>
                 </div>

                 
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
               <i class="mdi mdi-checkbox-marked"></i> Update
            </button>
           </center>
        </form>
      </div>
    </div>
  </div>
@endsection