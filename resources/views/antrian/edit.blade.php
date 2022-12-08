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
        <form class="forms-sample mt-5" enctype="multipart/form-data" method="POST" action="{{ route('categories.update',$dataCategory['id']) }}">
            @csrf
            <div class="row">

              <div class="col-md-6">         
                <div class="form-group">
               <label for="exampleInputName1">No Antrian</label>
               <input type="text" name="no_antrian" value="{{$dataCategory['no_antrian']}}" class="form-control" id="exampleInputName1" placeholder="No Antrian" readonly>
             </div>
              </div>

                <div class="col-md-6">         
                  <div class="form-group">
                 <label for="exampleInputName1">Nama</label>
                 <input type="text" name="nama" value="{{$dataCategory['nama']}}" class="form-control" id="exampleInputName1" placeholder="Nama">
               </div>
                </div>

               <div class="col-md-6">         
                <div class="form-group">
               <label for="exampleInputName1">NIK</label>
               <input type="text" name="nik" value="{{$dataCategory['nik']}}" class="form-control" id="exampleInputName1" placeholder="Name">
             </div> 

             <div class="col-md-6">         
              <div class="form-group">
              <label for="exampleInputName1">Jenis Kelamin</label><br>
              <select name="gender" id="gender" class="custom-select">
                <option value="{{$dataCategory['gender']}}" hidden>
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

             </div>
             <div class="col-md-6">         
              <div class="form-group">
              <label for="exampleInputName1">Alamat</label>
              <input type="text" name="alamat" value="{{$dataCategory['alamat']}}" class="form-control" id="exampleInputName1" placeholder="Alamat">
              </div>
            </div>
          <div class="col-md-6">         
            <div class="form-group">
            <label for="exampleInputName1">Tanggal Kunjungan</label>
            <input type="datetime-local" name="tgl_kunjungan" value="{{$dataCategory['tgl_kunjungan']}}" class="form-control" id="exampleInputName1" placeholder="Tanggal Kunjungan">
            </div>
          </div>

          <div class="col-md-6">         
            <div class="form-select">
              <label for="poli_id1">Jenis Poli</label><br>
              <select name="poli_id" id="poli_id1" class="custom-select">
                <option value="{{$dataCategory['poli_id']}}" hidden>
               @if ($dataCategory['poli_id'] == 1)
                   Poli Umum
               @elseif($dataCategory['poli_id'] == 2)
                   Poli Gigi
                @elseif($dataCategory['poli_id'] == 3)
                Poli KIA
               @endif
               
                  
              </option>
                <option value="1">Poli Umum</option>
                <option value="2">Poli Gigi</option>
                <option value="3">Poli KIA</option>

                
              </select>
            </div>
          </div>

          <div class="col-md-6">         
            <div class="form-group">
            <label for="exampleInputName1">Status Bayar</label><br>
            <select name="status_bayar" id="status_bayar" class="custom-select">
              <option value="{{$dataCategory['status_bayar']}}" hidden>{{$dataCategory['status_bayar']}}</option>
              <option value="Bayar">Bayar</option>
              <option value="BPJS">BPJS</option>

            </select>
            
            </div>
          </div>

          <div class="col-md-6">         
            <div class="form-group">
            <label for="exampleInputName1">Status antrian</label><br>
            <select name="status_antrian" id="status_antrian" class="custom-select">
              <option value="{{$dataCategory['status_antrian']}}" hidden>{{$dataCategory['status_antrian']}}</option>
              <option value="Selesai">Selesai</option>
              <option value="Antri">Antri</option>
              <option value="Konfirmasi">Konfirmasi</option>

            </select>
            </div>
          </div>

          <div class="col-md-6">         
            <div class="form-group">
            <label for="exampleInputName1">No BPJS</label>
            <input type="text" name="no_bpjs" value="{{$dataCategory['no_bpjs']}}" class="form-control" id="exampleInputName1" placeholder="No BPJS">
            </div>
          </div>

          <div class="col-md-6">         
            <div class="form-group">
            <label for="exampleInputName1">Keterangan</label>
            <input type="text" name="keterangan" value="{{$dataCategory['keterangan']}}" class="form-control" id="exampleInputName1" placeholder="Keterangan">
            </div>
          </div>


                <div class="col-md-6">         
                     <div class="form-group">
                    <label>Upload Gambar</label>
                    <br>
                    @if ($dataCategory['image'])
                    <img src="{{asset('img/'.$dataCategory['image']) }}" width="120" alt="">
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