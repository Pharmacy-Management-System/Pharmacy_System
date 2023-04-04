@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-center">
                <div class="card col-8 col-md-6 d-flex flex-column justify-content-center align-items-center rounded-4 p-5 my-5">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div>
                        <img src="dist/img/success-login.gif" alt="loginned successfully" width="200px"/>
                    </div>
                        {{ __('You are Logged in Successfully!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

