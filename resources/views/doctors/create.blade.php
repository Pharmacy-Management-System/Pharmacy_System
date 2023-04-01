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
                        <div class="mb-3 form-check">
                            <input name="is_banned" class="form-check-input" type="checkbox" id="banned" value="1">
                            <label for="banned" class="form-check-label">Is banned?</label>
                        </div>

                        <div class="mb-3">
                            <label for="avatar" class="form-label">Avatar</label>
                            <input name="avatar_image" type="file" class="form-control" id="avatar">
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
