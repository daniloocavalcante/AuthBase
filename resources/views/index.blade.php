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

                    <div class="container my-4">
                        <p>
                            Este site foi desenvolvido para fins de aprendizagem, com o objetivo de praticar conceitos de desenvolvimento web e organização de aplicações.
                        </p>

                        <p>
                            A aplicação possui funcionalidades de controle de acesso de usuários, incluindo cadastro, login, recuperação de senha e gerenciamento de sessões, com validações de dados para garantir maior consistência e integridade das informações inseridas.
                        </p>

                        <p>
                            Além disso, o sistema conta com <strong>implementação de logs de atividades</strong>, registrando eventos relevantes como autenticação de usuários, alterações de dados e ações importantes dentro da aplicação. Esses registros auxiliam no monitoramento, rastreabilidade e depuração do sistema, simulando práticas utilizadas em aplicações reais.
                        </p>                        

                        <h5 class="mt-4">Tecnologias utilizadas</h5>
                        <ul>
                            <li><strong>Laravel</strong> – Backend e estrutura MVC</li>
                            <li><strong>Bootstrap</strong> – Layout responsivo</li>
                            <li><strong>FontAwesome Free</strong> – Ícones</li>
                            <li><strong>jQuery</strong> – Validações e interações no front-end</li>
                        </ul>

                        <p class="mt-3">
                            O projeto possui caráter educacional, servindo como base para compreensão de conceitos como autenticação de usuários, controle de acesso, validação de formulários, arquitetura MVC, registro de logs e integração entre front-end e back-end.
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
