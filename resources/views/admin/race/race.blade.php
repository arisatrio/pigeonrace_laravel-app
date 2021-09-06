@extends('layouts.app')
@section('title', 'Data Race')
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
                    <h4>Data Race</h4>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.race.create') }}" class="btn btn-success btn-md mb-4">
                        <i class="fas fa-plus"></i> Tambah Race
                    </a>

                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th>Nama Race</th>
                                    <th>Tanggal Race</th>
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
                                    <td>{{ $item->tgl_race->format('d F Y') }}</td>
                                    <td>
                                        <span class="badge @if($item->status === 'AKTIF') badge-primary @elseif($item->status === 'SELESAI') badge-success @else badge-warning @endif">{{ $item->status }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.race.edit', $item->id) }}" class="btn btn-icon btn-info" data-toggle="tooltip" title="Edit Race"><i class="far fa-edit"></i></a>
                                        <a href="{{ route('admin.race.show', $item->id) }}" class="btn btn-icon btn-secondary ml-3" data-toggle="tooltip" title="Edit Detail Race"><i class="fas fa-info-circle"></i></a>
                                        <form class="btn" action="{{ route('admin.race.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon btn-danger" data-toggle="tooltip" title="Hapus Race">
                                                <i class="far fa-trash-alt"></i>
                                            </button>    
                                        </form>
                                        @if ($item->status === 'AKTIF')
                                        <form class="btn" action="{{ route('admin.race-finish', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button href="#" class="btn btn-icon btn-success" data-toggle="tooltip" title="Tandai Selesai">
                                                <i class="fas fa-check"></i>
                                                 Selesai
                                            </button>
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