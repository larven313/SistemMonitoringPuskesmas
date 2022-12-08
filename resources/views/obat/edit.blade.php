@extends('template.app')
@section('konten')


<div class="col-12 grid-margin stretch-card">
    
    <div class="card">
      <div class="card-body">
        <h3>Edit Obat</h3>
        <p class="card-description">
          Puskesmas Sukabumi
        </p>
        <a href="{{route('obat')}}">
        <button type="button" class="btn btn-sm btn-success">
           <i class="mdi mdi-arrow-left-bold-circle"></i> Kembali
        </button></a>
        <form class="forms-sample mt-5" enctype="multipart/form-data" method="POST" action="{{ route('obat.update',$dataObat['id']) }}">
            @csrf
            <div class="row">
              <div class="row">
                <div class="col-md-6">         
                     <div class="form-group">
                    <label for="kode_obat">Kode Obat</label>
                    <input type="text" name="kode_obat" value="{{$dataObat['kode_obat']}}" class="form-control {{ $errors->first('kode_obat') ? "is-invalid" :""}}" id="kode_obat" placeholder="Kode Obat">
                  </div>

                  {{-- tampil error opsi 2 --}}
                  @error('kode_obat')
                  <div class="alert alert-danger">
                    {{ $message }}
                  </div>
                  @enderror
                </div>


               <div class="col-md-6">         
                <div class="form-group">
               <label for="nama">Nama Obat</label>
               <input type="text" name="nama_obat" value="{{$dataObat['nama_obat']}}" class="form-control {{ $errors->first('nama_obat') ? "is-invalid" :""}}" id="nama" placeholder="Nama Obat">
             </div>

             {{-- tampil error opsi 2 --}}
             @error('nama_obat')
             <div class="alert alert-danger">
               {{ $message }}
             </div>
             @enderror
           </div>

           <div class="col-md-6">         
            <div class="form-group">
           <label for="jenis_obat">Jenis Obat</label>
           <input type="text" name="jenis_obat" value="{{$dataObat['jenis_obat']}}" class="form-control {{ $errors->first('jenis_obat') ? "is-invalid" :""}}" id="jenis_obat" placeholder="Jenis Obat">
            </div>

         {{-- tampil error opsi 2 --}}
            @error('jenis_obat')
            <div class="alert alert-danger">
            {{ $message }}
            </div>
            @enderror
        </div>

        <div class="col-md-6">         
            <div class="form-group">
           <label for="stok">Stok</label>
           <input type="number" min="0" name="stok" value="{{$dataObat['stok']}}" class="form-control {{ $errors->first('stok') ? "is-invalid" :""}}" id="stok" placeholder="Stok">
            </div>

         {{-- tampil error opsi 2 --}}
            @error('stok')
            <div class="alert alert-danger">
            {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-md-6">         
            <div class="form-group">
           <label for="min_stok">Minimal Stok</label>
           <input type="number" min="0" name="min_stok" value="{{$dataObat['min_stok']}}" class="form-control {{ $errors->first('min_stok') ? "is-invalid" :""}}" id="min_stok" placeholder="Minimal Stok">
            </div>

         {{-- tampil error opsi 2 --}}
            @error('min_stok')
            <div class="alert alert-danger">
            {{ $message }}
            </div>
            @enderror
        </div>

       
       <div class="col-md-6">         
        <div class="form-group">
       <label for="satuan">Satuan</label>
       <input type="text" name="satuan" value="{{$dataObat['satuan']}}" class="form-control {{ $errors->first('satuan') ? "is-invalid" :""}}" id="satuan" placeholder="Jenis Obat">
        </div>

     {{-- tampil error opsi 2 --}}
        @error('satuan')
        <div class="alert alert-danger">
        {{ $message }}
        </div>
        @enderror
    </div>


    <div class="col-md-6">         
        <div class="form-group">
       <label for="dosis">Dosis Aturan Obat</label>
       {{-- <input type="text" name="dosis_aturan_obat" value="{{ old('dosis_aturan_obat')}}" class="form-control {{ $errors->first('dosis_aturan_obat') ? "is-invalid" :""}}" id="exampleInputName1" placeholder="Name"> --}}
       <input type="text" name="dosis_aturan_obat" id="dosis" cols="30" rows="10" value="{{$dataObat['dosis_aturan_obat']}}" class="form-control {{ $errors->first('dosis_aturan_obat') ? "is-invalid" :""}}" placeholder="Dosis Aturan Obat">
     </div>

     {{-- tampil error opsi 2 --}}
     @error('dosis_aturan_obat')
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