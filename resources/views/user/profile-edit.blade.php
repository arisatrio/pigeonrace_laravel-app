@extends('layouts.app')
@section('title', 'Akun')
@section('content')
<div class="section-header">
    <h1>Akun</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('user.home') }}">Home</a></div>
        <div class="breadcrumb-item">Akun</div>
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
                <div class="card-header">
                    <h4>Edit Profile</h4>
                </div>
                <div class="card-body">
                    
                    <form action="{{ route('user.edit-profile-store', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="control-label">Nama Kandang / Loft</label>
                                    <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="control-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nohp" class="control-label">No. HP</label>
                                    <input type="text" class="form-control" name="nohp" value="{{ $user->nohp }}">
                                </div>
                            </div>
                            
                        </div>
                        <button type="submit" class="float-right btn btn-primary mt-4 mb-4">Simpan</button>
                    </form>

                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h4>Edit Password</h4>
                </div>
                <form action="#" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password" class="control-label">Password Lama</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password" class="control-label">Password Baru</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="confirmation_password" class="control-label">Konfirmasi Password</label>
                                    <input type="password" class="form-control" name="confirmation_password">
                                </div>
                            </div>

                        </div>
                        
                        <button type="submit" class="float-right btn btn-primary mt-4 mb-4">Simpan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection