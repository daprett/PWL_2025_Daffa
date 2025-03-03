<!DOCTYPE html>
<html>
<head>
    <title>Add Item</title>  <!-- judul web -->
</head>
<body>
    <h1>Add Item</h1>
    <form action="{{ route('items.store') }}" method="POST"><!-- form menambah item baru -->
        @csrf
        <label for="name">Name:</label><!-- label input nama  -->
        <input type="text" name="name" required> <!-- input nama dan, wajib diisi -->
        <br>
        <label for="description">Description:</label> <!-- label input deskripsi  -->
        <textarea name="description" required></textarea> <!-- input deskripso dan, wajib diisi -->
        <br>
        <button type="submit">Add Item</button> <!-- tombol untuk menambah item -->
    </form>
    <a href="{{ route('items.index') }}">Back to List</a> <!-- Link untuk kembali ke daftar item -->
</body>
</html>
