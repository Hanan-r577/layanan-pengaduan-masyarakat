@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-title">
                <h5>Chat dengan {{ $session->nama }}</h5>
            </div>

            <div style="height:400px; overflow-y:auto; background:#f5f5f5; padding:15px;">
                @foreach ($session->messages as $msg)
                    <div class="mb-2">
                        <strong>{{ $msg->sender_type }}:</strong>
                        {{ $msg->message }}
                    </div>
                @endforeach
            </div>

            <form method="POST" action="{{ route('admin.chat.reply') }}">
                @csrf
                <input type="hidden" name="chat_session_id" value="{{ $session->id }}">

                <div class="d-flex mt-2">
                    <input type="text" name="message" class="form-control" required>
                    <button class="btn btn-primary ms-2">Kirim</button>
                </div>
            </form>

        </div>
    </div>
@endsection
