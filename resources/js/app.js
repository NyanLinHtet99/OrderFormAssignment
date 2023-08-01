import './bootstrap';
import $ from "jquery";
window.$ = window.jQuery = $;
import L from "leaflet";
import '@selectize/selectize';
// Promisifying the geolocation API
let getLocationPromise = () => {
    return new Promise(function (resolve, reject) {
        let defaultPos = L.latLng(16.8746163450411, 96.13998413085939);
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => resolve(L.latLng(position.coords.latitude, position.coords.longitude)),
                () => reject(defaultPos)
            );
        }
        else {
            resolve(defaultPos);
        }
    });
};

getLocationPromise()
    .then(setUpMap)
    .catch(setUpMap);
function setUpMap(pos) {
    var map = L.map('map').setView([pos.lat, pos.lng], 17);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(map);
    var pin;
    pin = L.marker(pos, { riseOnHover: true, draggable: true });
    pin.addTo(map);
    $('#lat').val(pos.lat);
    $('#lng').val(pos.lng);
    map.on('click', function (ev) {
        $('#lat').val(ev.latlng.lat);
        $('#lng').val(ev.latlng.lng);
        pin.setLatLng(ev.latlng);
    });
}
(function () {
    'use strict'
    var form = document.querySelector('.needs-validation')
    form.addEventListener('submit', function (event) {
        if (!customValidation() || !form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
        }

        form.classList.add('was-validated');
    });
    function customValidation() {
        if ($('#product').val() === '') {
            $('#product').removeClass('is-valid');
            $('#product').addClass('is-invalid');
            return false;
        }
        $('#product').removeClass('is-invalid');
        $('#product').addClass('is-valid');
        return true;
    }
    var select = $('select').selectize({
        sortField: 'text',
        items: [],
    });
    $('select').each(
        function () {
            var control = this.selectize;
            control.clear();
        }
    )
})()
