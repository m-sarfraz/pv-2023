<div class="">
    <table id="fmtable1" class="table ">
        <thead class="bg-light w-100">
            <tr style="border-bottom: 3px solid white;border-top: 3px solid white; white-space:nowrap">
                <th class="ant-table-cell hideIDTh">secret-id</th>
                <th class="ant-table-cell hideIDTh">id</th>
                <th class="ant-table-cell">Team</th>
                <th class="ant-table-cell">Recruiter</th>
                <th class="ant-table-cell">Client</th>
                <th class="ant-table-cell">Reprocess</th>
                <th class="ant-table-cell">Candidate</th>
                <th class="ant-table-cell">CL</th>
                <th class="ant-table-cell">OB Date</th>
                <th class="ant-table-cell">Placement Fee</th>
                <th class="ant-table-cell">Remarks</th>
                <th class="ant-table-cell">P.Status</th>
                <th class="ant-table-cell ant-table-cell-scrollbar"></th>
            </tr>
        </thead>
        <tbody class="hidetrID" style="height:100px"> </tbody>
    </table>
</div>
<script>
    // show detail of record on click a row in data table 
    $('#fmtable1').on('click', 'tbody tr', function() {
        // $(this).css('background-color','red')
        $('tr').removeClass('hover-primary1');
        $(this).addClass('hover-primary1');
        let tdVal = $(this).children()[1];
        var id = tdVal.innerHTML
        // console.log('id is ' + id)
        userDetail(this, id)
    })
    // close 
    $(document).ready(function() {
        load_datatable1();
    })
</script>
