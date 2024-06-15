@extends('master.admin')
@section('title', 'Schedule')
@section('main')
    <!-- Main content -->
    <section class="content">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    Schedule detail
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-6 invoice-col">
                <p>Title : <b>{{ isset($schedule_user->schedule) ? $schedule_user->schedule->title : '' }}</b></p>
                <p>Date : <b>{{ isset($schedule_user->schedule) ? $schedule_user->schedule->schedule_date : '' }}</b></p>
                <p>Status : <b>{{ isset($status_schedule[$schedule_user->schedule->status]) ? $status_schedule[$schedule_user->schedule->status] : '' }}</b></p>

            </div>
            <div class="col-sm-6 invoice-col">
                <p>Fullname : <b>{{ isset($schedule_user->user) ? $schedule_user->user->name : '' }}</b></p>
                <p>Email : <b>{{ isset($schedule_user->user) ? $schedule_user->user->email : '' }}</b></p>
                <p>Phone : <b>{{ isset($schedule_user->user) ? $schedule_user->user->phone : '' }}</b></p>
                <p>Address : <b>{{ isset($schedule_user->address) ? $schedule_user->user->address : '' }}</b></p>
            </div>
            <div class="col-sm-12 invoice-col">
                <b>Detail : </b>
                <p>
                    {!! isset($schedule_user->schedule) ? $schedule_user->schedule->contents : '' !!}
                </p>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-sm-12">
                <form role="form" action="{{ route('schedule.user.update', $schedule_user->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control"  name="status">
                            @foreach($status as $key => $item)
                                <option
                                        {{old('status', isset($schedule_user->status) ? $schedule_user->status : '') == $key ? 'selected="selected"' : ''}}
                                        value="{{$key}}"
                                >
                                    {{$item}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" name="submit" class="btn btn-info">
                        <i class="fa fa-save"></i> Save
                    </button>
                </form>
            </div>
        </div>
        <!-- /.row -->
    </section>
@stop
@section('css')
    <link rel="stylesheet" href="ad_assets/plugins/summernote/summernote.min.css">
@stop()

@section('js')
    <script src="ad_assets/plugins/summernote/summernote.min.js"></script>
    <script>
        $('.contents').summernote({
            height: 250
        });
    </script>
@stop()