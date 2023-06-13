@extends('layouts.app')

@section('style')
    <!-- ================= -->
    <!-- Datatable css start-->
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}" />

    <!-- Datatable css end-->
    <!-- ================= -->
    <style>
        button.dt-button.buttons-columnVisibility:not(.active) {
            background-color: #e8e8e8 !important;
            background: #e8e8e8 !important;
            color: black !important;
        }

        #fmtable1 td {
            text-align: center;
            max-width: 40ch;
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }

        #fmtable td {
            text-align: center;
            max-width: 40ch;
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }

        button.dt-button.buttons-columnVisibility {
            background-color: #dc8627 !important;
            background: #dc8627 !important;
            color: white !important;
        }

        #example1_filter label {
            display: flex;
            width: fit-content;
            margin-left: auto;
        }

        .hideID:first-child,
        .hidetrID tr td:first-child {
            display: none !important;
        }

        .hideID:first-child,
        .hidetrID tr td:nth-child(2) {
            display: none !important;
        }

        .hidetrID tr:hover {
            background-color: rgb(220 134 39) !important;
            color: white;

        }

        #fmtable_filter {
            visibility: hidden;
        }

        #fmtable1_filter {
            /* visibility: hidden; */
            display: none;
        }

        .hideIDTh:nth-child(1) {
            display: none;
        }

        .hideIDTh:nth-child(2) {
            display: none;
        }

        th {
            padding: 8px;
            border: 1px solid silver;
        }



        pre {
            margin: 20px;
            padding: 10px;
            background: #eee;
            border: 1px solid silver;
            border-radius: 4px;
        }

        .resizer {
            position: absolute;
            top: 0;
            right: -8px;
            bottom: 0;
            left: auto;
            width: 16px;
            cursor: col-resize;
        }

        .tableFixHead {
            overflow-y: auto;
            height: 670px;
        }

        .tableFixHead thead th {
            position: sticky;
            top: -10px;
        }
    </style>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-lg-6 ">
                <div class="card">
                    <p class="C-Heading pt-3 px-3">Record Finder:</p>
                    <div class=" mb-13">
                        <div id="loader1" style="display: block;"></div>
                        <div class="card-body">
                            <form action="">
                                <div class="row mb-4">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="d-block font-size-3 mb-0">
                                                Search (keyword):
                                            </label>
                                            <input type="text" name="searchKeyword" id="searchKeyword"
                                                placeholder="search keyword" required=""
                                                class="form-control h-px-20_custom border" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="d-block font-size-3 mb-0">
                                                Number Of Records Found:
                                            </label>
                                            <input type="text" name="REF_CODE" value="" disabled=""
                                                required="" id="record" class="form-control h-px-20_custom border" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <p class="mb-0 mt-2">Filter by:</p>
                                            <!-- <label class="Label">Recruiter</label> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1 align-items-center">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0">
                                            <label class="Label">Original Recruiter</label>
                                            <select multiple name="recruiter" id="recruiter"
                                                class="w-100 form-control select2_dropdown" onchange="filterUserData()">
                                                {{-- @foreach ($recruiter as $key => $user)
                                                <option value="{{ $user->id }}">
                                                    {{ $user->name }}</option>
                                            @endforeach --}}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-0 pt-0 pt-lg-1 pt-sm-0 ">
                                            <label class="d-block font-size-3 mb-0">
                                                Candidate's Name:
                                            </label>
                                            <select multiple name="" id="candidate"
                                                class="w-100 form-control select2_dropdown" onchange="filterUserData()">
                                                {{-- @foreach ($candidates as $key => $candidate)
                                                <option value="{{ $candidate->cid }}">
                                                    {{ $candidate->last_name }}</option>
                                            @endforeach --}}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="d-block font-size-3 mb-0">
                                                Remarks
                                            </label>
                                            <select multiple name="remarks" id="remarks"
                                                class="w-100 form-control select2_dropdown" onchange="filterUserData()">
                                                {{-- <option disabled>Select Option</option> --}}
                                                {{-- @foreach ($remarks_finance as $remarks)
                                                <option value="{{ $remarks->remarks_for_finance }}">
                                                    {{ $remarks->remarks_for_finance }}</option>
                                            @endforeach --}}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="d-block font-size-3 mb-0">
                                                Team
                                            </label>
                                            <select multiple name="team_id" id="team_id"
                                                class="w-100 form-control select2_dropdown" onchange="filterUserData()">
                                                {{-- <option disabaled> select option </option> --}}
                                                {{-- @foreach ($teams as $team)
                                                <option value="{{ $team->name }}">{{ $team->name }}</option>
                                            @endforeach --}}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="d-block font-size-3 mb-0">
                                                From (OB Date:)
                                            </label>
                                            <input type="date" class="w-100 form-control" id="ob_date"
                                                onchange="filterUserData()">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="d-block font-size-3 mb-0">
                                                Reprocess:
                                            </label>
                                            <select multiple name="process" id="process"
                                                class="w-100 form-control select2_dropdown" onchange="filterUserData()">
                                                {{-- <option disabaled> select option </option> --}}
                                                {{-- @foreach ($candidates as $reprocess)
                                                <option value="{{ $reprocess->reprocess }}">
                                                    {{ $reprocess->reprocess }}
                                                </option>
                                            @endforeach --}}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            @php
                                                $client = Helper::get_dropdown('clients');
                                            @endphp
                                            <label class="d-block font-size-3 mb-0">
                                                Client:
                                            </label>
                                            <select multiple name="" id="client"
                                                class="w-100 form-control select2_dropdown" onchange="filterUserData()">
                                                {{-- <option value="" disabled>Select Option</option> --}}
                                                {{-- @foreach ($client->options as $clientOptions)
                                                <option value="{{ $clientOptions->option_name }}">
                                                    {{ $clientOptions->option_name }}
                                                </option>
                                            @endforeach --}}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-0">
                                            <label class="Label">To (OB Date:)</label>
                                            <input type="date" class="w-100 form-control" id="to_ob_date"
                                                onchange="filterUserData()">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1 align-items-center">
                                    <div class="col-lg-8">
                                        <div class="form-group mb-0 pt-lg-1 pt-m-0 pt-0">
                                            <label class="d-block font-size-3 mb-0">
                                                Process Status:
                                            </label>
                                            <select multiple name="appstatus" id="appstatus"
                                                class="w-100 form-control select2_dropdown" onchange="filterUserData()">
                                                {{-- <option value="FB">FB</option>
                                            <option value="DONE">DONE</option>
                                            <option value="RCVD">RCVD</option>
                                            <option value="FFUP">FFUP</option>
                                            <option value="OVERDUE">OVERDUE</option> --}}

                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>




            </div>
            <div class="col-lg-6 " id="detail_div">
                <div class="card h-100">
                    <p class="C-Heading pt-3 px-3">Summary:</p>
                    <div class=" mb-13" id="summaryDiv">
                        <div class="card-body">
                            <form action="">
                                <fieldset disabled="">
                                    <div class="row mb-1">
                                        <div class="col-lg-3">
                                            <div class="form-group mb-0">
                                                <label class="Label">
                                                    Number of Hires:
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="hires.." id="hires" />
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group mb-0">
                                                <label class="Label">
                                                    Company Revenue:
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="Rev.." id="revenue" />
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group mb-0">
                                                <label class="Label">
                                                    Incentive Based Revenue:
                                                </label>
                                                <input type="text" id="Revenue_In_Incentive"
                                                    class="form-control users-input-S-C" placeholder="Rev.." />
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group mb-0">
                                                <label class="Label">
                                                    Total Receivables:
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="total.." />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-3">
                                            <div class="form-group mb-0">
                                                <label class="Label">
                                                    Number Of Billed:
                                                </label>
                                                <input type="text" class="form-control users-input-S-C" id="billed"
                                                    placeholder="hires.." />
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group mb-0">
                                                <label class="Label">
                                                    Billed Amount:
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="Rev.." />
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group mb-0">
                                                <label class="Label">
                                                    BOD (less share):
                                                </label>
                                                <input type="text" id="vcc_share" class="form-control users-input-S-C"
                                                    placeholder="Rev.." />
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group mb-0">
                                                <label class="Label">
                                                    Current Receivables:
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="total.." />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-3">
                                            <div class="form-group mb-0">
                                                <label class="Label">
                                                    Number Of Unbilled:
                                                </label>
                                                <input type="text" class="form-control users-input-S-C" id="unbilled"
                                                    placeholder="hires.." />
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group mb-0">
                                                <label class="Label">
                                                    Unbilled Amount:
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="Rev.." />
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group mb-0">
                                                <label class="Label">
                                                    BOD Share:
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="Rev.." />
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group mb-0">
                                                <label class="Label">
                                                    Overdue Receivables:
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="total.." />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-lg-3">
                                            <div class="form-group mb-0">
                                                <label class="Label">
                                                    Number of Fallout:
                                                </label>
                                                <input type="text" class="form-control users-input-S-C" id="fallout"
                                                    placeholder="hires.." />
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group mb-0">
                                                <label class="Label">
                                                    Fallout Amount:
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="Rev.." />
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group mb-0">
                                                <label class="Label">
                                                    Consultants Share:
                                                </label>
                                                <input type="text" id="c_take" class="form-control users-input-S-C"
                                                    placeholder="Rev.." />
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group mb-0">
                                                <label class="Label">
                                                    Consultants Take:
                                                </label>
                                                <input type="text" class="form-control users-input-S-C"
                                                    placeholder="total.." />
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-12">
                <!-- ================= -->
                <!-- Datatable code start-->
                <div class="table-responsive border-right pt-3" id="filterData_div">
                    <div class="tableFixHead">
                        <table id="fmtable" class="table w-100">
                            <thead class="bg-light w-100">
                                <tr style="text-align:center">
                                    <th class="ant-table-cell hideIDTh noVis">secret-id</th>
                                    {{-- <th class="ant-table-cell hideID">id</th> --}}
                                    <th class="ant-table-cell hideIDTh noVis">id</th>
                                    <th class="ant-table-cell">Team</th>
                                    <th class="ant-table-cell"> Original Recruiter</th>
                                    <th class="ant-table-cell"> Reprocessed </th>
                                    <th class="ant-table-cell">Client</th>
                                    <th class="ant-table-cell">Candidate</th>
                                    <th class="ant-table-cell">CL</th>
                                    <th class="ant-table-cell">OB Date</th>
                                    <th class="ant-table-cell">Placement Fee</th>
                                    <th class="ant-table-cell">Remarks</th>
                                    <th class="ant-table-cell">P.Status</th>
                                </tr>
                            </thead>
                            <tbody class="hidetrID  hidetrIDFinance" style="height:100px"> </tbody>
                        </table>
                    </div>


                </div>
                <!-- Datatable code end-->
                <!-- ================= -->
            </div>
        </div>
    </div>
    <div style="height: 30px;"></div>
