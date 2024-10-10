<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">New product</h1>
    <ul class="list-unstyled">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </ul>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="" method="post" class="mt-4">
        @csrf
        <div class="form-group">
            <label for="brand">Brand:</label>
            <input type="text" name="brand" id="brand" class="form-control" placeholder="Enter brand">
        </div>

        <div class="form-group">
            <label for="modell">Modell:</label>
            <input type="text" name="modell" id="modell" class="form-control" placeholder="Enter model">
        </div>

        <div class="form-group">
            <label for="color">Color:</label>
            <input type="text" name="color" id="color" class="form-control" placeholder="Enter color">
        </div>

        <div class="form-group">
            <label for="size">Size:</label>
            <input type="number" name="size" id="size" class="form-control" placeholder="Enter size">
        </div>

        <div class="form-group">
            <label for="stock">Stock:</label>
            <input type="number" name="stock" id="stock" class="form-control" placeholder="Enter stock quantity">
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" name="price" id="price" class="form-control" placeholder="Enter price">
        </div>

        <div class="form-group">
            <label for="product_type_id">Product type:</label>
            <select name="product_type_id" id="product_type_id" class="form-control">
                @foreach($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>