<!DOCTYPE html>
<html>
<head>
    <title>Data User</title>
</head>
<body>
    <h1>Data User</h1>
    <table border="1" cellpadding="2">
        {{-- <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Nama</th>
            <th>IDPengguna</th>
        </tr> --}}

        {{-- @foreach ($data as $d) --}}
            {{-- <tr>
                <td>{{ $data->user_id }}</td>
                <td>{{ $data->username }}</td>
                <td>{{ $data->nama }}</td>
                <td>{{ $data->level_id }}</td>
            </tr> --}}
        {{-- @endforeach --}}
    {{-- </table> --}}
    <table border="1" cellpadding="2">
        <tr>
        <th>Jumlah pengguna</th>
        </tr>
        <tr>
            <td>{{ $data }}</td>
        </tr>
    </table>
   

</body>
</html>