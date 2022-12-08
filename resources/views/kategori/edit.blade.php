@extends('template.app')
@section('konten')


<div class="col-12 grid-margin stretch-card">
    
    <div class="card">
      <div class="card-body">
        <h3>Edit Pasien</h3>
        <p class="card-description">
          Puskesmas Sukabumi
        </p>
        <a href="{{route('categories')}}">
        <button type="button" class="btn btn-sm btn-success">
           <i class="mdi mdi-arrow-left-bold-circle"></i> Kembali
        </button></a>
        <form class="forms-sample mt-5" enctype="multipart/form-data" method="POST" action="{{ route('categories.update',$dataCategory->id) }}">
            @csrf
            <div class="row">

              <div class="col-md-6">         
                <div class="form-group">
                  <label for="no_antrian">No Antrian</label>
                  <input type="text" name="no_antrian" value="{{$dataCategory->no_antrian}}" class="form-control" id="no_antrian" placeholder="No Antrian">
                </div>
              </div>

                <div class="col-md-6">         
                  <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" value="{{$dataCategory->nama}}" class="form-control" id="nama" placeholder="Nama">
                  </div>
                </div>

              <div class="col-md-6">         
                <div class="form-group">
                  <label for="nik">NIK</label>
                  <input type="text" name="nik" value="{{$dataCategory->nik}}" class="form-control" id="nik" placeholder="Name">
                 </div> 
              </div>

              <div class="col-md-6">         
               <div class="form-group">
                  <label for="gender">Jenis Kelamin</label><br>
                    <select name="gender" id="gender" class="custom-select">
                      <option value="{{$dataCategory->gender}}" hidden>
                        @if ($dataCategory->gender == "L")
                            {{ "Laki-laki" }}
                        @else
                            {{ "Perempuan" }}
                        @endif
                      </option>
                      <option value="L">Laki-laki</option>
                      <option value="P">Perempuan</option>
                    </select>
                </div>
              </div>

            <div class="col-md-6">         
              <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" value="{{$dataCategory->alamat}}" class="form-control" id="alamat" placeholder="Alamat">
              </div>
            </div>

          <div class="col-md-6">         
            <div class="form-group">
              <label for="tgl_kunjungan">Tanggal Kunjungan</label>
              <small>({{$dataCategory->tgl_kunjungan}})</small>
              <input type="date" name="tgl_kunjungan" value="{{$dataCategory->tgl_kunjungan}}" class="form-control" id="tgl_kunjungan" placeholder="Tanggal Kunjungan">
            </div>
          </div>

          <div class="col-md-6">         
            <div class="form-group">
              <label for="jam_kunjungan">Jam Kunjungan</label>
              <small>({{$dataCategory->jam_kunjungan}})</small>
              <input type="time" name="jam_kunjungan" value="{{$dataCategory->jam_kunjungan}}" class="form-control" id="jam_kunjungan" placeholder="Jam Kunjungan">
            </div>
          </div>

          <div class="col-md-6">         
            <div class="form-select">
              <label for="puskesmas_id">Puskesmas & Poli</label><br>
              <select name="puskesmas_id" id="puskesmas_id" class="custom-select">
                <option hidden value="{{ $dataCategory->puskesmas_id }}">{{ $puskesmas['0']->nama  }} - {{ $puskesmas['0']->nama_poli }}</option>
                @foreach ($dataPuskesmas as $data)
                <option value="{{ $data->id }}">
                  {{ $data->nama }}  - 
                  {{ $data->nama_poli }}
                </option>
                @endforeach
           </select>
            </div>
          </div>

          <div class="col-md-6">         
            <div class="form-group">
              <label for="status_bayar">Status Bayar</label><br>
              <select name="status_bayar" id="status_bayar" class="custom-select">
                <option value="{{$dataCategory->status_bayar}}" hidden>{{$dataCategory->status_bayar}}</option>
                <option value="Bayar">Bayar</option>
                <option value="BPJS">BPJS</option>
              </select>
            
            </div>
          </div>

          <div class="col-md-6">         
            <div class="form-group">
              <label for="status_antrian">Status antrian</label><br>
              <select name="status_antrian" id="status_antrian" class="custom-select">
                {{-- <option value="{{$dataCategory->status_antrian}}" hidden>{{$dataCategory->status_antrian}}</option> --}}
                <option value="Selesai">Selesai</option>
                <option value="Antri">Antri</option>
                <option value="Konfirmasi" @checked(true) selected>Konfirmasi</option>
              </select>
            </div>
          </div>

          <div class="col-md-6">         
            <div class="form-group">
              <label for="bpjs">No BPJS</label>
              <input type="text" name="no_bpjs" value="{{$dataCategory->no_bpjs}}" class="form-control" id="bpjs" placeholder="No BPJS">
            </div>
          </div>

          <div class="col-md-6">         
            <div class="form-group">
              <label for="ket">Keterangan</label>
              <input type="text" name="keterangan" value="{{$dataCategory->keterangan}}" class="form-control" id="ket" placeholder="Keterangan">
            </div>
          </div>

          <div class="col-md-6">         
            <div class="form-group">
              <label for="obat_id">Resep Obat</label>
              <select name="obat_id" id="obat_id" class="custom-select">
                <option hidden>Pilih Obat</option>
                @foreach ($dataObat as $item)
                <option value="{{ $item->id_obat }}">{{ $item->nama_obat }}</option>
                    
                @endforeach
              </select>
            </div>
          </div>


              <div class="col-md-6">         
                <div class="form-group">
                    <label>Upload Gambar</label>
                    <br>
                    @if ($dataCategory->image)
                    <img src="{{asset('img/'.$dataCategory->image) }}" width="120" alt="">
                    @else
                    <small class="text-danger">Tidak Ada Gambar</small>    
                    @endif
                    
                    <input type="file" name="img[]" class="file-upload-default">
                   <input type="file" name="image" class="form-control">
                   <small class="text-muted">*Kosongkan jika tidak ingin mengubah gambar</small>
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