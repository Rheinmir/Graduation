@extends('master.admin')
@section('title', 'Lịch hẹn')
@section('main')

    <form action="" method="GET" class="form-inline" role="form">

        <div class="form-group">
            <label class="sr-only" for="">label</label>
            <input type="text" class="form-control" name="title" id="" placeholder="Tiêu đề lịch hẹn">
        </div>



        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
        <a href="{{ route('schedule.create') }}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Thêm mới</a>
    </form>


    <br>

    <table class="table table-hover">
        <thead>
        <tr>
            <th class=" text-center">STT</th>
            <th>Tiêu đề lịch hẹn</th>
            <th>Ngày hẹn</th>
            <th>Trạng thái</th>
            <th class=" text-center">Hành động</th>
        </tr>
        </thead>
        <tbody>
            @if (!$schedules->isEmpty())
                @php $i = $schedules->firstItem(); @endphp
                @foreach($schedules as $schedule)
                    <tr>
                        <td class=" text-center">{{ $i }}</td>
                        <td>{{ $schedule->title }}</td>
                        <td>{{ $schedule->schedule_date }}</td>
                        <td>{{ isset($status[$schedule->status]) ? $status[$schedule->status] : '' }}</td>
                        <td class="text-center">

                            <form action="{{ route('schedule.delete', $schedule->id) }}" method="post" >
                                @csrf @method('DELETE')
                                <a href="{{ route('schedule.update', $schedule->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you suere wanto delete it?')"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @php $i++ @endphp
                @endforeach
            @endif

        </tbody>
    </table>

    @if($schedules->hasPages())
        <div class="pagination float-right margin-20">
            {{ $schedules->appends($query = '')->links() }}
        </div>
    @endif

@stop()
