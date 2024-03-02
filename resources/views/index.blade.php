@extends('home')

@section('content')
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
            <div class="card border-dark">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Swagger</h5>
                    <p class="card-text">{{ __('messages.documentation.swagger.description') }}</p>
                    <a href="/api/documentation" class="btn btn-primary w-100">{{ __('messages.documentation') }}</a>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                </div>
            </div>
        </div>
    </div>
@endsection
