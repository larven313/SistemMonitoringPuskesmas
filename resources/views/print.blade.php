<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Nomor Antrian</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
  @if (session('status'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
   {{session('status')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div> 
  @endif
    <h1 align="center">Silahkan Print atau Screenshot Ini</h1>
    <h4 align="center">Kemudian tunjukkan ke petugas</h4>

<div class="container">
    <div class="card text-center">
      <div class="card-header">
       Kupon Antrian  {{ $poli_id['0']->nama }}
      </div>
      <div class="card-body">
        <h3 class="card-title"> {{ $nama }}</h3>
        <h1 class="card-text">Nomor Antrian {{ $max }}</h1>
        <p>Tanggal Kunjungan {{ $tgl_kunjungan }}</p>
        <p> {{ $poli_id['0']->nama_poli }}</p>
      </div>
      <div class="card-footer text-muted">
        Terima Kasih
      </div>
    </div>
  </div>
  <br>

            <center>
            <a href="{{ route('welcome') }}">
            <button class="btn btn-primary">Kembali</button></a>
          </center>

  

</div>


{{-- <p>Tanggal dibuat : {{$created_at->isoFormat('D MMMM Y')}}</p> --}}


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>