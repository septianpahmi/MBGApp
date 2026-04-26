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
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-circle"
                                    src="{{ asset('storage/menu/' . $data->menu->image) }}" height="100px"
                                    width="100px" style="object-fit: cover" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ $data->menu->title }}</h3>

                            <p class="text-muted text-center">{{ Str::limit($data->menu->description, 30) }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Kalori</b> <a class="float-right">1,322</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Protein</b> <a class="float-right">543</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Karbohidrat</b> <a class="float-right">13,287</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Lemak</b> <a class="float-right">13,287</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link" href="#activity"
                                        data-toggle="tab">Penilaian</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <!-- Post -->
                                    @foreach ($feedback as $item)
                                        <div class="post">
                                            <div class="user-block">
                                                <img class="img-circle img-bordered-sm"
                                                    src="../../dist/img/user1-128x128.jpg" alt="user image">
                                                <span class="username">
                                                    <a href="#">{{ $item->beneficiary->name }}</a>
                                                </span>
                                                <span class="description">7:30 PM today</span>
                                            </div>
                                            <!-- /.user-block -->
                                            <p>
                                                {{ $item->comment }}
                                            </p>
                                            <img class="img-fluid mb-3" src="../../dist/img/photo4.jpg" alt="Photo"
                                                width="200px">
                                            {{-- <p>
                                            <a href="#" class="link-black text-sm mr-2"><i
                                                    class="fas fa-share mr-1"></i> Share</a>
                                            <a href="#" class="link-black text-sm"><i
                                                    class="far fa-thumbs-up mr-1"></i> Like</a>
                                            <span class="float-right">
                                                <a href="#" class="link-black text-sm">
                                                    <i class="far fa-comments mr-1"></i> Comments (5)
                                                </a>
                                            </span>
                                        </p> --}}
                                        </div>
                                        <!-- /.post -->
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('dashboard.partials.footer')
