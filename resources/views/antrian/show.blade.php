
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Antrian</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('template')}}/css/style.css">
</head>
<body>
<h1 class="text-center my-5">Daftar Antrian</h1>
    <table class="table table-striped" id="list">
        <thead>
          <tr>
            <th>
              No
            </th>
            <th>
              Nama
            </th>
            <th>
              Nama Puskesmas
            </th>
            <th>
              Kode Antrian
            </th>

            <th>
              Tanggal Kunjungan
            </th>
            <th>
              Jam Kunjungan
            </th>
          </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)

            <span>
          <tr class=" @if ($item->user_id == Auth::user()->id)
              bg-success
          @else
          
          @endif">
              <td>
                {{++$no}}
              </td>

            <td class="py-1">
                {{$item->nama}} 
            </td>
            <td>
              {{ $item->nama_puskesmas }}
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
            <td class="py-1">
              {{$item->jam_kunjungan}} 
          </td>

          </tr>
        </span>
       
        @endforeach
        </tbody>
        <tfoot>
          <tr>
            
          <td colspan="1">
            <span class="badge badge-success"> </span><b> Antrianku : <?php echo $totalData; ?></b><br>
            <br><b>Total Antrian : <?php echo $jmlhAntrian; ?></b>
            
          </td>
          <td class="text-center" colspan="4"><a href="{{ url('/') }}"><button class="btn btn-primary">Kembali</button></a></td>
        <td colspan="4" align="right">{{ $data->links() }}</td>
        
        </tr>
        <tr>
         
        </tr>
        </tfoot>
      </table>

  <script src="{{ asset('template')}}/vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="{{ asset('template')}}/vendors/chart.js/Chart.min.js"></script>
  <script src="{{ asset('template')}}/vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="{{ asset('template')}}/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
</body>
</html>