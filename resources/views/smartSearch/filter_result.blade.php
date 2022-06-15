<div class="">
    <table id="smTable1" class="table">
        <thead class="bg-light w-100">
            <tr style="">
                <th class="ant-table-cell noVis">secret-id</th>
                <th class="ant-table-cell">Recruiter</th>
                <th class="ant-table-cell">Candidate</th>
                <th class="ant-table-cell">Client</th>
                <th class="ant-table-cell">Gender</th>
                <th class="ant-table-cell">Domain</th>

                <th class="ant-table-cell">Candidate's Profile</th>
                <th class="ant-table-cell">Educational Attainment</th>
                <th class="ant-table-cell">Salary</th>
                <th class="ant-table-cell">Portal</th>
                <th class="ant-table-cell">Date Sifted</th>
                <th class="ant-table-cell">CL</th>
                <th class="ant-table-cell">Status</th>
                <th class="ant-table-cell">Endo Date</th>

                <th class="ant-table-cell">Remarks</th>
                <th class="ant-table-cell">Category</th>
                <th class="ant-table-cell">SPR</th>
                <th class="ant-table-cell">Date Onboarded</th>
                <th class="ant-table-cell">Placement fee</th>
                <th class="ant-table-cell">Location</th>
                <th class="ant-table-cell ant-table-cell-scrollbar"></th>
            </tr>
        </thead>
        <tbody class="hidetrID" style="height:100px">




        </tbody>
    </table>
</div>

<script>
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
    $('#foundRecord').val({!! $onBoarded !!});
</script>
