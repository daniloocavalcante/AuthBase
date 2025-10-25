import './bootstrap'; // Linha padrão do Laravel, mantenha.

// 1. Torna o jQuery acessível globalmente
import $ from 'jquery';
window.jQuery = window.$ = $;

// 2. Importa o JS do Bootstrap
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;