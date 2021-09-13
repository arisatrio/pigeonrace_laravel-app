@extends('layouts.app')
@section('title', 'Hasil Race')
@section('content')
<div class="section-header">
    <h1>{{ $race->nama_race }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{ route('admin.race-results.index') }}">Hasil Race</a></div>
        <div class="breadcrumb-item"><a href="{{ route('admin.race-results.show', $race->id) }}">{{ $race->nama_race }}</a></div>
        <div class="breadcrumb-item">POS {{ $pos->no_pos }} - {{ $pos->city }}</div>
    </div>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-12">

          @if (session('messages'))
            <div class="alert alert-success alert-dismissible">
                {{ session('messages') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <div class="card">
              <div class="card-body">
                
                <ul class="nav nav-pills mb-3">
                  <li class="nav-item">
                    <a class="nav-link text-white btn-secondary btn-sm btn-icon mr-2" href="{{ route('admin.race-results.show', $race->id) }}">
                      <i class="fas fa-arrow-left"></i>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white btn-primary btn-sm mr-2" href="#">
                      <i class="fas fa-map-marker-alt"></i>
                      Pos {{ $pos->no_pos }} - {{ $pos->city }}
                    </a>
                  </li>
                </ul>

                <ul class="nav nav-pills mb-3">
                  @foreach ($race->kelas as $item)
                  <li class="nav-item">
                    <a class="nav-link text-white btn-info btn-sm mr-2" href="{{ route('admin.pos.kelas', ['race_id' => $race->id, 'id' => $pos->id, 'kelas_id' => $item->id]) }}">
                      {{ $item->nama_kelas }}
                    </a>
                  </li>
                  @endforeach
                </ul>

                @if ($validated > 0)
                <div class="alert alert-warning alert-dismissible">
                  ({{ $validated }}) Data Clock belum divalidasi
                </div>
                @endif
                
                <div class="tab-content">
                  <div class="tab-pane fade active show">

                    
                    <table class="table table-striped" id="table-1">
                        <thead>
                          <tr class="text-center bg-dark">
                            <th colspan="9" class="text-white">Pos {{ $pos->no_pos }} - {{ $pos->city }}</th>
                          </tr>
                          <tr class="bg-info">
                              <th rowspan="2" style="width: 5%;" class="text-white">No</th>
                              <th rowspan="2" style="width: 20%;" class="text-white">Nama Peserta / Loft</th>
                              <th rowspan="2" class="text-white">Kota</th>
                              <th rowspan="1" colspan="3" class="text-center text-white">Data Burung</th>
                              <th rowspan="2" class="text-white">Stiker</th>
                              <th rowspan="2" class="text-white">Status</th>
                              <th rowspan="2" style="width: 10%;" class="text-white">Action</th>
                            </tr>
                            <tr class="bg-info">
                              <th class="text-white">No. Ring</th>
                              <th class="text-white">Warna</th>
                              <th class="text-white">Jenis Kelamin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1 @endphp
                            @foreach($pos->clock as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->user->city }}</td>
                                <td>{{ Helper::noRing($item->club->nama_club, $item->tahun, $item->no_ring) }}</td>
                                <td>{{ $item->warna }}</td>
                                <td>{{ $item->jenkel }}</td>
                                <td>{{ $item->clock->no_stiker}}</td>
                                <td>
                                  <span class="badge 
                                    @empty($item->clock->status)
                                    badge-warning
                                    @endempty
                                    @if($item->clock->status === 'TIDAK SAH') 
                                    badge-danger  
                                    @elseif($item->clock->status === 'SAH')
                                    badge-success
                                    @endif
                                    ">
                                    @empty($item->clock->status)
                                    Belum Validasi
                                    @endempty
                                    {{ $item->clock->status }}
                                  </span>
                                </td>
                                <td>
                                  @empty($item->clock->status)
                                  <div class="row">
                                    <form class="btn" action="{{ route('admin.pos.validasi-post', ['id' => $item->id, 'pos_id' => $pos->id]) }}" method="POST">
                                      @csrf
                                      @method('PUT')
                                      <input type="hidden" name="status" value="SAH">
                                      <button class="btn btn-success btn-icon btn-sm text-white" type="submit">
                                        <i class="fas fa-check"></i>
                                        SAH
                                      </button>
                                    </form>
                                    <form class="btn" action="{{ route('admin.pos.validasi-post', ['id' => $item->id, 'pos_id' => $pos->id]) }}" method="POST">
                                      @csrf
                                      @method('PUT')
                                      <input type="hidden" name="status" value="TIDAK SAH">
                                      <button class="btn btn-danger btn-icon btn-sm text-white" type="submit">
                                        <i class="fas fa-times"></i>
                                        TIDAK
                                      </button>
                                    </form>
                                  </div>
                                  @endempty
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    

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
            $('#table-1').DataTable({
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
                        messageTop: 'Data Pos '+ @JSON($pos->no_pos) + ' - ' + @JSON($pos->city),
                    },
                    { 
                        extend: 'excel', 
                        className: 'btn btn-secondary', 
                        text: 'Excel',
                        messageTop: 'Data Pos '+ @JSON($pos->no_pos) + ' - ' + @JSON($pos->city),
                    },
                ],
            });
            function goBack() {
              window.history.back();
            }
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