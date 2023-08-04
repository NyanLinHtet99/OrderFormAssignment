import './bootstrap';
import $ from "jquery";
window.$ = window.jQuery = $;
import DataTable from 'datatables.net-dt';
const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
$(function () {
    $('#posts').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "/orders",
            "dataType": "json",
            "type": "POST",
            "data": { _token: csrfToken }
        },
        "columns": [
            { "data": "id" },
            { "data": "nrc" },
            { "data": "name" },
            { "data": "phone" },
            { "data": "secondary_phone" },
            { "data": "email" },
            { "data": "address" },
            { "data": "product" },
        ]

    });
});
