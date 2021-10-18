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
                <th class="ant-table-cell">Status</th>
                <th class="ant-table-cell ant-table-cell-scrollbar"></th>
            </tr>
        </thead>
        <tbody>

            @foreach ($Userdata as $renderIndex)

                <tr onclick="Filter('{{ $renderIndex->cid }}')">
                    <!-- Table data 1 -->
                    <td>{{ $renderIndex->endo_client }}</td>
                    <td>{{ $renderIndex->candidate_segment }}</td>
                    <td>{{ $renderIndex->candidate_sub_segment }}</td>
                    <td>{{ $renderIndex->endo_career_endo }}</td>
                    <td>{{ $renderIndex->endo_position_title }}</td>
                    <td>no data</td>
                    <td>{{ $renderIndex->candidate_address }}</td>
                    <td>no data</td>
                    <td>no data</td>
                    <td>{{ $renderIndex->endo_status }}</td>
                </tr>
            @endforeach

        </tbody>
        </table>
    </div>
    
</div>
<script>
    $('#No_of_count').val({!! json_encode($count) !!});
</script>
