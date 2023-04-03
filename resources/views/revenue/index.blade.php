@extends('layouts.app')

@section('title')
/ Revenues
@endsection

@section('content')

@role('admin')
    @include('revenue.admin')
@endrole


@role('pharmacy')
@include('revenue.pharmacy')
@endrole

@endsection
