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
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <di class="row">
                <div class="col-lg-12">
                    <form action="{{ route('beneficiaryStore') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Buat Akun Penerima Manfaat</h3>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">NIK/NIS <code>*</code></label>
                                            <input type="text" class="form-control" id="email" name="username"
                                                placeholder="Masukkan NIK/NIS" inputmode="numeric" pattern="[0-9]*"
                                                minlength="3" maxlength="15" required
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                            <span class="text-danger">{{ $errors->first('username') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Password <code>*</code></label>
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="Masukkan password" required>
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Lengkapi Informasi Penerima Manfaat</h3>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Nama <code>*</code></label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Masukkan nama lengkap" autofocus required>
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="receiver_id">Pilih Instansi Penerima <code>*</code></label>
                                            <select class="form-control" id="receiver_id" name="receiver_id" required>
                                                <option value="" selected disabled>Pilih Instansi</option>
                                                @foreach ($receivers as $receiver)
                                                    <option value="{{ $receiver->id }}">{{ $receiver->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">{{ $errors->first('receiver_id') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">Nomor Telepon <code>*</code></label>
                                            <input type="text" class="form-control" id="phone" name="phone"
                                                placeholder="Masukkan Nomor Telepon" inputmode="numeric"
                                                pattern="[0-9]*" minlength="11" maxlength="15" required
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="address">Alamat <code>*</code></label>
                                            <textarea type="text" class="form-control" id="address" name="address" placeholder="Masukkan Alamat" required></textarea>
                                            <span class="text-danger">{{ $errors->first('address') }}</span>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="card">
                            <button type="submit" class="btn btn-primary w-100">Simpan</button>
                        </div>
                    </form>
                </div>
            </di>
        </div>
    </div>
</div>

@include('dashboard.partials.footer')
