@extends('template.app')
@section('konten')
<div class="card ">
    <div class="card-body">
    <div class="card-title">
<h3>Detail Data Pegawai {{ $showPegawai->nama }}</h3>
</div>
<a href="{{route('pegawai')}}" class="float-right">
    <button type="button" class="btn btn-sm btn-success">
       <i class="mdi mdi-arrow-left-bold-circle"></i> Kembali
    </button></a>
<br>
        <div class="col-lg-9 grid-margin stretch-card">
          <div class="card ml-5">
            <div class="card-body">
              <h4 class="card-title">Data Pegawai </h4>


             

                {{-- <p>Tanggal dibuat : {{$showPegawai->created_at->isoFormat('D MMMM Y')}}</p> --}}
         
                    <div class="row">
                      <img src="{{ asset('img/'.$showPegawai->avatar)}}" alt="image" width="124" height="124"/> 
          
                      <div class="col-md-9">
                          <table class="table-responsive card-description" style="width: 80%">
                              <tr>
                                  <td>NPWP</td>
                                  <td>:</td>
                                  <td>{{ $showPegawai->npwp }}</td>
             
                              </tr>
                              <tr>
                                  <td> Nama </td>
                                  <td> :</td>
                                  <td> {{ $showPegawai->nama }}</td>
                              </tr>
                              <tr>
                                  <td> Alamat </td>
                                  <td> :</td>
                                  <td> {{ $showPegawai->alamat }}</td>
                              </tr>
                              <tr>
                                  <td>Tanggal Lahir</td>
                                  <td>:</td>
                                  <td>{{ $showPegawai->tgl_lahir }}</td>
             
                              </tr>
                              <tr>
                                  <td>No Telepon</td>
                                  <td>:</td>
                                  <td>
                                    {{ $showPegawai->telepon }}
                                  </td>
                              </tr>
                              <tr>
                                  <td>Jabatan</td>
                                  <td>:</td>
                                  <td>{{ $showPegawai->jabatan }}</td>
             
                              </tr>
                              <tr>
                                  <td>Bidang</td>
                                  <td>:</td>
                                  <td>
                                      {{ $showPegawai->bidang  }}
                                  </td>
             
                              </tr>
                              <tr>
                                <td>Bertugas di </td>
                                <td>:</td>
                                <td>
                                    {{ $showPegawai->nama_puskesmas  }}
                                </td>
           
                            </tr>
                              
                          </table>
                        </div>  
              </div>

</div>
</div>

@endsection