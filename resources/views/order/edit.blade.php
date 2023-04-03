<div class="modal fade" id="modEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="edit-form" enctype="multipart/form-data" >
                @csrf
                @method('PUT')
                <div class="modal-body row gy-2 gx-3 align-items-center">
                    <div class="col-md-12 mb-2">
                        <label for="orderUser" class="form-label">Assigned User</label>
                        <select name="user_id" id="AssignedUser" class="form-control">
                            @foreach ($clients as $client)
                                <option value="{{ $client->user_id }}">
                                    {{ $client->User->name }}{{ '/' }}{{$client->User->email }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="address" class="form-label">Address</label>
                        <select name="delivering_address_id" id="editadress" class="form-control">
                            @foreach ($clients as $client)
                                    @foreach ($client->Address as $address)
                                    @if ($client->id == $address->client_id)
                                    <option value="{{$address->id}}">
                                        {{ $address->id }} {{'-'}} {{$address->street_name}}{{' '}}{{$address->Area->name}}
                                    </option>
                                    @endif
                                    @endforeach
                            @endforeach
                        </select>
                    </div>
                    {{-- medicine --}}
                    <div class="form-group">
                        <label>Medicine</label>
                        <select name="medicine_id[]" id="edit_medicine" class="select2 js-data-example-ajax" multiple="multiple"
                            data-placeholder="Select a State" data-dropdown-css-class="select2-purple"
                            style="width: 100%;" disabled>
                            <option></option>
                            @foreach ($medicines as $medicine)
                                <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
                            @endforeach
                        </select>
                        <!-- /.form-group -->
                    </div>
                    <div class="form-group">
                        <label>Qunatity</label>
                        <div class="input-group" id="editQuantity" disabled>
                            <!-- input fields will be dynamically added/removed here -->
                        </div >

                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="createPharmacyName" class="form-label">Pharmacy Name</label>
                        <select name="pharmacy_id" id="pharmacyEdit" class="form-control">
                            @foreach ($pharmacies as $pharmacy)
                                <option value="{{ $pharmacy->id }}">{{ $pharmacy->pharmacy_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="createDoctorName" class="form-label">Doctor Name</label>
                        <select name="doctor_id" id="doctorEdit" class="form-control">
                            @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}">{{ $doctor->User->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="createOrderCreator" class="form-label">Order Creator</label>
                        <select name="creator_type" id="editOrderCreator" class="form-control">
                            <option value="client">client</option>
                            <option value="doctor">doctor</option>
                            <option value="pharmacy">pharmacy</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="createStatus" class="form-label">status</label>
                        <select name="status" id="orderStatus" class="form-control">
                            <option value="New">New</option>
                            <option value="Processing">Processing</option>
                            <option value="WaitingForUserConfirmation">WaitingForUserConfirmation</option>
                            <option value="Canceled">Canceled</option>
                            <option value="Confirmed">Confirmed</option>
                            <option value="Delivered">Delivered</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3 ml-3 ">
                        <input name="is_insured" class="form-check-input" type="checkbox" id="edit_insured" value="1">
                        <label for="createPharmacyName" class="form-check-label">Is insured?</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit"  class="btn btn-primary text-white">Edit</button>
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
        var itemId = event.target.id;
        $.ajax({
            url: "{{ route('orders.show', ':id') }}".replace(':id', itemId),
            method: "GET",
            success: function(response) {
                console.log(response);
                $('#AssignedUser').val(response.user.id);
                $('#editadress').val(response.order.delivering_address_id);
                $('#pharmacyEdit').val(response.pharmacy.id);
                $('#doctorEdit').val(response.doctor.id);
                $('#editOrderCreator').val(response.order.creator_type);
                $('#orderStatus').val(response.order.status);
                $('#edit_insured').prop('checked', response.order.is_insured == 1);
            }

        });
        var route = "{{route('orders.update',':id') }}".replace(':id', itemId);
        document.getElementById("edit-form").action = route;
    }


</script>





