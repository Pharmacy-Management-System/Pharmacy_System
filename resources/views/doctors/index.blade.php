@extends('layouts.app')

@section('content')

<section class="content">
    {{-- when delete doctor related to other records --}}
    @if (session('error'))
    <div class="alert alert-danger p-2 mt-3 ">
        {{ session('error') }}
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger pb-0">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="container-fluid">
        {{-- {{@dd( $dataTable->table())}} --}}
        {{ $dataTable->table() }}
    </div>
    <div class="container">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
            Create
        </button>
    </div>
    <!-- delete moadal -->
    <div class="modal fade" id="del-model" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="staticBackdropLabel"><i class="bi bi-exclamation-triangle-fill text-danger me-2"></i>Waring</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure to delete this record?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button id="delete" type="button" class="btn btn-danger">Delete</button>
                </div>

            </div>
        </div>
    </div>
    <!-- edit moadal -->
    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Doctor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="edit-form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nationalId" class="form-label">National ID</label>
                            <input name="id" class="form-control" id="nationalId" value="">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">name</label>
                            <input name="name" class="form-control" id="name" value="">
                        </div>
                        <div class="mb-3">
                            <label for="nationalId" class="form-label">email</label>
                            <input name="email" class="form-control" id="email" value="">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">password</label>
                            <input name="password" class="form-control" id="password" value="">
                        </div>
                        <div class="mb-3">
                            <label for="pharmacy_id" class="form-label">Pharmacy Name</label>
                            <select name="pharmacy_id" id="pharmacySelect" class="form-control">
                                <!-- options go here -->
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="banned" class="form-label">Is banned?</label>
                            <input name="is_banned" class="form-control" id="banned" value="">
                        </div>

                        <div class="mb-3">
                            <label for="Avatar" class="form-label">Avatar</label>
                            <input name="avatar" class="form-control" id="Avatar" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary text-white">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Doctor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('doctors.store') }}" id="create-form" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nationalId" class="form-label">National ID</label>
                            <input name="id" class="form-control" id="nationalId" value="">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">name</label>
                            <input name="name" class="form-control" id="name" value="">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">email</label>
                            <input name="email" class="form-control" id="email" value="">
                        </div>
                        <div class="mb-3">
                            <label for="pass" class="form-label">password</label>
                            <input name="password" class="form-control" id="pass" value="">
                        </div>
                        <div class="mb-3">
                            <label for="pharmacy_id" class="form-label">Pharmacy Name</label>
                            <select name="pharmacy_id" id="pharmacySelect" class="form-control">
                                <option value="" disabled selected hidden></option>
                                @foreach($pharmacies as $pharmacy)
                                <option value="{{ $pharmacy->id }}">{{ $pharmacy->User->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="banned" class="form-label">Is banned?</label>
                            <input name="is_banned" class="form-control" id="banned" value="">
                        </div>
                        <div class="mb-3">
                            <label for="avatar" class="form-label">Avatar</label>
                            <input name="avatar" class="form-control" id="avatar" value="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary text-white">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-----------Show modal------------>
<div class="modal fade" id="show-doctor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Doctor Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <p><strong>Name:</strong> <span id="doctorName"></span></p>
                    </div>
                    <div class="mb-3">
                        <p><strong>Email:</strong> <span id="doctorEmail"></span></p>
                    </div>
                    <div class="mb-3">
                        <p><strong>National ID:</strong> <span id="national-id"></span></p>
                    </div>
                    <div class="mb-3">
                        <p><strong>Assigned Pharmacy:</strong> <span id="pharmacy"></span></p>
                    </div>
                    <div class="mb-3">
                        <p><strong>Is Banned:</strong> <span id="is-banned"></span></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
        </div>
    </div>
</div>


</section>

@endsection

@push('scripts')
{{ $dataTable->scripts() }}
<script>
    function deletemodalShow(event) {
        event.preventDefault();
        event.stopPropagation();
        let deleteBtnModal = document.querySelector("#delete");
        deleteBtnModal.onclick = function() {
            event.target.closest("form").submit();
        }
    }

    function editmodalShow(event) {
        event.preventDefault();
        event.stopPropagation();
        var itemId = event.target.id;
        $.ajax({
            url: "{{ route('doctors.show', ':id') }}".replace(':id', itemId),
            method: "GET",

            success: function(response) {
                $('#nationalId').val(response.doctor.id);
                $('#banned').val(response.doctor.is_banned);
                $('#Avatar').val(response.doctor.avatar);
                $('#name').val(response.users.find(user => user.id === response.doctor.user_id).name);
                $('#email').val(response.users.find(user => user.id === response.doctor.user_id).email);
                var pharmacySelect = $('#pharmacySelect');
                pharmacySelect.empty();
                $.each(response.pharmacies, function(index, pharmacy) {
                    var pharmacyName = response.users.find(user => user.id === pharmacy.user_id).name;
                    var option = $('<option>').val(pharmacy.id).text(pharmacyName);
                    if (pharmacy.id === response.doctor.pharmacy_id) {
                        option.attr('selected', 'selected');
                    }
                    pharmacySelect.append(option);
                });

                pharmacySelect.val(response.doctor.pharmacy_id);
            }

        });
        var route = "{{ route('doctors.update', ':id') }}".replace(':id', itemId);
        document.getElementById("edit-form").action = route;
    }


    function doctorshowmodalShow(event){
            var itemId = event.target.id;
            $('span').text("");
            $.ajax({
                url: "{{ route('doctors.show', ':id') }}".replace(':id', itemId),
                method: "GET",
                success: function(response) {
                    console.log(response.users.find(user => user.id === response.doctor.user_id).name);
                    $('#doctorName').text(response.users.find(user => user.id === response.doctor.user_id).name);
                    $('#doctorEmail').text(response.users.find(user => user.id === response.doctor.user_id).email);
                    $('#national-id').text(response.doctor.id)
                    $('#is-banned').text(response.doctor.is_banned)
                    var pharmacy = response.pharmacies.find(pharmacy=>pharmacy.id === response.doctor.pharmacy_id);
                    var pharmacyName = response.users.find(user => user.id === pharmacy.user_id).name;
                    $('#pharmacy').text(pharmacyName)
                }
            });
    }
</script>
@endpush
