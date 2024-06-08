<?php

namespace App\Http\Controllers\Admin;

use App\Models\ScheduleUser;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use Illuminate\Mail\Mailer as MailMailer;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Illuminate\Contracts\Mail\Mailer;
use App\Mail\ConfirmSchedule;

class ScheduleUserController extends Controller
{
    //
    protected $scheduleUser;
    /**
     * constructor.
     */
    public function __construct(ScheduleUser  $scheduleUser)
    {
        view()->share([
            'status' => $scheduleUser::STATUS,
        ]);
        $this->scheduleUser = $scheduleUser;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $schedule_users = ScheduleUser::with(['user', 'schedule']);
        if ($request->title) {
            $schedule_users->where('title', 'like', '%'.$request->title.'%');
        }

        $schedule_users = $schedule_users->orderByDesc('id')->paginate(15);

        return view('admin.schedule-user.index', compact('schedule_users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $schedule_user = ScheduleUser::with(['user', 'schedule'])->find($id);
        $status_schedule = Schedule::STATUS;

        if (!$schedule_user) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        return view('admin.schedule-user.edit', compact('schedule_user', 'status_schedule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        \DB::beginTransaction();
        try {
            $schedule_user = ScheduleUser::with(['user', 'schedule'])->find($id);

            if (!$schedule_user) {
                return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
            }
            $schedule = $schedule_user->schedule;
            $status = $request->status;
            $schedule_user->status = $status;
            if ($schedule_user->save()) {
                if ($schedule_user->status == 2) {
                    $customer = $schedule_user->user;
                    Mail::to($customer->email)->send(new ConfirmSchedule($customer, $schedule));
                }
            }

            \DB::commit();
            return redirect()->back()->with('ok', 'Lưu dữ liệu thành công');
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->back()->with('no', 'Đã xảy ra lỗi khi lưu dữ liệu');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
        $schedule_user = ScheduleUser::find($id);
        if (!$schedule_user) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        try {
            $schedule_user->delete();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể xóa dữ liệu');
        }
    }
}
