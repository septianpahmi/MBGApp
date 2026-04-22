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
                    <form action="{{ route('menuUpdate', $menu->slug) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Lengkapi Informasi Menu</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label fw-semibold mb-2">
                                                Upload Gambar <code>*</code>
                                            </label>

                                            <!-- Upload Box -->
                                            <div class="upload-box" onclick="document.getElementById('image').click()">
                                                <input type="file" id="image" name="image" accept="image/*"
                                                    hidden required>

                                                <div id="upload-content">
                                                    <i class="bi bi-cloud-upload fs-1 text-secondary"></i>
                                                    <p class="mb-0 text-muted">Klik atau drag gambar ke sini</p>
                                                </div>

                                                <!-- Preview -->
                                                <img id="preview-image" class="img-preview d-none" />
                                            </div>
                                            <small class="text-muted d-block mt-2">
                                                Maksimal ukuran <b>5MB</b>, format JPG/PNG,.</b>
                                            </small>
                                            <span class="text-danger">{{ $errors->first('image') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="title">Nama Menu <code>*</code></label>
                                            <input type="text" class="form-control" id="title" name="title"
                                                placeholder="Masukkan nama menu" autofocus required
                                                value="{{ old('title', $menu->title) }}">
                                            <span class="text-danger">{{ $errors->first('title') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="receiver_id">Pilih Instansi <code>*</code></label>
                                            <select class="form-control" id="receiver_id" name="receiver_id" required>
                                                <option value="" selected disabled>Pilih Instansi</option>
                                                @foreach ($receivers as $receiver)
                                                    <option value="{{ $receiver->id }}"
                                                        {{ old('receiver_id', $menu->receiver_id) == $receiver->id ? 'selected' : '' }}>
                                                        {{ $receiver->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">{{ $errors->first('receiver_id') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="date">Tanggal <code>*</code></label>
                                            <input type="date" class="form-control" id="date" name="date"
                                                autofocus required value="{{ old('date', $menu->date) }}">
                                            <span class="text-danger">{{ $errors->first('date') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Deskripsi</label>
                                            <textarea type="text" class="form-control" id="description" name="description" placeholder="Masukkan deskripsi">{{ old('description', $menu->description) }}</textarea>
                                            <span class="text-danger">{{ $errors->first('description') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Informasi Gizi</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="calories">Kalori</label>
                                            <input type="text" class="form-control" id="calories" name="calories"
                                                placeholder="Masukkan jumlah kalori" inputmode="numeric"
                                                pattern="[0-9]*"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                value="{{ old('calories', $menu->nutrition ? $menu->nutrition->calories : '') }}">
                                            <span class="text-danger">{{ $errors->first('calories') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="protein">Protein</label>
                                            <input type="text" class="form-control" id="protein" name="protein"
                                                placeholder="Masukkan jumlah protein" inputmode="numeric"
                                                pattern="[0-9]*"
                                                value="{{ old('protein', $menu->nutrition ? $menu->nutrition->protein : '') }}"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                            <span class="text-danger">{{ $errors->first('protein') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="carbs">Karbohidrat</label>
                                            <input type="text" class="form-control" id="carbs" name="carbs"
                                                placeholder="Masukkan jumlah karbohidrat" inputmode="numeric"
                                                pattern="[0-9]*"
                                                value="{{ old('carbs', $menu->nutrition ? $menu->nutrition->carbs : '') }}"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                            <span class="text-danger">{{ $errors->first('carbs') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fats">Lemak</label>
                                            <input type="text" class="form-control" id="fats" name="fats"
                                                placeholder="Masukkan jumlah lemak" inputmode="numeric"
                                                pattern="[0-9]*"
                                                value="{{ old('fats', $menu->nutrition ? $menu->nutrition->fats : '') }}"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                            <span class="text-danger">{{ $errors->first('fats') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <button type="submit" class="btn btn-primary w-100">Simpan Menu</button>
                        </div>
                    </form>
                </div>
            </di>
        </div>
    </div>
</div>

@include('dashboard.partials.footer')
