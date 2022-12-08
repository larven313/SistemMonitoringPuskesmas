@extends('template.app')
@section('konten')
<div class="card ">
    <div class="card-body">
    <div class="card-title">
<h3>Resep Obat</h3>
</div>

<br>
@if ($showObat != null)
<div class="col-lg-9 grid-margin stretch-card">
  <div class="card ml-5">
    <div class="card-body">
      <h3 class="card-title">Rekam Medis Pasien {{ $showObat->nama_pasien }}</h3>

      <div class="row">
        <div class="col-md-9">
            <table class="table-responsive card-description" style="width: 80%">
                <tr>
                    <td>ID Resep Obat</td>
                    <td>:</td>
                    <td>{{ $showObat->id }}</td>

                </tr>
                <tr>
                    <td> Nama Pasien</td>
                    <td> :</td>
                    <td> {{ $showObat->nama_pasien }}</td>
                </tr>
                <tr>
                  <td> Kode Obat </td>
                  <td> :</td>
                  <td> {{ $showObat->kode_obat }}</td>
              </tr>
                <tr>
                  <td>Jenis Obat</td>
                  <td>:</td>
                  <td>{{ $showObat->jenis_obat }}</td>

              </tr>
                <tr>
                    <td> Dosis Aturan Obat </td>
                    <td> :</td>
                    <td> {{ $showObat->dosis_aturan_obat }}</td>
                </tr>
                <tr>
                    <td>Satuan</td>
                    <td>:</td>
                    <td>{{ $showObat->satuan }}</td>

                </tr>
              

                </tr>

                
            </table>
          </div>

      </div>
     

        {{-- <p>Tanggal dibuat : {{$showObat->created_at->isoFormat('D MMMM Y')}}</p> --}}
 

      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Keterangan Sakit</th>
            </tr>
          </thead>
          <tbody>
           
            <tr>
              <td>{{ $showObat->keterangan }}</td>
            </tr>
          </tbody>
        </table>
      </div>

</div> 
@else
<div class="col-lg-9 grid-margin stretch-card">
  <div class="card ml-5">
    <p>Belum ada resep obat</p>
  </div>
</div>
@endif

</div>

@endsection