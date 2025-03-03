<!DOCTYPE html>
<html>
<head>
    <title>Item List</title> <!-- judul web -->
</head>
<body>
    <h1>Items</h1>
    @if(session('success'))
        <p>{{ session('success') }} </p>  <!-- menampilkan pesan success -->
    @endif
    <a href="{{ route('items.create') }}">Add Item</a>  <!-- Link untuk menambahkan item baru -->
    <ul>
        @foreach ($items as $item)   <!-- Melakukan looping untuk menampilkan daftar item -->
            <li>
                {{ $item->name }} -  <!-- Menampilkan nama item -->
                <a href="{{ route('items.edit', $item) }}">Edit</a> <!-- Link untuk mengedit item -->
                <form action="{{ route('items.destroy', $item) }}" method="POST" style="display:inline;"> <!-- Form untuk menghapus item -->
                    @csrf
                    @method('DELETE')<!-- Menggunakan metode HTTP DELETE untuk menghapus item -->
                    <button type="submit">Delete</button> <!-- Tombol untuk menghapus item -->
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>