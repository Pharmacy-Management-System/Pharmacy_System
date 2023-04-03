<div class="modal fade" id="showOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <p><strong>User Name: </strong> <span id="Username"></span></p>
                </div>
                <div class="mb-3">
                    <p><strong>Pharmacy Name: </strong> <span id="pharName"></span></p>
                </div>
                <div class="mb-3">
                    <p><strong>Doctor Name: </strong> <span id="doctorName"></span></p>
                </div>
                <div class="mb-3">
                    <p><strong>Status: </strong> <span id="status"></span></p>
                </div>
                <div class="mb-3">
                    <p><strong>Is Insured: </strong> <span id="isInsured"></span></p>
                </div>
                <div class="mb-3">
                    <p><strong>Creator Type: </strong> <span id="creatorType"></span></p>
                </div>
                <div class="mb-3">
                    <p><strong>Total Price: </strong> <span id="totalPrice"></span></p>
                </div>
                <div class="mb-3">
                    <p><strong></strong> <span id="medicine"></span></p>
                </div>
                <div class="mb-3">
                    <p><strong>Created at:</strong> <span id="createdAt"></span></p>
                </div>
                <div class="mb-3">
                    <p><strong>Updated at:</strong> <span id="updateddAt"></span></p>
                </div>
                <table class="table table-striped  table-bordered" id="order-addresses">
                    <thead>
                        <tr>
                            <th scope="col">Postal Code</th>
                            <th scope="col">Area Name</th>
                            <th scope="col">Street Name</th>
                            <th scope="col">Building Number</th>
                            <th scope="col">Floor Number</th>
                            <th scope="col">Flat Number</th>
                            <th scope="col">Main Street</th>
                        </tr>
                    </thead>
                    <tbody id="order-body-addresses"></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script>
    function orderShow(event) {
        event.preventDefault();
        event.stopPropagation();
        var itemId = event.target.id;
        $('sapn').text("")
        $('#medicine').text("")
        $('#order-body-addresses').empty();
        $.ajax({
            url: "{{ route('orders.show', ':id') }}".replace(':id', itemId),
            method: "GET",
            success: function(response) {
                console.log(response)
                $('#Username').text(response.user.name)
                $('#pharName').text(response.pharmacy.pharmacy_name)
                $('#doctorName').text(response.doctor_name.name)
                $('#status').text(response.order.status)
                $('#isInsured').text(response.order.is_insured ? "Yes" : "No")
                $('#creatorType').text(response.order.creator_type)
                $('#totalPrice').text(response.order.price)

                // for(let i = 0; i < medicines.length; i++){
                //     $('#medicine').append(`<span>${medicines[i].name} -  ${medicineQunaity[i]}</span> <br>`);
                // }
                let medicines = response.order.medicines
                let medicineQunaity = response.order.medicines.map(medicine => medicine.pivot.quantity)
                let tableContent = '';

                for (let i = 0; i < medicines.length; i += 2) {
                    tableContent += '<tr>';

                    // Add the first medicine and quantity to the row
                    tableContent += `<td>${medicines[i].name} - ${medicineQuantities[i]}</td>`;

                    // If there is a second medicine, add it to the row
                    if (medicines[i + 1]) {
                        tableContent += `<td>${medicines[i + 1].name} - ${medicineQuantities[i + 1]}</td>`;
                    } else {
                        // If there is no second medicine, add an empty cell to the row
                        tableContent += '<td></td>';
                    }

                    tableContent += '</tr>';
                }

                $('#medicine').append(tableContent);

                $('#createdAt').text(response.order.created_at)
                $('#updateddAt').text(response.order.updated_at)
                var table_body = $('#order-body-addresses');
                var mainStreet = (response.address.is_main) ? "yes" : "no"
                var record = `
                        <tr>
                            <td>${response.address.area_id}</td>
                            <td>${response.address.area_name}</td>
                            <td>${response.address.street_name}</td>
                            <td>${response.address.building_number}</td>
                            <td>${response.address.floor_number}</td>
                            <td>${response.address.flat_number}</td>
                            <td>${mainStreet}</td>
                        </tr>
                        `;
                table_body.append(record);

                $("#order-addresses").append(table_body);

            }
        });
    }
</script>
