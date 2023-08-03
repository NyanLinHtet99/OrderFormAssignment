import './bootstrap';
import $ from "jquery";
window.$ = window.jQuery = $;
import L from "leaflet";
import '@selectize/selectize';
// Promisifying the geolocation API
let getLocationPromise = () => {
    return new Promise(function (resolve, reject) {
        let defaultPos = L.latLng(16.8067072, 96.1806336);
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
    // $('select').selectize({
    //     sortField: 'text',
    //     items: [],
    // });
    // $('select').each(
    //     function () {
    //         var control = this.selectize;
    //         control.clear();
    //     }
    // )
    $('#nrc_region').selectize({
        valueField: 'id',
        labelField: 'nrcRegion',
        searchField: 'nrcRegion',
        selectOnTab: true,
        closeAfterSelect: true,
        onChange: reqTownship,
    });
    $('#nrc_township').selectize({
        valueField: 'name',
        labelField: 'name',
        searchField: 'name',
        selectOnTab: true,
        closeAfterSelect: true,
    });
    $('#product').selectize({
        valueField: 'id',
        labelField: 'name',
        searchField: 'name',
        selectOnTab: true,
        closeAfterSelect: true,
        onChange: showPrice,
    });
    function reqTownship(id) {
        $.ajax({
            url: "/nrctownships",
            data: { "id": id },
            type: "get",
            dataType: "json",
            success: function (response) {
                let select = $('#nrc_township')[0].selectize;
                select.clearOptions();
                response.map(function (name) {
                    select.addOption({
                        'name': name
                    })
                })
                select.settings.placeholder = 'OoKaMa';
                select.updatePlaceholder();
            },
        });
    }
    function showPrice() {
        $('#price').text('Price = ' + this.options[this.items[0]].price + 'MMK');
    }
    $.ajax({
        url: "/nrcregions/",
        type: "get",
        dataType: "json",
        success: function (response) {
            let select = $('#nrc_region')[0].selectize;
            response.map(function (id) {
                select.addOption({
                    'id': id, 'nrcRegion': id + '/'
                })
            })
        },
    });
    $.ajax({
        url: "/products",
        type: "get",
        dataType: "json",
        success: function (response) {
            let select = $('#product')[0].selectize;
            response.map(function (product) {
                select.addOption({
                    'id': product.id, 'name': product.name, 'price': product.price,
                });
            });
        },
    });
})()
