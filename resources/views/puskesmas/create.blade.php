@extends('template.app')
@section('konten')
@if (session('status'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
 {{session('status')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div> 
@endif
<div class="col-12 grid-margin stretch-card">

    <div class="card">
      <div class="card-body">
        <h3>Tambah puskesmas</h3>
        <p class="card-description">
          Puskesmas Sukabumi
        </p>
        <a href="{{route('puskesmas')}}">
        <button type="button" class="btn btn-sm btn-success">
           <i class="mdi mdi-arrow-left-bold-circle"></i> Kembali
        </button></a>
        <form class="forms-sample mt-5"  enctype="multipart/form-data"  method="POST" action="{{ route('puskesmas.store') }}">
            @csrf
            <div class="row">
              <div class="col-md-6">         
                <div class="form-group">
               <label for="puskesmas_id">Nama Puskesmas</label>
               <select name="puskesmas_id" id="puskesmas_id" class="custom-select">Nama Puskesmas
                 <option hidden>-Pilih Puskesmas-</option>
                 @foreach ($dataPoli as $item)
                 <option value="{{ $item->id_puskesmas }}">{{ $item->nama_puskesmas }}</option>
                 @endforeach
              </select>
             </div>

             {{-- tampil error opsi 2 --}}
             @error('puskesmas_id')
             <div class="alert alert-danger">
               {{ $message }}
             </div>
             @enderror
           </div>


               <div class="col-md-6">         
                <div class="form-group">
               <label for="nama_poli">Nama Poli</label>
               <select name="poli_id" id="poli_id" class="custom-select">Nama Poli
                <option hidden>-Pilih Poli-</option>
                @foreach ($dataPoli as $item)
                <option value="{{ $item->id_poli }}">{{ $item->nama_poli }}</option>
                @endforeach
             </select>
             </div>

             {{-- tampil error opsi 2 --}}
             @error('nama_poli')
             <div class="alert alert-danger">
               {{ $message }}
             </div>
             @enderror
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