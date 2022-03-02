Name: <?php echo   isset($user->last_name)?$user->last_name:'N/A';?>;
Candidate Profile: <?php echo isset( $user->candidate_profile )?  $user->candidate_profile:'N/A';?>;
Position Apllied: <?php echo isset( $user->position_applied )?$user->position_applied:'N/A';?>;
Manner of invite: <?php echo isset( $user->manner_of_invite )?$user->manner_of_invite:'N/A';?>;
Source: <?php echo isset($user->source)?$user->source :'N/A';?>;
Employe History: 
<?php 
 if(isset($user->emp_history))
 {
    echo implode(' ', array_slice(explode(' ', $user->emp_history), 0, 20))."\n";
 }else{
    echo "N/A";
 }
?>;
App status: <?php echo isset( $user->app_status )?$user->app_status:'N/A';?>;
