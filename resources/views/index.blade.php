@extends('home')

@section('content')
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
            <div class="card border-dark">
                <img src="/images/placeholder-engrenagem.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Product</h5>
                    <p class="card-text">Provides endpoints to manage product information, including creation, retrieval,
                        update, and deletion functionalities.</p>
                    <a href="#" class="btn btn-primary w-100">Documentation</a>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Last updated 3 mins ago</small>
                </div>
            </div>
        </div>
    </div>
@endsection
