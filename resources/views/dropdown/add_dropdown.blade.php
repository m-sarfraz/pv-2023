@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css')  }}" />
<style>
    .dropdown_table div.col-12:nth-child(even) {background: #CCC}
.dropdown_table div.col-12:nth-child(odd) {background: #FFF}

</style>
@endsection



@section('content')
<div class="container-fluid mt-8 mt-lg-11" id="dashboard-body">
    <div class="">
        <div class="mb-15 mb-lg-23">
            <div class="row">
                <div class="col-xl-12 px-lg-5 mt-5 ">
                    <p class="C-Heading">Add dropdowns</p>
                    <div class="card">
                        <div class="card-body">
                            <form action="/">
                                <fieldset>
                                    <div class="row mb-xl-1 mb-9">
                                        <div class="col-lg-8 mb-xl-0 mb-7">
                                            <div class="form-group position-relative">
                                                <label for="select3" class="d-block text-black-2 font-size-4 font-weight-semibold mb-4">
                                                    Dropdowns
                                                </label>
                                                <div class="d-flex justify-content-between">


                                                    <select class="js-example-disabled-results w-75">
                                                        <option value="two" disabled="disabled">Choose options</option>
                                                        @foreach($dropdowns as $dropdown)
                                                            <option value="{{ $dropdown->id  }}">{{ $dropdown->name  }}</option>
                                                        @endforeach
                                                    </select>
                                                    <button class="btn btn-warning px-5 text-white" type="submit">Add</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                            <div class="row m-0">
                                    <div class="col-7 d-flex py-3">Options</div>
                                    <div class="col-5 d-flex text-center py-3">
                                        <div>Action</div>
                                    </div>
                            </div>

                            <div class="row m-0 shadow dropdown_table text-uppercase border rounded">
                                    <div class="col-7 d-flex py-3 border-bottom">Heading is here</div>
                                    <div class="col-5 d-flex text-center py-3 border-bottom">
                                        <button class="bg-transparent text-danger border-0">Delete</button>
                                    </div>
                                    <div class="col-7 d-flex py-3 border-bottom">Heading is here</div>
                                    <div class="col-5 d-flex text-center py-3 border-bottom">
                                        <button class="bg-transparent text-danger border-0">Delete</button>
                                    </div>
                                    <div class="col-7 d-flex py-3 border-bottom">Heading is here</div>
                                    <div class="col-5 d-flex text-center py-3 border-bottom">
                                        <button class="bg-transparent text-danger border-0">Delete</button>
                                    </div>
                                    <div class="col-7 d-flex py-3 border-bottom">Heading is here</div>
                                    <div class="col-5 d-flex text-center py-3 border-bottom">
                                        <button class="bg-transparent text-danger border-0">Delete</button>
                                    </div>
                                    <div class="col-7 d-flex py-3 border-bottom">Heading is here</div>
                                    <div class="col-5 d-flex text-center py-3 border-bottom">
                                        <button class="bg-transparent text-danger border-0">Delete</button>
                                    </div>
                                    <div class="col-7 d-flex py-3 border-bottom">Heading is here</div>
                                    <div class="col-5 d-flex text-center py-3 border-bottom">
                                        <button class="bg-transparent text-danger border-0">Delete</button>
                                    </div>
                                    <div class="col-7 d-flex py-3 border-bottom">Heading is here</div>
                                    <div class="col-5 d-flex text-center py-3 border-bottom">
                                        <button class="bg-transparent text-danger border-0">Delete</button>
                                    </div>
                                    <div class="col-7 d-flex py-3 border-bottom">Heading is here</div>
                                    <div class="col-5 d-flex text-center py-3 border-bottom">
                                        <button class="bg-transparent text-danger border-0">Delete</button>
                                    </div>
                            </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('script')
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    var $disabledResults = $(".js-example-disabled-results");
    $disabledResults.select2();

</script>
@endsection
