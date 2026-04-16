/** Load bootstrap and base dependencies */

import 'bootstrap';

// Definir bootstrap globalmente
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

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


/** Charts.js */

import initLogsChart from './logsChart';

document.addEventListener('DOMContentLoaded', function () {
    initLogsChart();
});