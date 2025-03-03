<!DOCTYPE html>
<html>
<head>
    <title>Edit Item</title>
</head>
<body>
    <h1>Edit Item</h1>
    <form action="{{ route('items.update', $item) }}" method="POST"><!-- Membuat form dengan action menuju route update item -->
        @csrf
        @method('PUT')
        <label for="name">Name:</label>
        <input type="text" name="name" value="{{ $item->name }}" required><!-- Input teks untuk nama item -->
        <br>
        <label for="description">Description:</label>
        <textarea name="description" required>{{ $item->description }}</textarea><!-- Input area untuk deskripsi item-->
        <br>
        <button type="submit">Update Item</button><!-- Tombol untuk submit form -->
    </form>
    <a href="{{ route('items.index') }}">Back to List</a><!-- Tautan untuk kembali ke daftar item -->
</body>
</html>
