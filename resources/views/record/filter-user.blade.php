<div class="">
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
                <th class="ant-table-cell">certificate</th>
                <th class="ant-table-cell">client</th>
                <th class="ant-table-cell">phone</th>
                <th class="ant-table-cell">course</th>
                <th class="ant-table-cell">Endorsement Date</th>
                <th class="ant-table-cell">date invited</th>
                <th class="ant-table-cell">date sifted</th>
                <th class="ant-table-cell">educational attainment</th>
                <th class="ant-table-cell">emp history</th>
                <th class="ant-table-cell">type</th>
                <th class="ant-table-cell">exp salary</th>
                <th class="ant-table-cell">Gender</th>
                <th class="ant-table-cell">interview note</th>
                <th class="ant-table-cell">invoice number</th>
                <th class="ant-table-cell">onboarding date </th>
                <th class="ant-table-cell">position title </th>
                <th class="ant-table-cell">remarks </th>
                <th class="ant-table-cell">remarks_for_finance </th>
                <th class="ant-table-cell">address </th>
                <th class="ant-table-cell">segment </th>
                <th class="ant-table-cell">site</th>
                <th class="ant-table-cell">endostatus</th>
                <th class="ant-table-cell">sub_segment</th>
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
