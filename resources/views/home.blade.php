@extends('template.app')

@section('konten')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        {{ __('You are logged in!') }}
                    @endif
                   
                    <div class="row" >
                        @if (Auth::user()->roles == '["USER"]')
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">{{ $jumlahPasien }} Pasien dikonfirmasi</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="{{route('categories')}}">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>  
                        @elseif(Auth::user()->roles == '["ADMIN"]')
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">{{ $jumlahPasien }} Jumlah pasien di semua puskesmas Sukabumi</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="{{route('categories')}}">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>  
                        @else
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">{{ $jumlahPasien }} Pasien Tersedia</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="{{route('categories')}}">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>  
                        @endif
  
                        @if (Auth::user()->roles == '["USER"]')
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">{{ $jmlhAntri }} Antrian Menunggu</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="{{route('antrian')}}">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        @else

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">{{ $jmlhAntri }} Antrian Tersedia</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="{{route('antrian')}}">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        @endif


                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">{{ $jmlhSelesai }} Pasien Diperiksa</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="{{route('categories')}}">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body">{{ $jmlhObat }} Obat Tersedia</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="{{route('obat')}}">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        @foreach ($data as $item)

                        <div class="col-md-6 mb-3">
                                
                        <div class="container">
                            <div class="card text-center">
                              <div class="card-header">
                                <h2 align="center">Kupon antrian {{ $item->nama}}</h2>
                              </div>
                              
                              <div class="card-body">

                                <h3 class="card-title"> {{ $item->nama }}</h3>
                                <h1 class="card-text">Nomor Antrian {{ $item->no_antrian }}</h1>
                                <p>Tanggal Kunjungan {{ $item->tgl_kunjungan }}</p>
                                <p>Jam Kunjungan {{ $item->jam_kunjungan }}</p>
                                <p> {{ $item->nama_poli }}</p>

                                @if ($item->tgl_kunjungan == $tgl_skrng )
                                    @if ($jam_skrng > $item->jam_kunjungan)
                                    Status Antrian :
                                    <span class="badge badge-danger">
                                         Kadaluarsa
                                    </span>
                                    @endif
                                    @if ($item->status_antrian == "Konfirmasi")
                                    <p>Status Antrian : <span class="badge badge-primary"> {{ $item->status_antrian }}</span></p>
   
                                   @endif
                                @else

                                 <p>Status Antrian : <span class="badge {{ $item->status_antrian != 'Selesai' ? 'badge-waring' : 'badge-success' }}"> {{ $item->status_antrian }}</span></p>
                                    
                                @endif
                            </div>

                                <div class="card-footer text-muted">
                                    Terima Kasih
                                </div>
                                </div>
                            </div>
                            
                        </div>
                        
                        @endforeach

                        </div>

                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

