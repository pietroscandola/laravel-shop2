@extends('layouts.main')

@section('content')
    <div class="container">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product) }}" method="post">
            @method('PUT')
            @csrf
            <div class="my-3 ">
                <label for="name" class="form-label">Nome del Prodotto</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('title', $product->name) }}">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <input type="text" class="form-control" id="description" name="description"
                    value="{{ old('description', $product->description) }}">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Prezzo</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01"
                    value="{{ old('price', $product->price) }}">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Immagine</label>
                <input type="text" class="form-control" id="image" name="image"
                    value="{{ old('image', $product->image) }}">
            </div>
            <div class="mb-3 ">
                <select class="form-select @error('brand_id') is-invalid @enderror" name="brand_id">
                    <option value="">Nessuna Marca</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" @if (old('brand_id ', $product->brand_id) == $brand->id) selected @endif>
                            {{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
            <hr>
            <div class="col-12" @error('color') is_invalid @enderror>
                @foreach ($colors as $color)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="color-{{ $color->id }}"
                            value="{{ $color->id }}" name="colors[]" @if (in_array($color->id, old('colors', $colors_product_id ?? []))) checked @endif>
                        <label class="form-check-label" for="color-{{ $color->id }}">{{ $color->color }}</label>
                    </div>
                @endforeach
                @error('color')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <hr>
            <button type="submit" class="btn btn-success">Conferma</button>
        </form>
    </div>
@endsection
