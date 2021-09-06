@extends('layouts.app')

@section('style')

@endsection


@section('content')
    @if (Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>
    @endif
    <form action="enter" method="POST"> @csrf
        <div class="col-md-12">
            <input type="text" name="option" class="form-control">
            <button type="submit">add</button>
        </div>
    </form>
@endsection
