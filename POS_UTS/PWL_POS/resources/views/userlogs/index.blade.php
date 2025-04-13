@extends('layouts.template')

@section('content')
<div class="container">
    <h4 class="mb-3">Riwayat Aktivitas Pengguna</h4>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Waktu</th>
                    <th>Aktivitas</th>
                    <th>User Pelaku</th>
                    <th>Target</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                    <tr>
                        <td>{{ $log->performed_at }}</td>
                        <td>{{ $log->activity }}</td>
                        <td>{{ $log->user->username ?? '-' }}</td>
                        <td>{{ $log->target }}</td>
                        <td>{{ $log->detail }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada aktivitas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {{ $logs->links() }}
    </div>
</div>
@endsection
