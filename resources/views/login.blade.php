@extends('layout')
@section('judul', 'Login')
@section('content')

<style>
    .centered {
        max-width: 25%;
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
                    <div class="col-lg-4 centered">
                        <div class="card shadow-lg border-0 rounded-lg">
                            {{-- Error Alert --}}
                            @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{session('error')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            <div class="card-header bg-success">
                                <h3 class="text-center my-3" style="color: white;"><b>Login</b></h3>
                            </div>
                            <div class="card-body">
                                <form action="{{url('proses_login')}}" method="POST" id="logForm">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        @error('login_gagal')
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert" style="padding: 10px !important">
                                                {{-- <span class="alert-inner--text" > --}}
                                                    <center><strong>Warning!</strong></center>
                                                    <center>{{ $message }}</center>
                                                {{-- </span> --}}
                                            </div>
                                        @enderror
                                        <label class="small mb-1" for="inputEmailAddress">NIP</label>
                                        <input
                                            class="form-control"
                                            id="inputEmailAddress"
                                            name="nip"
                                            type="text"
                                            placeholder="Masukkan NIP"/>
                                        @if($errors->has('nip'))
                                        <span class="error">{{ $errors->first('nip') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputPassword">Password</label>
                                        <input
                                            class="form-control"
                                            id="inputPassword"
                                            type="password"
                                            name="password"
                                            placeholder="Masukkan Password"/>
                                        @if($errors->has('password'))
                                        <span class="error">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    {{-- <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox"/>
                                            <label class="custom-control-label" for="rememberPasswordCheck">Ingat Saya!</label>
                                        </div>
                                    </div> --}}
                                    <div
                                    class="form-group d-flex align-items-center justify-content-center mt-4 mb-0">
                                        {{-- <a class="small" href="#">Forgot Password?</a> --}}
                                        <button class="btn w-50 btn-outline-primary btn-block btn-login" type="submit">Login</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center bg-success">
                                <div class="small my-2">
                                    {{-- <a href="{{route('register')}}">Belum Punya Akun? Daftar!</a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</div>
@endsection