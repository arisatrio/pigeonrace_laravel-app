@extends('layouts.app')
@section('title', 'Data Burung')
@section('content')
<div class="section-header">
    <h1>Data Burung</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('user.home') }}">Home</a></div>
        <div class="breadcrumb-item">Data Burung</div>
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
                    <h4>Data Burung</h4>
                </div>
                <div class="card-body">
                    <a href="{{ route('user.burung.create') }}" class="btn btn-success btn-md mb-4" data-toggle="tooltip" title="Tambah Burung"><i class="fas fa-plus"></i> Tambah Burung</a>
                    <table class="table table-striped display-nowrap" id="table-1">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th>No Ring</th>
                                <th>Warna</th>
                                <th>Jenis Kelamin</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1 @endphp
                            @foreach($burung as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ Helper::noRing($item->club->nama_club, $item->tahun, $item->no_ring) }}</td>
                                <td>{{ $item->warna }}</td>
                                <td>{{ $item->jenkel }}</td>
                                <td>
                                    <a href="{{ route('user.burung.edit', $item->id) }}" class="btn btn-primary btn-sm">
                                        EDIT
                                    </a>
                                    <form action="{{ route('user.burung.destroy', $item->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" >HAPUS</button>
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
    </script>
@endpush