@extends('layouts.app')

@section('content')
<div class="section-header">
    <h1>Data Race</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item active">Data Race</div>
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
                    <h5>Data Race</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.race.create') }}" class="btn btn-success btn-md mb-4">
                        <i class="fas fa-plus"></i> Tambah Race
                    </a>

                    <div class="table-responsive">
                        <table class="dttable table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th>Nama Race</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1 @endphp
                                @foreach ($race as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->nama_race }}</td>
                                    <td>{{ $item->deskripsi }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>
                                        <a href="{{ route('admin.race.edit', $item->id) }}" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>
                                        <form class="btn" action="{{ route('admin.race.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon btn-danger"><i class="far fa-trash-alt"></i></button>
                                        </form>
                                        <a href="{{ route('admin.race.show', $item->id) }}" class="btn btn-icon btn-secondary"><i class="fas fa-info-circle"></i></a>
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