@extends('template.app')
@section('konten')


<div class="col-12 grid-margin stretch-card">
    
    <div class="card">
      <div class="card-body">
        <h3>Edit Kategori Buku</h3>
        <p class="card-description">
          Larabook Store
        </p>
        <a href="{{route('users')}}">
        <button type="button" class="btn btn-sm btn-success">
           <i class="mdi mdi-arrow-left-bold-circle"></i> Kembali
        </button></a>
        <form class="forms-sample mt-5" enctype="multipart/form-data" method="POST" action="{{ route('users.update',$dataUser['id']) }}">
            @csrf
            <div class="row">

                <div class="col-md-6">         
                  <div class="form-group">
                    <label for="exampleInputName1">Name</label>
                    <input type="text" name="nama" value="{{$dataUser['name']}}" class="form-control" id="exampleInputName1" placeholder="Name">
                  </div>
                </div>

                <div class="col-md-6">         
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="mail" value="{{$dataUser['email']}}" class="form-control" id="email" placeholder="email">
                  </div>
                </div>

                <div class="col-md-6">         
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="pengguna" value="{{$dataUser['username']}}" class="form-control" id="username" placeholder="masukkan username">
                  </div>
                </div>

                <div class="col-md-6">         
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="passwords" value="{{$dataUser['password']}}"  class="form-control" id="password" placeholder="password">
                  </div>
                </div>


                <div class="col-md-6">         
                  <div class="form-group">
                    <label for="address">Alamat</label>
                    <input type="text" name="address" value="{{$dataUser['address']}}" class="form-control" id="address" placeholder="Masukkan alamat">
                  </div>
                </div>

                <div class="col-md-6">         
                  <div class="form-group">
                    <label for="phone">No.Telpon</label>
                    <input type="text" name="telpon" value="{{$dataUser['phone']}}" class="form-control" id="phone" placeholder="Masukkan no.telpon">
                  </div>
                </div>

                <div class="col-md-6">         
                  <br>
                  <div class="form-group">
                   <label for="gender">Jenis Kelamin</label>
                   <select name="gender" id="gender" class="custom-select">
                     <option value="{{  $dataUser['gender']}}" hidden>
                      @if ($dataUser['gender'] == 'L')
                          {{ 'Laki-laki' }}
                      @else
                      {{ 'Perempuan' }}
                      @endif
                    </option>
                     <option value='L'>Laki-laki</option>
                     <option value='P'>Perempuan</option>
                   </select>  
                  </div>

                 </div>


                 @if ($dataUser['roles'] == '["USER"]' || $dataUser['roles'] == '["STAFF"]')
                 <div class="col-md-6">         
                  <br>
                 <div class="form-group">
                  <label for="status">Status</label>
                  <select name="status" id="status" class="custom-select">
                    <option hidden>{{  $dataUser['status']}}</option>
                    <option value="ACTIVE">Active</option>
                    <option value="INACTIVE">InActive</option>
                  </select>  
                 </div>
                @elseif($dataUser['roles'] == '["ADMIN"]')
                <input type="text" name="status" value="Active" hidden>
                 @endif
                </div>

                <div class="col-md-6">         
                  <br>
                  @if ($dataUser['roles'] == '["USER"]' || $dataUser['roles'] == '["STAFF"]')
                  <div class="form-group">
                   <label for="roles">Roles</label>
                   <select name="roles" id="roles" class="custom-select">
                     <option hidden>{{  $dataUser['roles']}}</option>
                     <option value='["STAFF"]'>Staff</option>
                     <option value='["USER"]'>User</option>
                   </select>  
                  </div>
                 @elseif($dataUser['roles'] == '["ADMIN"]')
                 <input type="text" name="roles" value='["ADMIN"]' hidden>
                  @endif
                 </div>

                <div class="col-md-6">         
                  <div class="form-group">
                    <label>Upload Avatar</label>
                    <br>
                    @if ($dataUser['avatar'])
                    <img src="{{asset('img/'.$dataUser['avatar']) }}" width="120" alt="">
                    @else
                    <small class="text-danger">Tidak Ada Avatar</small>    
                    @endif
                    
                    <input type="file" name="img[]" class="file-upload-default">
                   <input type="file" name="avatar" class="form-control">
                   <small class="text-muted">*Kosongkan jika tidak ingin mengubah avatar</small>
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