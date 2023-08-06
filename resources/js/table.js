import './bootstrap';
import $ from "jquery";
window.$ = window.jQuery = $;
import DataTable from 'datatables.net-dt';
import 'datatables.net-bs5/js/dataTables.bootstrap5';
const csrfToken = $('meta[name="csrf-token"]').attr('content');
$(function () {
    $('#orders').DataTable({
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
            { "data": "secondary_phone", 'sortable': 'false' },
            { "data": "email" },
            { "data": "address" },
            { "data": "product" },
        ],
        'columnDefs': [{
            'targets': [4, 6], // column index (start from 0)
            'orderable': false, // set orderable false for selected columns
        }],
        'order': [[0, 'desc']],
    });
});
