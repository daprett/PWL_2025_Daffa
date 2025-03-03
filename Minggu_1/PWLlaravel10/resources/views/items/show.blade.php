<!DOCTYPE html>
<html>
<head>
    <title>Item List</title> <!-- judul web -->
</head>
<body>
    <h1>Items</h1>

    <!-- Menampilkan pesan sukses -->
    @if(session('success'))
        <p>{{ session('success') }}</p> <!-- Menampilkan pesan sukses dari session -->
    @endif

    
    <a href="{{ route('items.create') }}">Add Item</a><!-- Link untuk menambahkan item baru -->

    <ul>
        
        @foreach ($items as $item)<!-- Melakukan perulangan untuk setiap item dalam variabel $items -->
            <li>
                {{ $item->name }} - <!-- Menampilkan nama item -->

              
                <a href="{{ route('items.edit', $item) }}">Edit</a>  <!-- Link untuk mengedit item -->

                <!-- Form untuk menghapus item -->
                <form action="{{ route('items.destroy', $item) }}" method="POST" style="display:inline;">
                    @csrf 
                    @method('DELETE') <!-- Mengubah metode menjadi delete sesuai dengan standar restful -->
                    <button type="submit">Delete</button> <!-- Tombol untuk menghapus item -->
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
