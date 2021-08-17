@extends('layouts.app-user')

@section('content')
<div class="section-header">
    <h1>Home</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"></div>
    </div>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-12">
            @if (auth()->user()->latitude == null)
            <div class="alert alert-danger alert-dismissible">
                Anda belum setting Koordinat!.
            </div>
            @endif
        </div>
    </div>
</div>
@endsection