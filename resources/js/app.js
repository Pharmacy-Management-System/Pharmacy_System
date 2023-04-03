
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
        var $element = $(element);
        $element.detach();
        $(this).append($element);
        $(this).trigger("change");

        inputContainer.empty();

    // add new input fields


    // get the number of existing input fields
    const numSelected = $(this).find('option:selected').length;
    const numInputs = 0;
        // console.log(numSelected);
        // console.log(numInputs);
    // remove excess input fields
    if (numInputs > numSelected) {
        inputContainer.find('input:gt(' + (numSelected - 1) + ')').remove();
    }

    // add missing input fields
    for (let i = numInputs + 1; i <= numSelected; i++) {
        const input = $('<input id="quantity" type="text" name="quantity[]" class="form-control" placeholder="Multiple Input in Input Group">');
        inputContainer.append(input);
    }
    });
});
    select2();
