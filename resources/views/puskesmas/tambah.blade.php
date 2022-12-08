@extends('template.app')
@section('konten')
    
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
        <form class="forms-sample mt-5"  enctype="multipart/form-data"  method="POST" action="{{ route('puskesmas.proses') }}">
            @csrf
            <div class="row">
                <div class="col-md-6">         
                     <div class="form-group">
                    <label for="kode_puskesmas">Kode puskesmas</label>
                    <input type="text" name="kode_puskesmas" value="{{ old('kode_puskesmas')}}" class="form-control {{ $errors->first('kode_puskesmas') ? "is-invalid" :""}}" id="kode_puskesmas" placeholder="Kode puskesmas">
                  </div>

                  {{-- tampil error opsi 2 --}}
                  @error('kode_puskesmas')
                  <div class="alert alert-danger">
                    {{ $message }}
                  </div>
                  @enderror
                </div>


               <div class="col-md-6">         
                <div class="form-group">
               <label for="nama">Nama puskesmas</label>
               <input type="text" name="nama" value="{{ old('nama')}}" class="form-control {{ $errors->first('nama') ? "is-invalid" :""}}" id="nama" placeholder="Nama puskesmas">
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
           <label for="alamat">Alamat</label>
           <input type="text" name="alamat" value="{{ old('alamat')}}" class="form-control {{ $errors->first('alamat') ? "is-invalid" :""}}" id="alamat" placeholder="Alamat">
            </div>

         {{-- tampil error opsi 2 --}}
            @error('alamat')
            <div class="alert alert-danger">
            {{ $message }}
            </div>
            @enderror
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="admin_id">Admin Puskesmas</label>
            <select name="admin_id" id="admin_id" class="custom-select {{ $errors->first('alamat') ? "is-invalid" :""}}">
              <option hidden>-Pilih Admin-</option>
              @foreach ($users as $item)
              <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
              @endforeach
            </select>
          </div>

          @error('admin_id')
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