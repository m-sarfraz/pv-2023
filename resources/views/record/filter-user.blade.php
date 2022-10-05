<div class="tableFixHead">
    <table id="filteredTable" class="table">
        <thead class="bg-light w-100">
            <tr style="">
                <th class="ant-table-cell hideID noVis">id</th>
                <th class="ant-table-cell">Sr</th>
                <th class="ant-table-cell">Recruiter</th>
                <th class="ant-table-cell">Team</th>
                <th class="ant-table-cell">Candidate</th>
                <th class="ant-table-cell">Email</th>
                <th class="ant-table-cell">OR Number</th>
                <th class="ant-table-cell">Replacement For</th>
                <th class="ant-table-cell">Application Status</th>
                <th class="ant-table-cell">Candidate’s Profile</th>
                <th class="ant-table-cell">Career</th>
                <th class="ant-table-cell">Certificate</th>
                <th class="ant-table-cell">Client</th>
                <th class="ant-table-cell">Phone</th>
                <th class="ant-table-cell">Course</th>
                <th class="ant-table-cell">Endorsement Date</th>
                <th class="ant-table-cell">Date Invited</th>
                <th class="ant-table-cell">Date Sifted</th>
                <th class="ant-table-cell">Educational Attainment</th>
                <th class="ant-table-cell">Employment History</th>
                <th class="ant-table-cell">Type</th>
                <th class="ant-table-cell">Exp Salary</th>
                <th class="ant-table-cell">Gender</th>
                <th class="ant-table-cell">Interview Note</th>
                <th class="ant-table-cell">Invoice Number</th>
                <th class="ant-table-cell">Onboarding Date </th>
                <th class="ant-table-cell">Position Title </th>
                <th class="ant-table-cell">Remarks </th>
                <th class="ant-table-cell">Remarks For Finance </th>
                <th class="ant-table-cell">Address </th>
                <th class="ant-table-cell">Segment </th>
                <th class="ant-table-cell">Site</th>
                <th class="ant-table-cell">Endorsement Status</th>
                <th class="ant-table-cell">Sub-Segment</th>
                <th class="ant-table-cell ant-table-cell-scrollbar"></th>
            </tr>
        </thead>
        <tbody class="hidetrID" style="height:100px">
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        load_datatable1();
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

    $('#searchKeyword').on("change", function() {
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
    // function for (if domain is changed append segments acoordingly) starts
</script>
