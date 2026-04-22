@include('dashboard.partials.header')
@include('dashboard.partials.navbar')
@include('dashboard.partials.sidebar')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $title }}</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right" href="{{ route('kitchenCreate') }}">
                        Tambah Dapur
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <di class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Table Data Dapur</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Telp</th>
                                        <th>Alamat</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $kitchen)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $kitchen->name }}</td>
                                            <td>{{ $kitchen->phone ?? 'N/A' }}</td>
                                            <td>{{ $kitchen->address ?? 'N/A' }}</td>
                                            <td>
                                                <div class="btn-group btn-block">
                                                    <a class="btn btn-sm btn-warning"
                                                        href="{{ route('kitchenEdit', $kitchen->slug) }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button url="{{ route('kitchenDestroy', $kitchen->slug) }}"
                                                        type="button" class="btn btn-sm btn-danger delete"
                                                        data-id="{{ $kitchen->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </di>
        </div>
    </div>
</div>

@include('dashboard.partials.footer')
