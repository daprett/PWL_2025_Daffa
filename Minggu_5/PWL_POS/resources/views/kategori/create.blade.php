@extends('layouts.app')

@section('subtitle', 'Kategori')
@section('content_header_title', 'Kategori')
@section('content_header_subtitle', 'Create')

@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header"><h3>Buat Kategori Baru</h3></div>

            <form method="post" action="../kategori">

                <div class="card-body">
                    <div class="form-group">
                        <label for="kodeKategori">KodeKategori</label>
                        <input type="text" class="form-control" id="kodeKategori" name="kodeKategori" placeholder="Untuk makanan, contoh:MKN">
                    </div>
                    <div class="form-group">
                        <label for="namaKategori">NamaKategori</label>
                        <input type="text" class="form-control" id="namaKategori" name="namaKategori" placeholder="Nama">
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection