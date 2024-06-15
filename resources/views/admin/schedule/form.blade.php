<div class="container-fluid">
    <form role="form" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group {{ $errors->first('title') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Title <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="text" class="form-control"  placeholder="Title" name="title" value="{{ old('title',isset($schedule) ? $schedule->title : '') }}">
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('title') }}</p></span>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->first('contents') ? 'has-error' : '' }}">
                            <label for="">Description <sup class="text-danger">(*)</sup></label>
                            <textarea name="contents" class="form-control contents" placeholder="description">{!! old('contents',isset($schedule) ? $schedule->contents : '') !!}</textarea>
                            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('contents') }}</p></span>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">

                    <div class="col-md-12">
                        <div class="form-group {{ $errors->first('schedule_date') ? 'has-error' : '' }}">
                            <label>Date <sup class="text-danger">(*)</sup></label>
                            <input type="date" name="schedule_date" value="{{ old('schedule_date',isset($schedule) ? $schedule->schedule_date : '') }}" class="form-control">
                            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('schedule_date') }}</p></span>
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control"  name="status">
                                @foreach($status as $key => $item)
                                    <option
                                            {{old('status', isset($schedule->status) ? $schedule->status : '') == $key ? 'selected="selected"' : ''}}
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
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>
