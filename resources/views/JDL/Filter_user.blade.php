<div class="table-responsive border-right pt-3" id="filter_table_div">
    <div class="">
        <table id="filteredJdlTable" class="table">
            <thead class="bg-light w-100">
                <tr style="border-bottom: 3px solid white;border-top: 3px solid white; white-space:nowrap">
                    <th class="ant-table-cell hideID">id</th>
                    <th class="ant-table-cell">Sr</th>
                    <th class="ant-table-cell">Client</th>
                    <th class="ant-table-cell">Segment</th>
                    <th class="ant-table-cell">S segment</th>
                    <th class="ant-table-cell">Career Level</th>
                    <th class="ant-table-cell">Position Title</th>
                    <th class="tooltip1">MOR <span class="tooltiptext">Maturity Of
                            Requirement</span></th>
                    <th class="ant-table-cell">Budget</th>
                    <th class="ant-table-cell">Location</th>
                    <th class="ant-table-cell">Work Sched</th>
                    <th class="ant-table-cell">Priorty</th>
                    <th class="ant-table-cell">Status</th>
                    <th class="ant-table-cell ant-table-cell-scrollbar"></th>
                </tr>
            </thead>
            <tbody class="hidetrID" style="height:100px">
            </tbody>
        </table>
    </div>

</div>
<script>
    $('#No_of_count').val({!! json_encode($count) !!});
    $(document).ready(function() {
        load_datatable1()
    })
    $('#filteredJdlTable').on('click', 'tbody tr', function() {
           // $(this).css('background-color','red')
           $('tr').removeClass('hover-primary1');
            $(this).addClass('hover-primary1');
            let tdVal = $(this).children()[0];
            var id = tdVal.innerHTML
            Filter(this, id)
            // alert($(this).val())
        })
</script>
