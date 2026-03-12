/** Load bootstrap and base dependencies */

import './bootstrap';

/** Vue */

import { createApp } from 'vue';

/** jQuery (required for DataTables) */

import $ from 'jquery';
window.$ = $;
window.jQuery = $;

/** DataTables Bootstrap 5 */

import 'datatables.net-bs5';

/** Bootstrap JS Components */

import { Tooltip } from 'bootstrap';

/** Initialize Bootstrap Tooltips */

document.addEventListener('DOMContentLoaded', () => {

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');

    tooltipTriggerList.forEach(el => {
        new Tooltip(el);
    });

});


/** DataTables */

$(document).ready(function () {
    $('#usersTable').DataTable({
        pageLength: 10,

    });
});
