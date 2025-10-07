@extends('auth.layout')

@section('form')
    <form action="{{ route('auth.verifycode') }}" method="post">
        @csrf
        <input type="number" name="code" placeholder="کد تأیید" required />
        <button type="submit">ورود</button>

        @isset($status)
            {{ $status }}
        @endisset
    </form>
@endsection
