@extends('layouts.app')

@section('title')
{{ config('app.name', 'Laravel') }} || {{ __('Home') }}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">


            <div class="alert alert-success alert-dismissible fade show">
                <p class="mb-0">Você foi logado com sucesso !</p>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>                  
            </div>

            

            

                <div class="card text-center">
                <div class="card-header">
                    Featured
                </div>
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
                <div class="card-footer text-body-secondary">
                    2 days ago
                </div>
                </div>









        </div>
    </div>
</div>
@endsection
