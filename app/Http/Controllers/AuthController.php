<?php

namespace App\Http\Controllers;

use DB;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{


    public function index(){
        return view('login');
    }

    public function proses_login(Request $request){
        $request->validate([
            'nip'=>'required',
            'password'=>'required'
        ]);
    
        $credential = $request->only('nip','password');

        if(Auth::attempt($credential)){
            $user =  Auth::user();
            if($user->status == true){
                if($user->jabatan == 'direktur'){
                    return redirect()->intended('/home');
                }
                else if($user->jabatan == 'finance'){
                    return redirect()->intended('/home');
                }
                else if($user->jabatan == 'staff'){
                    return redirect()->intended('/home');
                }
                return redirect()->intended('/');
            }
        }

        return redirect('login')
            ->withInput()
            ->withErrors(['login_gagal'=>'Akun belum terdaftar!']);
    }

    public function register(){
        return view('register');
    }

    public function proses_register(Request $request){ 
        $validator =  Validator::make($request->all(),[
            'name'=>'required',
            'nip'=>'required|unique:users',
            'email'=>'required|email',
            'password'=>'required'
        ]);
        
        if($validator->fails()){
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
        }
        $request['status'] = $request->status;
        $request['jabatan'] = $request->jabatan;
        $request['password'] = bcrypt($request->password);

        User::create($request->all());

        return redirect()->route('home')
            ->withInput()
            ->withErrors(['login_berhasil'=>'Akun telah didaftarkan!']);;
    }

    public function edit_user($id){
        $data = DB::table('users')->where('id' , '=' , $id)->first();
        return view('register', compact('data'));
    }

    public function proses_edit_user(Request $request, $id){ 

        // $validator =  Validator::make($request->all(),[
        //     'name'=>'required',
        //     'nip'=>'required|unique:users',
        //     'email'=>'required|email',
        //     'password'=>'required'
        // ]);
        
        // if($validator->fails()){
        //     return redirect('home')
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        if(!empty($request->password)) {
            $users = User::where('id', '=', $id)->update([
                'name' => $request->name,
                'nip' => $request->nip,
                'email' => $request->email,
                'jabatan' => $request->jabatan,
                'status' => $request->status,
                'password' => bcrypt($request->password),
            ]);
        } else {
            $users = User::where('id', '=', $id)->update([
                'name' => $request->name,
                'nip' => $request->nip,
                'email' => $request->email,
                'jabatan' => $request->jabatan,
                'status' => $request->status,
            ]);
        }

        return redirect()->route('home')
            ->withInput()
            ->withErrors(['login_berhasil'=>'Akun telah diubah!']);;
    }

    public function logout(Request $request){
        $request->session()->flush();

        Auth::logout();
        return Redirect('login');
    }
}