@include('dashboard.partials.header')
@include('dashboard.partials.navbar')
@include('dashboard.partials.sidebar')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
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
                            <h3 class="card-title">Table Data {{ $title }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Menu</th>
                                        <th>Desc</th>
                                        <th>Tanggal</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $reviews)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><img src="{{ asset('storage/menu/' . $reviews->menu->image) }}"
                                                    width="60px" class="" alt="">
                                            </td>
                                            <td>{{ $reviews->menu->title }}</td>
                                            <td>{{ Str::limit($reviews->menu->description, 50) ?? 'N/A' }}</td>
                                            <td>{{ Carbon\Carbon::parse($reviews->menu->date)->format('d/m/Y') }}</td>
                                            <td>
                                                <div class="btn-group btn-block">
                                                    <a class="btn btn-sm btn-primary"
                                                        href="{{ route('penilaianDetail', $reviews->id) }}"> Lihat
                                                        Penilaian
                                                    </a>
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
