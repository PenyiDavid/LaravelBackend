<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<ul>
    @if($errors->any())
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    @endif
    </ul>

    @if(session('success'))
        {{session('success')}}
    @endif
    <form action="" method="post">
    @csrf
    <label for="brand">Brand:</label>
    <input type="text" name="brand" id="brand"><br>

    <label for="modell">Modell:</label>
    <input type="text" name="modell" id="modell"><br>

    <label for="color">Color:</label>
    <input type="text" name="color" id="color"><br>

    <label for="size">Size:</label>
    <input type="number" name="size" id="size"><br>

    <label for="stock">Stock:</label>
    <input type="number" name="stock" id="stock"><br>

    <label for="price">Price:</label>
    <input type="text" name="price" id="price"><br>

    <label for="product_type_id">Product type:</label>
    <select name="product_type_id" id="product_type_id">
        @foreach($types as $type)
            <option value="{{$type->id}}">{{$type->name}}</option>
        @endforeach
    </select><br>

    <button type="submit">Save</button>
    </form>
</body>
</html>