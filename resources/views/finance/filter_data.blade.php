
<div class="">
    <table id=" example1" class="table">
    <thead class="bg-light w-100">
        <tr style="border-bottom: 3px solid white;border-top: 3px solid white; white-space:nowrap">
            <th class="ant-table-cell">Team</th>
            <th class="ant-table-cell">Recruiter</th>
            <th class="ant-table-cell">Reprocess</th>
            <th class="ant-table-cell">Candidate</th>
            <th class="ant-table-cell">Role</th>
            <th class="ant-table-cell">CL</th>
            <th class="ant-table-cell">Client</th>
            <th class="ant-table-cell">OB Date</th>
            <th class="ant-table-cell">Placement Fee</th>
            <th class="ant-table-cell">Remarks</th>
            <th class="ant-table-cell">P.Status</th>
            <th class="ant-table-cell ant-table-cell-scrollbar"></th>
        </tr>
    </thead>
    <tbody>
        @forelse ( $Userdata as $key=>$value )
            <tr class="bg-transparent" onclick="teamDetail('{{ $value->C_id }}')">
                <!-- Table data 1 -->
                @php
                    $user = \App\User::where('id', $value->saved_by)->first();
                    $role = $user->roles->pluck('name');
                @endphp
                <td> {{ $role[0] }}</td>
                @php
                    $name = \App\User::with('candidate_information')
                        ->where('id', $value->saved_by)
                        ->first();
                @endphp
                <td>{{ $name->name }}</td>
                <td></td>
                <td>
                    @if (isset($value->first_name))
                        {{ $value->first_name }} {{ $value->last_name }}

                    @endif
                </td>
                <td> {{ $role[0] }}</td>
                <td>{{ $value->career_endo }}</td>
                <td>{{ $value->client }}</td>
                <td>
                    @if (isset($value->endi_date))
                        {{ $value->endi_date }}

                    @endif
                </td>
                <td>
                    @if (isset($value->placement_fee))
                        {{ $value->placement_fee }}

                    @endif
                </td>
                <td>
                    @if (isset($value->remarks))
                        {{ $value->remarks }}

                    @endif
                </td>
                <td>
                    @if (isset($value->app_status))
                        {{ $value->app_status }}

                    @endif
                </td>
            </tr>

        @empty
            <tr>

                <td> no data found</td>
            </tr>
        @endforelse
    </tbody>
    </table>
</div>
<script>
    var numberofFallout= "{{ $fallout }}";
    var numberofBilled = "{{ $billed }}";
    var numberofhires = "{{ $hires }}";
    var numberofUnBilled = "{{ $unbilled }}";
    var c_t_sum = "{{ $Userdata[0]->c_t_s }}";
    var vcc_amount_sum = "{{$Userdata[0]->v_c_c_amount }}";
    var revenue= parseInt(c_t_sum) + parseInt(vcc_amount_sum);
    $('#billed').val(numberofBilled);
    $('#unbilled').val(numberofUnBilled);
    $('#fallout').val(numberofFallout);
    $('#hires').val(numberofhires);
    $('#record').val(numberofhires);
    $('#c_take').val(c_t_sum);
    $('#vcc_share').val(vcc_amount_sum);
    $('#Revenue_In_Incentive').val(revenue);
</script>