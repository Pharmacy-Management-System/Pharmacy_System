@extends('layouts.app')

@section('title')

@endsection

@section('content')
<div class="border-white" style="width:30%;margin-left:35%;">
    <marquee behavior="scroll" direction="left" class="text-center text-monospace fs-2">WELCOME TO ORDERS CHARTS</marquee>
</div>
<div class="col-12 d-flex justify-content-between align-items-center flex-wrap" style="height: 70vh;">
    @include('statistics.statusbarchart')
    @include('statistics.statuspiechart')
</div>

@endsection

