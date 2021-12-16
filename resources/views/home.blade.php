@extends('layouts.app')

@section('content')

    <section class="px-3">
        <div class="row m-0 pt-3">
            <div class="col-lg-3">
                <span class="text-danger"> Select Date :</span> <input type="date" name="filterdate" id="filterdate"
                    onchange="filterdate()" />

            </div>
            <div class="col-lg-9">
                <p class="TVA" style="color: rgb(107, 110, 111); font-weight: bold;">Target vs Actual
                    Revenue(under <Span id="Quartile"><?php echo date('y-m-d'); ?></Span>)<span id="year"></span></p>
            </div>
        </div>

        <!-- SECTION ONE -->
        <div class="row m-0">
            <div class="col-lg-6">
                <div class="card cardBorderColor mb-8">
                    <ul class="nav nav-pills position-relative mb-0 justify-content-center " id="pills-tab" role="tablist">


                        <div class="svgDasboard "><svg id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" class="cp dropdown-toggle" fill="#6E8192"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="none" d="M0 0h24v24H0V0z"></path>
                                <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"></path>
                            </svg>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="#">Download SVG</a>
                                <a class="dropdown-item" href="#">Download PNG</a>
                                <a class="dropdown-item" href="#">Download CSV</a>
                            </div>
                        </div>
                    </ul>
                    <div class="tab-content px-2" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            <div style="width: 80%;margin: 0 auto;" id="chart">
                                {!! $chart->container() !!}
                            </div>

                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">B
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="card cardBorderColor mb-8">
                    <ul class="nav nav-pills position-relative mb-0 justify-content-center " id="pills-tab" role="tablist">


                        <div class="svgDasboard "><svg id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" class="cp dropdown-toggle" fill="#6E8192"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="none" d="M0 0h24v24H0V0z"></path>
                                <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"></path>
                            </svg>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="#">Download SVG</a>
                                <a class="dropdown-item" href="#">Download PNG</a>
                                <a class="dropdown-item" href="#">Download CSV</a>
                            </div>
                        </div>
                    </ul>
                    <div class="tab-content px-2" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home1" role="tabpanel"
                            aria-labelledby="pills-home-tab1">
                            <div style="width: 80%;margin: 0 auto;">
                                {!! $count_user_pie->container() !!}
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile1" role="tabpanel"
                            aria-labelledby="pills-profile-tab1">B
                        </div>
                    </div>

                </div>
            </div>
        </div>

        @php $data = DB::table('roles')->where('team_revenue', 1)->get(); @endphp
        <div class="row pt-4 m-0">
            <div class="col-lg-9">
                <div class="card cardBorderColor mb-8">
                    <div class="table-responsive tableFixHead">
                        <table id="tablePreview" class="table header-fixed table-striped">
                            <thead>
                                <tr>
                                    <th>Team</th>
                                    <th>Target</th>
                                    <th>Incentive Based Revenue</th>
                                    <th>PDM (Less Share) </th>
                                    <th>Company Revenue</th>
                                    <th>Targest vs Revenue %</th>
                                    <th>No of Ongoing (CIP)</th>
                                    <th>Total Ongoing (CIP)</th>
                                </tr>
                            </thead>
                            <tbody id="render_body">



                                @for ($i = 0; $i < count($data); $i++)

                                    @php $index_count_final_stage_0__check="count_final_stage_".$i @endphp
                                    @php $index_count_mid_stage_0__check="count_mid_stage_".$i @endphp
                                    @php $index_total_ogoing__check="total_ogoing_".$i @endphp
                                    @php $lastColumnsec_row__check="lastColumnsec_row_".$i @endphp
                                  

                                    <tr>
                                        <td><?php echo $data[$i]->name; ?></td>
                                        <td>@php echo $TAT @endphp</td>
                                        <td>@php echo  isset($append[$i]['incentive_base_revenue_'.$i][0]->Sume)?$append[$i]['incentive_base_revenue_'.$i][0]->Sume:0 @endphp</td>
                                        <td>@php echo  isset($append[$i]['PDM_LessShare_'.$i][0]->Sume)?$append[$i]['PDM_LessShare_'.$i][0]->Sume:0 @endphp</td>
                                        
                                        <td>@php $incentive_base_revenue = isset($append[$i]['incentive_base_revenue_'.$i][0]->Sume)?$append[$i]['incentive_base_revenue_'.$i][0]->Sume:0;
                                                 $PDM_Less_share=isset($append[$i]['PDM_LessShare_'.$i][0]->Sume)?$append[$i]['PDM_LessShare_'.$i][0]->Sume:0 
                                                ;echo  $incentive_base_revenue+$PDM_Less_share   @endphp</td>
                                        <td>@php
                                     if($append[$i][$lastColumnsec_row__check][0]->f_srp > 1)
                                         {
                                         echo $incentive_base_revenue/$append[$i][$lastColumnsec_row__check][0]->f_srp;
                                        }
                                         {
                                           echo  0;  
                                         }
                                        @endphp
                                            %
                                        </td>
                                        <td>@php
                                            echo isset($append[$i][$index_total_ogoing__check]) ? $append[$i][$index_total_ogoing__check] : '';
                                        @endphp</td>
                                        <td>@php echo isset($append[$i][$lastColumnsec_row__check][0]->f_srp)?$append[$i][$lastColumnsec_row__check][0]->f_srp:0;@endphp</td>
                                    </tr>

                                @endfor

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card cardBorderColor mb-8">
                    <div id="chart" style="position: relative;">
                        <div options="[object Object]" series="24,0" class="allGraph" type="pie" width="305"
                            height="auto">
                            {!! $del->container() !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>

        @for ($i = 0; $i < count($data); $i++)
       
            @php $index_weekly_data__check="weekly_data_".$i @endphp
            @php $index_Mounthly_data__check="Mounthly_data_".$i @endphp
            @php $index_Quarterly_data__check="Quarterly_data_".$i @endphp
            @php $index_count_final_stage_0__check="count_final_stage_".$i @endphp
            @php $index_count_mid_stage_0__check="count_mid_stage_".$i @endphp
            @php $index_user_pie__check="count_user_pie_".$i @endphp
            @php $index_count_onboarded__check="count_onboarded_".$i @endphp
            @php $index_count_offere__check="count_offere_".$i @endphp
            @php $index_count_mid_failed_check="failed_mid_stage_".$i @endphp
            @php $index_count_final_failed_check="failed_final_stage_".$i @endphp
            @php $index_count_onborded_stage="onborded_stage_".$i @endphp
            @php $index_count_offer_stage="offer_stage_".$i @endphp
      

            

            <div class="row m-0 pt-4">
                <div class="col-lg-5">
                    <div class="card ETHcardBorderColor mb-7">
                        <div class="text-center pt-3 pb-3"> @php echo  isset($data[$i]->name)?$data[$i]->name:""@endphp Progress</div>

                        <div class="table-responsive tableFixHead1">
                            <table id="tablePreview" class="table header-fixed table-striped">
                                <thead>
                                    <tr>
                                        <th>Team</th>
                                        <th>CIP Target At</th>
                                        <th>Actual CIP</th>
                                        <th>% Achieved </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Quarterly</td>
                                        <td>400000</td>
                                        <td> @php echo  isset($append[$i][$index_Quarterly_data__check][0]->f_srp)?$append[$i][$index_Quarterly_data__check][0]->f_srp:0;@endphp</td>
                                        <td>@php echo  isset($append[$i][$index_Quarterly_data__check][0]->f_srp)?($append[$i][$index_Quarterly_data__check][0]->f_srp/400000)*100:0;@endphp</td>
                                    </tr>
                                    <tr>
                                        <td>Monthly</td>
                                        <td>1200000</td>
                                        <td> @php echo  isset($append[$i][$index_Mounthly_data__check][0]->f_srp)?$append[$i][$index_Mounthly_data__check][0]->f_srp:0;@endphp</td>
                                        <td>@php echo  isset($append[$i][$index_Mounthly_data__check][0]->f_srp)?($append[$i][$index_Mounthly_data__check][0]->f_srp/1200000)*100:0;@endphp</td>
                                    </tr>
                                    <tr>
                                        <td>Weekly (WK-7)</td>
                                        <td>342857</td>
                                        <td>@php echo  isset($append[$i][$index_weekly_data__check][0]->f_srp)?$append[$i][$index_weekly_data__check][0]->f_srp:0;@endphp</td>
                                        <td>@php echo  isset($append[$i][$index_weekly_data__check][0]->f_srp)?($append[$i][$index_weekly_data__check][0]->f_srp/342857)*100:0;@endphp</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card ETHcardBorderColor mb-7 h-100">
                        <div class="table-responsive tableFixHead1" style="height:237px">
                            <table id="tablePreview" class="table header-fixed table-striped">
                                <thead>
                                    <tr>
                                        <th>CIP Classifications</th>
                                        <th>Total Ongoing</th>
                                        <th>Total Failed</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Mid</td>
                                        <td>@php echo isset($append[$i][$index_count_mid_stage_0__check])?count($append[$i][$index_count_mid_stage_0__check]):""; @endphp</td>
                                        <td>@php echo !empty($append[$i][$index_count_mid_failed_check][0]->f_m_stage)?intval($append[$i][$index_count_mid_failed_check][0]->f_m_stage):0; @endphp</td>
                                    </tr>
                                    <tr>
                                        <td>Final</td>
                                        <td>@php echo isset($append[$i][$index_count_final_stage_0__check])?count($append[$i][$index_count_final_stage_0__check]):""; @endphp</td>
                                        <td>@php echo isset($append[$i][$index_count_final_failed_check][0]->f_m_stage)?intval($append[$i][$index_count_final_failed_check][0]->f_m_stage):0; @endphp</td>
                                    </tr>
                                    <tr>
                                        <td>Offer Stage</td>
                                        <td>@php echo isset($append[$i][$index_count_offere__check])?count($append[$i][$index_count_offere__check]):""; @endphp</td>
                                        <td>@php echo !empty($append[$i][$index_count_offer_stage][0]->f_m_stage)?intval($append[$i][$index_count_offer_stage][0]->f_m_stage):0; @endphp </td>
                                    </tr>
                                    <tr>
                                        <td>Onboarded</td>
                                        <td>@php echo isset($append[$i][$index_count_onboarded__check])?count($append[$i][$index_count_onboarded__check]):""; @endphp</td>
                                        <td>@php echo !empty($append[$i][$index_count_onborded_stage][0]->f_m_stage)?intval($append[$i][$index_count_onborded_stage][0]->f_m_stage):0; @endphp</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3" style="height: 277px !important;">
                    <div class="card ETHcardBorderColor  mb-7 h-100">
                        {!! $append[$i][$index_user_pie__check]->container() !!}
                        {!! $append[$i][$index_user_pie__check]->script() !!}
                    </div>
                </div>
            </div>
        @endfor

        <!-- SECTION ONE -->
    </section>


    <!-- <div class="container">
                                                                                                            <div class="row justify-content-center">
                                                                                                                <div class="col-md-8">
                                                                                                                    <div class="card">
                                                                                                                        <div class="card-header">Dashboard</div>

                                                                                                                        <div class="card-body">
                                                                                                                            @if (session('status'))
                                                                                                                                <div class="alert alert-success" role="alert">
                                                                                                                                    {{ session('status') }}
                                                                                                                                </div>
                                                                                                                            @endif

                                                                                                                            You are logged in!
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div> -->
    <!-- Charting library -->
    <script src="https://unpkg.com/chart.js@^2.9.3/dist/Chart.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>
    {!! $chart->script() !!}
    {!! $count_user_pie->script() !!}
    {!! $del->script() !!}
    <script>
        function filterdate() {
            // call ajax with data to controller 
            $.ajax({
                type: 'POST',
                url: '{{ url('filter-dashboard-by-date') }}',
                data: {
                    _token: token,
                    date: $("#filterdate").val()
                },
                // Ajax success function
                success: function(res) {
                    $("#Quartile").html(res.data.Quartile);
                    $("#year").html(res.data.Year);
                    data = {!! count($data) !!}
                    let html = [];
                    for (var i = 0; i < data; i++) {
                        var fillarray = "total_ogoing_" + i;
                      
                        var sume = 0;
                        var ongoing = 0;
                        if (res.data.revenue[i] == undefined) {
                            sum = 0;
                        } else {
                            sum = res.data.revenue[i].Sume;
                        }
                        // (res.data.append[i][fillarray] == undefined)?ongoing = "0":ongoing = res.data.append[i][fillarray];
                        
                        
                        html += "<tr>" +
                            "<td>" + res.data.roles[i].name + "</td>" +
                            "<td>2,000,000</td>" +
                            "<td>" + sum + "</td>" +
                            "<td>0</td>" +
                            "<td>0</td>" +
                            "<td>" + (res.data.total_ogoing_Last_column[i].f_srp) + "%</td>" +
                            "<td>" + ongoing + "</td>" +
                            "<td>" + res.data.total_ogoing_Last_column[i].f_srp + "</td>" +
                            "</tr>";
                        $("#render_body").html(html)
                      

                    }


                }

            });
        }
    </script>
@endsection
