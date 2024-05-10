<!-- Stored in resources/views/child.blade.php -->
@extends('home')
@section('content')

    @if(session()->has('success'))
        <div style="text-align:center; border-radius:20px" class="alert alert-success alert-dismissible">
            <strong>{{ session('success') }}</strong>
        </div>
    @endif
    <form action="{{ route('insertPengajuan') }}" enctype="multipart/form-data" method="POST">
        {{ csrf_field() }}

        <div class="mb-3">
            <label for="formTanggal" class="form-label">Tanggal</label>
            <input class="form-control" type="date" name="formTanggal" id="formTanggal">
        </div>
        <div class="mb-3">
            <label for="formNama" class="form-label">Nama Reimbursement</label>
            <input class="form-control" type="text" name="formNama" id="formNama">
        </div>
        <div class="mb-3">
            <label for="formDeskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" name="formDeskripsi" id="formDeskripsi" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">File Pendukung</label>
            <input type="file" class="form-control formFile" name="formFile" id="formFile" accept=".jpg, .jpeg, .png, .pdf">
        </div>
        
        <button class="btn btn-outline-success" type="submit">Kirim</button>

    </form>


@endsection