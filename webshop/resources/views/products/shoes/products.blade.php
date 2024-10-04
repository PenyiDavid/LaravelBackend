<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<ul class="list-unstyled">
    @if($errors->any())
        @foreach($errors->all() as $error)
            <li class="alert alert-danger">{{ $error }}</li>
        @endforeach
    @endif
</ul>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<h1 class="mt-4">Products</h1>

<form method="GET" action="{{ route('products.index')}}" class="mb-4">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="brand">Brand:</label>
            <input type="text" class="form-control" name="brand" id="brand" value="{{ request()->brand }}">
        </div>
        <div class="form-group col-md-3">
            <label for="modell">Modell:</label>
            <input type="text" class="form-control" name="modell" id="modell" value="{{ request()->modell }}">
        </div>
        <div class="form-group col-md-3">
            <label for="min_price">Minimum price:</label>
            <input type="number" class="form-control" name="min_price" id="min_price" value="{{ request()->min_price }}">
        </div>
        <div class="form-group col-md-3">
            <label for="max_price">Maximum price:</label>
            <input type="number" class="form-control" name="max_price" id="max_price" value="{{ request()->max_price }}">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Search</button>
    <a href="products" class="btn btn-secondary">Szűrők törlése</a>
</form>

<ul class="list-group">
    @if($products->isNotEmpty())
        @foreach($products as $product)
            <li class="list-group-item">
                <h5>{{ $product->brand . ' - ' . $product->modell }}</h5>
                <ul class="list-unstyled">
                    <li>{{ 'Raktáron: ' . $product->stock }}</li>
                    <li>{{ 'Szín: ' . $product->color }}</li>
                    <li>{{ 'Ár: ' . $product->price . ' Ft' }}</li>
                    <li>
                        <form action="{{ route('update_stock', $product->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="form-row align-items-end">
                                <div class="form-group col-md-4">
                                    <label for="quantity">Mennyiség:</label>
                                    <input type="number" class="form-control" name="quantity" id="quantity" required>
                                </div>
                                <div class="form-group col-md-2">
                                    <button type="submit" class="btn btn-success">Vásárlás</button>
                                </div>
                            </div>
                        </form>
                    </li>
                    <li> 
                        <form action="{{ route('delete_product', $product->id) }}" method="POST" onsubmit="return confirm('Biztosan törli?');">
                            @csrf
                            @method('DELETE')

                            <button type="SUBMIT" class="btn btn-danger">DELETE PRODUCT</button>
                        </form>
                        
                    </li>
                </ul>
            </li>
        @endforeach
    @else
        <p class="text-muted">Nincs találat a szűrők alapján.</p>
    @endif
</ul>
</body>
</html>