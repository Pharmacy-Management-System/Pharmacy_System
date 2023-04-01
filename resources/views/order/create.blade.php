<div class="modal fade" id="createOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{-- action="{{ route('pharmacies.store') }}" --}}
            <form  method="POST"  id="create-pharmacy-form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body row gy-2 gx-3 align-items-center">
                    <div class="col-md-6 mb-2">
                        <label for="createPharmacyId" class="form-label visually-hidden">User Name</label>
                        <input name="id" class="form-control" id="createPharmacyId" placeholder="Pharmacy Owner ID" value="">
                    </div>
                        {{-- medicine --}}
                        <div class="form-group">
                          <label>Medicine</label>
                          <input class="select2-search__field">
                            <select class="select2 " multiple="multiple" data-placeholder="Select a State" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                <option></option>
                                @foreach($medicines as $medicine)
                                <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
                                @endforeach
                            </select>
                        <!-- /.form-group -->
                      </div>
                      <div class="form-group">
                          <select class="js-example-basic-multiple select2 @error('qty[]') is-invalid @enderror" name="qty[]" multiple="multiple" style="width: 100%;">
                            @for($x=1;$x<=10;$x++)
                                <option value="{{$x}}">{{$x}}</option>
                            @endfor
                            </select>
                      </div>
                      {{--  --}}
                    <div class="mb-3">
                        <label for="createPharmacyName" class="form-label">Pharmacy Name</label>
                        <select name="pharmacy_id" id="pharmacySelect" class="form-control">
                            <option value="" disabled selected hidden></option>
                            @foreach($pharmacies as $pharmacy)
                            <option value="{{ $pharmacy->id }}">{{ $pharmacy->pharmacy_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="createDoctorName" class="form-label">Doctor Name</label>
                        <select name="doctor_id" id="doctorSelect" class="form-control">
                            <option value="" disabled selected hidden></option>
                            @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->User->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="createOrderCreator" class="form-label visually-hidden">Order Creator</label>
                        <select name="creator_type" id="createPharmacyName" class="form-control">
                            <option value="Doctor">Doctor</option>
                            <option value="Pharmacy">Pharmacy</option>
                            <option value="User">User</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="createStatus" class="form-label visually-hidden">status</label>
                        <select name="status" id="createPharmacyName" class="form-control">
                            <option value="New">New</option>
                            <option value="Processing">Processing</option>
                            <option value="WaitingForUserConfirmation">WaitingForUserConfirmation</option>
                            <option value="Canceled">Canceled</option>
                            <option value="Confirmed">Confirmed</option>
                            <option value="Delivered">Delivered</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-2">
                        <input name="is_insured" class="form-check-input" type="checkbox" id="banned" value="1">
                            <label for="createPharmacyName" class="form-check-label">Is insured?</label>
                    </div>
            </form>
        </div>
    </div>
</div>

