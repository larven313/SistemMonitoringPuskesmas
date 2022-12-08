@extends('template.app')
@section('konten')
    
<div class="col-12 grid-margin stretch-card">
    
    <div class="card">
      <div class="card-body">
        <h3>Tambah Supplier</h3>
        <p class="card-description">
          Puskesmas Sukabumi
        </p>
        <a href="{{route('suplai')}}">
        <button type="button" class="btn btn-sm btn-success">
           <i class="mdi mdi-arrow-left-bold-circle"></i> Kembali
        </button></a>
        <form class="forms-sample mt-5"  enctype="multipart/form-data"  method="POST" action="{{ route('suplai.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-6">         
                     <div class="form-group">
                    <label for="kode_supplier">Kode Supplier</label>
                    <input type="text" name="kode_supplier" value="{{ old('kode_supplier')}}" class="form-control {{ $errors->first('kode_supplier') ? "is-invalid" :""}}" id="kode_supplier" placeholder="Kode Obat">
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
               <label for="nama_supplier">Nama Supplier</label>
               <input type="text" name="nama_supplier" value="{{ old('nama_supplier')}}" class="form-control {{ $errors->first('nama_supplier') ? "is-invalid" :""}}" id="nama" placeholder="Nama Supplier">
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
           <label for="perusahaan">Nama Perusahaan</label>
           <input type="text" name="perusahaan" value="{{ old('perusahaan')}}" class="form-control {{ $errors->first('perusahaan') ? "is-invalid" :""}}" id="perusahaan" placeholder="Nama Perusahaan">
            </div>

         {{-- tampil error opsi 2 --}}
            @error('perusahaan')
            <div class="alert alert-danger">
            {{ $message }}
            </div>
            @enderror
        </div>

        
        @if (Auth::user()->roles == '["ADMIN"]')
        <div class="col-md-6">         
         <div class="form-group">
        <label for="puskesmas">Puskesmas</label>
        <select name="puskesmas_id" id="puskesmas" class="custom-select">
          <option hidden>-Pilih Puskesmas-</option>
          @foreach ($puskesmas_admin as $item)
          <option value="{{ $item->id }}">{{ $item->nama }}</option>
          @endforeach
        </select>
      </div>
        </div>

      @error('puskesmas_id')
      <div class="alert alert-danger">
        {{ $message }}
      </div>
      @enderror
      </div>    

        @else

        <div class="col-md-6">         
         <div class="form-group">
        <label for="puskesmas">Puskesmas</label>
        <select name="puskesmas_id" id="puskesmas" class="custom-select">
          @foreach ($puskesmas as $item)
           @if ($item == null)
               <option hidden>Staff belum menjadi Admin Puskesmas</option>
           @else
               
           @endif
          <option value="{{ $item->id_puskesmas }}" hidden selected>{{ $item->nama }}</option>
          @endforeach
        </select>
      </div>
        </div>

        @endif

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