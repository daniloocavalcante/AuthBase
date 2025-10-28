@extends('layouts.app')

@section('title')
{{ config('app.name', 'Laravel') }} || {{ __('Register') }}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row">      
                            <div class="col">
                                @include('layouts.validations-forms') 
                            </div> 
                        </div>

                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">                
                                <label class="h6 mb-1 m-1" for="name">{{ __('Name') }}</label> 
                                <input class="form-control" id="inputNameCard" type="text" required placeholder="Insira seu nome" name="name" value="{{ old('name') ? old("name") : "" }}">                
                            </div>
                            <div class="col-md-6">                
                                <label class="h6 mb-1 m-1" for="surname">{{ __('Surname') }}</label> 
                                <input class="form-control" id="inputNameCard" type="text" required placeholder="Insira o nome do cartão" name="surname" value="{{ old('surname') ? old("surname") : "" }}">                
                            </div>
                        </div> 

                        <div class="row gx-3 mb-3">                                
                            <div class="col-md-6">                
                                <label class="h6 mb-1 m-1" for="birth">{{ __('Birth') }}</label> 
                                <input id="birth" type="date" class="form-control" name="birth" value="{{ old('birth') }}" required autocomplete="birth" autofocus>                
                            </div>
                            <div class="col-md-6">                
                                    <label class="h6 mb-1 m-1" for="gender">{{ __('Gender') }}</label> 
                                    <div class="col-md-12">   
                                        <select class="form-select" name="gender" aria-label="Selecione seu gênero">
                                        <option value="1" {{ old('gender')=="1" ? "selected" : "" }}>{{ __('Male') }}</option>
                                        <option value="2" {{ old('gender')=="2" ? "selected" : "" }}>{{ __('Female') }}</option>
                                        <option value="3" {{ old('gender')=="3" ? "selected" : "" }}>{{ __('Prefer not to disclose') }}</option>
                                        </select>
                                    </div>                
                            </div>
                        </div>
                                                
                        <div class="row gx-3 mb-3">                               
                            <div class="col-md-12">  
                                <label class="h6 mb-1 m-1" for="email">{{ __('Email Address') }}</label> 
                                <input class="form-control" id="email" type="email" required placeholder="Insira seu e-mail" name="email" autocomplete="email" value="{{ old('email') ? old("email") : "" }}">                
                            </div>

                        </div>

                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">                
                                <label class="h6 mb-1 m-1" for="password">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Insira sua senha" required autocomplete="new-password"> 
                            </div>                            
                            <div class="col-md-6">
                                <label class="h6 mb-1 m-1" for="password_confirmation">{{ __('Password Confirmation') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirme sua senha" autocomplete="new-password">
                                
                            </div>
                        </div>   
                        
                        <div class="row col-md-12">                           
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button class="btn btn-secondary px-5" type="reset">Limpar</button>
                            <button class="btn btn-dark px-5" type="submit">{{ __('Register') }}</button>
                            </div>
                        </div>
                                

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
