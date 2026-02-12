@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-tite mx-4 ">
                <h2 class="mb-0 mt-4 fw-semibold"> Data Chat </h2>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>

                        @foreach ($sessions as $session)
                            <tr>
                                <td>{{ $session->nama }}</td>
                                <td>{{ $session->email }}</td>
                                <td>
                                    @if ($session->status == 'open')
                                    <span class="badge bg-success">
                                        {{ $session->status }}
                                    </span>
                                    @else
                                    <span class="badge bg-danger">
                                        {{ $session->status }}
                                    </span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.chat.show', $session->id) }}" class="btn btn-sm btn-primary">
                                        Buka
                                    </a>
                                    @if($session->status == 'open')
                                        <form action="{{ route('admin.chat.close', $session->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                            <button class="btn btn-danger btn-sm">
                                                Tutup Chat
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
