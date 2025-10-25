@extends('auth.layout')

@section('form')
    <div class="overlay"></div>
    <form action="{{ route('auth.verifycode') }}" method="post" class="form-group">
        @csrf
        <img src="{{ asset('assets/imgs/ncc-logo-white.png') }}" alt="Logo" class="ncc-logo" />
        <h1 class="title">تایید ورود</h1>
        <input type="tel" name="code" placeholder="کد تأیید" required class="input_data" />
        <button type="submit" class="submit_button">ورود</button>

        @isset($status)
            <span class="error">
                {{ $status }}
            </span>
        @endisset
    </form>
@endsection
