@extends('master.main')

@section('main')
    <!-- main-area -->
    <main>
        <!-- breadcrumb-area -->
        <section class="breadcrumb-area tg-motion-effects breadcrumb-bg" data-background="uploads/bg/breadcrumb_bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-content">
                            <h2 class="title">Danh sách lịch hẹn</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Danh sách lịch hẹn</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb-area-end -->

        <!-- contact-area -->
        <section class="contact-area">
            <div class="contact-wrap">
                <div class="container">
                    <div class="row align-items-center">
                        @include('account.sidebar')
                        <div class="col-lg-9">
                            <div class="contact-content">
                                <div class="section-title mb-15">
                                    <span class="sub-title">Đăng ký lịch hẹn</span>
                                    <h2 class="title">Danh sách lịch hẹn</h2>
                                </div>
                                <p>Đăng ký lịch hẹn</p>

                                @if (Session::has('no') && ($message = Session::get('no')))
                                    <div class="alert alert-danger" role="alert">
                                        {!! $message !!}
                                    </div>
                                @elseif (Session::has('ok') && ($message = Session::get('ok')))
                                    <div class="alert alert-success" role="alert">
                                        {!! $message !!}
                                    </div>
                                    <!--nothing-->
                                @endif

                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">Tiêu đề</th>
                                        <th scope="col">Ngày hẹn</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col" class="text-center">Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($schedules as $key => $schedule)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>{{ $schedule->title }}</td>
                                            <td>{{ $schedule->schedule_date }}</td>
                                            <td>
                                                @if ($schedule->users->isNotEmpty())
                                                    @if ($schedule->users->where('user_id', $user->id))
                                                        @foreach($schedule->users as $schedule_user)
                                                            @if ($schedule_user->user_id == $user->id)
                                                                @if ($schedule_user->status == 2)
                                                                    Đã xác nhận
                                                                @else
                                                                    Đã đăng ký
                                                                @endif
                                                            @else
                                                                Chưa đăng ký
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        Chưa đăng ký
                                                    @endif
                                                @else
                                                    Chưa đăng ký
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('account.schedule.user', $schedule->id) }}" title="Danh sách"><i class="fa fa-list" aria-hidden="true"></i></a>
                                                <a href="{{ route('account.schedule.user.detail', $schedule->id) }}" title="Đăng ký"><i class="fa fa-save" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if($schedules->hasPages())
                                <div class="pagination float-right margin-20">
                                    {{ $schedules->appends($query = '')->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact-area-end -->

    </main>
    <!-- main-area-end -->

@stop()
