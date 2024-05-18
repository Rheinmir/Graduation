<?php

namespace App\Http\Controllers;

use App\Mail\VerifyAccount;
use App\Models\Customer;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailer as MailMailer;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Mail;

class AccountController extends Controller
{
    public function login() {
        return view('account.login');
    }
    public function register() {
        return view('account.register');
    }
    public function check_register(Request $req) {
        $req->validate([
            'name' => 'required|min:6|max:100',
            'email' => 'required|email|min:6|max:100|unique:customers',
            'password' => 'required|min:4',
            'confirm_password' => 'required|same:password',
        ], [
            'name.required' => 'Họ tên không được để trống',
            'name.min' => 'Họ tên tối thiểu là 4 ký tự'
        ]);

        $data = $req->only('name','email','phone','address','gender');

        $data['password'] = bcrypt($req->password);
        if ($acc = Customer::create($data) ) {
            // Sends a verification email to the specified email address.
            Mail::to($acc->email)->send(new VerifyAccount($acc));
            return redirect()->route('account.login')->with('Ok','Register successfully, please check your email to verify account');
        }
        return redirect()->back()->with('no','Smething error, please try again');
    }
    public function verify($email) {
        $acc = Customer::where('email', $email)->whereNUll('email_verified_at')->firstOrFail();
        Customer::where('email', $email)->update(['email_verified_at' => date('Y-m-d')]);
        return redirect()->route('account.login')->with('Ok','Verify account successfully, Now you can login');
    }

    public function change_password() {
        return view('account.changer_pasword');
    }
    public function check_change_password() {

    }
    public function forgot_password() {
        return view('account.forgot_password');
    }
    public function check_forgot_password() {

    }
    public function profile() {
        return view('account.profile', compact('auth'));
    }
    public function check_profile() {

    }
    public function reset_password() {
        return view('account.login');
    }
    public function check_reset_password() {

    }
}