
<div class="" >
    <table id=" example1" class="table">
   <thead class="bg-light w-100">
       <tr style="border-bottom: 3px solid white;border-top: 3px solid white; white-space:nowrap">
           <th class="ant-table-cell">Recruiter</th>
           <th class="ant-table-cell">Candidate</th>
           <th class="ant-table-cell">Client </th>
           <th class="ant-table-cell">Gender</th>
           <th class="ant-table-cell">DOMAIN</th>
           <th class="ant-table-cell">Profile</th>
         
           <th class="ant-table-cell">Education Attainment</th>
           <th class="ant-table-cell">Salary</th>
           <th class="ant-table-cell">Portal</th>
           <th class="ant-table-cell">Date Sifted</th>
           <th class="ant-table-cell">CL</th>
           <th class="ant-table-cell">Endo</th>
           <th class="ant-table-cell">Status</th>
           <th class="ant-table-cell">Remarks</th>
           <th class="ant-table-cell">Category</th>
           <th class="ant-table-cell">SPR</th>
           <th class="ant-table-cell">Date Onboarded</th>
           <th class="ant-table-cell">Placement fee</th>
           <th class="ant-table-cell">location</th>
           <th class="ant-table-cell ant-table-cell-scrollbar"></th>
       </tr>
   </thead>
   <tbody>

       @forelse ( $Userdata as $key=>$value )
           <tr class="bg-transparent" >
               <!-- Table data 1 -->
               @php
                   $user = \App\User::where('id', $value->saved_by)->first();
                   $role = $user->roles->pluck('name');
               @endphp
               <td> <?php
               if(isset($role[0])){
                   echo $role[0];
               }
               
               ?></td>
               {{-- @php
                   $name = \App\User::with('candidate_information')
                       ->where('id', $value->saved_by)
                       ->first();
               @endphp
               <td>
                   {{ $name->name }}
                </td> --}}
               <td>
                   @if (isset($value->last_name))
                       {{ $value->last_name }}

                   @endif
               </td>
               <td> {{ $value->client }}</td>
               <td> {{ $value->gender}}</td>
               <td> {{ $value->domain }}</td>
               <td>{{ $value->candidate_profile }}</td>
              
               <td>{{ $value->educational_attain }}</td>
               <td>{{ $value->curr_salary }}</td>
               <td></td>
               <td>{{ $value->date_shifted }}</td>
               <td>{{ $value->career_endo }}</td>
               <td>
                   @if (isset($value->endi_date))
                       {{ $value->endi_date }}

                   @endif
               </td>
               <td>{{ $value->app_status }}</td>
               <td>{{ $value->remarks }}</td>
               <td>{{ $value->remarks_for_finance }}</td>
               <td>{{ $value->srp }}</td>
               <td>{{ $value->onboardnig_date }}</td>
               <td>
                   @if (isset($value->placement_fee))
                       {{ $value->placement_fee }}

                   @endif
               </td>
               <td>{{ $value->address }}</td>
             
            
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
    $('#foundRecord').val({!! $onBoarded !!});
</script>