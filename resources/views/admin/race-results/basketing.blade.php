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
                      <a class="nav-link text-white btn-secondary btn-sm btn-icon mr-2" href="#home3">
                        <i class="fas fa-arrow-left"></i>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-white btn-primary btn-sm mr-2" href="#home3">
                        <i class="fas fa-home"></i>
                      </a>
                    </li>
                </ul>

                <ul class="nav nav-pills mb-3">
                  <li class="nav-item">
                    <a class="nav-link text-white btn-primary btn-sm mr-2" href="#home3">
                      <i class="fas fa-dove"></i>
                      Basketing Pos {{ $pos->no_pos }} - {{ $pos->city }}
                    </a>
                  </li>
                </ul>
                
                <div class="tab-content">
                  <div class="tab-pane fade active show">

                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                          <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Burung</th>
                                  <th>Nama Pemilik / Loft</th>
                              </tr>
                          </thead>
                          <tbody>
                              {{-- @php $no = 1 @endphp
                              @foreach($race->join as $item)
                              <tr>
                                  <td>{{ $no++ }}</td>
                                  <td>{{ Helper::birdName($item->name, auth()->user()->name) }}</td>
                                  <td>{{ $item->name }}</td>
                              </tr>
                              @endforeach --}}
                          </tbody>
                      </table>
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
@endpush
@push('js_script')
    @include('layouts.datatable-js-assets')
    <script>
        $(document).ready(function() {
            $('#table-1').DataTable();
        } );
    </script>
@endpush