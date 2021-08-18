@extends('layouts.app')
@section('title', 'Race')
@section('content')
<div class="section-header">
    <h1>Race</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('user.home') }}">Home</a></div>
        <div class="breadcrumb-item">Race</div>
    </div>
</div>
@if (auth()->user()->latitude == null)
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger alert-dismissible">
                Anda belum setting Koordinat!.
            </div>
        </div>
    </div>
</div>
@else
<div class="section-body">
    <div class="row">
        <div class="col-12">
            Daftar Race
        </div>
    </div>
</div>
@endif
@endsection