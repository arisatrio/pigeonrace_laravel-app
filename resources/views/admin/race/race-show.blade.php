@extends('layouts.app')

@section('content')
<div class="section-header">
    <h1>{{ $race->nama_race }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="{{ route('admin.race.create') }}">Buat Race</a></div>
        <div class="breadcrumb-item">{{ $race->nama_race}}</div>
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
                <div class="card-body">

                    @if ($race->status != 'AKTIF')
                    <div class="row">
                        <div class="col">
                            <form action="{{ route('admin.race.update', $race->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="AKTIF">
                                <button class="btn btn-primary btn-lg mb-4 float-right"><i class="fas fa-paper-plane"></i> 
                                    Kirim
                                </button>
                            </form>
                        </div>
                        <div class="col-12">
                            <div class="alert alert-secondary alert-dismissible">
                                Kirim untuk mengaktifkan Race !
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    <div class="card">
                        <div class="card-header">
                            <h5>Data Kelas Lomba</h5>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('admin.race-kelas.create', $race->id) }}" class="btn btn-success btn-md mb-4">
                                <i class="fas fa-plus"></i> Tambah Data Kelas
                            </a>

                            <div class="table-responsive">
                                <table class="dttable table table-bordered text-center" id="table-1">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">No</th>
                                            <th>Nama Kelas</th>
                                            <th>Biaya Lomba</th>
                                            <th style="width: 25%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1 @endphp
                                        @foreach ($race->kelas as $item)                                
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->nama_kelas }}</td>
                                            <td>{{ $item->biaya }}</td>
                                            <td>
                                                <a href="{{ route('admin.race-kelas.edit', $item->id) }}" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>
                                                <form class="btn" action="{{ route('admin.race-kelas.destroy', ['id' => $item->id, 'race_id' => $race->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-icon btn-danger"><i class="far fa-trash-alt"></i></button>
                                                </form>
                                                <a href="{{ route('admin.race-kelas.show', $item->id) }}" class="btn btn-icon btn-secondary"><i class="fas fa-info-circle"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5>Data Latihan</h5>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('admin.race-latihan.create', $race->id) }}" class="btn btn-success btn-md mb-4">
                                <i class="fas fa-plus"></i> Tambah Data Latihan
                            </a>

                            <div class="table-responsive">
                                <table class="dttable table table-bordered text-center" id="table-1">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">No</th>
                                            <th>Tanggal Inkorv</th>
                                            <th>Tanggal Lepasan</th>
                                            <th>Kota</th>
                                            <th>Jarak</th>
                                            <th style="width: 25%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1 @endphp
                                        @foreach ($race->latihan as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->tgl_inkorv->format('d F Y') }}</td>
                                            <td>{{ $item->tgl_lepasan->format('d F Y') }}</td>
                                            <td>{{ $item->city }}</td>
                                            <td>{{ $item->jarak }}</td>
                                            <td>
                                                <a href="{{ route('admin.race-latihan.edit', $item->id) }}" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>
                                                <form class="btn" action="{{ route('admin.race-latihan.destroy', ['id' => $item->id, 'race_id' => $race->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-icon btn-danger"><i class="far fa-trash-alt"></i></button>
                                                </form>
                                                <a href="{{ route('admin.race-latihan.show', $item->id) }}" class="btn btn-icon btn-secondary"><i class="fas fa-info-circle"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5>Data Pos</h5>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('admin.race-pos.create', $race->id) }}" class="btn btn-success btn-md mb-4">
                                <i class="fas fa-plus"></i> Tambah Data Pos
                            </a>

                            <div class="table-responsive">
                                <table class="dttable table table-bordered text-center" id="table-1">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">No</th>
                                            <th>Tanggal Inkorv</th>
                                            <th>Tanggal Lepasan</th>
                                            <th>Kota</th>
                                            <th>Jarak</th>
                                            <th style="width: 25%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($race->pos as $item)
                                        @php $no = 1 @endphp
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->tgl_inkorv->format('d F Y') }}</td>
                                            <td>{{ $item->tgl_lepasan->format('d F Y') }}</td>
                                            <td>{{ $item->city }}</td>
                                            <td>{{ $item->jarak }}</td>
                                            <td>
                                                <a href="{{ route('admin.race-pos.edit', $item->id) }}" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>
                                                <form class="btn" action="{{ route('admin.race-pos.destroy', ['id' => $item->id, 'race_id' => $race->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-icon btn-danger"><i class="far fa-trash-alt"></i></button>
                                                </form>
                                                <a href="{{ route('admin.race-latihan.show', $item->id) }}" class="btn btn-icon btn-secondary"><i class="fas fa-info-circle"></i></a>
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
    </div>
</div>
@endsection