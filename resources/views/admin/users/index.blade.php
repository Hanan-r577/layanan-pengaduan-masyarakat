@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-tite mx-4">
                <h2 class="mb-0 mt-3 fw-semibold"> Data Users </h2>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <a href="{{ route('user.create') }}" class="btn btn-primary mb-3"> Tambah Users </a>
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telefon</th>
                                <th>Tanggal_dibuat</th>
                                <th>Level</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->nama }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->telp }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>{{ $user->level }}</td>
                                    <td class="align-middle text-center">
                                        <div class="d-inline-flex gap-2 justify-content-center">
                                            <a href="{{ route('user.edit', $user->id_user) }}"
                                                class="btn btn-sm btn-warning">Edit</a>

                                            <form action="{{ route('user.destroy', $user->id_user) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin ingin menghapus data usernya?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        });
    </script>
@endsection
