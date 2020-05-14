<?php

namespace App\Http\Controllers;

use App\Admin;
use App\AdminsVerify;
use App\Seller;
use App\VerifyErrorsAdmin;
use App\VerifyErrorsSeller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if ($request->option == 'admin') {
            $admin = new Admin();
            $result = $admin->where('username', '=', $request->username)->where('password', '=', md5($request->password))->get(['username', 'logged', 'id']);
            if (sizeof($result) == 0) {
                $verify = new VerifyErrorsAdmin();
                $verify = $verify->where('username_admin', '=', $request->username)->get();
                if (sizeof($verify) > 0) {
                    if ($verify[0]['numbers_errors'] <= 4) {
                        $update = new VerifyErrorsAdmin();
                        $update = $update->find($verify[0]['id']);
                        $update->numbers_errors = $verify[0]['numbers_errors'] + 1;
                        $update->save();
                    }
                }
                $request->session()->flash('error', 'Usuário ou Senha Incorreto(a)');
                return redirect('/');
            } else {
                if ($result[0]["logged"] == 1) {
                    $request->session()->flash('error', 'Usuário atual já está online.');
                    return redirect('/');
                } else {
                    $verify = new VerifyErrorsAdmin();
                    $verify = $verify->where('username_admin', '=', $request->username)->get();
                    if (sizeof($verify) > 0 && $verify[0]['numbers_errors'] >= 4) {
                        $request->session()->flash('error', 'Limite de tentativas atingido, contate o administrador.');
                        return redirect('/');
                    }
                    $update = new Admin();
                    $update = $admin->find($result[0]["id"]);
                    $update->logged = 1;
                    $update->save();
                    Session::put('admin', $request->username);
                    Session::put('logado', true);
                    Session::put('idAdmin', $result[0]["id"]);
                    return redirect('/admin');
                }
            }
        } else {
            $seller = new Seller();
            $result = $seller->where('username', '=', $request->username)->where('password', '=', md5($request->password))->get(['username', 'id', 'logged']);
            if (sizeof($result) == 0) {
                $verify = new VerifyErrorsSeller();
                $verify = $verify->where('username_seller', $request->username)->get();
                if (sizeof($verify) > 0) {
                    if ($verify[0]['numbers_errors'] <= 4) {
                        $update = new VerifyErrorsSeller();
                        $update = $update->find($verify[0]['id']);
                        $update->numbers_errors = $verify[0]['numbers_errors'] + 1;
                        $update->save();
                    }
                }
                $request->session()->flash('error', 'Usuário ou Senha Incorreto(a)');
                return redirect('/');
            } else {
                if ($result[0]["logged"] == 1) {
                    $request->session()->flash('error', 'Usuário atual já está online.');
                    return redirect('/');
                } else {
                    $verify = new VerifyErrorsSeller();
                    $verify = $verify->where('username_seller', '=', $request->username)->get();
                    if (sizeof($verify) > 0 && $verify[0]['numbers_errors'] >= 4) {
                        $request->session()->flash('error', 'Limite de tentativas atingido, contate o administrador.');
                        return redirect('/');
                    }
                    $update = new Seller();
                    $update = $seller->find($result[0]['id']);
                    $update->logged = 1;
                    $update->save();
                    Session::put('idSeller', $result[0]['id']);
                    Session::put('seller', $request->username);
                    Session::put('logado', true);
                    return redirect('/seller');
                }
            }
        }
    }

    public function logout()
    {
        if (Session::exists('logado') && Session::exists('admin')) {
            $admin = new Admin();
            $update = $admin->find(Session::get('idAdmin'));
            $update->logged = 0;
            $update->save();
            Session::flush();
        } else if (Session::exists('logado') && Session::exists('seller')) {
            $seller = new Seller();
            $update = $seller->find(Session::get('idSeller'));
            $update->logged = 0;
            $update->save();
            Session::flush();
        }
        return redirect('/');
    }

    public function index()
    {
        if (Session::exists('admin') && Session::exists('logado')) {
            return redirect('/admin');
        } else if (Session::exists('logado') && Session::exists('admin') == false) {
            return redirect('/seller');
        } else {
            return view('index');
        }
    }

    public function home()
    {
        if (Session::exists('logado') && Session::exists('admin')) {
            return redirect('/admin');
        } else if (Session::exists('logado') && Session::exists('admin') == false) {
            return redirect('/seller');
        } else {
            return redirect('/');
        }
    }
}
