@extends('template.app')
@section('konten')
    
<div class="col-12 grid-margin stretch-card">
    
    <div class="card">
      <div class="card-body">
        <h3>Tambah Pemasukan Obat</h3>
        <p class="card-description">
          Puskesmas Sukabumi
        </p>
        <a href="{{route('pemasukan-obat')}}">
        <button type="button" class="btn btn-sm btn-success">
           <i class="mdi mdi-arrow-left-bold-circle"></i> Kembali
        </button></a>
        <form class="forms-sample mt-5"  enctype="multipart/form-data"  method="POST" action="{{ route('pemasukan-obat.store') }}">
            @csrf
            <div class="row">

              <div class="col-md-6">         
                <div class="form-group">
               <label for="no_trans">No.Transaksi</label>
               <input type="text" name="no_trans" value="{{ old('no_trans')}}" class="form-control {{ $errors->first('no_trans') ? "is-invalid" :""}}" id="no_trans" placeholder="No Transaksi">
             </div>

             {{-- tampil error opsi 2 --}}
             @error('no_trans')
             <div class="alert alert-danger">
               {{ $message }}
             </div>
             @enderror
           </div>

                <div class="col-md-6">         
                     <div class="form-group">
                    <label for="nama_supplier">Nama Supplier</label>
                    <select name="supplier_id" id="nama_supplier" class="custom-select">Nama Supplier
                      <option hidden>-Pilih Supplier-</option>
                      @foreach ($dataSuplai as $item)
                      <option value="{{ $item['id_supplier'] }}">{{ $item['nama_supplier'] }}</option>
                      @endforeach
                 </select>
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
               <label for="nama_obat">Nama Obat</label>
               <select name="obat_id" id="nama_obat" class="custom-select">
                <option hidden>-Pilih Obat-</option>
                @foreach ($dataObat as $item)
                <option value="{{ $item['id_obat'] }}">{{ $item['nama_obat'] }}
                </option>
                @endforeach
           </select>
               {{-- <input type="text" name="obat_id" value="{{ old('nama_obat')}}" class="form-control {{ $errors->first('nama_obat') ? "is-invalid" :""}}" id="nama" placeholder="Nama Obat"> --}}
             </div>

             {{-- tampil error opsi 2 --}}
             @error('nama_obat')
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
             @foreach ($puskesmas as $item)
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
             @foreach ($id_puskesmas as $item)
             <option value="{{ $item->id_puskesmas }}" hidden selected>{{ $item->nama }}</option>
             @endforeach
           </select>
         </div>
           </div>

           @endif




           <div class="col-md-6">         
            <div class="form-group">
           <label for="harga">Harga</label>
           <input type="text" name="harga" value="{{ old('harga')}}" class="form-control {{ $errors->first('harga') ? "is-invalid" :""}}" id="harga" placeholder="Harga">
            </div>
           @error('harga')
           <div class="alert alert-danger">
             {{ $message }}
           </div>
           @enderror
          </div>


            <div class="col-md-6">         
              <div class="form-group">
             <label for="jumlah">Jumlah</label>
             <input type="text" name="jumlah" value="{{ old('jumlah')}}" class="form-control {{ $errors->first('jumlah') ? "is-invalid" :""}}" id="jumlah" placeholder="Jumlah">
           </div>
  
           {{-- tampil error opsi 2 --}}
           @error('jumlah')
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