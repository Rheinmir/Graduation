@extends('master.admin')
@section('title', 'Lịch hẹn')
@section('main')

    <!-- Main content -->
    <section class="content">
        @include('admin.schedule.form')
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