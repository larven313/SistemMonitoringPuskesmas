@extends('template.app')
@section('konten')


<div class="col-12 grid-margin stretch-card">
    
    <div class="card">
      <div class="card-body">
        <h3>Edit Supplier</h3>
        <p class="card-description">
          Puskesmas Sukabumi
        </p>
        <a href="{{route('suplai')}}">
        <button type="button" class="btn btn-sm btn-success">
           <i class="mdi mdi-arrow-left-bold-circle"></i> Kembali
        </button></a>
        <form class="forms-sample mt-5" enctype="multipart/form-data" method="POST" action="{{ route('suplai.update',$dataSuplai['id']) }}">
            @csrf
              <div class="row">
                <div class="col-md-6">         
                     <div class="form-group">
                    <label for="kode_supplier">Kode Supplier</label>
                    <input type="text" name="kode_supplier" value="{{$dataSuplai['kode_supplier']}}" class="form-control {{ $errors->first('kode_supplier') ? "is-invalid" :""}}" id="kode_supplier" placeholder="Kode Obat">
                  </div>

                  {{-- tampil error opsi 2 --}}
                  @error('kode_supplier')
                  <div class="alert alert-danger">
                    {{ $message }}
                  </div>
                  @enderror
                </div>


               <div class="col-md-6">         
                <div class="form-group">
               <label for="nama_supplier">Nama Obat</label>
               <input type="text" name="nama_supplier" value="{{$dataSuplai['nama_supplier']}}" class="form-control {{ $errors->first('nama_supplier') ? "is-invalid" :""}}" id="nama" placeholder="Nama Obat">
             </div>

             {{-- tampil error opsi 2 --}}
             @error('nama_supplier')
             <div class="alert alert-danger">
               {{ $message }}
             </div>
             @enderror
           </div>

           <div class="col-md-6">         
            <div class="form-group">
           <label for="perusahaan">Perusahaan</label>
           <input type="text" name="perusahaan" value="{{$dataSuplai['perusahaan']}}" class="form-control {{ $errors->first('perusahaan') ? "is-invalid" :""}}" id="perusahaan" placeholder="Nama Perusahaan">
            </div>
            {{-- tampil error opsi 2 --}}
             @error('perusahaan')
            <div class="alert alert-danger">
               {{ $message }}
            </div>
             @enderror
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