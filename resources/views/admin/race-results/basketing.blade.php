@extends('layouts.app')
@section('title', 'Hasil Race')
@section('content')
<div class="section-header">
    <h1>{{ $race->nama_race }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{ route('admin.race-results.index') }}">Hasil Race</a></div>
        <div class="breadcrumb-item">{{ $race->nama_race }}</div>
    </div>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-12">

            <div class="card">
              <div class="card-body">
                
                <ul class="nav nav-pills mb-3">
                  <li class="nav-item">
                    <a class="nav-link text-white btn-secondary btn-sm btn-icon mr-2" href="{{ route('admin.race-results.show', $race->id) }}">
                      <i class="fas fa-arrow-left"></i>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white btn-primary btn-sm mr-2" href="{{ route('admin.basketing.index', ['race_id' => $race->id, 'id' => $pos->id]) }}">
                      <i class="fas fa-dove"></i>
                      Basketing Pos {{ $pos->no_pos }} - {{ $pos->city }}
                    </a>
                  </li>
                    <li class="nav-item">
                      @isset($kelas)  
                      <a class="nav-link btn btn-info text-white">
                        {{ $kelas->nama_kelas }}
                      </a>
                      @endisset
                    </li>
                </ul>

                <ul class="nav nav-pills mb-3">
                  @foreach ($race->kelas as $item)
                  <li class="nav-item">
                    @isset($kelas)  
                      @if ($item->id !== $kelas->id)
                      <a class="nav-link text-white btn-info btn-sm mr-2" href="{{ route('admin.basketing-kelas', ['race_id' => $race->id, 'id' => $pos->id, 'kelas_id' => $item->id]) }}">
                        {{ $item->nama_kelas }}
                      </a>
                      @endif
                    @endisset
                    @empty($kelas)
                      <a class="nav-link text-white btn-info btn-sm mr-2" href="{{ route('admin.basketing-kelas', ['race_id' => $race->id, 'id' => $pos->id, 'kelas_id' => $item->id]) }}">
                        {{ $item->nama_kelas }}
                      </a>
                    @endempty
                  </li>
                  @endforeach
                </ul>
                <button type="submit" class="btn btn-danger btn-sm btn icon mb-2" onclick="event.preventDefault(); document.getElementById('delete').submit();">
                  <i class="fas fa-times ml-2"></i>
                  Delete selected data
                </button>

                @if (session('messages'))
                <div class="alert alert-success alert-dismissible">
                    {{ session('messages') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                
                <div class="tab-content">
                  <div class="tab-pane fade active show">

                    <div class="table-responsive">
                      
                      <form action={{ route('admin.basketing-hapus') }} method="POST" id="delete">
                        @csrf
                        @method('delete')
                      <table class="table table-striped" id="table-1">
                          <thead>
                            <tr class="text-center bg-dark">
                              <th class="text-white" colspan="7">Basketing Pos {{ $pos->no_pos }} - {{ $pos->city }}</th>
                            </tr>
                            <tr class="bg-warning">
                                <th style="width: 5%;" class="text-white">No</th>
                                <th class="text-white">Ring</th>
                                <th class="text-white">Warna</th>
                                <th class="text-white">Jenis Kelamin</th>
                                <th class="text-white">Nama Peserta / Loft</th>
                                <th style="width: 5%;" class="text-white">Validasi</th>
                            </tr>
                          </thead>
                          <tbody>
                                @foreach($pos->basketing as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ Helper::noRing($item->club->nama_club, $item->tahun, $item->no_ring) }}</td>
                                    <td>{{ $item->warna }}</td>
                                    <td>{{ $item->jenkel }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td class="text-center">
                                      <input type="hidden" name="pos_id" value="{{$pos->id}}">
                                      <input type="checkbox" class="form-check-input" name="burung[]" value="{{$item->id}}">
                                    </td>
                                </tr>
                                @endforeach
                              
                          </tbody>
                      </table>
                      
                    </form>
                    </div>

                  </div>
                </div>

              </div>
            </div>  
      
        </div>
    </div>
</div>
@endsection
@push('css_script')
    @include('layouts.datatable-css-assets')
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.bootstrap4.min.css">
@endpush
@push('js_script')
    @include('layouts.datatable-js-assets')
    <script>
        $(document).ready(function() {
            var race = @JSON($race->nama_race);
            var t = $('#table-1').DataTable({
              "order": [[ 4, 'asc' ]],
              dom: 'lBfrtip',
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                buttons: [
                  { 
                      extend: 'pdf', 
                      className: 'btn btn-secondary', 
                      text: 'PDF',
                      messageTop: 'Data Basketing Pos '+ @JSON($pos->no_pos) + ' - ' + @JSON($pos->city),
                  },
                  { 
                      extend: 'excel', 
                      className: 'btn btn-secondary', 
                      text: 'Excel',
                      messageTop: 'Data Basketing Pos '+ @JSON($pos->no_pos) + ' - ' + @JSON($pos->city),
                  },
                  { 
                    extend: 'print', 
                    className: 'btn btn-secondary', 
                    text: 'Print',
                    messageTop: 'Data Basketing Pos '+ @JSON($pos->no_pos) + ' - ' + @JSON($pos->city),
                    exportOptions: {
                        columns: [0,1,2,3,4,6]
                    }
                  },
                ],
            });
            t.on( 'order.dt search.dt', function () {
              t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                  cell.innerHTML = i+1;
              } );
            }).draw();
        } );
    </script>
     <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.bootstrap4.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
     <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
@endpush