<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">

    <title>Reimbursement</title>

    <style>
        .center {
            padding: 70px 0;
            margin: auto;
            text-align: center;
        }
        .brand {
            font-weight: 700;
            /* margin-bottom: 20px; */
            color: white !important;
        }
        .btn {
            margin: 0px 10px;
        }
        .container {
            padding-top: 50px;
        }
    </style>

</head>
<body>
    
    <nav class="navbar navbar-light bg-success">
        <div class="container-fluid">
            <a class="navbar-brand brand">Selamat Datang, {{ ucfirst(auth()->user()->name) }}</a>
            <form class="d-flex">
                @if (url()->current() == route('pengajuan'))
                    <a class="btn btn-outline-light" href="{{ route('home') }}" role="button">Kembali</a>
                @else
                    @if(auth()->user()->jabatan == 'staff')
                        <a class="btn btn-outline-light" href="{{ route('pengajuan') }}" role="button">Form Pengajuan</a>
                    @endif
                    <a class="btn btn-outline-danger" href="{{ route('logout') }}" role="button">Logout</a>
                @endif
            </form>
        </div>
    </nav>

    <div class="container">
        @if (url()->current() == route('pengajuan'))
            @yield('content')
        @else
            <h3>Data Pengajuan Reimbursement</h3>
            <div class="table-responsive">
                <table id="myTableRiwayat" class="table align-items-center table-flush table-success table-bordered table-striped">
                    <thead class="thead-light" style="text-align: center;">
                        <tr>
                            <th scope="col" class="sort" style="width: 100px;">Tanggal</th>
                            <th scope="col" class="sort">Nama Reimbursement</th>
                            <th scope="col" class="sort">Deskripsi</th>
                            <th scope="col" class="sort" style="width: 300px;">Status</th>
                            @if(auth()->user()->jabatan != 'staff')
                                <th scope="col" class="sort" style="width: 200px">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="list" style="text-align: center;">
                        @foreach($result as $d)
                            <tr>
                                <td>{{ $d->tanggalPengajuan }}</td>
                                <td>{{ $d->namaPengajuan }}</td>
                                <td>{{ $d->deskripsiPengajuan }}</td>
                                <td>
                                    @if($d->d_verified == false)
                                        @if(auth()->user()->jabatan == 'direktur')
                                            <button type="button" class="btn btn-danger">Menunggu Persetujuan Anda</button>
                                        @else
                                            <button type="button" class="btn btn-warning">Menunggu Persetujuan Direktur</button>
                                        @endif
                                    @else
                                        @if($d->f_verified == false)
                                            @if(auth()->user()->jabatan == 'finance')
                                                <button type="button" class="btn btn-danger">Menunggu Persetujuan Anda</button>
                                            @else
                                                <button type="button" class="btn btn-warning">Menunggu Persetujuan Finance</button>
                                            @endif
                                        @else
                                            <button type="button" class="btn btn-success">Telah disetujui</button>
                                        @endif
                                    @endif
                                    {{-- <button type="button" class="btn btn-danger">Tidak disetujui</button> --}}
                                </td>
                                @if(auth()->user()->jabatan == 'direktur')
                                    <td>
                                        @if($d->d_verified == true)
                                            <button type="button" class="btn btn-success">Telah Anda Setujui</button>
                                        @else
                                            <form action="/pengajuan/updatePengajuan/{{ $d->id_pengajuan }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary" >Setujui</button> 
                                            </form>
                                        @endif
                                    </td>
                                @endif
                                @if(auth()->user()->jabatan == 'finance')
                                    <td>
                                        @if($d->f_verified == true)
                                            <button type="button" class="btn btn-success">Telah Anda Setujui</button>
                                        @else
                                        <form action="/pengajuan/updatePengajuan2/{{ $d->id_pengajuan }}" method="POST">
                                            @csrf
                                                @if($d->d_verified == true)
                                                    <button type="submit" class="btn btn-primary" >Setujui</button> 
                                                @else
                                                    <button type="button" class="btn btn-info" >Menunggu</button> 
                                                @endif
                                            </form>
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            @if(auth()->user()->jabatan == 'direktur')
                <div class="d-flex justify-content-between" style="margin-bottom: 10px;">
                    <h3>Data Pegawai</h3>
                    <a class="btn btn-outline-dark" href="{{ route('register') }}" role="button">Tambah Akun</a>
                </div>
                @error('login_berhasil')
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="padding: 10px !important">
                        {{-- <span class="alert-inner--text" > --}}
                            <center><strong>Berhasil!</strong></center>
                            <center>{{ $message }}</center>
                        {{-- </span> --}}
                    </div>
                @enderror
                <div class="table-responsive">
                    <table id="myTableRiwayat" class="table align-items-center table-flush table-success table-bordered table-striped">
                        <thead class="thead-light" style="text-align: center;">
                            <tr>
                                <th scope="col" class="sort">NIP</th>
                                <th scope="col" class="sort">Nama</th>
                                <th scope="col" class="sort">Jabatan</th>
                                @if(auth()->user()->jabatan != 'staff')
                                    <th scope="col" class="sort">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="list" style="text-align: center;">
                            @foreach($data as $d)
                                <tr>
                                    <td>{{ $d->nip }}</td>
                                    <td>{{ $d->name }}</td>
                                    <td>{{ $d->jabatan }}</td>
                                    @if(auth()->user()->jabatan != 'staff')
                                        <td>
                                            <a class="btn btn-outline-dark" href="/edit_user/{{ $d->id }}" role="button">Edit</a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        @endif
    </div>    

    
</body>
</html>