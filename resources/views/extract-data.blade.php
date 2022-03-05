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
/* -----------------------------------------
  =Default css to make the demo more pretty
-------------------------------------------- */
.table td, .table th {
    padding: 0.75rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
    vertical-align: middle;
}







/* -----------------------------------------
  =CSS3 Loading animations
-------------------------------------------- */

/* =Elements style
---------------------- */
.load-wrapp {
  float: left;
  /* width: 100px;
  height: 100px; */
  /* margin: 0 10px 10px 0; */
  /* padding: 20px 20px 20px; */
  /* border-radius: 5px; */
  /* text-align: center;
  background-color: #d8d8d8; */
}

.load-wrapp p {
  padding: 0 0 20px;
}
.load-wrapp:last-child {
  margin-right: 0;
}

.line {
  display: inline-block;
  width: 15px;
  height: 15px;
  border-radius: 15px;
  background-color: #4b9cdb;
}

.ring-1 {
  width: 10px;
  height: 10px;
  margin: 0 auto;
  padding: 10px;
  border: 7px dashed #4b9cdb;
  border-radius: 100%;
}

.ring-2 {
  position: relative;
  width: 45px;
  height: 45px;
  margin: 0 auto;
  border: 4px solid #4b9cdb;
  border-radius: 100%;
}

.ball-holder {
  position: absolute;
  width: 12px;
  height: 45px;
  left: 17px;
  top: 0px;
}

.ball {
  position: absolute;
  top: -11px;
  left: 0;
  width: 16px;
  height: 16px;
  border-radius: 100%;
  background: #4282b3;
}

.letter-holder {
  /* padding: 16px; */
}

.letter {
  float: left;
  font-size: 14px;
  color: #777;
}

.square {
  width: 12px;
  height: 12px;
  border-radius: 4px;
  background-color: #4b9cdb;
}

.spinner {
  position: relative;
  width: 45px;
  height: 45px;
  margin: 0 auto;
}

.bubble-1,
.bubble-2 {
  position: absolute;
  top: 0;
  width: 25px;
  height: 25px;
  border-radius: 100%;
  background-color: #4b9cdb;
}

.bubble-2 {
  top: auto;
  bottom: 0;
}

.bar {
  float: left;
  width: 15px;
  height: 6px;
  border-radius: 2px;
  background-color: #4b9cdb;
}

.load-6 .letter {
  animation-name: loadingF;
  animation-duration: 1.6s;
  animation-iteration-count: infinite;
  animation-direction: linear;
}

.l-1 {
  animation-delay: 0.48s;
}
.l-2 {
  animation-delay: 0.6s;
}
.l-3 {
  animation-delay: 0.72s;
}
.l-4 {
  animation-delay: 0.84s;
}
.l-5 {
  animation-delay: 0.96s;
}
.l-6 {
  animation-delay: 1.08s;
}
.l-7 {
  animation-delay: 1.2s;
}
.l-8 {
  animation-delay: 1.32s;
}
.l-9 {
  animation-delay: 1.44s;
}
.l-10 {
  animation-delay: 1.56s;
}

.load-7 .square {
  animation: loadingG 1.5s cubic-bezier(0.17, 0.37, 0.43, 0.67) infinite;
}

.load-8 .line {
  animation: loadingH 1.5s cubic-bezier(0.17, 0.37, 0.43, 0.67) infinite;
}

.load-9 .spinner {
  animation: loadingI 2s linear infinite;
}
.load-9 .bubble-1,
.load-9 .bubble-2 {
  animation: bounce 2s ease-in-out infinite;
}
.load-9 .bubble-2 {
  animation-delay: -1s;
}

.load-10 .bar {
  animation: loadingJ 2s cubic-bezier(0.17, 0.37, 0.43, 0.67) infinite;
}

@keyframes loadingA {
  0 {
    height: 15px;
  }
  50% {
    height: 35px;
  }
  100% {
    height: 15px;
  }
}

@keyframes loadingB {
  0 {
    width: 15px;
  }
  50% {
    width: 35px;
  }
  100% {
    width: 15px;
  }
}

@keyframes loadingC {
  0 {
    transform: translate(0, 0);
  }
  50% {
    transform: translate(0, 15px);
  }
  100% {
    transform: translate(0, 0);
  }
}

