@extends('template.app')
@section('konten')
<div class="card ">
    <div class="card-body">
    <div class="card-title">
{{-- <h3>Detail Data Puskesmas {{ $showPuskesmas->nama }}</h3> --}}
</div>

<div class="row">
  <div class="col-md-2">  @if (Auth::user()->roles == '["STAFF"]')
    <a href="{{route('puskesmas.create')}}">
      <button type="button" class="btn btn-sm btn-primary">
      <i class="mdi mdi-plus-box"></i>  Tambah Poli
      </button>
    </a>
    @else
        
    @endif
  </div>
  <div class="col-md-8">

    <form action="{{route('categories',$showPuskesmas->id)}}">
      <div class="input-group">
      <label for="tgl_awal">Cari pasien dari tanggal : </label>
        <input type="date" class="form-control" name="tgl_awal" id="tgl_awal" placeholder="Cari Berdasarkan Tanggal" aria-label="Cari pasien" required>
        <label for="tgl_akhir"> Sampai : </label>
          <input type="date" class="form-control" name="tgl_akhir" id="tgl_akhir" placeholder="Cari Berdasarkan Tanggal" aria-label="Cari pasien" required>
      </div>

      <input type="hidden" name="id_puskesmas" value="{{ $showPuskesmas->id  }}">

          <div class="input-group-append float-right mt-2">
            <button class="btn btn-sm btn-primary" type="submit">Cari</button>
          </div>
   </form>
  </div>
  <div class="col-md-2">
    <a href="{{route('puskesmas')}}" class="float-right">
      <button type="button" class="btn btn-sm btn-success">
         <i class="mdi mdi-arrow-left-bold-circle"></i> Kembali
      </button>
    </a>
  </div>


</div>

  

        <script>
        //   function hapus() {
        //     let btn_hapus = document.getElementById("button");
        //     btn_hapus.style.visibility = 'hidden';
        //   }
        // </script>
        <br>
        <div class="col-lg-9 grid-margin stretch-card mt-3">
          <div class="card ml-5">
            <div class="card-body">
              <h4 class="card-title">Data {{ $showPuskesmas->nama }}</h4>

              
             

                {{-- <p>Tanggal dibuat : {{$showPuskesmas->created_at->isoFormat('D MMMM Y')}}</p> --}}
         
                    <div class="row">
                      {{-- <img src="{{ asset('img/'.$showPuskesmas->avatar)}}" alt="image" width="124" height="124"/>  --}}
          
                      <div class="col-md-9">
                          <table class="table-responsive card-description" style="width: 80%">
                              <tr>
                                  <td>Kode Puskesmas</td>
                                  <td>:</td>
                                  <td>{{ $showPuskesmas->kode_puskesmas }}</td>
             
                              </tr>
                              <tr>
                                  <td> Nama </td>
                                  <td> :</td>
                                  <td> {{ $showPuskesmas->nama }}</td>
                              </tr>
                              <tr>
                                  <td> Alamat </td>
                                  <td> :</td>
                                  <td> {{ $showPuskesmas->alamat }}</td>
                              </tr>
                              <tr>
                                <td>Pasien Hari ini </td>
                                <td> :</td>
                                <td> {{ $pasienHariIni }}</td>
                            </tr>
                            <tr>
                              <td>Pasien Minggu ini </td>
                              <td> :</td>
                              <td> {{ $pasienMingguIni }}</td>
                          </tr>
                          <tr>
                            <td>Pasien Bulan ini </td>
                            <td> :</td>
                            <td> {{ $pasienBulanIni }}</td>
                        </tr>
                          
                              <tr>
                                <td> Jumlah Pasien </td>
                                <td> :</td>
                                <td> {{ $jmlhPasien }}</td>
                            </tr>
                              <tr valign="top">
                                  <td rowspan="4">Poli</td>
                                  <td>:</td>
                                  <td>
                                  <ol>
                                    @foreach ($showPoli as $item)
                                   
                                      <li>{{ $item->nama_poli }}               
                                          <a href="{{route('puskesmas.delete',$item->id_poli_item)}}" >
                                        <button type="button" class="btn btn-small btn-rounded  btn-icon" data-toggle="tooltip" data-placement="bottom" title="Hapus" onclick="return confirm('Apakah Anda Yakin Menghapus Data Ini ?')">
                                          <i class="mdi mdi-close-circle text-danger"></i>
                                        </button>
                                       </a>
                                    </li>
                                   
                                      @endforeach
                                  </ol>
                                </td>
                              </tr>
                              

      
                              
                          </table>
                        </div>  
              </div>

</div>
</div>

@endsection