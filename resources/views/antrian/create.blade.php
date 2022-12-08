@extends('template.app')
@section('konten')


<div class="col-12 grid-margin stretch-card">
    
    <div class="card">
      <div class="card-body">
        <h3>Tambah Pasien</h3>
        <p class="card-description">
          Puskesmas Sukabumi
        </p>
        <a href="{{route('antrian')}}">
        <button type="button" class="btn btn-sm btn-success">
           <i class="mdi mdi-arrow-left-bold-circle"></i> Kembali
        </button></a>
        <form class="forms-sample mt-5"  enctype="multipart/form-data"  method="POST" action="{{ route('antrian.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-6">         
                     <div class="form-group">
                    <label for="exampleInputName1">Name</label>
                    <input type="text" name="nama" value="{{ old('nama')}}" class="form-control {{ $errors->first('nama') ? "is-invalid" :""}}" id="exampleInputName1" placeholder="Name">
                   {{-- tampil error opsi 1 --}}
                    {{-- <div class="invalid-feedback">
                      {{ $errors->first('nama') }}
                    </div> --}}
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
                    <label>Upload Gambar</label>
                   <input type="file" name="image" class="form-control {{ $errors->first('image') ? "is-invalid" :""}}">
                   {{-- tampil error opsi 1--}}
                   {{-- <div class="invalid-feedback">
                    {{ $errors->first('image') }}
                  </div> --}}

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