@extends('master.admin')
@section('title', 'Schedule')
@section('main')

    <form action="" method="GET" class="form-inline" role="form">

        <div class="form-group">
            <label class="sr-only" for="">label</label>
            <input type="text" class="form-control" name="title" id="" placeholder="">
        </div>
        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
    </form>


    <br>

    <table class="table table-hover">
        <thead>
        <tr>
            <th class=" text-center">No.</th>
            <th>Requester</th>
            <th>Date</th>
            <th>Status</th>
            <th class=" text-center">Edit/Delete</th>
        </tr>
        </thead>
        <tbody>
        @if (!$schedule_users->isEmpty())
            @php $i = $schedule_users->firstItem(); @endphp
            @foreach($schedule_users as $schedule_user)
                <tr>
                    <td class=" text-center">{{ $i }}</td>
                    <td>{{ isset($schedule_user->user) ? $schedule_user->user->name : '' }}</td>
                    <td>{{ isset($schedule_user->schedule) ? $schedule_user->schedule->title : '' }}</td>
                    <td>{{ isset($status[$schedule_user->status]) ? $status[$schedule_user->status] : '' }}</td>
                    <td class="text-center">

                        <form action="{{ route('schedule.user.delete', $schedule_user->id) }}" method="post" >
                            @csrf @method('DELETE')
                            <a href="{{ route('schedule.user.update', $schedule_user->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you suere wanto delete it?')"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @php $i++ @endphp
            @endforeach
        @endif

        </tbody>
    </table>

    @if($schedule_users->hasPages())
        <div class="pagination float-right margin-20">
            {{ $schedule_users->appends($query = '')->links() }}
        </div>
    @endif

@stop()
