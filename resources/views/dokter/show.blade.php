@extends('template.app')
@section('konten')
<div class="card ">
    <div class="card-body">
    <div class="card-title">
<h3>Detail Data dokter {{ $showDokter->nama }}</h3>
</div>
<a href="{{route('dokter')}}" class="float-right">
    <button type="button" class="btn btn-sm btn-success">
       <i class="mdi mdi-arrow-left-bold-circle"></i> Kembali
    </button></a>
<br>
        <div class="col-lg-9 grid-margin stretch-card">
          <div class="card ml-5">
            <div class="card-body">
              <h4 class="card-title">Data dokter </h4>


             

                {{-- <p>Tanggal dibuat : {{$showDokter->created_at->isoFormat('D MMMM Y')}}</p> --}}
         
                    <div class="row">
                      <img src="{{ asset('img/'.$showDokter->image)}}" alt="image" width="124" height="124"/> 
          
                      <div class="col-md-9">
                          <table class="table-responsive card-description" style="width: 80%">
                              <tr>
                                  <td>Kode Dokter</td>
                                  <td>:</td>
                                  <td>{{ $showDokter->kode_dokter }}</td>
             
                              </tr>
                              <tr>
                                  <td> Nama </td>
                                  <td> :</td>
                                  <td> {{ $showDokter->nama_dokter }}</td>
                              </tr>
                              <tr>
                                  <td> Alamat </td>
                                  <td> :</td>
                                  <td> {{ $showDokter->alamat }}</td>
                              </tr>
                              <tr>
                                  <td>No Induk Dokter</td>
                                  <td>:</td>
                                  <td>{{ $showDokter->no_induk }}</td>
             
                              </tr>
                              <tr>
                                  <td>Jenis Kelamin</td>
                                  <td>:</td>
                                  <td>
                                    {{ $showDokter->gender }}
                                  </td>
                              </tr>
                              <tr>
                                <td>Tanggal Lahir</td>
                                <td>:</td>
                                <td>{{ $showDokter->tgl_lahir }}</td>
           
                            </tr>
                              <tr>
                                  <td>Tempat Lahir</td>
                                  <td>:</td>
                                  <td>{{ $showDokter->tmpt_lahir }}</td>
             
                              </tr>
      
                              
                          </table>
                        </div>  
              </div>

</div>
</div>

@endsection