@endsection

{{-- script section starts here --}}
@section('script')
    <script src="{{ asset('assets/plugins/data-tables/script/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/data-tables/script/datatables-responsive/js/dataTables.responsive.min.js') }}">
    </script>
    <script src="{{ asset('assets/plugins/data-tables/script/datatables-responsive/js/responsive.bootstrap4.min.js') }}">
    </script>
    <script>
        $("th")
            .css({
                /* required to allow resizer embedding */
                position: "relative"
            })
            /* check .resizer CSS */
            .prepend("<div class='resizer'></div>")
            .resizable({
                resizeHeight: false,
                // we use the column as handle and filter
                // by the contained .resizer element
                handleSelector: "",
                onDragStart: function(e, $el, opt) {
                    // only drag resizer
                    if (!$(e.target).hasClass("resizer"))
                        return false;
                    return true;
                }
            });
        // Section for docement ready funciton starts
        $(document).ready(function() {
            load_datatable()
            select2Dropdown("select2_dropdown");
            // show and hide loader after time set starts
            $('#loader').show();
            setTimeout(function() {
                $('#loader').hide();
            }, 10);
            // show and hide loader after time set ends
            // call for summary append 
            appendSummary(1)
            appendFilterOptions()
            // close 
            setTimeout(() => {
                // $('#candidate').select2({
                //     minimumInputLength: 1,
                //     ajax: {
                //         url: '{{ url('admin/showCandidateDropDown') }}',
                //         dataType: 'json', 
                //         processResults: function(data) {
                //             return {
                //                 results: $.map(data, function(item) {
                //                     return {
                //                         text: item.fullName,
                //                         id: item.id
                //                     }
                //                 })
                //             };
                //         },
                //     },
                // })
                $('#candidate').select2({
                    minimumInputLength: 1,
                    ajax: {
                        url: '{{ url('admin/showCandidateDropDown') }}',
                        dataType: 'json',
                        data: function(params) {
                            return {
                                term: params.term,
                                _type: 'query',
                                q: params.q,
                                finance: true // set the flag value to true or false as needed
                            };
                        },
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        text: item.fullName,
                                        id: item.id
                                    }
                                })
                            };
                        },
                    },
                })

                console.log('calll');
            }, 4000);
        });
        // close 

        // ajax call for sumary append on documnet ready 
        function appendSummary(array) {
            // $("#loader").show();
            // if (!array) {
            // call Ajax for returning the data as view
            $.ajax({
                type: "GET",
                url: '{{ url('admin/summaryAppend_finance') }}',
                data: {
                    _token: token,
                    array: array
                },
                // Success fucniton of Ajax
                success: function(data) {
                    $('#summaryDiv').html('');
                    $('#summaryDiv').html(data);
                }
            });
            // }
            // if (array) {
            //     // call Ajax for returning the data as view
            //     $.ajax({
            //         type: "GET",
            //         url: '{{ url('admin/summaryAppend_finance') }}',
            //         data: {
            //             _token: token,
            //             array: array
            //         },
            //         // Success fucniton of Ajax
            //         success: function(data) {
            //             $('#summaryDiv').html('');
            //             $('#summaryDiv').html(data);
            //         }
            //     });
            // }

        }
        //close

        // show detail of record on click a row in data table 
        $('#fmtable').on('click', 'tbody tr', function() {
            // $(this).css('background-color','red')
            $('tr').removeClass('hover-primary1');
            $(this).addClass('hover-primary1');
            // let tdVal = $(this).children()[1];
            // var id = tdVal.innerHTML
            // // console.log('id is ' + id)
            // userDetail(this, id)
        })
        // close 
        var option_table = '';
        // function for loading data in yajra on page load 
        function load_datatable() {
            option_table = $('#fmtable').DataTable({
                destroy: true,
                // search: {
                //     smart: false
                // },
                processing: true,
                serverSide: false,

                ajax: {
                    url: "{{ route('view-finance-search-table') }}",
                    type: "GET",
                },
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass('id');
                    let id = $(row).find('td:eq(1)').text().trim();
                    $(row).attr('data-href', `{{ url('admin/finance-details/${id}') }}`);

                },

                drawCallback: function(settings) {
                    $('.hidetrIDFinance').find('tr').each(function() {
                        $(this).dblclick(function() {
                            window.open($(this).attr('data-href'), '_blank');
                        });
                    });
                },
                initComplete: function(settings, json) {
                    // $('#searchKeyword').trigger('input');
                    let tableID = $('#filterData_div').children().children().attr('id')
                    if (tableID == 'fmtable_wrapper') {
                        countRecord()
                    }
                    if (tableID == 'fmtable1_wrapper') {
                        countRecordFilter()
                    }
                    $('#filterData_div').find('.dt-buttons').append(
                        '<button type=checkbox onclick="showAllColumnFunc()" class="customColumnBtn  btn btn-sm" id="selectAll">&nbsp; Show All Columns</button>'
                    )
                    $('#filterData_div').find('.dt-buttons').append(
                        '<button type=checkbox onclick="showNoColumnFunc()" class="customColumnBtn ml-2 btn btn-sm" id="selectAll">&nbsp; Hide All Columns</button>'
                    )
                    $('#fmtable_length').hide();

                },
                columns: [{
                        data: 'array',
                        name: 'array'
                    },
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'team',
                        name: 'team'
                    },
                    {
                        data: 'recruiter',
                        name: 'recruiter'
                    },
                    {
                        data: 'tapped',
                        name: 'tapped'
                    },
                    {
                        data: 'client',
                        name: 'client'
                    },

                    {
                        data: 'last_name',
                        name: 'last_name'
                    },
                    {
                        data: 'career_endo',
                        name: 'career_endo'
                    },
                    {
                        data: 'onboardnig_date',
                        name: 'onboardnig_date'
                    },
                    {
                        data: 'placement_fee',
                        name: 'placement_fee'
                    },
                    {
                        data: 'remarks_for_finance',
                        name: 'remarks_for_finance'
                    },
                    {
                        data: 'process_status',
                        name: 'process_status'
                    },
                ],
                dom: 'Blfrtip',
                columnDefs: [{
                    targets: 1,
                    className: 'noVis'
                }],
                columnDefs: [{
                    targets: 8,
                    type: 'date'
                }],
                bInfo: true,
                buttons: [{
                    extend: 'colvis',
                    text: 'List of Visible Coloumn Names in Current Table(Click to Deselect a Coloumn)',
                    columns: ':not(.noVis)'
                }]
            });
        }
        // close 

        //append  dropdowns
        function appendFilterOptions() {
            $.ajax({
                    type: "GET",
                    url: '{{ url('admin/appendFinanceOptions') }}',
                })
                .done(function(res) {
                    recruiter_dp = JSON.parse(localStorage.getItem('recruiter'));
                    candidate_dp = JSON.parse(localStorage.getItem('candidate'));
                    process_dp = JSON.parse(localStorage.getItem('process'));
                    team_id_dp = JSON.parse(localStorage.getItem('team_id'));
                    client_dp = JSON.parse(localStorage.getItem('client'));
                    remarks_dp = JSON.parse(localStorage.getItem('remarks'));
                    appstatus_dp = JSON.parse(localStorage.getItem('appstatus'));
                    var fromOB_view = JSON.parse(localStorage.getItem('from_ob'));
                    var toOB_view = JSON.parse(localStorage.getItem('to_ob'));

                    // for (let i = 0; i < res.candidates.length; i++) {
                    //     $('#candidate').append('<option  value="' + res.candidates[i].cid + '">' +
                    //         res.candidates[i].name + '</option>')
                    // }
                    for (let i = 0; i < res.recruiter.length; i++) {
                        $('#process').append('<option value="' + res.recruiter[i].id + '">' + res.recruiter[i]
                            .name + '</option>')
                    }
                    for (let i = 0; i < res.recruiter.length; i++) {
                        $('#recruiter').append('<option value="' + res.recruiter[i].id + '">' + res.recruiter[i]
                            .name + '</option>')
                    }
                    for (let i = 0; i < res.remarks_finance.length; i++) {
                        $('#remarks').append('<option value="' + res.remarks_finance[i].remarks_for_finance + '">' + res
                            .remarks_finance[i]
                            .remarks_for_finance + '</option>')
                    }
                    for (let i = 0; i < res.teams.length; i++) {
                        $('#team_id').append('<option value="' + res.teams[i].id + '">' + res.teams[i]
                            .name + '</option>')
                    }
                    for (let i = 0; i < res.client.length; i++) {

                        $('#client').append('<option value="' + res.client[i].client + '">' + res.client[i].client +
                            '</option>')
                    }
                    for (let i = 0; i < res.process.options.length; i++) {
                        $('#appstatus').append('<option value="' + res.process.options[i].option_name + '">' +
                            res.process.options[i].option_name + '</option>')
                    }
                    // for (let i = 0; i < res.appstatus.length; i++) {
                    //     if (res.appstatus[i].app_status != '') {
                    //         $('#appstatus').append('<option value="' + res.appstatus[i].app_status + '">' + res
                    //             .appstatus[i]
                    //             .app_status + '</option>')
                    //     }
                    // }
                    $('#loader1').hide()
                    if (recruiter_dp != null || candidate_dp != null || process_dp != null || team_id_dp !=
                        null ||
                        client_dp != null || remarks_dp != null || appstatus_dp != null || fromOB_view !=
                        null || toOB_view != null
                    ) {
                        $('#recruiter').val(recruiter_dp).trigger('change');
                        $('#candidate').val(candidate_dp);
                        $('#process').val(process_dp);
                        $('#team_id').val(team_id_dp);
                        $('#client').val(client_dp);
                        $('#remarks').val(remarks_dp);
                        $('#appstatus').val(appstatus_dp);
                        $('#ob_date').val(fromOB_view);
                        $('#to_ob_date').val(toOB_view);
                    }
                })
                .fail(function(err) {
                    console.log(err);
                });
        }
        //close 

        function load_datatable1() {
            // get values of selected inputs of users
            searchKeyword = $('#searchKeyword').val();
            recruiter = $('#recruiter').val();
            appstatus = $('#appstatus').val();
            team_id = $('#team_id').val();
            candidate = $('#candidate').val();
            remarks = $('#remarks').val();
            team = $('#team').val();
            // status = $('#status').val();
            toDate = $('#to_ob_date').val();
            ob_date = $('#ob_date').val();
            client = $('#client').val();
            process = $('#process').val();
            ob_date = $('#ob_date').val();
            option_table = $('#fmtable1').DataTable({
                // destroy: false,
                // // search: {
                // //     smart: false
                // // },
                // processing: true,
                // serverSide: true,
                // // stateSave: true,
                // // order: [[ 8, "asc" ]], // Sort by first column descending
                // // columnDefs : [{targets:8, type:"date-eu"}],

                // "language": {
                //     processing: '<div class="spinner-border mr-3" role="status"> </div><span>Processing ...</span>'
                // },
                destroy: true,
                // search: {
                //     smart: false
                // },
                processing: true,
                serverSide: false,

                ajax: {
                    url: "{{ route('financeRecordFilter') }}",
                    type: "POST",
                    data: {
                        _token: token,
                        searchKeyword: searchKeyword,
                        recruiter: recruiter,
                        candidate: candidate,
                        remarks: remarks,
                        toDate: toDate,
                        ob_date: ob_date,
                        team: team,
                        status: status,
                        client: client,
                        appstatus: appstatus,
                        team_id: team_id,
                        process: process,
                    },
                },
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass('id');
                    let id = $(row).find('td:eq(1)').text().trim();
                    $(row).attr('data-href', `{{ url('admin/finance-details/${id}') }}`);

                },
                drawCallback: function(settings) {
                    $('.hidetrIDFinance').find('tr').each(function() {
                        $(this).dblclick(function() {
                            window.open($(this).attr('data-href'), '_blank');
                        });
                    });
                },

                initComplete: function(settings, json) {
                    // $('#searchKeyword').trigger('input');
                    if (json.searchKeyword != null) {
                        $('#searchKeyword').val(json.searchKeyword)
                        $('#searchKeyword').change()
                    }
                    let tableID = $('#filterData_div').children().children().attr('id')

                    if (tableID == 'fmtable_wrapper') {
                        countRecord()
                    }
                    if (tableID == 'fmtable1_wrapper') {
                        countRecordFilter()
                    }
                    $('#filterData_div').find('.dt-buttons').append(
                        '<button type=checkbox onclick="showAllColumnFunc()" class="customColumnBtn  btn btn-sm" id="selectAll">&nbsp; Show All Columns</button>'
                    )
                    $('#filterData_div').find('.dt-buttons').append(
                        '<button type=checkbox onclick="showNoColumnFunc()" class="customColumnBtn ml-2 btn btn-sm" id="selectAll">&nbsp; Hide All Columns </button>'
                    )
                    $('#fmtable1_length').hide();
                    appendSummary(json.array);

                },
                columns: [{
                        data: 'array',
                        name: 'array'
                    },
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'team',
                        name: 'team'
                    },
                    {
                        data: 'recruiter',
                        name: 'recruiter'
                    },
                    {
                        data: 'tapped',
                        name: 'tapped'
                    },
                    {
                        data: 'client',
                        name: 'client'
                    },


                    {
                        data: 'last_name',
                        name: 'last_name'
                    },


                    {
                        data: 'career_endo',
                        name: 'career_endo'
                    },
                    {
                        data: 'onboardnig_date',
                        name: 'onboardnig_date'
                    },
                    {
                        data: 'placement_fee',
                        name: 'placement_fee'
                    },
                    {
                        data: 'remarks_for_finance',
                        name: 'remarks_for_finance'
                    },

                    {
                        data: 'process_status',
                        name: 'process_status'
                    },


                ],
                dom: 'Blfrtip',
                columnDefs: [{
                    targets: 1,
                    className: 'noVis'
                }],
                columnDefs: [{
                    targets: 8,
                    type: 'date'
                }],
                bInfo: true,
                buttons: [{
                    extend: 'colvis',
                    text: 'List of Visible Coloumn Names in Current Table(Click to Deselect a Coloumn)',
                    columns: ':not(.noVis)'
                }]
            });
        }
        //close 

        // function for getting detail of user starts 
        function userDetail(elem, id) {
            $('#loader').show();
            $('.common-tr').removeClass('hover-primary1');
            $(elem).addClass('hover-primary1');
            // call Ajax whihc will return view of detail data of user
            $.ajax({
                type: "GET",
                url: '{{ url('admin/finance_records_detail') }}',
                data: {
                    _token: token,
                    id: id,
                },

                // Ajax Success funciton
                success: function(data) {
                    // append retured view view to div 
                    $('#detailView').html('');
                    $('#detailView').html(data);
                    $("#loader").hide();

                    // hide loader 
                },
            });
        }
        // close

        // function for filtering the data according to selected input starts
        function filterUserData() {
            $("#loader").show();
            // call Ajax for returning the data as view
            $.ajax({
                type: "GET",
                url: '{{ url('admin/filterView') }}',
                success: function(data) {
                    $('#filterData_div').html(data);
                    $("#loader").hide();
                    // load_datatable1();
                },
            });
        }
        // close

        // oninput append value in yajra table 
        $('#searchKeyword').on('change', function() {
            option_table.page.len(-1).draw();
            setTimeout(() => {
                test = document.getElementsByClassName('id');
                var obj = {};
                for (let item of test) {
                    var tdValue = item.children[0].innerText;
                    array = tdValue.split("-");
                    value = array[0];
                    key = array[1];
                    obj = {
                        ...obj,
                        [key]: value
                    };
                }
                appendSummary(obj)
                setTimeout(() => {
                    $('#fmtable_length').children().children().val('10');
                    $('#fmtable_length').children().children().change();
                    $('#fmtable1_length').children().children().val('10');
                    $('#fmtable1_length').children().children().change();
                    // $('#searchKeyword').trigger('input');
                    $("#loader").hide();

                }, 100);
            }, 1000);
            $('#fmtable_filter').children().children().val($('#searchKeyword').val());
            $('#fmtable_filter').children().children().trigger('input');
            $('#fmtable1_filter').children().children().val($('#searchKeyword').val());
            $('#fmtable1_filter').children().children().trigger('input');
            let tableID = $('#filterData_div').children().children().attr('id')
            if (tableID == 'fmtable_wrapper') {
                countRecord()
            }
            if (tableID == 'fmtable1_wrapper') {
                countRecordFilter()
            }
            // code for search only for summary //


        });

        // count record on page load 
        function countRecord() {
            var count = $('#fmtable_info').text().split(' ');

            $('#record').val(count[5])
        }
        // close 

        // count record of filtered data
        function countRecordFilter() {
            var count = $('#fmtable1_info').text().split(' ');
            $('#record').val(count[5])
        }
        // setInterval(() => {
        window.onbeforeunload = function(event) {
            // get destined url and save or not save selected dropdosn according to conditions 
            url = document.activeElement.href;
            currentURL = window.location.href;
            let bfrLifeStr = currentURL.split("admin/").pop();
            let afterLifeStr = url.split("admin/").pop();
            if (afterLifeStr == bfrLifeStr) {
                localStorage.clear();
                return;
            }
            if (afterLifeStr == 'record' || afterLifeStr == 'search' || afterLifeStr == 'finance') {

                var recruiter = $('#recruiter').val();
                var candidate = $('#candidate').val();
                var remarks = $('#remarks').val();
                var team_id = $('#team_id').val();
                var process = $('#process').val();
                var client = $('#client').val();
                var appstatus = $('#appstatus').val();
                var from_ob = $('#ob_date').val();
                var to_ob = $('#to_ob_date').val();
                localStorage.setItem('recruiter', JSON.stringify(recruiter));
                localStorage.setItem('candidate', JSON.stringify(candidate));
                localStorage.setItem('remarks', JSON.stringify(remarks));
                localStorage.setItem('team_id', JSON.stringify(team_id));
                localStorage.setItem('process', JSON.stringify(process));
                localStorage.setItem('client', JSON.stringify(client));
                localStorage.setItem('appstatus', JSON.stringify(appstatus));
                localStorage.setItem('from_ob', JSON.stringify(from_ob));
                localStorage.setItem('to_ob', JSON.stringify(to_ob));
            } else {
                localStorage.clear();

            }
        };
        // }, 3000);
    </script>
@endsection
{{-- script seciton ends here --}}
