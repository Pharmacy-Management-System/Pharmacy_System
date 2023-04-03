@extends('layouts.app')

@section('content')

@role('admin')
    @include('revenue.admin')
@endrole


@role('pharmacy')
@include('revenue.pharmacy')
@endrole

@endsection
