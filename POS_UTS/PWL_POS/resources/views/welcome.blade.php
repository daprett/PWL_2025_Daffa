@extends('layouts.template')

@section('content')

<div class="card shadow-lg border-0 rounded-lg"> 
    <div class="card-header bg-primary text-white">
        <h3 class="card-title"><i class="fas fa-user-circle"></i> Selamat Datang, {{ $user->username }}!</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <table class="table table-bordered">
                    <tr>
                        <th><i class="fas fa-id-card"></i> User ID</th>
                        <td>{{ $user->user_id }}</td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-user"></i> Username</th>
                        <td>{{ $user->username }}</td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-user-tag"></i> Nama</th>
                        <td>{{ $user->nama }}</td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-shield-alt"></i> Role</th>
                        <td>{{ $user->level->level_nama }}</td>
                    </tr>
                </table>
            </div>   
        </div>
    </div>
    <div class="card-footer text-center">
        <form id="logout-form" action="{{ url('logout') }}" method="GET">
            @csrf
            <button type="submit" class="btn btn-danger btn-lg">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div> 
</div>

@endsection
