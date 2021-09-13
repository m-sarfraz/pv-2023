<div class="">
    <table id=" record" class="table">
    <thead class="bg-light w-100">
        <tr style="border-bottom: 3px solid white;border-top: 3px solid white; white-space:nowrap">
            <th class="ant-table-cell">Sr#</th>
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
    <tbody>
        @forelse ( $Userdata as $key=>$value )

            <tr class="bg-transparent">
                <!-- Table data 1 -->
                <td>{{ $key + 1 }}</td>
                <td>Recruiter</td>
                <td>
                    <a href="">
                        @if (isset($value->first_name))
                            {{ $value->first_name }} {{ $value->last_name }}

                        @endif
                    </a>
                </td>
                <td>Profile</td>
                <td>S segment</td>
                <td>
                    @if (isset($value->curr_salary))
                        {{ $value->curr_salary }}

                    @endif
                </td>
                <td>
                    @if (isset($value->exp_salary))
                        {{ $value->exp_salary }}

                    @endif
                </td>
                <td>App.Status</td>
                <td>Client</td>
                <td>CL</td>
                <td>
                    @if (isset($value->endi_date))
                        {{ $value->endi_date }}

                    @endif
                </td>
                <td></td>
            </tr>

        @empty

        @endforelse

    </tbody>
    </table>
</div>