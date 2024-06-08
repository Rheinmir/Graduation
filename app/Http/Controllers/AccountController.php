<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use App\Mail\VerifyAccount;
use App\Models\Customer;
use App\Models\Schedule;
use App\Models\ScheduleUser;
use App\Models\CustomerResetToken;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailer as MailMailer;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Mail;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function login() {
        return view('account.login');
    }

    public function favorite() {
        $favorites = auth('cus')->user()->favorites ? auth('cus')->user()->favorites : [];
        return view('account.favorite', compact('favorites'));
    }
    
    public function logout() {
        auth('cus')->logout();
        return redirect()->route('account.login')->with('ok','Bye bye!');
    }
    public function check_login(Request $req) {
        $req->validate([
            'email' => 'required|exists:customers',
            'password' => 'required'
        ]);

        $data = $req->only('email','password');

        $check = auth('cus')->attempt($data);

        if ($check) {
            if (auth('cus')->user()->email_verified_at == '') {
                auth('cus')->logout();
                return redirect()->back()->with('no','You account is not verify, please check email again');
            }

            return redirect()->route('home.index')->with('ok','Welcome back');
        }

        return redirect()->back()->with('no','Your account or password invalid');

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
            return redirect()->route('account.profile')->with('ok','Register successfully, please check your email to verify account');
        }
        return redirect()->back()->with('no','Something error, please try again');
    }
    public function verify($email) {
        $acc = Customer::where('email', $email)->whereNUll('email_verified_at')->firstOrFail();
        Customer::where('email', $email)->update(['email_verified_at' => date('Y-m-d')]);
        return redirect()->route('account.login')->with('ok','Verify account successfully, Now you can login');
    }

    public function change_password() {
        return view('account.change_password');
    }

    public function check_change_password(Request $req) {
        $auth = auth('cus')->user();
        $req->validate([
            'old_password' => [
                'required',
                function($attr, $value, $fail) use($auth)  {
                    $auth = auth('cus')->user();
                    if (!Hash::check($value, $auth->password) ) {
                        $fail('Your password is not match');
                    }
                }],
            'password' => 'required|min:4',
            'confirm_password' => 'required|same:password'
        ]);

        $data['password'] = bcrypt($req->password);
        $check = $auth->update($data);
        if ($check) {
            auth('cus')->logout();
            return redirect()->route('account.login')->with('ok','Update your password successfuly');
        }
        return redirect()->back()->with('no','Something error, please check agian');

    }
    public function forgot_password() {
        return view('account.forgot_password');
    }

    public function check_forgot_password(Request $req) {
        $req->validate([
            'email' => 'required|exists:customers'
        ]);

        $customer = Customer::where('email', $req->email)->first();

        $token = \Str::random(50);
        $tokenData = [
            'email' => $req->email,
            'token' => $token
        ];

        if (CustomerResetToken::create($tokenData)) {
            Mail::to($req->email)->send(new ForgotPassword($customer, $token));
            return redirect()->route('account.login')->with('ok','Send email successfully, please check email to continue');
        }

        return redirect()->back()->with('no','Something error, please check agian');

    }
    public function profile() {
        $auth = auth('cus')->user();
        return view('account.profile', compact('auth'));
    }

    public function check_profile(Request $req) {
        $auth = auth('cus')->user();
        $req->validate([
            'name' => 'required|min:6|max:100',
            'email' => 'required|email|min:6|max:100|unique:customers,email,'.$auth->id,
            'password' => ['required', function($attr, $value, $fail) use($auth) {
                if (!Hash::check($value, $auth->password)) {
                    return $fail('Your password í not mutch');
                }
            }],
        ], [
            'name.required' => 'Họ tên không được để tróng',
            'name.min' => 'Họ ten tối thiểu là 6 ký tự'
        ]);

        $data = $req->only('name','email','phone','address','gender');

        $check = $auth->update($data);
        if ($check) {
            return redirect()->back()->with('ok','Update your profile successfuly');
        }
        return redirect()->back()->with('no','Something error, please check agian');

    }
    public function reset_password($token) {

        $tokenData = CustomerResetToken::checkToken($token);

        return view('account.reset_password');
    }

    public function check_reset_password($token) {
        request()->validate([
            'password' => 'required|min:4',
            'confirm_password' => 'required|same:password'
        ]);

        $tokenData = CustomerResetToken::checkToken($token);
        $customer = $tokenData->customer;

        $data = [
            'password' => bcrypt(request(('password')))
        ];

        $check = $customer->update($data);

        if ($check) {
            return redirect()->route('account.login')->with('ok','Update your password successfuly');
        }

        return redirect()->back()->with('no','Something error, please check agian');

    }

    public function schedule()
    {
        $user = auth('cus')->user();

        $schedules = Schedule::with(['users' => function ($query) use ($user) {
            $query->where('user_id', $user->id);
        }])->orderByDesc('id')->paginate(15);

        return view('account.schedule', compact('schedules', 'user'));
    }

    public function scheduleUser($id)
    {
        $schedule = Schedule::find($id);

        if (!$schedule) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        $schedule_users = ScheduleUser::with(['user', 'schedule'])->where('schedule_id', $id)->get();
        $user = auth('cus')->user();
        $status = ScheduleUser::STATUS;
        return view('account.schedule_user', compact('schedule_users', 'user', 'schedule', 'status'));
    }

    public function scheduleUserDetail($id)
    {
        $schedule = Schedule::find($id);

        if (!$schedule) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        $user = auth('cus')->user();

        $schedule_user = ScheduleUser::where(['user_id' => $user->id, 'schedule_id' => $schedule->id])->first();

        return view('account.schedule_detail', compact('schedule', 'user', 'schedule_user'));
    }

    public function registerSchedule($id)
    {
        $schedule = Schedule::find($id);

        if (!$schedule) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        $user = auth('cus')->user();

        $schedule_user = ScheduleUser::where(['user_id' => $user->id, 'schedule_id' => $schedule->id])->first();

        if ($schedule_user) {
            return redirect()->route('account.schedule')->with('no','Bạn đã đăng ký');
        }

        $data = [
            'user_id' => $user->id,
            'schedule_id' => $schedule->id,
            'status' => 1,
        ];

        ScheduleUser::create($data);

        return redirect()->route('account.schedule')->with('ok','Đăng ký thành công lịch hẹn.');

    }
}