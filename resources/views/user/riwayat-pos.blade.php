@extends('layouts.app')
@section('title', 'Race')
@section('content')
<div class="section-header">
    <h1>{{ $race->nama_race }}</h1>
</div>
<div class="section-body">
    <div class="row">
        <div class="col">

            <ul class="nav nav-pills mb-3">
                <li class="nav-item">
                    <a onclick="goBack()" class="nav-link text-white btn-secondary btn-sm btn-icon mr-2" href="#">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white btn-primary btn-sm btn-icon mr-2" href="{{ route('user.home') }}">
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

            @foreach ($race->pos as $item)
            <a href="{{ route('user.pos-rank', $item->id) }}" class="btn btn-success btn-block btn-lg text-white"><h6 class="mb-0">POS {{ $item->no_pos }} - {{ $item->city }}</h6></a>
            @endforeach
            <a href="{{ route('user.total-pos', $race->id) }}" class="btn btn-danger btn-block btn-lg text-white"><h6 class="mb-0">TOTAL POS</h6></a>

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
        function goBack() {
          window.history.back();
        }
    </script>
@endpush