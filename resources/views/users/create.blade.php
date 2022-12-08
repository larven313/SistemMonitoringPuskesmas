@extends('template.app')
@section('konten')


<div class="col-12 grid-margin stretch-card">
    
    <div class="card">
      <div class="card-body">
        <h3>Tambah Pengguna</h3>
        <p class="card-description">
          Larabook Store
        </p>
        <a href="{{route('users')}}">
        <button type="button" class="btn btn-sm btn-success">
           <i class="mdi mdi-arrow-left-bold-circle"></i> Kembali
        </button></a>
 
        <form class="forms-sample mt-5" enctype="multipart/form-data"  method="POST" action="{{ route('users.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-6">         
                     <div class="form-group">
                    <label for="exampleInputName1">Name</label>
                    <input type="text" name="name" value="{{ old('name')}}" class="form-control {{ $errors->first('name') ? "is-invalid" :""}}" id="exampleInputName1" placeholder="Name">
                   {{-- tampil error opsi 1 --}}
                    {{-- <div class="invalid-feedback">
                      {{ $errors->first('name') }}
                    </div> --}}
                  </div>

                  {{-- tampil error opsi 2 --}}
                  @error('name')
                  <div class="alert alert-danger">
                    {{ $message }}
                  </div>
                  @enderror

                </div>
                <div class="col-md-6">         
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" name="email"  class="form-control {{ $errors->first('email') ? "is-invalid" :""}}" id="email" placeholder="email" value="{{ old('email')}}">
                    </div>
                  </div>

                  @error('email')
                  <div class="alert alert-danger">
                    {{ $message }}
                  </div>
                  @enderror

                  <div class="col-md-6">         
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" name="username"  class="form-control {{ $errors->first('username') ? "is-invalid" :""}}" id="username" placeholder="masukkan username" value="{{ old('username')}}">
                    </div>
                  </div>

                  @error('username')
                  <div class="alert alert-danger">
                    {{ $message }}
                  </div>
                  @enderror
  
                  <div class="col-md-6">         
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" name="password"  class="form-control" id="password" placeholder="masukkan password">
                    </div>
                  </div>
  
  
                  <div class="col-md-6">         
                    <div class="form-group">
                      <label for="address">Alamat</label>
                      <textarea name="address"  class="form-control" id="address" placeholder="masukkan alamat" value="{{ old('address')}}"></textarea>
                    </div>
                  </div>

                  <div class="col-md-6">         
                    <div class="form-group">
                      <label for="gender">Jenis Kelamin</label>
                      <select name="gender" id="gender1" class="custom-select"><br>
                        <option hidden>Pilih</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                      </select>
                    </div>
                  </div>  
  
                  <div class="col-md-6">         
                    <div class="form-group">
                      <label for="phone">No.Telpon</label>
                      <input type="text" name="phone" class="form-control" id="phone" placeholder="masukkan no.telpon" value="{{ old('phone')}}">
                    </div>
                  </div>

                  <div class="col-md-6">         
                    <div class="form-group">
                      <label for="roles">Roles</label>
                      {{-- <input type="text" name="roles" class="form-control" id="roles" placeholder="masukkan roles"> --}}
                      <select class="custom-select" id="inputGroupSelect01" name="roles" value="{{ old('roles')}}">
                        <option hidden>Pilih</option>
                        <option value='["USER"]'>User</option>
                        <option value='["STAFF"]'>Staff</option>
                      </select>
                    </div>
                  </div>   
  
            
                  <div class="col-md-6">         
                 <div class="form-group">
                      <label  for="inputGroupSelect01">Status</label>
                    <select class="custom-select" id="inputGroupSelect01" name="status" value="{{ old('status')}}">
                      <option hidden>Pilih</option>
                      <option value="ACTIVE">ACTIVE</option>
                      <option value="INACTIVE">INACTIVE</option>
                    </select>
                  </div>
                  </div>
                  
                  <div class="col-md-6">         
                       <div class="form-group">
                      <label>Upload Avatar</label>
                      <br>
                    
                     <input type="file" name="avatar" class="form-contro {{ $errors->first('avatar') ? "is-invalid" :""}}l">
                     @error('avatar')
                     <div class="alert alert-danger mt-2">
                       {{ $message }}
                     </div>
                     @enderror
                     </div>
                     {{-- <small class="text-muted">*Kosongkan jika tidak ingin mengubah avatar</small> --}}
                  </div>
               </div>

            </div>
            <center>
                <button type="submit" class="btn btn-sm btn-primary mr-2 mt-4">
                 <i class="mdi mdi-checkbox-marked"></i> Simpan
              </button>
             </center>
          </div>
          

        </form>

      </div>
    </div>
  </div>
@endsection