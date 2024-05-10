@extends('layout')
@section('judul', 'Register')
@section('content')

<style>
    .centered {
        max-width: 30%;
        position: fixed;
        top: 50%;
        left: 50%;
        /* bring your own prefixes */
        transform: translate(-50%, -50%);
    }
</style>

<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7 centered">
                        <div class="card shadow-lg border-0 rounded-lg">
                            @if (url()->current() == route('register'))
                                <div class="card-header bg-success"><h3 class="text-center font-weight-light my-4" style="color: white;">Buat Akun</h3></div>
                            @else
                                <div class="card-header bg-success"><h3 class="text-center font-weight-light my-4" style="color: white;">Edit Akun</h3></div>
                            @endif
                            <div class="card-body">
                                @if (url()->current() == route('register'))
                                    <form action="{{route('proses_register')}}" method="POST" id="regForm">
                                @else
                                    <form action="{{route('proses_edit_user', $data->id)}}" method="POST" id="regForm">
                                @endif
                                {{ csrf_field() }}
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputFirstName">Nama</label>
                                        <input class="form-control" id="inputFirstName" type="text" name="name" value="{{ $data->name ?? '' }}" placeholder="Masukkan Nama" />
                                         @if ($errors->has('name'))
                                          <span class="error"> * {{ $errors->first('name') }}</span>
                                          @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputnip">NIP</label>
                                        <input class="form-control" id="inputnip" type="text" name="nip" value="{{ $data->nip ?? '' }}" placeholder="Masukkan NIP" />
                                         @if ($errors->has('nip'))
                                          <span class="error"> * {{ $errors->first('nip') }}</span>
                                          @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputEmailAddress">Email</label>
                                        <input class="form-control" id="inputEmailAddress" type="email" aria-describedby="emailHelp" name="email" value="{{ $data->email ?? '' }}" placeholder="Masukkan Email" />
                                        @if ($errors->has('email'))
                                          <span class="error">* {{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputJabatan">Jabatan</label>
                                        <input class="form-control" id="inputJabatan" type="text" name="jabatan" value="{{ $data->jabatan ?? '' }}" placeholder="Masukkan Jabatan" />
                                         @if ($errors->has('jabatan'))
                                          <span class="error"> * {{ $errors->first('jabatan') }}</span>
                                          @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputPassword">Password</label>
                                        <input class="form-control" id="inputPassword" type="password" name="password" placeholder="Masukkan Password" />
                                        @if ($errors->has('password'))
                                        <span class="error">* {{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputStatus">Status</label>
                                        <select class="form-control" id="inputStatus" name="status" value="{{ $data->status ?? '' }}">
                                            <option value="true">Aktif</option>
                                            <option value="false">Tidak Aktif</option>>
                                        </select>
                                         @if ($errors->has('status'))
                                          <span class="error"> * {{ $errors->first('status') }}</span>
                                          @endif
                                    </div>
                                    <div class="form-group mt-4 mb-0">
                                        <div class="d-flex justify-content-between">
                                            <button class="btn btn-primary btn-block" type="submit">Submit</button>
                                            <a class="btn btn-warning" href="{{ route('home') }}" role="button">Kembali</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            {{-- <div class="card-footer text-center">
                                <div class="small"><a href="{{route('login')}}">Sudah Punya Akun?</a></div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</div>
@endsection