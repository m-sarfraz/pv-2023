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
                @if ($value->saved_by == Auth::user()->id)
                    <tr class="bg-transparent common-tr hover-primary" onclick="UserDetail(this,'{{ $value->CID }}')">
                        <!-- Table data 1 -->
                        <td>{{ $key + 1 }}</td>
                        {{-- @php
                    $name = \App\User::with('candidate_information')
                        ->where('id', $value->saved_by)
                        ->first();
                @endphp --}}
                        <td>
                            @if (isset($value->recruiter))
                                {{ $value->recruiter }}
                            @endif
                        </td>
                        <td>
                            @if (isset($value->first_name))
                                {{ $value->first_name }} {{ $value->last_name }}

                            @endif
                        </td>
                        <td>{{ $value->candidate_profile }}
                        </td>
                        <td>{{ $value->sub_segment }}</td>
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
                        <td>{{ $value->app_status }}</td>
                        <td>{{ $value->client }}</td>
                        <td>{{ $value->career_endo }}</td>
                        <td>
                            @if (isset($value->endi_date))
                                {{ $value->endi_date }}

                            @endif
                        </td>
                        <td></td>
                    </tr>
                @else
                    <tr class="bg-transparent common-tr hover-primary" style="background-color: #e9ecef;"
                        onclick="UserDetail(this,'{{ $value->CID }}')">
                        <!-- Table data 1 -->
                        <td>{{ $key + 1 }}</td>
                        {{-- @php
                        $name = \App\User::with('candidate_information')
                            ->where('id', $value->saved_by)
                            ->first();
                    @endphp --}}
                        <td>
                            @if (isset($value->recruiter))
                                {{ $value->recruiter }}
                            @endif
                        </td>
                        <td>
                            @if (isset($value->first_name))
                                {{ $value->first_name }}

                            @endif
                        </td>
                        <td>{{ $value->candidate_profile }}
                        </td>
                        <td>{{ $value->sub_segment }}</td>
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
                        <td>{{ $value->app_status }}</td>
                        <td>{{ $value->client }}</td>
                        <td>{{ $value->career_endo }}</td>
                        <td>
                            @if (isset($value->endi_date))
                                {{ $value->endi_date }}

                            @endif
                        </td>
                        <td></td>
                    </tr>
                @endif

            @empty
                <tr>

                    <td> no data found</td>
                </tr>
            @endforelse

        </tbody>
    </table>
    <input type="hidden" name="abc" id="abc" value="{{ $count }}">
</div>
