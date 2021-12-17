<div class="">
    <table id="filteredTable" class="table">
        <thead class="bg-light w-100">
            <tr style="border-bottom: 3px solid white;border-top: 3px solid white; white-space:nowrap">
                <th class="ant-table-cell hideID">id</th>
                <th class="ant-table-cell">Sr</th>
                <th class="ant-table-cell">Recruiter</th>
                <th class="ant-table-cell">Candidate</th>
                <th class="ant-table-cell">Profile</th>
                <th class="ant-table-cell">S segment</th>
                <th class="ant-table-cell">CSalary</th>
                <th class="ant-table-cell">E.Salary</th>
                <th class="ant-table-cell">App.Status</th>
                <th class="ant-table-cell">Client</th>
                <th class="ant-table-cell">CL</th>
                <th class="ant-table-cell">Endorsement Date</th>
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
        $('#filteredTable_filter').hide('div');

    })
    $('#filteredTable').on('click', 'tbody tr', function() {
        $('tr').removeClass('hover-primary1');
        $(this).addClass('hover-primary1');
        let tdVal = $(this).children()[0];
        console.log(tdVal)
        var id = tdVal.innerHTML
        UserDetail(this, id)
        // alert($(this).val())
    })

    $('#searchKeyword').on("input", function() {
        $('#recordTable_filter').children().children().val($('#searchKeyword').val());
        $('#filteredTable_filter').children().children().val($('#searchKeyword').val());
        $('#recordTable_filter').children().children().focus();
        $('#filteredTable_filter').children().children().focus();
        $('#searchKeyword').focus();
        $('#recordTable_filter').children().children().trigger('input');
        $('#filteredTable_filter').children().children().trigger('input');
        $('#recordTable_filter').hide('div');
        $('#filteredTable_filter').hide('div');
    });
 

    // function for (if domain is changed append segments acoordingly) starts
</script>
