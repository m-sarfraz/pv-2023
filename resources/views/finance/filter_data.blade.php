<div class="tableFixHead">
    <table id="fmtable1" class="table ">
        <thead class="bg-light w-100">
            <tr style="">
                <th class="ant-table-cell hideIDTh noVis">secret-id</th>
                <th class="ant-table-cell hideIDTh">id</th>
                <th class="ant-table-cell">Team</th>
                <th class="ant-table-cell">Original Recruiter</th>
                <th class="ant-table-cell">Reprocessed</th>
                <th class="ant-table-cell">Client</th>
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
</script>
