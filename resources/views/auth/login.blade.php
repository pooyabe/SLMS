@extends('auth.layout')

@section('form')
    <form action="{{ route('auth.getphone') }}" method="post">
        @csrf
        <input type="tel" name="phone" placeholder="شماره تلفن" required />
        <button type="submit">دریافت کد</button>

        @error('phone')
            کاربر یافت نشد
        @enderror
    </form>
@endsection
