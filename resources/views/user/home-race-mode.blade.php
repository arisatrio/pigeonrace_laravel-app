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
            <a href="{{ route('user.pos-mode', $item->id) }}" class="btn btn-success btn-block btn-lg text-white"><h6 class="mb-0">POS {{ $item->no_pos }} - {{ $item->city }}</h6></a>
            @endforeach

        </div>
    </div>
</div>
@endsection
@push('js_script')
    <script>
        function goBack() {
          window.history.back();
        }
    </script>
@endpush