import './bootstrap';
import $ from "jquery";
window.$ = window.jQuery = $;
import '@selectize/selectize';
import map from './map'
import select from './select';
//This is for bootstrap5 validation
let validation = function () {
    let form = document.querySelector('.needs-validation');

    function customValidation() {
        return validateSelect('#product') &&
            validateSelect('#nrc_region') &&
            validateSelect('#nrc_township');
    }
    function validateSelect(id) {
        if ($(id).val() === '') {
            $(id).removeClass('is-valid');
            $(id).addClass('is-invalid');
            return false;
        }
        $(id).removeClass('is-invalid');
        $(id).addClass('is-valid');
        return true;
    }
    function addEvent() {
        form.addEventListener('submit', function (event) {

            if (!customValidation() || !form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            //To change the feedback text to defualt after changing it to "Nrc Exists" in SSR
            $('#nrc_no_feedback').text('Please provide a valid NRC');
            form.classList.add('was-validated');
        });
    }
    function init() {
        addEvent();
    }
    return { init }
}();


$(function () {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    // Set the CSRF token in the header of all AJAX requests
    $.ajaxSetup({
        headers: {
            'X-XSRF-TOKEN': csrfToken,
        },
    });
    function clearIsInvalid() {
        const inputs = $('form :input').not('select');
        inputs.each(function () {
            $(this).on('input', function () {
                if ($(this).hasClass('is-invalid')) $(this).removeClass('is-invalid');
            });
        })
    }
    clearIsInvalid();

    if (!map.check()) {
        $('#geoservice').removeClass('d-none');
    }
    map.init();
    validation.init();
    select.init();
});
