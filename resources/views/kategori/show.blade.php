@extends('template.app')
@section('konten')
<div class="card ">
    <div class="card-body">
    <div class="card-title">
<h3>Detail Data Pasien {{ $showKategori->nama }}</h3>
</div>
<a href="{{route('categories')}}" class="float-right">
    <button type="button" class="btn btn-sm btn-success">
       <i class="mdi mdi-arrow-left-bold-circle"></i> Kembali
    </button></a>
<br>
        <div class="col-lg-9 grid-margin stretch-card">
          <div class="card ml-5">
            <div class="card-body">
              <h3 class="card-title">Rekam Medis Pasien {{ $showPuskesmas->nama }}</h3>

              <div class="row">
                <div class="col-md-9">
                    <table class="table-responsive card-description" style="width: 80%">
                        <tr>
                            <td>ID Rekam Medis</td>
                            <td>:</td>
                            <td>{{ $showKategori->id }}</td>
       
                        </tr>
                        <tr>
                            <td> Nama </td>
                            <td> :</td>
                            <td> {{ $showKategori->nama }}</td>
                        </tr>
                        <tr>
                          <td> NIK </td>
                          <td> :</td>
                          <td> {{ $showKategori->nik }}</td>
                      </tr>
                        <tr>
                          <td>Kode Antrian</td>
                          <td>:</td>
                          <td>{{ $showKategori->no_antrian }}</td>
     
                      </tr>
                        <tr>
                            <td> Alamat </td>
                            <td> :</td>
                            <td> {{ $showKategori->alamat }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Kunjungan</td>
                            <td>:</td>
                            <td>{{ $showKategori->tgl_kunjungan }}</td>
       
                        </tr>
                        <tr>
                            <td>Jenis Poli</td>
                            <td>:</td>
                            <td>
                                {{ $showKategori->nama_poli }}

                            </td>
                        </tr>
                        <tr>
                            <td>Status Bayar</td>
                            <td>:</td>
                            <td>{{ $showKategori->status_bayar }}</td>
       
                        </tr>
                        <tr>
                          <td>Status Antrian</td>
                          <td>:</td>
                          <td>
                            <span class="badge {{ $showKategori->status_antrian == 'Antri' ? 'badge-warning' :'badge-success' }}">
                            {{ $showKategori->status_antrian }}
                            </span>
                          </td>
     
                      </tr>
                        <tr>
                            <td>No BPJS</td>
                            <td>:</td>
                            <td>
                                @if ($showKategori->no_bpjs == null)
                                {{ "-" }}
                            @else
                              {{$showKategori->no_bpjs}} 
                                
                            @endif
                            </td>
       
                        </tr>

                        
                    </table>
                  </div>
                  <div class="col-md-3">
                    <img src="{{ asset('img/'.$showKategori->image)}}" alt="image" width="124" height="124"/> 
    
                  </div>
              </div>
             

                {{-- <p>Tanggal dibuat : {{$showKategori->created_at->isoFormat('D MMMM Y')}}</p> --}}
         

              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Keterangan Sakit</th>
                    </tr>
                  </thead>
                  <tbody>
                   
                    <tr>
                      <td>{{ $showKategori->keterangan }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>

</div>
</div>

@endsection