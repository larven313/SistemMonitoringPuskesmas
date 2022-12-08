@extends('template.app')
@section('konten')

<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
<h3>Detail Data {{$showUser->name}}</h3>
<a href="{{route('users')}}" class="float-right">
    <button type="button" class="btn btn-sm btn-success">
       <i class="mdi mdi-arrow-left-bold-circle"></i> Kembali
    </button></a>
<br>
@if ($showUser->avatar == null)
    
@else
<img src="{{ asset('img/'.$showUser->avatar)}}" alt="image" width="124" height="124"/> 
    
@endif
<p class="mt-3">Nama : {{$showUser->name}}</p>
<p>Email : {{$showUser->email}}</p>
<p>Username : {{$showUser->username}}</p>
<p>Alamat : {{$showUser->address}}</p>
<p>Telepon : {{$showUser->phone}}</p>
<p>Status : {{$showUser->status}}</p>
{{-- <p>Tanggal dibuat : {{$showUser->created_at->isoFormat('dddd, D MMMM Y')}}</p> --}}
<p>Terakhir diupdate : {{$showUser->updated_at}}</p>
        </div>  
</div>
</div>
@endsection
