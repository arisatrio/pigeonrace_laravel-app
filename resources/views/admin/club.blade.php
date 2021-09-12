@extends('layouts.app')
@section('title', 'Data Club')
@section('content')
<div class="section-header">
    <h1>Data Club</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Data Club</div>
    </div>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Data Club</h4>
                </div>
                <div class="card-body">

                    <a href="{{ route('admin.club.create') }}" class="btn btn-success btn-md mb-4" data-toggle="tooltip" title="Tambah Club">
                        <i class="fas fa-plus"></i> Tambah Club
                    </a>

                    @include('layouts.messages-alert')

                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
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
                                @php $no = 1 @endphp
                                @foreach ($club as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->nama_club }}</td>
                                    <td>{{ $item->city }}</td>
                                    <td>{{ $item->no_center }}</td>
                                    <td>
                                        <a href="{{ route('admin.club.edit', $item->id) }}" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>
                                        {{-- <form class="btn" action="{{ route('admin.club.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon btn-danger"><i class="far fa-trash-alt"></i></button>
                                        </form> --}}
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