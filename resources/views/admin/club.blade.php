@extends('layouts.app-admin')

@section('content')
<div class="section-header">
    <h1>Data Club</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item">Data Club</div>
    </div>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('admin.club.create') }}" class="btn btn-success btn-sm" data-toggle="tooltip" title="Add Data">
                        <i class="fas fa-plus"></i> Add Data
                    </a>
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
                                    <th>Nama Club</th>
                                    <th>City</th>
                                    <th>No. Center</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($club as $item)
                                <tr>
                                    <td>11</td>
                                    <td>{{ $item->nama_club }}</td>
                                    <td>{{ $item->city }}</td>
                                    <td>{{ $item->no_center }}</td>
                                    <td>
                                        <a href="{{ route('admin.club.edit', $item->id) }}" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>
                                        <form class="btn" action="{{ route('admin.club.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon btn-danger"><i class="far fa-trash-alt"></i></button>
                                        </form>
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
