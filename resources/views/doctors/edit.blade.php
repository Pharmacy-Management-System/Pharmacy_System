@extends('layouts.app')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div id="edit-modal">
            <form action="{{ route('doctors.update', $doctor->national_id) }}" method="POST" id="edit-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nationalID" class="form-label">National ID</label>
                        <input name="national_id" class="form-control" id="nationalID" value="{{ old('national_id', $doctor->national_id) }}">
                    </div>
                    <div class="mb-3">
                        <label for="pharName" class="form-label">Pharmacy Name</label>
                        <input name="pharmacy_id" class="form-control" id="pharName" value="{{ old('pharmacy_id', $doctor->pharmacy_id) }}">
                    </div>
                    <div class="mb-3">
                        <label for="isBanned" class="form-label">Is Banned</label>
                        <input name="is_banned" class="form-control" id="isBanned" value="{{ old('is_banned', $doctor->is_banned) }}">
                    </div>
                    <div class="mb-3">
                        <label for="avatar" class="form-label">Avatar</label>
                        <input name="avatar" class="form-control" id="avatar" value="{{ old('avatar', $doctor->avatar) }}">
                    </div>
                    <div class="alert alert-danger" style="display: none;" id="error-message"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary text-white">Edit</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
