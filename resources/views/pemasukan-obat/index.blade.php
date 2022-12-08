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
        <h4 class="card-title">Data Pemasukan Obat</h4>
        <p class="card-description">
         Puskesmas Sukabumi
        </p>
        <a href="{{route('pemasukan-obat.create')}}">
        <button type="button" class="btn btn-sm btn-primary">
        <i class="mdi mdi-plus-box"></i>  Tambah
        </button></a>
        &nbsp;
<a href="{{route('pemasukan-obat')}}">
  <button data-toggle="tooltip" data-placement="bottom" title="Tampilkan semua data" type="submit" class="btn btn-sm btn-success"><i class="mdi mdi-reload"></i></button>
</a>

        <div class="form-group" style="float: right">
      <form action="{{route('pemasukan-obat')}}">
            <div class="input-group">
              <input type="text" class="form-control" name="nama_supplier" placeholder="Cari Berdasarkan Nama Supplier" aria-label="Recipient's username" required>
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
                  No Trans
                </th>

                <th>
                  Nama Supplier
                </th>

                  <th>
                    Nama Obat
                  </th>

                  <th>
                    Jenis Obat
                  </th>
                  <th>
                    Harga Beli
                  </th>

                  <th>
                    Jumlah
                  </th>
                <th>
                    Satuan
                </th>
                <th>
                  Total
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
                    {{$item->no_trans}}
                </td>
                <td>
                    {{$item->nama_supplier}}
                </td>

                <td>
                    {{$item->nama_obat}}
                </td>

                <td>
                    {{$item->jenis_obat}}
                </td>

                <td>
                    Rp {{$item->harga}}
                </td>

                <td>
                  {{$item->jumlah}}
                  

              </td>

                <td>
                  {{$item->satuan}}
              </td>
              <td>
                Rp {{$item->harga * $item->jumlah}}

              </td>

                <td>

                    <a style="text-decoration: none" href="{{route('pemasukan-obat.edit',$item->id_pemasukan)}}">
                      <button type="button" class="btn btn-warning btn-rounded btn-icon" data-toggle="tooltip" data-placement="bottom" title="Edit">
                        <i class="mdi mdi-eyedropper"></i>
                      </button>
                    </a>
                    <a href="{{route('pemasukan-obat.destroy',$item->id_pemasukan)}}" >
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