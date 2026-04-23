/** Load bootstrap and base dependencies */

import 'bootstrap';


// Definir bootstrap globalmente
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

/** jQuery */

import $ from 'jquery';
window.$ = $;
window.jQuery = $;


// Fontawesome-free
import '@fortawesome/fontawesome-free/css/all.min.css'


/** Bootstrap JS Components */

import { Tooltip } from 'bootstrap';

/** Initialize Bootstrap Tooltips */

document.addEventListener('DOMContentLoaded', () => {

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');

    tooltipTriggerList.forEach(el => {
        new Tooltip(el);
    });

});


/** DataTables 
import $ from 'jquery';
window.$ = $;
window.jQuery = $;

import 'datatables.net-bs5';  

$(document).ready(function () {
    $('#usersTable').DataTable({
        pageLength: 10,

    });
}); */


/** Charts.js */

import initLogsChart from './logsChart';

document.addEventListener('DOMContentLoaded', function () {
    initLogsChart();
});



/**  Roles */

window.toggleUsers = function (el) {
    const container = el.closest('div');
    const extraUsers = container.querySelectorAll('.extra-user');

    if (!extraUsers.length) return;

    const isHidden = extraUsers[0].classList.contains('d-none');

    extraUsers.forEach(user => {
        user.classList.toggle('d-none');
    });

    if (isHidden) {
        el.textContent = 'Ver menos';
        el.setAttribute('title', 'Ver menos');
    } else {
        el.textContent = '+' + extraUsers.length;
        el.setAttribute('title', 'Ver mais...');
    }
};

document.getElementById('toggleUsers')?.addEventListener('click', function () {
    document.querySelectorAll('.extra-user-role').forEach(el => el.classList.toggle('d-none'));

    this.textContent = this.textContent === 'Ver mais' ? 'Ver menos' : 'Ver mais';
});