@extends('layouts.app')

@section('title')
{{ config('app.name', 'Laravel') }} || {{ __('About') }}
@endsection

@section('content')

<div class="container mt-4">
    <div class="row justify-content-center g-4">

        <!-- Card principal -->
        <div class="col-lg-8 col-md-7">
            <div class="card shadow-lg  border-0">

                <div class="card-header fw-bold fs-3">
                    Sobre o AuthBase v1.0
                </div>

                <div class="card-body">

                    <div class="descricao-projeto">

                        <p>
                            Este site foi desenvolvido <strong>exclusivamente para fins de aprendizagem</strong>,
                            com o objetivo de praticar conceitos de desenvolvimento web e organização de aplicações.
                        </p>

                        <p>
                            A aplicação possui funcionalidades básicas de <strong>controle de acesso de usuários</strong>,
                            incluindo <strong>cadastro, login, recuperação de senha e gerenciamento de sessão</strong>.
                            Durante o cadastro e a autenticação, são realizadas <strong>validações de dados</strong>,
                            como verificação de <strong>formato de e-mail, datas e campos obrigatórios</strong>,
                            garantindo maior consistência das informações inseridas.
                        </p>

                        <p>
                            O sistema também implementa um <strong>controle de acesso</strong>, permitindo que apenas
                            usuários autenticados possam acessar determinadas áreas do site.
                        </p>

                        <h5 class="mt-4">
                            Tecnologias e dependências utilizadas
                        </h5>

                        <ul>
                            <li>
                                <strong>Laravel</strong> – Framework PHP utilizado para estruturar a aplicação
                                e gerenciar rotas, autenticação e banco de dados.
                            </li>

                            <li>
                                <strong>Bootstrap</strong> – Framework CSS utilizado para estilização
                                e layout responsivo da interface.
                            </li>

                            <li>
                                <strong>FontAwesome Free</strong> – Biblioteca de ícones utilizada
                                para melhorar a interface visual.
                            </li>

                            <li>
                                <strong>jQuery</strong> – Biblioteca JavaScript utilizada para facilitar
                                manipulações no front-end e validações dinâmicas.
                            </li>
                        </ul>

                        <p>
                            O projeto tem caráter <strong>educacional</strong>, servindo como prática
                            para compreensão de conceitos como <strong>autenticação de usuários,
                            validação de formulários, organização MVC e integração entre
                            front-end e back-end</strong>.
                        </p>

                        <div class="text-end mt-3">
                            <small class="text-muted">
                                Projeto educacional para estudo de autenticação em Laravel.
                            </small>
                        </div>

                    </div>

                </div>
            </div>
        </div>


        <!-- Card guia rápido -->
        <div class="col-lg-4 col-md-5">
            <x-auth.quick-guide-card />
        </div>

    </div>
</div>







@endsection
