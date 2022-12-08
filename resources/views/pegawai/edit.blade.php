@extends('template.app')
@section('konten')


<div class="col-12 grid-margin stretch-card">
    
    <div class="card">
      <div class="card-body">
        <h3>Edit Pegawai</h3>
        <p class="card-description">
          Puskesmas Sukabumi
        </p>
        <a href="{{route('pegawai')}}">
        <button type="button" class="btn btn-sm btn-success">
           <i class="mdi mdi-arrow-left-bold-circle"></i> Kembali
        </button></a>
        <form class="forms-sample mt-5" enctype="multipart/form-data" method="POST" action="{{ route('pegawai.update',$dataPegawai['id']) }}">
            @csrf
            <div class="row">

                <div class="col-md-6">         
                    <div class="form-group">
                    <label for="exampleInputName1">Nama</label>
                    <input type="text" name="nama" value="{{$dataPegawai['nama']}}" class="form-control {{ $errors->first('nama') ? "is-invalid" :""}}" id="exampleInputName1" placeholder="Name">
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
                   <label for="npwp">NPWP</label>
                   <input type="text" name="npwp" value="{{$dataPegawai['npwp']}}" class="form-control {{ $errors->first('npwp') ? "is-invalid" :""}}" id="npwp" placeholder="NPWP">
                  </div>
                   @error('npwp')
                   <div class="alert alert-danger">
                     {{ $message }}
                   </div>
                   @enderror
                </div>
                  



                 <div class="col-md-6">         
                    <div class="form-group">
                   <label for="alamat">Alamat</label>
                   <input type="text" name="alamat" value="{{$dataPegawai['alamat']}}" class="form-control {{ $errors->first('alamat') ? "is-invalid" :""}}" id="alamat" placeholder="Alamat">
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
                    
                    @if ($dataPegawai['gender'] == "L")
                    <option value="L" selected hidden>  {{ "Laki-laki" }}
                    </option>
                    <option value="P">  {{ "Perempuan" }}
                    </option>
                    @elseif($dataPegawai['gender']  == "P")
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
                   <label for="telp">No Telepon</label>
                   <input type="text" name="telepon" value="{{$dataPegawai['telepon']}}" class="form-control {{ $errors->first('telepon') ? "is-invalid" :""}}" id="telp" placeholder="No Telepon">
                  </div>
                  @error('telepon')
                  <div class="alert alert-danger">
                    {{ $message }}
                  </div>
                  @enderror
                 </div>

 

                 <div class="col-md-6">         
                    <div class="form-group">
                   <label for="tgl_lahir">Tanggal Lahir</label>
                   <input type="date" name="tgl_lahir" value="{{$dataPegawai['tgl_lahir']}}" class="form-control {{ $errors->first('tgl_lahir') ? "is-invalid" :""}}" id="tgl_lahir" placeholder="Tanggal Lahir">
                   @error('tgl_lahir')
                   <div class="alert alert-danger">
                     {{ $message }}
                   </div>
                   @enderror
                  </div>


                 </div>

                 <div class="col-md-6">         
                    <div class="form-group">
                   <label for="jabatan">Jabatan</label>
                   <input type="text" name="jabatan" value="{{$dataPegawai['jabatan']}}" class="form-control {{ $errors->first('jabatan') ? "is-invalid" :""}}" id="jabatan" placeholder="Jabatan">
                    </div>
                   @error('jabatan')
                   <div class="alert alert-danger">
                     {{ $message }}
                   </div>
                   @enderror
                  </div>



               
                  <div class="col-md-6">         
                    <div class="form-group">
                   <label for="bidang">Bidang</label>
                   <input type="text" name="bidang" value="{{$dataPegawai['bidang']}}" class="form-control {{ $errors->first('bidang') ? "is-invalid" :""}}" id="bidang" placeholder="Bidang">
                 </div>

                 @error('bidang')
                 <div class="alert alert-danger">
                   {{ $message }}
                 </div>
                 @enderror
                 </div>

                 {{-- <div class="col-md-6">         
                  <div class="form-group">
                 <label for="puskesmas">Puskesmas</label>
                 <select name="puskesmas_id" id="puskesmas" class="custom-select">
                   <option hidden>{{$puskesmas['0']->nama_puskesmas}}</option>

                   @foreach ($allPuskesmas as $item)
                   <option value="{{ $item->id }}">{{ $item->nama }}</option>
                   @endforeach
                 </select>
               </div>

               @error('puskesmas_id')
               <div class="alert alert-danger">
                 {{ $message }}
               </div>
               @enderror
               </div> --}}

                <div class="col-md-6">         
                     {{-- <div class="form-group">
                    <label>Upload Gambar</label>
                   <input type="file" name="avatar" class="form-control {{ $errors->first('avatar') ? "is-invalid" :""}}" value="{{$dataPegawai['avatar']}}">
                     </div> --}}
                     <div class="form-group">
                        <label>Upload Avatar</label>
                        <br>
                        @if ($dataPegawai['avatar'])
                        <img src="{{asset('img/'.$dataPegawai['avatar']) }}" width="120" alt="">
                        @else
                        <small class="text-danger">Tidak Ada Avatar</small>    
                        @endif
                        
                        <input type="file" name="img[]" class="file-upload-default">
                       <input type="file" name="avatar" class="form-control">
                       <small class="text-muted">*Kosongkan jika tidak ingin mengubah avatar</small>
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
               <i class="mdi mdi-checkbox-marked"></i> Update
            </button>
           </center>
        </form>
      </div>
    </div>
  </div>
@endsection