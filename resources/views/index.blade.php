@extends('home')

@section('content')
    <h1 class="fw-bold">API - Products</h1>

    <ul class="list-group mb-3">
        @if (isset($products) && count($products) > 0)
            @foreach ($products as $product)
                <li class="list-group-item d-flex">
                    <div class="col-10">
                        <p class="mb-0"><span class="fw-bold">Name:</span> {{ $product->name }}</p>
                        <p class="mb-0"><span class="fw-bold">Description:</span> {{ $product->description }}</p>
                        <p class="mb-0"><span class="fw-bold">Price:</span> {{ $product->price }}</p>
                        <p class="mb-0"><span class="fw-bold">Quantity:</span> {{ $product->quantity }}</p>
                    </div>

                    <div class="col-2 d-flex justify-content-end align-items-center">
                        <form class="mb-0 me-1" action="{{ route('product.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                        </form>

                        <a class="btn btn-primary" href="{{ route('product.update', $product->id) }}">
                            <i class="fa-solid fa-gear"></i>
                        </a>
                    </div>
                </li>
            @endforeach
        @else
            <li class="list-group-item">{{ __('messages.no.itens.avaliable') }}</li>
        @endif
    </ul>

    <h1 class="fw-bold">API - Peoples</h1>

    <ul class="list-group mb-3">
        @if (isset($peoples) && count($peoples) > 0)
            @foreach ($peoples as $people)
                <li class="list-group-item d-flex">
                    <div class="col-10">
                        <p class="mb-0"><span class="fw-bold">Name:</span> {{ $people->name }}</p>
                        <p class="mb-0"><span class="fw-bold">Age:</span> {{ $people->age }}</p>
                        <p class="mb-0"><span class="fw-bold">Height:</span> {{ $people->height }}</p>
                        <p class="mb-0"><span class="fw-bold">Sex:</span> {{ $people->sex }}</p>
                    </div>

                    <div class="col-2 d-flex justify-content-end align-items-center">
                        <form class="mb-0 me-1" action="{{ route('people.destroy', $people->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                        </form>

                        <a class="btn btn-primary" href="{{ route('people.update', $people->id) }}">
                            <i class="fa-solid fa-gear"></i>
                        </a>
                    </div>
                </li>
            @endforeach
        @else
            <li class="list-group-item">{{ __('messages.no.itens.avaliable') }}</li>
        @endif

    @endsection
