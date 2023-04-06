@extends('layouts.app')

@section('title')

@endsection

@section('content')
<div class="col-12 d-flex justify-content-between align-items-center flex-wrap" style="height: 80vh;">
    @include('statistics.statusbarchart')
    @include('statistics.statuspiechart')
</div>

@endsection

