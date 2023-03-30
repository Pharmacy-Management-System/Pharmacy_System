@extends('layouts.app')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('areas.update',$area->area_id) }}" method="POST" id="edit-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="areaId" class="form-label">Area ID</label>
                        <input name="area_id" class="form-control" id="areaId" value="{{ $area->area_id }}">
                    </div>
                    <div class="mb-3">
                        <label for="areaName" class="form-label">Area Name</label>
                        <input name="name" class="form-control" id="areaName" value="{{ $area->name }}" >
                    </div>
                    <div class="mb-3">
                        <label for="areaAddress" class="form-label">Area Address</label>
                        <input name="address" class="form-control" id="areaAddress" value="{{ $area->address }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary text-white">Edit</button>
                </div>
            </form>
        </div>
        @if ($errors->any())
        <div class="alert alert-danger pb-0 ">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    </section>
@endsection
