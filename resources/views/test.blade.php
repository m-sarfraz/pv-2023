@extends('layouts.app')

@section('content')

    <section class="px-3">
        <div class="row m-0 pt-3">

        </div>

        <div class="card">
            <div class="card-header">Dashboard</div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('save_permission') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("post")
                    <div class="form-group">

                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name">
                        </div>
                        <div class="form-group">
                            <label for="">Type</label>
                            <input type="text" name="type">
                        </div>

                        <div class="form-group">
                            <button type="submit"> save </button>
                        </div>
                </form>
            </div>
        </div>

    @endsection
