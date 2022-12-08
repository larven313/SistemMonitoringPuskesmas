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
        <h4 class="card-title">Data User</h4>
        <p class="card-description">
         Puskesmas Sukabumi
        </p>
        <a href="{{route('users.create')}}">
        <button type="button" class="btn btn-sm btn-primary">
        <i class="mdi mdi-plus-box"></i>  Tambah
        </button></a>
        &nbsp;
<a href="{{route('users')}}">
  <button data-toggle="tooltip" data-placement="bottom" title="Tampilkan semua data" type="submit" class="btn btn-sm btn-success"><i class="mdi mdi-reload"></i></button>
</a>

        <div class="form-group" style="float: right">
      <form action="{{route('users')}}">
            <div class="input-group">
              <input type="text" class="form-control" name="name" placeholder="Cari Berdasarkan Nama" aria-label="Recipient's username" required>
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
                  Username
                </th>

                <th>
                  Email
                </th>


                  <th>
                    Role
                  </th>

                  <th>
                    Status
                  </th>

                  <th>
                    Avatar
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
                    {{$item->username}}
                </td>
                <td>
                    {{$item->email}}
                </td>

                <td>
                    {{$item->roles}}
                </td>
                <td>
                  @if ($item->status == "ACTIVE")
                      <span class="badge badge-success">{{$item->status}}</span>
                 @else 
                 <span class="badge badge-danger">{{$item->status}}</span>
                      @endif
              </td>

                <td>
                  @if ($item->avatar== null)
                  {{-- <img src="{{ asset('template')}}/images/faces/ic_user.png" alt="profile"/> --}}
                  @if ($item->gender == 'L')
                  <img src="https://img.icons8.com/color/48/000000/user.png"/>                      
                  @else
                  <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAABmJLR0QA/wD/AP+gvaeTAAAFVUlEQVRoge2Ya2xURRTHf3PvbrellHZpu1UiCKW8rVQitWlpKGiIrTVAaKlQlYQPEomaaIJoYsgmJhZ8UB6SSPyG8mpBKRJBEFGQ1hqFEMMj0JAgGiktj0JLu687ftjKo93dO3d3iTH2n9xssuf1PzNnZs4MDGAA/2+IeDlyl5QMvuVy1GqSMoHIAvS+OoaUG1bt+OaVeMUEsMXqwF1SMtjrcvzgkWKKLiPr6kIsAeKaQEwz8OZzpRV6QG4HNEuGUkqEuCGE2PRe3d7XYuEQdQLL5pW9btOM1bEEB5ASj9/mmP7htobmaOyjSmB51VOzNcO2KxrbMJDogTk12w7stmpoOQF3SclgT2ZiB1bLxpyJkexxjHynoeGiFTPLJHpcST9HY2cKidaV4LFcRpaILFtYlieknGA1iAU8uKKqtNqKgaUEdJ+x0xqfO8gYAotm2cgfFzmkT8r1VvwqrwG3253gOfmTx4pzAIcdZubpFE7S0DUIGPDp135+vxz+0HDY/aPdW749r+JfeQa8pxprVXUBhIApYzTeqLBTnBskD6BrUD1TJ2VQ+LHz+BI2qsZRTsBAm6+q+1Cm4OVyGxXFOilJ/eUpgwTVM/XbSYWIlq8aS7mVEJJ0M52UJHhyis7UcZppbY5wCeZO09lxOBBKPESVl9IMLK94ppAI60XXoDg3WC75CuT/wZSc8OHfmle2QMWH0gzYhG+xESbXnGEa5QUarrS4NbZBiEAVsNWUm4oviTY1nGzx0/265nhhooqSUglJxHAVvU/qzrCx7kzU8rshEA+o6CnuQnKQWlAinixm8j7KIfav/lDdhewqSkvmj49J3gdKtalYQveheTOH0lwpEYvz/hJXxDyygYDJRTiSrRFr9DgksGZne9S263ZdCS8UnFDxoVZCQtwIJzv82y32NN5UcXMPdjd18P3xztBCaWyrqduXp+JHaaUfOdmyctrE7GwhxOS+srbrNznW0k1bh58nRnWDzWTH7Wmndnc3Xx4JjonLmXKPOCACK1bVH1B+qVAuoZU79i8CMUlIeT2U/OCxLmhthNYm6LwAvk4w/MHP1xn8r7UJWptCjrwEaWj+Oe/XHXhXlRNYfNiqqd97CnC+XVX6OYYMffXraQ9+1uBNtNknu7fuUzum70JUi7hm+97nfbqjAClujU7MYLV3LF+0DUfKbFNbaWSzs204H3nHku1IRwraW0hJc2/9yjJ5iOFp8QNmQIJ2nBEU8euP0N2N/CsXRl4Bb0doo4RUOJ+LrfsmOYnJ1D4yFySnkWKSoP6XaHhYngFZus4hF67fiKY1AUUApDoBEM2J4CoCR4i7j8MJriJEc2+Lkzo0+CsoRpPNsnrtBlnpTrivCcgFa7IYyncgX+LuAzotI/h7rgs0HbIKIDUHdEfwS82BrMKgrKV3ATsz7uUhxVLsQw/KynWZVjgpdwnyxY/T8RtHgXH9hRKO7oeebqh0QXlXaCd7kqH+MiQmQdGs4M2/HyNxGqkXiS1Lr6nwUmzmpMBvbA5JPhgURvWKGjrgjxCVcNEBDb07cPb40OQBpJyA8H+mwgsUZ0AuXPsCiE2RlSQcb4SrbeBwQHkalPQEZYeSYM9V8HohPQvyCsIncJuZqBabX90ScwKysk7H3noWFPZIvw9ONMO1MOeAMxMezQe70vXiHGOvjhdud8SWz3wbtV+aAZiTB7DZ4bFCuHQR/rwAXb09UnIKDHsYho0wH/k7GMNZ53TgUMSQCo6eVY0IgKb1kn3YklkYzMYkAZVFHPZF4v5DPG6mYZ6AYFRcuEQDwWgzFfMEJM64kIkG/2bsAQzgP4K/AbCyf2L4VoG7AAAAAElFTkSuQmCC">
                  @endif
                  @else
                    {{-- @if (Auth::user()->avatar == )
                   <img src="https://img.icons8.com/color/48/000000/circled-user-female-skin-type-4--v1.png"/>
                    @endif --}}
                    <img src="{{ asset('img/'.$item->avatar)}}" alt="image"/> 

                  @endif
              </td>

                <td>
                  <a style="text-decoration: none" href="{{route('users.show',$item->id)}}">
                    <button type="button" class="btn btn-primary btn-rounded btn-icon" data-toggle="tooltip" data-placement="bottom" title="Detail"> 
                        <i class="mdi mdi-filter-variant"></i>
                      </button>
                  </a>
                    <a style="text-decoration: none" href="{{route('users.edit',$item->id)}}">
                      <button type="button" class="btn btn-warning btn-rounded btn-icon" data-toggle="tooltip" data-placement="bottom" title="Edit">
                        <i class="mdi mdi-eyedropper"></i>
                      </button>
                    </a>
                    <a href="{{route('users.destroy',$item->id)}}" >
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