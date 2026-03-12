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


/** Print Tables */

// Função para imprimir apenas a tabela
function printTablea() {
    const table = document.getElementById('card-users');
 
    if (!table) return;

    const newWin = window.open('', '', 'width=1000,height=800');
    newWin.document.write(`
        <html>
            <head>
                <title>Imprimir Tabela</title>
                <!-- Bootstrap -->
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
                <!-- Seu CSS customizado -->
                <link rel="stylesheet" href="/css/app.css">
                <style>
                    body { padding: 20px; }
                    table { width: 100%; border-collapse: collapse; }
                    th, td { border: 1px solid #dee2e6; padding: 8px; }
                </style>
            </head>
            <body>
                ${table.outerHTML}
            </body>
        </html>
    `);
    newWin.document.close();
    newWin.focus();
    newWin.print();
    newWin.close();
}

window.printTable = printTablea;


document.addEventListener('DOMContentLoaded', function() {
    const exportBtn = document.getElementById('confirmExportBtn'); // botão Confirmar Exportar
    const modalEl = document.getElementById('exportCsvModal');

    exportBtn.addEventListener('click', function() {
        // Pega ou cria a instância do modal
        const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
        modal.hide(); // Fecha o modal
    });
});