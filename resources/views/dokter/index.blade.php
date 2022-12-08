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
        <h4 class="card-title">Data dokter</h4>
        <p class="card-description">
         Puskesmas Sukabumi
        </p>
        <a href="{{route('dokter.create')}}">
        <button type="button" class="btn btn-sm btn-primary">
        <i class="mdi mdi-plus-box"></i>  Tambah
        </button></a>
        &nbsp;
<a href="{{route('dokter')}}">
  <button data-toggle="tooltip" data-placement="bottom" title="Tampilkan semua data" type="submit" class="btn btn-sm btn-success"><i class="mdi mdi-reload"></i></button>
</a>

        <div class="form-group" style="float: right">
      <form action="{{route('dokter')}}">
            <div class="input-group">
              <input type="text" class="form-control" name="nama_dokter" placeholder="Cari Berdasarkan Nama dokter" aria-label="Recipient's username" required>
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
                  Kode dokter
                </th>

                <th>
                  Nama dokter
                </th>

                  <th>
                    Alamat
                  </th>
                  <th>
                    Jenis Kelamin
                  </th>
                  <th>
                    No Induk Dokter
                  </th>
                  <th>
                    Tempat Lahir
                  </th>

                  <th>
                    Tanggal Lahir
                  </th>
                  <th>
                    Puskesmas
                  </th>

                  <th>
                    Action
                  </th>
              </tr>
            </thead>
            <tbody>

                @foreach ($data as $item)

              <tr>
                  <td>
                    {{++$no}}
                  </td>

                  <td>
                    {{$item->kode_dokter}}
                </td>
                <td>
                    {{$item->nama_dokter}}
                </td>
                <td>
                  {{$item->alamat}}
              </td>
                <td>
                    {{$item->gender}}
                </td>

                <td>
                    {{$item->no_induk}}
                </td>

                <td>
                    {{$item->tmpt_lahir}}
                </td>

                <td>
                    {{$item->tgl_lahir}}

              </td>
              
              <td>
                {{$item->nama}}

          </td>


                <td>
                  <a style="text-decoration: none" href="{{route('dokter.show',$item->id)}}">
                    <button type="button" class="btn btn-primary btn-rounded btn-icon" data-toggle="tooltip" data-placement="bottom" title="Detail"> 
                        <i class="mdi mdi-filter-variant"></i>
                      </button>
                  </a>
                    <a style="text-decoration: none" href="{{route('dokter.edit',$item->id)}}">
                      <button type="button" class="btn btn-warning btn-rounded btn-icon" data-toggle="tooltip" data-placement="bottom" title="Edit">
                        <i class="mdi mdi-eyedropper"></i>
                      </button>
                    </a>
                    <a href="{{route('dokter.destroy',$item->id)}}" >
                      <button type="button" class="btn btn-danger btn-rounded btn-icon" data-toggle="tooltip" data-placement="bottom" title="Hapus" onclick="return confirm('Apakah Anda Yakin Menghapus Data Ini ?')">
                        <i class="mdi mdi-delete"></i>
                      </button>
                    </a>
                </td>
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