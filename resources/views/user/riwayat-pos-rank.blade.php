@extends('layouts.app')
@section('title', 'Hasil Race')
@section('content')
<div class="section-header">
    <h1>POS {{ $pos->no_pos }} - {{ $pos->city }}</h1>
</div>
<div class="section-body">
    <div class="row">
        <div class="col">

            <ul class="nav nav-pills mb-3">
                <li class="nav-item">
                    <a onclick="goBack()" class="nav-link text-white btn-secondary btn-sm btn-icon mr-2" href="#home3">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white btn-primary btn-sm btn-icon mr-2" href="#home3">
                      <i class="fas fa-home"></i> 
                    </a>
                </li>
            </ul>

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
                    <table class="table table-striped display-nowrap" id="table-1">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Burung</th>
                                <th>Velocity</th>
                                <th>Jarak</th>
                                <th>Clock</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1 @endphp
                            @foreach($rank as $item)
                            <tr @if ($item->user->id === auth()->user()->id)  class="bg-success" @endif>
                                <td>{{ $no++ }}</td>
                                <td>{{ Helper::birdName($item, $item->user->name) }}</td>
                                <td>{{ $item->clock->velocity }}</td>
                                <td>{{ $item->clock->distance }} KM</td>
                                <td>{{ $item->clock->arrival_clock }}</td>
                                <td>
                                    @if ($item->clock->status === null)
                                        <span class="bagde badge-warning">BELUM DIVALIDASI</span>
                                    @endif
                                    <span class="
                                    @if ($item->clock->status === 'SAH')
                                    badge badge-success    
                                    @else
                                    badge badge-danger"
                                    @endif>
                                        {{ $item->clock->status }}
                                    </span>
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
@endsection
@push('css_script')
    @include('layouts.datatable-css-assets')
@endpush
@push('js_script')
    @include('layouts.datatable-js-assets')
    <script>
        $(document).ready(function() {
            $('#table-1').DataTable({
                rowReorder: {
                    selector: 'td:nth-child(1)'
                },
                responsive: true
            });
        });
        function goBack() {
          window.history.back();
        }
    </script>
@endpush