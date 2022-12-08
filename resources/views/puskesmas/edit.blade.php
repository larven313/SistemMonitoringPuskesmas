@extends('template.app')
@section('konten')


<div class="col-12 grid-margin stretch-card">
    
    <div class="card">
      <div class="card-body">
        <h3>Edit Puskesmas</h3>
        <p class="card-description">
          Puskesmas Sukabumi
        </p>
        <a href="{{route('puskesmas')}}">
        <button type="button" class="btn btn-sm btn-success">
           <i class="mdi mdi-arrow-left-bold-circle"></i> Kembali
        </button></a>
        <form class="forms-sample mt-5" enctype="multipart/form-data" method="POST" action="{{ route('puskesmas.update',$dataPuskesmas['id']) }}">
            @csrf
            <div class="row">
              <div class="row">
                <div class="col-md-6">         
                     <div class="form-group">
                    <label for="kode_puskesmas">Kode Puskesmas</label>
                    <input type="text" name="kode_puskesmas" value="{{$dataPuskesmas['kode_puskesmas']}}" class="form-control {{ $errors->first('kode_puskesmas') ? "is-invalid" :""}}" id="kode_puskesmas" placeholder="Kode puskesmas">
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
               <input type="text" name="nama" value="{{$dataPuskesmas['nama']}}" class="form-control {{ $errors->first('nama') ? "is-invalid" :""}}" id="nama" placeholder="Nama">
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
           <input type="text" name="alamat" value="{{$dataPuskesmas['alamat']}}" class="form-control {{ $errors->first('alamat') ? "is-invalid" :""}}" id="alamat" placeholder="Alamat">
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
              @if (!$dataPuskesmas['admin_id'] == NULL )
              <option value="{{ $dataPuskesmas['admin_id'] }}" hidden>{{ $joinPuskesmas->name }}</option>
                  
              @else
              <option value="" hidden>-Belum ada admin, Silahkan pilih admin-</option>
                  
              @endif
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