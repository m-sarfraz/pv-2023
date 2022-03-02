@extends('layouts.app')

@section('style')
<!-- ================= -->
<!-- Datatable css start-->
<link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}" />

<!-- Datatable css end-->
<!-- ================= -->
<style>
.row {
    margin: 0px !important;
}

#example1_filter label {
    display: flex;
    width: fit-content;
    margin-left: auto;
}
.card {
    flex-direction: inherit;
}
</style>
@endsection


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <p class="C-Heading pt-3">Filter By:</p>
          <div class="row mx-0 card align-items-center">
              <div class="col-lg-11">
              <div class=" mb-13 h-100">
                <div class="card-body px-0">
                    <form action="">
                        <div class="row mx-0">
                            <div class="col-lg-6">
                                <div class="row mx-0">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">Domain:</label>
                                            <select multiple name="DOMAIN" id="domain" required=""
                                                class="form-control p-0 users-input-S-C select2_dropdown w-100">
                                                <option value="option 1">
                                                    option 1</option>
                                                <option value="option 1">
                                                    option 1</option>
                                                <option value="option 1">
                                                    option 1</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">Client:</label>
                                            <select multiple name="DOMAIN" id="domain2" required=""
                                                class="form-control p-0 users-input-S-C select2_dropdown w-100">
                                                <option value="option 1">
                                                    option 1</option>
                                                <option value="option 1">
                                                    option 1</option>
                                                <option value="option 1">
                                                    option 1</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mx-0 pt-3">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">Category:</label>
                                            <select multiple name="DOMAIN" id="domain3" required=""
                                                class="form-control p-0 users-input-S-C select2_dropdown w-100">
                                                <option value="option 1">
                                                    option 1</option>
                                                <option value="option 1">
                                                    option 1</option>
                                                <option value="option 1">
                                                    option 1</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">Career Level:</label>
                                            <select multiple name="DOMAIN" id="domain4" required=""
                                                class="form-control p-0 users-input-S-C select2_dropdown w-100">
                                                <option value="option 1">
                                                    option 1</option>
                                                <option value="option 1">
                                                    option 1</option>
                                                <option value="option 1">
                                                    option 1</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mx-0 pt-3">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">Application status:</label>
                                            <select multiple name="DOMAIN" id="domain5" required=""
                                                class="form-control p-0 users-input-S-C select2_dropdown w-100">
                                                <option value="option 1">
                                                    option 1</option>
                                                <option value="option 1">
                                                    option 1</option>
                                                <option value="option 1">
                                                    option 1</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">Remarks:</label>
                                            <select multiple name="DOMAIN" id="domain6" required=""
                                                class="form-control p-0 users-input-S-C select2_dropdown w-100">
                                                <option value="option 1">
                                                    option 1</option>
                                                <option value="option 1">
                                                    option 1</option>
                                                <option value="option 1">
                                                    option 1</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row mx-0">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">Start Date (Shifted):</label>
                                            <select multiple name="DOMAIN" id="domain7" required=""
                                                class="form-control p-0 users-input-S-C select2_dropdown w-100">
                                                <option value="option 1">
                                                    option 1</option>
                                                <option value="option 1">
                                                    option 1</option>
                                                <option value="option 1">
                                                    option 1</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">End Date (Shifted):</label>
                                            <select multiple name="DOMAIN" id="domain8" required=""
                                                class="form-control p-0 users-input-S-C select2_dropdown w-100">
                                                <option value="option 1">
                                                    option 1</option>
                                                <option value="option 1">
                                                    option 1</option>
                                                <option value="option 1">
                                                    option 1</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mx-0 pt-3">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">Start Date (Endo):</label>
                                            <select multiple name="DOMAIN" id="domain9" required=""
                                                class="form-control p-0 users-input-S-C select2_dropdown w-100">
                                                <option value="option 1">
                                                    option 1</option>
                                                <option value="option 1">
                                                    option 1</option>
                                                <option value="option 1">
                                                    option 1</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="Label-00">End Date (Endo):</label>
                                            <select multiple name="DOMAIN" id="domain10" required=""
                                                class="form-control p-0 users-input-S-C select2_dropdown w-100">
                                                <option value="option 1">
                                                    option 1</option>
                                                <option value="option 1">
                                                    option 1</option>
                                                <option value="option 1">
                                                    option 1</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
              </div>
              <div class="col-lg-1"> <button type="buton" class="btn btn-warning text-white w-100">Extract</button></div>
          </div>

        </div>
    </div>
   <div class="col-lg-12 mt-3">
   <div class="card py-3 justify-content-center align-items-center" style="text-align:center;">
   <img src="{{ asset('assets/image/global/icon.png') }}" width="77" alt="" srcset=""> <span style="    color: #6b6e6f !important;" class="h1 pl-3">76 Records Found</span> </div>
   </div>
</div>

@endsection


@section('script')
<!-- ================= -->
<!-- Datatable js start-->
<script src="{{ asset('assets/plugins/data-tables/script/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/data-tables/script/datatables-bs4/js/dataTables.bootstrap4.min.js') }}">
</script>
<script src="{{ asset('assets/plugins/data-tables/script/datatables-responsive/js/dataTables.responsive.min.js') }}">
</script>
<script src="{{ asset('assets/plugins/data-tables/script/datatables-responsive/js/responsive.bootstrap4.min.js') }}">
</script>
<script>
select2Dropdown("select2_dropdown");
</script>

@endsection