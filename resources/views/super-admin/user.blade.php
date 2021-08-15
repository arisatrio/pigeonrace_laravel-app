@extends('layouts.app')

@section('content')
<div class="section-header">
    <h1>Data User</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('superadmin.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Data User</div>
    </div>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('superadmin.user.create') }}" class="btn btn-success btn-sm" data-toggle="tooltip"
                        title="Add Data"><i class="fas fa-plus"></i> Add Data</a>
                </div>
                <div class="card-body">
                    @if (session('messages'))
                    <div class="alert alert-success alert-dismissible">
                        {{ session('messages') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table class="dttable table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $item)

                                <tr>
                                    <td>11</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->role->name }}</td>
                                    <td>
                                        <a href="{{ route('superadmin.user.edit', $item->id) }}" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>
                                        {{-- <form action="{{ route('superadmin.user.destroy', $item->id) }}" method="POST">
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon btn-danger"><i class="far fa-trash-alt"></i></button>
                                        </form> --}}
                                        @if ($item->id != Auth::user()->id)
                                            <form class="btn" action="{{ route('superadmin.user.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-icon btn-danger"><i class="far fa-trash-alt"></i></button>
                                            </form>
                                        @endif
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
@endsection