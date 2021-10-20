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

                <form action="{{ route('addtest_store') }}" method="post">
                    @csrf
                    @method("post")
                   <div class="form-group">
       
       
                       <label for=""> Candidate profile</label>
                       <input type="text" name="c_profile" >
                      </div>
                      <div class="form-group">
       
                       <label for=""> Domain</label>
                       <input type="text" name="domain" >
                      </div>
                      <div class="form-group">
       
                       <label for=""> segement</label>
                       <input type="text" name="segment" >
                      </div>
                      <div class="form-group">
       
                       <label for=""> sub-segement</label>
                       <input type="text" name="s_segment" >
                      </div>
                      <div class="form-group">
                          <button type="submit"> save </button>
                      </div>
                </form>
            </div>
        </div>

    @endsection
