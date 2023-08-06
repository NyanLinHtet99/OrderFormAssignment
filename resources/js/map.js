import $ from "jquery";
window.$ = window.jQuery = $;
import L from "leaflet";
let map = function () {
    let getLocationPromise = () => {
        return new Promise(function (resolve, reject) {
            let defaultPos = L.latLng(16.8702531, 96.1407619);
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
    function setUpMap(pos) {
        var map = L.map('map').setView([pos.lat, pos.lng], 17);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);
        let pin;
        pin = L.marker(pos, { riseOnHover: true, draggable: true });
        pin.addTo(map);
        $('#lat').val(pos.lat.toFixed(7));
        $('#lng').val(pos.lng.toFixed(7));
        map.on('click', function (ev) {
            $('#lat').val(ev.latlng.lat.toFixed(7));
            $('#lng').val(ev.latlng.lng.toFixed(7));
            pin.setLatLng(ev.latlng);
        });
    }
    function init() {
        getLocationPromise()
            .then(setUpMap)
            .catch(setUpMap);
    }
    function check() {
        return Boolean(navigator.geolocation);
    }
    return { init, check };
}();
export default map;
// Promisifying the geolocation API

