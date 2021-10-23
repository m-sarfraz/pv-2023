<div class="table-responsive border-right pt-3" id="filter_table_div">
    <div class="">
        <table id=" example1" class="table">
            <thead class="bg-light w-100">
                <tr style="border-bottom: 3px solid white;border-top: 3px solid white; white-space:nowrap">
                    <th class="ant-table-cell">Client</th>
                    <th class="ant-table-cell">Segment</th>
                    <th class="ant-table-cell">Sub Segment</th>
                    <th class="ant-table-cell">Career Level</th>
                    <th class="ant-table-cell">Position Title</th>
                    <th class="ant-table-cell">Budget</th>
                    <th class="ant-table-cell">Location</th>
                    <th class="ant-table-cell">Work Sched</th>
                    <th class="ant-table-cell">Priorty</th>
                    <th class="ant-table-cell">Maturity Of Requirement</th>
                    <th class="ant-table-cell">Status</th>
                    <th class="ant-table-cell ant-table-cell-scrollbar"></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($Userdata as $renderIndex)

                    <tr onclick="Filter('{{ $renderIndex->id }}')">
                        <!-- Table data 1 -->
                        <td>{{ $renderIndex->client }}</td>
                        <td>{{ $renderIndex->segment }}</td>
                        <td>{{ $renderIndex->subsegment }}</td>
                        <td>{{ $renderIndex->c_level }}</td>
                        <td>{{ $renderIndex->p_title }}</td>
                        <td>{{ $renderIndex->budget }}</td>
                        <td>{{ $renderIndex->location }}</td>
                        <td>{{ $renderIndex->w_schedule }}</td>
                        <td>{{ $renderIndex->priority }}</td>
                        <td> @php
                            $date = Carbon\Carbon::parse($renderIndex->req_date);
                            // echo  $date;
                            
                            $now = Carbon\Carbon::now();
                            echo $diff = $date->diffInDays($now);
                        @endphp
                        </td>
                        <td>{{ $renderIndex->status }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

</div>
<script>
    $('#No_of_count').val({!! json_encode($count) !!});
</script>
