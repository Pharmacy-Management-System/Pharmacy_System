<div class="modal fade" id="modEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="edit-form" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body gy-2 gx-3 align-items-center">
                    <div class="row">
                        <div class="col-md-7 rounded p-5 mt-4 bg-light">
                            <div class="col-md-12 mb-2">
                                <label for="orderUser" class="form-label">Assigned User</label>
                                <select name="user_id" id="AssignedUser" class="form-control" disabled>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->user_id }}">
                                            {{ $client->User->name }}{{ '/' }}{{ $client->User->email }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="address" class="form-label">Address</label>
                                <select name="delivering_address_id" id="editadress" class="form-control" disabled>
                                    @foreach ($clients as $client)
                                        @foreach ($client->Address as $address)
                                            @if ($client->id == $address->client_id)
                                                <option value="{{ $address->id }}">
                                                    {{ $address->id }} {{ '-' }}
                                                    {{ $address->street_name }}{{ ' ' }}{{ $address->Area->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </select>

                            </div>

                            <div class="form-group">
                                <label>Medicine</label>
                                <select name="medicine_id[]" id="edit_medicine" class="select2 js-data-example-ajax"
                                    multiple="multiple" data-placeholder="Select a State"
                                    data-dropdown-css-class="select2-purple" style="width: 100%;">
                                    <option></option>
                                    @foreach ($medicines as $medicine)
                                        <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="form-group">
                                <label>Qunatity</label>
                                <div class="input-group" id="editQuantity">
                                    <!-- input fields will be dynamically added/removed here -->
                                </div>

                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="createPharmacyName" class="form-label">Pharmacy Name</label>
                                <select name="pharmacy_id" id="pharmacyEdit" class="form-control" disabled>
                                    @foreach ($pharmacies as $pharmacy)
                                        <option value="{{ $pharmacy->id }}">{{ $pharmacy->pharmacy_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="createDoctorName" class="form-label">Doctor Name</label>
                                <select name="doctor_id" id="doctorEdit" class="form-control">
                                    @if (auth()->user()->hasRole('admin'))
                                        @foreach ($pharmacies as $pharmacy)
                                            <option value="" disabled selected hidden></option>
                                            <optgroup label="{{ 'Pharmacy: ' . $pharmacy->pharmacy_name }}">
                                                @foreach ($pharmacy->doctors as $doctor)
                                                    <option value="{{ $doctor->id }}">{{ $doctor->User->name }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    @endif
                                    @if (auth()->user()->hasRole('pharmacy'))
                                        @foreach ($pharmacies as $pharmacy)
                                            @if ($pharmacy->id == auth()->user()->pharmacy->id)
                                                <option value="" disabled selected hidden></option>
                                                <optgroup label="{{ 'Pharmacy: ' . $pharmacy->pharmacy_name }}">
                                                    @foreach ($pharmacy->doctors as $doctor)
                                                        <option value="{{ $doctor->id }}">{{ $doctor->User->name }}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            @endif
                                        @endforeach
                                    @endif
                                    @if(auth()->user()->hasRole('doctor'))
                                        <option value="{{ auth()->user()->doctor->id }}">{{ auth()->user()->name }}</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="createStatus" class="form-label">creator type</label>
                                <input name="creator_type" id="editOrderCreator" value="pharmacy" class="form-control"
                                    readonly>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="createStatus" class="form-label">status</label>
                                <input name="status" id="orderStatus" value="pharmacy" class="form-control"
                                readonly>
                                <input type="hidden" id="orderStatus" name="status" value="Processing">
                            </div>
                            <div class="col-md-6 mb-3 ml-3 ">
                                <input name="is_insured" class="form-check-input" type="checkbox" id="edit_insured"
                                    disabled>
                                <label for="createPharmacyName" class="form-check-label">Is insured?</label>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary text-white">Edit</button>
                            </div>
                        </div>
                        <div class="col-md-5" style="margin-top: 100px;">
                            <div id="carouselExampleControls" class="carousel slide">
                                <div class="carousel-inner" id="prescription">
                                </div>
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon bg-black" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                    <span class="carousel-control-next-icon bg-black" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    function editmodalShow(event) {
        event.preventDefault();
        event.stopPropagation();
        $('editQuantity').text(" ");
        $('#prescription').text(" ");
        var itemId = event.target.id;
        $.ajax({
            url: "{{ route('orders.show', ':id') }}".replace(':id', itemId),
            method: "GET",
            success: function(response) {
                console.log(response);
                $('#AssignedUser').val(response.user.id);
                $('#editadress').val(response.order.delivering_address_id);
                $('#pharmacyEdit').val(response.pharmacy.id);
                $('#doctorEdit').val(response.order.doctor_id ? response.order.doctor_id : 0);
                $('#editOrderCreator').val(response.order.creator_type);
                $('#orderStatus').val(response.order.status);
                $('#edit_insured').prop('checked', response.order.is_insured == 1);
                for (let i = 0; i < response.prescriptions.length; i++) {
                    var imagePath = "{{ asset('storage/images/prescriptions/:image_name') }}".replace(':image_name', response.prescriptions[i].image);
                    console.log(imagePath);
                    $('#prescription').append(`
                    <div class="carousel-item active">
                                    <img src="${imagePath}" class="d-block w-100" alt="...">
                     </div>`);
                }
            }

        });
        var route = "{{ route('orders.update', ':id') }}".replace(':id', itemId);
        document.getElementById("edit-form").action = route;
    }
</script>

{{--  --}}
