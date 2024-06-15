@extends('master.main')

@section('main')

    <main>
        <!-- breadcrumb-area -->
        <section class="breadcrumb-area tg-motion-effects breadcrumb-bg" data-background="uploads/bg/breadcrumb_bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-content">
                            <h2 class="title">List</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">>List</li>
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
                                    <span class="sub-title">List</span>
                                    <h2 class="title">{{ $schedule->title }}</h2>
                                </div>
                                <p>List</p>
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th class=" text-center">No.</th>
                                        <th>Requester</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($schedule_users as $key => $schedule_user)
                                            <tr>
                                                <td class=" text-center">{{ $key + 1 }}</td>
                                                <td>{{ isset($schedule_user->user) ? $schedule_user->user->name : '' }}</td>
                                                <td>{{ isset($schedule_user->schedule) ? $schedule_user->schedule->title : '' }}</td>
                                                <td>{{ isset($status[$schedule_user->status]) ? $status[$schedule_user->status] : '' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact-area-end -->

    </main>

@stop()