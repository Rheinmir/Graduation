<?php

namespace App\Http\Controllers\Admin;

use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Requests\ScheduleRequest;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
    protected $schedule;
    /**
     * constructor.
     */
    public function __construct(Schedule  $schedule)
    {
        view()->share([
            'status' => $schedule::STATUS,
        ]);
        $this->schedule = $schedule;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $schedules = Schedule::select('*');
        if ($request->title) {
            $schedules->where('title', 'like', '%'.$request->title.'%');
        }
        $schedules = $schedules->orderByDesc('id')->paginate(15);

        return view('admin.schedule.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.schedule.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ScheduleRequest $request)
    {
        //
        \DB::beginTransaction();
        try {
            $this->schedule->createOrUpdate($request);
            \DB::commit();
            return redirect()->back()->with('ok', 'Lưu dữ liệu thành công');
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->back()->with('no', 'Đã xảy ra lỗi khi lưu dữ liệu');
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $schedule = Schedule::find($id);

        if (!$schedule) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        return view('admin.schedule.edit', compact('schedule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ScheduleRequest $request, $id)
    {
        //
        \DB::beginTransaction();
        try {
            $this->schedule->createOrUpdate($request, $id);
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
        $schedule = Schedule::find($id);
        if (!$schedule) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        try {
            $schedule->delete();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể xóa dữ liệu');
        }
    }
}
