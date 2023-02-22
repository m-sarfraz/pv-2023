<div class="card d-block py-3 justify-content-center align-items-center" style="text-align:center;">
    <div class="table-responsive">
        <table id="example1" class="table table-striped table-bordered text-center" style="width:100%">
            <thead>
                <tr>
                    <th>Sr#</th>
                    <th>User Name</th>
                    <th>File Type</th>
                    <th>Export Date</th>
                    <th>Status</th>
                    <th>Download Link</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $reports = \App\Report::where('user_id', Auth::user()->id)
                    ->orderBy('id', 'desc')
                    ->limit(10)->get();
                ?>
                @foreach ($reports as $key=>$report)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ \Auth::user()->name }}</td>
                        <td>{{$report->type}}</td>
                        <td>{{ $report->export_date }}</td>
                        @if ($report->status == 'Processing')
                            <td class="">
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="load-wrapp">
                                        <div class="load-6 d-flex justify-content-center">
                                            <div class="letter-holder">
                                                <h2 class="l-1 letter">P</h2>
                                                <h2 class="l-2 letter">r</h2>
                                                <h2 class="l-3 letter">o</h2>
                                                <h2 class="l-4 letter">c</h2>
                                                <h2 class="l-5 letter">e</h2>
                                                <h2 class="l-6 letter">s</h2>
                                                <h2 class="l-7 letter">s</h2>
                                                <h2 class="l-7 letter">i</h2>
                                                <h2 class="l-7 letter">n</h2>
                                                <h2 class="l-7 letter">g</h2>
                                                <h2 class="l-8 letter">.</h2>
                                                <h2 class="l-9 letter">.</h2>
                                                <h2 class="l-10 letter">.</h2>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </td>
                        @else
                            <td>
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="load-wrapp">
                                        <div class="load-6 d-flex justify-content-center">
                                            <div class="letter-holder">
                                                <span  type="span" class="border-0 bg-transparent text-success">
                                                  Available
                                                </button
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </td>
                        @endif
                        @if ($report->status == 'Processing')
                            <td>Download Link not Avaialbe </td>
                        @else
                            <td class="justify-content-center">
                                <a class="text-center" style="text-decoration:underline; color:blue"  target="blank"
                                    href="{{ url('/uploads/' . $report->download_link) }}">
                                   Click here to Download Report
                                </a>
                            </td>
                        @endif
                    </tr>
                @endforeach
        </table>
    </div>
    <!-- <img src="{{ asset('assets/image/global/icon.png') }}" width="77" alt="" srcset=""> <span style="    color: #6b6e6f !important;" class="h1 pl-3">76 Records Found</span> </div> -->
</div>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
        });
    });
</script>
