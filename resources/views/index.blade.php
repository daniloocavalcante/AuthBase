@extends('layouts.app')

@section('title')
{{ config('app.name', 'Laravel') }} || {{ __('Home') }}
@endsection

@section('content')

<div class="container mt-4">
    <div class="row justify-content-center g-4">

        <!-- Card principal -->
        <div class="col-lg-8 col-md-7">
            <div class="card shadow-lg  border-0">

                <div class="card-header fw-bold fs-3">
                    AuthBase v1.0
                </div>

                <div class="card-body">

                    <div class="descricao-projeto">
                        <p>
                        Este site foi desenvolvido para fins de aprendizagem, com o objetivo de praticar conceitos de desenvolvimento web e organização de aplicações.
                        </p>

                        <p>
                        Possui funcionalidades básicas de controle de acesso, como cadastro, login, recuperação de senha e gerenciamento de sessões, com validações de dados para maior consistência.
                        </p>

                        <p>
                        Tecnologias utilizadas: <strong>Laravel</strong> (backend), <strong>Bootstrap</strong> (layout responsivo), <strong>FontAwesome Free</strong> (ícones) e <strong>jQuery</strong> (validações e interações no front-end).
                        </p>

                        <p>
                        O projeto é educacional, servindo para entender autenticação de usuários, validação de formulários, organização MVC e integração front-end/back-end.
                        </p>
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
