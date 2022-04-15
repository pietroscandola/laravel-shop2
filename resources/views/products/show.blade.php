@extends('layouts.main')

@section('content')
    <div>
        <ul class="mt-4 list-unstyled">
            <li class="text-center">
                <figure>
                    <img class="img-fluid mt-3 rounded-pill" src="{{ $product->image }}" alt="">
                </figure>
                <h2 class="pt-2 text-uppercase">{{ $product->name }}</h2>
                <p class="w-25 mx-auto">{{ $product->description }}</p>
                <div class="pt-2">{{ $product->price }}</div>
                <h5>
                    <span
                        class="badge rounded-pill bg-{{ $product->brand->color ?? 'dark' }}">{{ $product->brand->name ?? '-' }}</span>
                </h5>

                <h5>Colori:</h5>
                @forelse ($product->colors as $color)
                    <h5>
                        <span class="badge bg-secondary">{{ $color->color }}</span>
                    </h5>
                @empty
                    <h5>
                        <span class="badge bg-secondary">Colore Sconosciuto</span>
                    </h5>
                @endforelse
                <a class="btn btn-info" href="{{ route('products.index') }}">Home</a>
                <a class="btn btn-primary" href="{{ route('products.edit', ['product' => $product->id]) }}">Modifica</a>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#ProductModal-{{ $product->id }}">
                    Elimina
                </button>

                <!-- Modal -->
                <div class="modal fade" id="ProductModal-{{ $product->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Conferma Cancellazione</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Vuoi eliminare il prodotto: {{ $product->name }}?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Annulla</button>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger" type="submit">Conferma</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>




            </li>
        </ul>
    </div>
@endsection
