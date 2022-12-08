@extends('template.app')
@section('konten')


<div class="col-12 grid-margin stretch-card">
    
    <div class="card">
      <div class="card-body">
        <h3>Edit poli</h3>
        <p class="card-description">
          Puskesmas Sukabumi
        </p>
        <a href="{{route('poli')}}">
        <button type="button" class="btn btn-sm btn-success">
           <i class="mdi mdi-arrow-left-bold-circle"></i> Kembali
        </button></a>
        <form class="forms-sample mt-5" enctype="multipart/form-data" method="POST" action="{{ route('poli.update',$dataPoli['id']) }}">
            @csrf
            <div class="row">
              <div class="row">
                <div class="col-md-6">         
                     <div class="form-group">
                    <label for="kode_poli">Kode poli</label>
                    <input type="text" name="kode_poli" value="{{$dataPoli['kode_poli']}}" class="form-control {{ $errors->first('kode_poli') ? "is-invalid" :""}}" id="kode_poli" placeholder="Kode poli">
                  </div>

                  {{-- tampil error opsi 2 --}}
                  @error('kode_poli')
                  <div class="alert alert-danger">
                    {{ $message }}
                  </div>
                  @enderror
                </div>


               <div class="col-md-6">         
                <div class="form-group">
               <label for="nama">Nama poli</label>
               <input type="text" name="nama_poli" value="{{$dataPoli['nama_poli']}}" class="form-control {{ $errors->first('nama_poli') ? "is-invalid" :""}}" id="nama" placeholder="Nama poli">
             </div>

             {{-- tampil error opsi 2 --}}
             @error('nama_poli')
             <div class="alert alert-danger">
               {{ $message }}
             </div>
             @enderror
           </div>

           <div class="col-md-6">         
            <div class="form-group">
           <label for="ruang_poli">Ruang Poli</label>
           <input type="text" name="ruang_poli" value="{{$dataPoli['ruang_poli']}}" class="form-control {{ $errors->first('ruang_poli') ? "is-invalid" :""}}" id="ruang_poli" placeholder="Jenis poli">
            </div>

         {{-- tampil error opsi 2 --}}
            @error('ruang_poli')
            <div class="alert alert-danger">
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