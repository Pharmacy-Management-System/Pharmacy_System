<div class="modal fade" id="create-client" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{route('clients.store')}}" id="create-form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body row g-3">
                    <div class="col-md-6 ">
                        <label for="client-id" class="form-label visually-hidden">Natioanl ID</label>
                        <input name="id" class="form-control" id="client-id" placeholder="Natioanl ID" value="">
                    </div>
                    <div class="col-md-6 ">
                        <label for="client-name" class="form-label visually-hidden">Name</label>
                        <input name="name" class="form-control" id="client-name" placeholder="Name" value="">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="client-email" class="form-label visually-hidden">Email</label>
                        <div class="input-group">
                            <span class="input-group-text" id="email-icon">@</span>
                            <input name="email" type="email" class="form-control" id="client-email" aria-describedby="email-icon" placeholder="Email" value="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="client-password" class="form-label visually-hidden">Password</label>
                        <input name="password" class="form-control" id="client-password" placeholder="Password" value="">
                    </div>
                    <div class="col-md-12">
                        <label for="client-phone" class="form-label visually-hidden">Phone Number</label>
                        <input name="phone" class="form-control" id="client-phone" placeholder="Phone Number" value="">
                    </div>
                    <div class="col-md-12">
                        <label for="client-birthdate" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" name="date_of_birth" placeholder="Date of Birth" id="client-birthdate" min="1860-01-01" max="2023-01-01"/>
                    </div>
                    <div class="col-md-12">
                        <label for="client-gender" class="form-label">Gender</label>
                        <select name="gender" id="client-gender" class="form-select "
                            aria-label="Default select example">
                            <option selected>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="col-md-12 ">
                        <label for="avatar" class="form-label">Avatar</label>
                        <input name="avatar_image" class="form-control" type="file" id="avatar" accept=".jpg,.png">
                    </div>
                    <input name="password_confirmation" class="form-control" id="client-password-confirmation" value="" hidden>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success text-white">Create</button>
                </div>
            </form>
        </div>
    </div>
</div> 

<!--scripts-->
@push('scripts')
<script>
    function createmodalShow(event) {
                event.preventDefault();
                event.stopPropagation();
                $('input').val("")
            }
    $("#client-password").on("input", function() {
    $('#client-password-confirmation').val($(this).val())
    });
</script>
@endpush