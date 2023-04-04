
import './bootstrap';
import 'laravel-datatables-vite';
import select2 from 'select2';

$(document).ready(function () {

    $(".select2").select2({
        tags: true,
        theme: 'bootstrap-5',
    });
    $(".select2").on("select2:select", function (evt) {
        var element = evt.params.data.element;
        const inputContainer = $('#input-container');
        const edit = $('#editQuantity')
        var $element = $(element);
        $element.detach();
        $(this).append($element);
        $(this).trigger("change");

        inputContainer.empty();


    const numSelected = ($(this).find('option:selected')).length;
    const numInputs = 0;
    if (numInputs > numSelected) {
        inputContainer.find('input:gt(' + (numSelected - 1) + ')').remove();
    }
    for (let i = numInputs + 1; i <= numSelected; i++) {
        const input = $('<input id="quantity" type="text" name="quantity[]" class="form-control" placeholder="Multiple Input in Input Group">');
        inputContainer.append(input);
    }

    edit.empty();

        // edit
    const editSelected = $(this).find('option:selected').length;
    const editInputs = 0;
    if (editInputs > editSelected) {
        inputContainer.find('input:gt(' + (editSelected - 1) + ')').remove();
    }
    for (let i = editInputs + 1; i <= editSelected; i++) {
        const input = $('<input id="quantityedit" type="text" name="quantity[]" class="form-control" placeholder="Multiple Input in Input Group">');
        edit.append(input);
    }
    });
});

    select2();