@keyframes loadingD {
  0 {
    transform: rotate(0deg);
  }
  50% {
    transform: rotate(180deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

@keyframes loadingE {
  0 {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

@keyframes loadingF {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}

@keyframes loadingG {
  0% {
    transform: translate(0, 0) rotate(0deg);
  }
  50% {
    transform: translate(70px, 0) rotate(360deg);
  }
  100% {
    transform: translate(0, 0) rotate(0deg);
  }
}

@keyframes loadingH {
  0% {
    width: 15px;
  }
  50% {
    width: 35px;
    padding: 4px;
  }
  100% {
    width: 15px;
  }
}

@keyframes loadingI {
  100% {
    transform: rotate(360deg);
  }
}

@keyframes bounce {
  0%,
  100% {
    transform: scale(0);
  }
  50% {
    transform: scale(1);
  }
}

@keyframes loadingJ {
  0%,
  100% {
    transform: translate(0, 0);
  }

  50% {
    transform: translate(80px, 0);
    background-color: #f5634a;
    width: 25px;
  }
}

</style>
@endsection


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <p class="C-Heading pt-3">Filter By:</p>
          <div class="row mx-0 card align-items-center">
              <div class="col-lg-12">
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
                                    <div class="col-12 text-center"> <button type="buton" class="btn btn-warning text-white mt-3">Extract</button></div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
              </div>
           
          </div>

        </div>
    </div>
   <div class="col-lg-12 mt-3">
   <div class="card d-block py-3 justify-content-center align-items-center" style="text-align:center;">
  <div class="table-responsive">
  <table id="example1" class="table table-striped table-bordered text-center" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Excel Type</th>
                <th>Export - Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tiger Nixon</td>
                <td>Edinburgh</td>
                <td>12/2/12</td>
                <td class="">
                 <div class="d-flex align-items-center justify-content-center">
                 <div class="load-wrapp">
                    <div class="load-6 d-flex justify-content-center">
                    <div class="letter-holder">
                    <div class="l-1 letter">P</div>
                    <div class="l-2 letter">r</div>
                    <div class="l-3 letter">o</div>
                    <div class="l-4 letter">c</div>
                    <div class="l-5 letter">e</div>
                    <div class="l-6 letter">s</div>
                    <div class="l-7 letter">s</div>
                    <div class="l-7 letter">i</div>
                    <div class="l-7 letter">n</div>
                    <div class="l-7 letter">g</div>
                    <div class="l-8 letter">.</div>
                    <div class="l-9 letter">.</div>
                    <div class="l-10 letter">.</div>
                    </div>
                     </div>
                        </div>
                        <div class="ml-5"><button class="btn btn-warning text-white">Exported</button></div>
                 </div>
                    </td>
                    </tr>
    </table>
  </div>
   <!-- <img src="{{ asset('assets/image/global/icon.png') }}" width="77" alt="" srcset=""> <span style="    color: #6b6e6f !important;" class="h1 pl-3">76 Records Found</span> </div> -->
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
        //append all uiser to dropdown for of candidate list 
        function appendFilterOptions() {
            $.ajax({
                    type: "GET",
                    url: '{{ route('append-extract-option') }}',
                })
                .done(function(res) {
                    for (let i = 0; i < res.user.length; i++) {
                        $('#recruiter').append('<option value="' + res.user[i].id + '">' + res.user[i].name +
                            '</option>')
                    }
                    for (let i = 0; i < res.candidates.length; i++) {
                        $('#candidate').append('<option value="' + res.candidates[i].id + '">' + res.candidates[i]
                            .last_name + '</option>')
                    }
                    for (let i = 0; i < res.candidates_profile.options.length; i++) {
                        $('#profile').append('<option value="' + res.candidates_profile.options[i].option_name + '">' +
                            res.candidates_profile.options[i].option_name + '</option>')
                    }
                    for (let i = 0; i < res.sub_segment.options.length; i++) {
                        $('#sub_segment').append('<option value="' + res.sub_segment.options[i].option_name + '">' + res
                            .sub_segment.options[i].option_name + '</option>')
                    }
                    for (let i = 0; i < res.clients.options.length; i++) {
                        $('#client').append('<option value="' + res.clients.options[i].option_name + '">' + res.clients
                            .options[i].option_name + '</option>')
                    }
                    for (let i = 0; i < res.career_level.options.length; i++) {
                        $('#career_level').append('<option value="' + res.career_level.options[i].option_name + '">' +
                            res.career_level.options[i].option_name + '</option>')
                    }
                    for (let i = 0; i < res.application_status.options.length; i++) {
                        $('#app_status').append('<option value="' + res.application_status.options[i].option_name +
                            '">' + res.application_status.options[i].option_name + '</option>')
                    }
                    $('#loader1').hide()
                })
                .fail(function(err) {
                    console.log(err);
                });
        }
        //close 
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            });
        });
</script>

@endsection