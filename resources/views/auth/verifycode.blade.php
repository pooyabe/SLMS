@extends('auth.layout')

@section('form')
    <form action="{{ route('auth.verifycode') }}" method="post">
        @csrf
        <input type="hidden" name="phone" value="{{ $phone }}" />
        <input type="number" name="code" placeholder="کد تأیید" required />
        <button type="submit">ورود</button>

        @error('code')
            کد اشتباه است.
        @enderror
    </form>
@endsection
