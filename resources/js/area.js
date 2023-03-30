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
        url: "{{ route('areas.show', ':id') }}".replace(':id', itemId),
        method: "GET",
        success: function(response) {
            $('#areaId').val(response.area[0].area_id)
            $('#areaName').val(response.area[0].name)
            $('#areaAddress').val(response.area[0].address)
        }
    });
    var route = "{{ route('areas.update', ':id') }}".replace(':id', itemId);
    document.getElementById("edit-form").action = route;
}