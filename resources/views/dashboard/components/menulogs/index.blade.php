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
                            <h3 class="card-title">Table Data Menu Logs</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Menu</th>
                                        <th>Status</th>
                                        <th>Waktu & Tanggal</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $menu)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $menu->menu->title ?? 'N/A' }}</td>
                                            <td>
                                                @if ($menu->status == 'Draft')
                                                    <span class="badge badge-warning"><i class="fas fa-clock"></i>
                                                        Draft</span>
                                                @elseif ($menu->status == 'Cooking')
                                                    <span class="badge badge-secondary"><i class="fas fa-fire"></i>
                                                        Cooking</span>
                                                @elseif ($menu->status == 'Packing')
                                                    <span class="badge badge-info"><i class="fas fa-box"></i>
                                                        Packing</span>
                                                @elseif ($menu->status == 'Delivered')
                                                    <span class="badge badge-primary"><i class="fas fa-truck"></i>
                                                        Delivered</span>
                                                @elseif ($menu->status == 'Distributed')
                                                    <span class="badge badge-success"><i
                                                            class="fas fa-check-circle"></i>
                                                        Distributed</span>
                                                @endif
                                            </td>
                                            <td>{{ Carbon\Carbon::parse($menu->created_at)->format('d/m/Y H:i') }}</td>
                                            <td>
                                                <div class="btn-group btn-block">
                                                    <button url="{{ route('menuLogsDestroy', $menu->id) }}"
                                                        type="button" class="btn btn-sm btn-danger delete"
                                                        data-id="{{ $menu->id }}">
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
