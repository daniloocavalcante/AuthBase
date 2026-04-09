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


// Fechar Button após exportar

document.addEventListener('DOMContentLoaded', function() {
    const exportBtn = document.getElementById('confirmExportBtn'); // botão Confirmar Exportar
    const modalEl = document.getElementById('exportCsvModal');

    // só adiciona o listener se o botão existir
    if (exportBtn) {
        exportBtn.addEventListener('click', function() {
            // Pega ou cria a instância do modal
            const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
            modal.hide(); // Fecha o modal
        });
    }
});


// Modal visualizar Log

function setLog(el) {
    let dump = `ID: ${el.dataset.id}
Date: ${el.dataset.date}
Action: ${el.dataset.action}
User: ${el.dataset.user} ${el.dataset.surname}
IP: ${el.dataset.ip}
Model: ${el.dataset.model}
Model-ID: ${el.dataset.modelid}

Description:
${el.dataset.desc}
    `;

    document.getElementById('title-log').innerText = "Dados do Log #" + el.dataset.id;
    document.getElementById('logDump').innerText = dump;
}


document.addEventListener('click', function (e) {
    const btn = e.target.closest('#btn-view');

    if (btn) {
        setLog(btn);
    }
});


// ===============================
// PRINT TABLE
// ===============================
function printTable() {
    const original = document.querySelector('.printable');
    if (!original) return;

    const clone = original.cloneNode(true);

    // 🔥 limpeza
    clone.querySelectorAll('.d-print-none').forEach(el => el.remove());
    clone.querySelectorAll('.text-truncate').forEach(el => el.style.maxWidth = '');

    const info = document.querySelector('#print-info')?.innerText || '';

    const win = window.open('', '', 'width=1000,height=800');

    win.document.write(getPrintHTML(clone, info));
    win.document.close();
    win.print();
}


// ===============================
// TEMPLATE HTML
// ===============================
function getPrintHTML(clone, info) {
    return `
    <html>
    <head>
        <title>Relatório de Logs</title>
        ${getStyles()}
    </head>

    <body>

        <div class="header">
            <div>
                <div class="title">Logs do Sistema</div>
                <div class="subtitle">
                    Gerado em: ${new Date().toLocaleString()}
                </div>
            </div>
        </div>

        <div class="table-container">
            ${clone.querySelector('table').outerHTML}
        </div>

        <div class="footer">
            <span>${info}</span>
            <span>Relatório gerado automaticamente</span>
        </div>

    </body>
    </html>
    `;
}


// ===============================
// STYLES
// ===============================
function getStyles() {
    return `
    <style>
        body{font-family:Segoe UI,Arial;padding:40px;background:#f1f5f9;color:#1e293b}

        .header{margin-bottom:25px}
        .title{font-size:22px;font-weight:600}
        .subtitle{font-size:12px;color:#64748b}

        .table-container{
            background:#fff;
            border-radius:12px;
            padding:20px;
            box-shadow:0 4px 15px rgba(0,0,0,.05)
        }

        table{width:100%;border-collapse:collapse;font-size:13px}

        thead{
            background:#f8fafc;
            border-bottom:2px solid #e2e8f0;
            color:#1e293b
        }

        th{
            padding:12px;
            font-size:12px;
            text-transform:uppercase;
            letter-spacing:.5px
        }

        td{
            padding:10px;
            border-bottom:1px solid #e2e8f0
        }

        tr:nth-child(even){background:#f8fafc}
        tr:hover{background:#eef2ff}

        .badge{
            padding:5px 8px;
            border-radius:999px;
            font-size:11px;
            color:#fff
        }

        .bg-success{background:#22c55e!important}
        .bg-danger{background:#ef4444!important}
        .bg-warning{background:#f59e0b!important}
        .bg-info{background:#3b82f6!important}

        td:nth-child(4){
            max-width:100%;
            word-break:break-word
        }

        .footer{
            margin-top:20px;
            display:flex;
            justify-content:space-between;
            font-size:12px;
            color:#64748b;
            border-top:1px solid #e2e8f0;
            padding-top:10px
        }

        tr{page-break-inside:avoid}

        *{
            -webkit-print-color-adjust:exact!important;
            print-color-adjust:exact!important
        }
    </style>
    `;
}


// ===============================
// EVENTS (SEM onclick)
// ===============================
document.addEventListener('DOMContentLoaded', () => {

    const btnPrint = document.getElementById('btn-print');

    if (btnPrint) {
        btnPrint.addEventListener('click', (e) => {
            e.preventDefault(); // segurança
            printTable();
        });
    }

});