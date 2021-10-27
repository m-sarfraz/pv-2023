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
    var numberofFallout = "{{ $fallout }}";
    var numberofBilled = "{{ $billed }}";
    var numberofhires = "{{ $hires }}";
    var numberofUnBilled = "{{ $unbilled }}";

    @php
    $c_take =[];
    $vcc_amount = [];
    for ($i = 0; $i < count($Userdata); $i++) {
        $data = intval($Userdata[$i]->c_take);
        array_push($c_take, $data);
    }
    for ($i = 0; $i < count($Userdata); $i++) {
        $data1 = intval($Userdata[$i]->vcc_amount);
        array_push($vcc_amount, $data1);
    }
    
    @endphp
    

    $('#billed').val(numberofBilled);
    $('#unbilled').val(numberofUnBilled);
    $('#fallout').val(numberofFallout);
    $('#hires').val(numberofhires);
    $('#record').val(numberofhires);
    $('#c_take').val({!! array_sum($c_take) !!});
    $('#vcc_share').val({!! array_sum($vcc_amount) !!});
    $('#Revenue_In_Incentive').val({!! array_sum($c_take) + array_sum($vcc_amount) !!});
</script>
