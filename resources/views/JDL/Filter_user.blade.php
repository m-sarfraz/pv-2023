<div class="tableFixHead">
    <table id="filteredJdlTable" class="table">
        <thead class="bg-light w-100">
            <tr style="whitespace-nowrap; text-align:center;">
                <th class="ant-table-cell hideID noVis">id</th>
                <th class="ant-table-cell">Sr</th>
                <th class="ant-table-cell"> Priority</th>
                <th class="ant-table-cell">Keyword</th>
                <th class="ant-table-cell">Status</th>
                <th class="ant-table-cell">Client</th>
                <th class="ant-table-cell">Domain</th>
                <th class="ant-table-cell">Segment</th>
                <th class="ant-table-cell">Sub-Segment</th>
                <th class="ant-table-cell">Position Title</th>
                <th class="ant-table-cell ">Career Level</th>
                <th class="ant-table-cell">Job Description</th>
                <th class="ant-table-cell">Educational Attainment</th>
                <th class="ant-table-cell">Location</th>
                <th class="ant-table-cell">Work Schedule</th>
                <th class="ant-table-cell customWidth">Budget</th>
                <th class="ant-table-cell">Recruitment Process/POC</th>
                <th class="ant-table-cell">Notes</th>
                <th class="ant-table-cell">Start Date</th>
                <th class="ant-table-cell">SLL. No</th>
                <th class="ant-table-cell">Total FTE</th>
                <th class="ant-table-cell">Updated FTE</th>
                <th class="ant-table-cell">Ref. Code</th>
                <th class="ant-table-cell">Requirement Date</th>
                <th class="tooltip1">MOR <span class="tooltiptext">Maturity Of
                        Requirement</span></th>
                <th class="ant-table-cell">Update Date</th>
                <th class="ant-table-cell">Closed Date</th>
                <th class="ant-table-cell">Old Shared Date</th>
                <th class="ant-table-cell">Recruiter</th>

                {{-- <th class="ant-table-cell ant-table-cell-scrollbar"></th> --}}
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
    $('#filteredJdlTable').on('click', 'tbody tr', function() {
        $('tr').removeClass('hover-primary1');
        $(this).addClass('hover-primary1');
        let tdVal = $(this).children()[0];
        var id = tdVal.innerHTML
        Filter(this, id)
        $('#exampleModal').modal('show');
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
