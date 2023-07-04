<div class="tableFixHead">
    <table id="smTable1" class="table">
        <thead class="bg-light w-100" style="">
                <tr style="text-align: center;">
                    <th class="d-none"> sr</th>
                    <th class="ant-table-cell" >
                        {{-- <svg title="Click Here For Columnwise Search" data-toggle="tooltip"
                            data-placement="top" style="color:#dc8627;text-color:red;top:0;bottom:0"
                            xmlns="http://www.w3.org/2000/svg" onclick="toggleSearchFunc()"
                            width="22" height="22" fill="currentColor"
                            class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                            <path
                                d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                        </svg> --}}
                        Sr
                    </th>

                    <th class="ant-table-cell"  >Team  </th>
                    <th class="ant-table-cell"  >Recruiter  </th>
                    <th class="ant-table-cell"  >Date Sifted  </th>
                    <th class="ant-table-cell"  >Candidate’s Profile  </th>
                    <th class="ant-table-cell"  >Date Invited  </th>
                    <th class="ant-table-cell"  >Candidate  </th>
                    <th class="ant-table-cell"  >Gender  </th>
                    <th class="ant-table-cell"  >Phone  </th>
                    <th class="ant-table-cell"  >Email  </th>
                    <th class="ant-table-cell"  >Address  </th>
                    <th class="ant-table-cell"  >Course  </th>
                    <th class="ant-table-cell"  >Educational Attainment  </th>
                    <th class="ant-table-cell"  >Certificate  </th>
                    <th class="ant-table-cell"  >Employment History  </th>
                    <th class="ant-table-cell"  >Interview Note  </th>
                    <th class="ant-table-cell"  >Exp Salary  </th>
                    <th class="ant-table-cell"  >Application Status  </th>
                    <th class="ant-table-cell"  >Type  </th>
                    <th class="ant-table-cell"  >Endorsement Date  </th>
                    <th class="ant-table-cell"  >Client  </th>
                    <th class="ant-table-cell"  >Site  </th>
                    <th class="ant-table-cell"  >Position Title  </th>
                    <th class="ant-table-cell"  >Career  </th>
                    <th class="ant-table-cell"  >Segment  </th>
                    <th class="ant-table-cell"  >Sub-Segment  </th>
                    <th class="ant-table-cell"  >Endorsement Status  </th>
                    <th class="ant-table-cell"  >Remarks For Finance  </th>
                    <th class="ant-table-cell"  >Onboarding Date  </th>
 
                </tr>
            </thead>
        <tbody class="hidetrID hidetrIDSmartSearch" style="height:100px">
        </tbody>
        <tfoot>
            <tr style="text-align: center;">
                <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Sr</th>
                <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Team</th>
                <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Recruiter</th>
                <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Candidate</th>
                <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Date Sifted</th>
                <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Candidate’s Profile</th>
                <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Date Invited</th>
                <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Gender</th>
                <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Phone</th>
                <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Email</th>
                <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Address </th>
                <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Course</th>
                <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Educational Attainment
                </th>
                <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Certificate</th>
                <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Employment History</th>
                <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Interview Note</th>
                <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Exp Salary</th>
                <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Application Status</th>
                <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Type</th>
                <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Endorsement Date</th>
                <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Client</th>
                <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Site</th>
                <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Position Title </th>
                <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Career</th>
                <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Segment </th>
                <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Sub-Segment</th>
                <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Endorsement Status</th>
                <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Remarks For Finance
                </th>
                <th class="ant-table-cell" onclick="enableFocusOnInput(this)">Onboarding Date </th>

                <th class="ant-table-cell ant-table-cell-scrollbar"></th>
            </tr>
        </tfoot>
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
