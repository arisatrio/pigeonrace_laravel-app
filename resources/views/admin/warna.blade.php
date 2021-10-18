@extends('layouts.app')
@section('title', 'Data Warna Burung')
@section('content')
<div class="section-header">
    <h1>Data Warna Burung</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Data Warna Burung</div>
    </div>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Data Warna Burung</h4>
                </div>
                <div class="card-body">

                    <a href="{{ route('admin.warna.create') }}" class="btn btn-success btn-md mb-4" data-toggle="tooltip" title="Tambah Warna Burung">
                        <i class="fas fa-plus"></i> Tambah Warna Burung
                    </a>

                    @if (session('messages'))
                    <div class="alert alert-success alert-dismissible">
                        {{ session('messages') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th>Kode Warna</th>
                                    <th>Warna</th>
                                    <th style="width: 15%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($warna as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->kode_warna }}</td>
                                    <td>{{ $item->warna }}</td>
                                    <td>
                                        <a href="{{ route('admin.warna.edit', $item->id) }}" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>
                                        <form class="btn" action="{{ route('admin.warna.destroy', $item->id) }}" method="POST">
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