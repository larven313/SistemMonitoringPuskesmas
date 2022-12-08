@extends('template.app')
@section('konten')
@if (session('status'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
 {{session('status')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div> 
@endif

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Data Antrian</h4>
        <p class="card-description">
          Puskesmas Sukabumi
        </p>
        {{-- <a href="{{route('antrian.create')}}">
        <button type="button" class="btn btn-sm btn-primary">
        <i class="mdi mdi-plus-box"></i>  Tambah
        </button></a> --}}
        &nbsp;
<a href="{{route('antrian')}}">
  <button data-toggle="tooltip" data-placement="bottom" title="Tampilkan semua data" type="submit" class="btn btn-sm btn-success"><i class="mdi mdi-reload"></i></button>
</a>

        <div class="form-group" style="float: right">
      <form action="{{route('antrian')}}">
        {{-- <div class="input-group mb-2">
          <select name="poli" id="poli" class="custom-select">
           <option hidden value="">Urut Berdasarkan Poli</option> 
           @foreach ($poli as $item)
           <option value="{{ $item->id_poli }}">{{ $item->nama_poli }}</option>
               
           @endforeach
          </select>
         </div> --}}
            <div class="input-group">
              <input type="text" class="form-control" name="nama" placeholder="Cari Berdasarkan Nama" aria-label="Recipient's username">
              <div class="input-group-append">
                <button class="btn btn-sm btn-primary" type="submit">Cari</button>
              </div>
            </div>
        </div>
     </form>
        <div class="table-responsive mt-4 ">
          <table class="table table-striped" id="list">
            <thead>
              <tr>
                <th>
                  No
                </th>
                <th>
                  Name
                </th>
                <th>
                  Nomor Antrian
                </th>
                <th>
                  Tanggal Kunjungan
                </th>
                <th>
                  Jam Kunjungan
                </th>
                <th>
                  Nama Puskesmas
                </th>
                <th>
                  Nama Poli
                </th>
                <th>
                  Status Bayar
                </th>
                <th>
                   No.BPJS 
                </th>
                <th>
                  Status Antrian
                  </th>
                  @if (Auth::user()->roles == '["USER"]' || Auth::user()->roles == '["ADMIN"]')
                      
                  @else
                  <th>
                    Action
                  </th>
                  @endif

              </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)

              <tr>
                  <td>
                    {{++$no}}
                  </td>

                <td class="py-1">
                    {{$item->nama}} 
                </td>
                <td class="py-1">
                  {{$item->no_antrian}} 
              </td>
                <td>
                    
                    @if ($item->tgl_kunjungan == null)
                   <span class="text-center"> {{ "-" }}</span>
                @else
                {{$item->tgl_kunjungan}}
                    
                @endif

                </td>
                <td>
                  {{$item->jam_kunjungan}} 

              </td>
                <td>
                  {{ $item->nama_puskesmas }}
                </td>
                <td>
                  {{ $item->nama_poli }}
                </td>
                <td class="py-1">
                  {{$item->status_bayar}} 
              </td>
              <td class="py-1">
                
                @if ($item->no_bpjs == null)
                    {{ "-" }}
                @else
                  {{$item->no_bpjs}} 
                    
                @endif
            </td>
            <td class="py-1">
              @if ($item->status_antrian == "Antri")
              <span class="badge badge-warning">
                {{$item->status_antrian}} 
            </span>
              @elseif ($item->status_antrian == "Konfirmasi")
              <span class="badge badge-primary">
                {{$item->status_antrian}} 
            </span>
              @endif
            </td>
            @if (Auth::user()->roles == '["USER"]' || Auth::user()->roles == '["ADMIN"]')
                      
            @else
            <td>
              <a style="text-decoration: none" href="{{route('categories.edit',$item->id)}}">
                <button type="button" class="btn btn-primary btn-rounded btn-icon" data-toggle="tooltip" data-placement="bottom" title="Disetujui"> 
                    <i class="mdi mdi-check"></i>
                  </button>
              </a>

                <a href="{{route('categories.destroy',$item->id)}}" >
                  <button type="button" class="btn btn-danger btn-rounded btn-icon" data-toggle="tooltip" data-placement="bottom" title="Ditolak" onclick="return confirm('Apakah Anda Yakin Menghapus Data Ini ?')">
                    <i class="mdi mdi-close"></i>
                  </button>
                </a>
            </td>
            @endif

              </tr>
            @endforeach
            </tbody>
            <tfoot>
              <tr>
              <td colspan="2"><b>Total : <?php echo $totalData; ?></b></td>
            <td colspan="4" align="right">{{ $data->links() }}</td>
            </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

  {{-- DataTables --}}
{{-- <script>
  $(document).ready(function() {
    $('#list').DataTable();
} );
</script> --}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  @endsection