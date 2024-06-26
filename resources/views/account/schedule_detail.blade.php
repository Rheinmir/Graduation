@extends('master.main')

@section('main')

    <main>
        <!-- breadcrumb-area -->
        <section class="breadcrumb-area tg-motion-effects breadcrumb-bg" data-background="uploads/bg/breadcrumb_bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-content">
                            <h2 class="title">Detail</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
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
                            <div class="row invoice-info">
                                <div class="section-title mb-15">
                                    <span class="sub-title">Detail</span>
                                    <h2 class="title">{{ $schedule->title }}</h2>
                                </div>
                                <p>Detail</p>
                                <div class="col-sm-12 text-right">
                                    @if (!$schedule_user)
                                    <a href="{{ route('register.schedule', $schedule->id) }}" class="btn btn-success text-right" style="float: right;">Request</a>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <p style="color: black">Title : <b>{{ isset($schedule) ? $schedule->title : '' }}</b></p>
                                    <p style="color: black">Date : <b>{{ isset($schedule) ? $schedule->schedule_date : '' }}</b></p>
                                </div>
                                <div style="color: black;" class="schedule-content">
                                    {!! $schedule->contents !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact-area-end -->

    </main>

@stop()