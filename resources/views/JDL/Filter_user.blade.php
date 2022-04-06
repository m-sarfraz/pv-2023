<div class="">
    <table id="filteredJdlTable" class="table">
        <thead class="bg-light w-100">
            <tr style="border-bottom: 3px solid white;border-top: 3px solid white; white-space:nowrap">
                <th class="ant-table-cell hideID">id</th>
                <th class="ant-table-cell">Sr</th>
                <th class="ant-table-cell">Client</th>
                <th class="ant-table-cell">Segment</th>
                <th class="ant-table-cell">S-Segment</th>
                <th class="ant-table-cell">Career Level</th>
                <th class="ant-table-cell">Position Title</th>
                <th class="tooltip1">MOR <span class="tooltiptext">Maturity Of
                        Requirement</span></th>
                <th class="ant-table-cell">Budget</th>
                <th class="ant-table-cell">Location</th>
                <th class="ant-table-cell">Work Sched</th>
                <th class="ant-table-cell"> Status</th>
                <th class="ant-table-cell">Priority</th>
                <th class="ant-table-cell ant-table-cell-scrollbar"></th>
            </tr>
        </thead>
        <tbody class="hidetrID" style="height:100px">
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        load_datatable1()
        $('#filteredJdlTable_filter').hide('div');

    })
    // $('#searchKeyword').on("input", function() {
    //     alert('yes')
    //         $('#jdlTable_filter').children().children().val($('#searchKeyword').val());
    //         $('#filteredJdlTable').children().children().val($('#searchKeyword').val());
    //         $('#jdlTable_filter').children().children().focus();
    //         $('#filteredJdlTable').children().children().focus();
    //         $('#searchKeyword').focus();
    //         $('#jdlTable_filter').children().children().trigger('input');
    //         $('#filteredJdlTable').children().children().trigger('input');
    //         // $('#jdlTable_filter').hide('div');
    //         // $('#filteredJdlTable').hide('div');
    //     });
    $('#filteredJdlTable').on('click', 'tbody tr', function() {
        $('tr').removeClass('hover-primary1');
        $(this).addClass('hover-primary1');
        let tdVal = $(this).children()[0];
        var id = tdVal.innerHTML
        Filter(this, id)
        $('#exampleModal').modal('show');
    })
</script>
