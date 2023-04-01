
import './bootstrap';
import 'laravel-datatables-vite';
import select2 from 'select2';
$(document).ready(function () {
        console.log('ready');
    $(".select2").select2({
        tags: true,
        theme: 'bootstrap-5',
    });
    // $("select").on("select2:select", function (evt) {
    //     var element = evt.params.data.element;
    //     var $element = $(element);
    //     $element.detach();
    //     $.each(valuesToAppend, function(index, value) {
    //         const $element = $('<div>').addClass('new-element').text(value);
    //         $(this).append($element);
    //       });

    //       // Trigger the change event on the parent element
    //       $(this).trigger('change');
    //   });
    $(".select2").on("select2:select", function (evt) {
        var selectedValue = evt.params.data.text;
        var $input = $(this).siblings("input.select2-search__field");
        var currentValue = $input.val();

        if (currentValue) {
            $input.val(currentValue + ", " + selectedValue);
        } else {
            $input.val(selectedValue);
        }

        $(this).trigger("change");
    });
    });
    select2();
