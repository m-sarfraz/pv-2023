<?php

namespace App\Http\Controllers\Admin;

use App\CandidateDomain;
use App\CandidateEducation;
use App\CandidateInformation;
use App\CandidatePosition;
use App\Cipprogress;
use App\Domain;
use App\Endorsement;
use App\Finance;
use App\Http\Controllers\Controller;
use App\Segment;
use App\SubSegment;
use App\User;
use Auth;
use File;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Response;
use Str;

class CandidateController extends Controller
{

    //index function for data entry page showing starts
    public function data_entry()
    {

        $candidateDetail = null;
        if (isset($_GET['id'])) {
            $candidateDetail = CandidateInformation::join('candidate_educations', 'candidate_informations.id', 'candidate_educations.candidate_id')
                ->join('candidate_positions', 'candidate_informations.id', 'candidate_positions.candidate_id')
                ->join('candidate_domains', 'candidate_informations.id', 'candidate_domains.candidate_id')
                ->join('endorsements', 'candidate_informations.id', 'endorsements.candidate_id')
                ->join('finance', 'candidate_informations.id', 'finance.candidate_id')
                ->select('candidate_educations.*', 'candidate_informations.*', 'candidate_informations.id as cid', 'candidate_positions.*', 'candidate_domains.*', 'finance.*', 'endorsements.*')
                ->where('candidate_informations.id', $_GET['id'])
                ->first();
        } # code...
        $role = Auth::user()->roles->first();
        $role_id = $role->id;
        $user = CandidateInformation::where('saved_by', Auth::user()->id)->get();
        $domainDrop = Domain::all();
        $segmentsDropDown = DB::table('segments')->get();
        $sub_segmentsDropDown = DB::table('sub_segments')->get();
        // return $sub_segmentsDropDown;
        $data = [
            'user' => $user,
            'role_id' => $role_id,
            'domainDrop' => $domainDrop,
            'segmentsDropDown' => $segmentsDropDown,
            'candidateDetail' => $candidateDetail,
            'sub_segmentsDropDown' => $sub_segmentsDropDown,
        ];

        return view('data_entry.add', $data);
    }
    //index function for data entry page showing ends

    public function save_data_entry(Request $request)
    {

        $recruiter = Auth::user()->roles->first();
        // return $recruiter->id;
        if ($recruiter->id == 1) {
            // return 'hi';

            $arrayCheck = [
                "DOMAIN" => 'required ',
                'LAST_NAME' => 'required',
                "FIRST_NAME" => "required",
                "EMAIL_ADDRESS" => "required|email",
                "CONTACT_NUMBER" => "required",
                "GENDER" => "required",
                "CERTIFICATIONS" => "required",
                "RESIDENCE" => 'required ',
                "APPLICATION_STATUS" => 'required ',
                // "EDUCATIONAL_ATTAINTMENT" => 'required ',
                // // "COURSE" => 'required ',
                "MANNER_OF_INVITE" => 'required ',
                "CANDIDATES_PROFILE" => 'required ',
                "INTERVIEW_NOTES" => 'required ',
                // "DATE_SIFTED" => 'required ',
                "SEGMENT" => 'required ',
                "SUB_SEGMENT" => 'required ',
                "EMPLOYMENT_HISTORY" => 'required ',
                // "POSITION_TITLE_APPLIED" => 'required ',
                // // "DATE_INVITED" => 'required ',
                // "MANNER_OF_INVITE" => 'required ',
                "CURRENT_SALARY" => 'required ',
                // "file" => 'required ',
                // "CURRENT_ALLOWANCE" => 'required ',
                "EXPECTED_SALARY" => 'required ',
                // "OFFERED_SALARY" => 'required ',
                // "OFFERED_ALLOWANCE" => 'required ',
            ];
            $status = Str::lower($request->APPLICATION_STATUS);
            if (str_contains($status, 'active') || str_contains($status, 'to be')) {
                $arrayCheck["EDUCATIONAL_ATTAINTMENT"] = "required";
            }
        } else {
            $arrayCheck = [
                'LAST_NAME' => 'required',
                "FIRST_NAME" => "required",
                "EMAIL_ADDRESS" => "required|email",
                // "CONTACT_NUMBER" => "required",
                "GENDER" => "required",
                "RESIDENCE" => 'required ',
                "EDUCATIONAL_ATTAINTMENT" => 'required ',
                "DOMAIN" => 'required ',
                "SEGMENT" => 'required ',
                "SUB_SEGMENT" => 'required ',
                // // "COURSE" => 'required ',
                "CANDIDATES_PROFILE" => 'required ',
                "APPLICATION_STATUS" => 'required ',
                "INTERVIEW_NOTES" => 'required ',
                // "DATE_SIFTED" => 'required ',
                "EMPLOYMENT_HISTORY" => 'required ',
                "POSITION_TITLE_APPLIED" => 'required ',
                // // "DATE_INVITED" => 'required ',
                "MANNER_OF_INVITE" => 'required ',
                "CURRENT_SALARY" => 'required ',
                // "file" => 'required ',
                // "CURRENT_ALLOWANCE" => 'required ',
                "EXPECTED_SALARY" => 'required ',
                // "OFFERED_SALARY" => 'required ',
                // "OFFERED_ALLOWANCE" => 'required ',
            ];
        }
        $validator = Validator::make($request->all(), $arrayCheck);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()]);
        } else {
            //get users data for matching duplicates

            $lname = explode(" ", $request->LAST_NAME);
            $fname = explode(" ", $request->FIRST_NAME);
            $phone = explode(" ", $request->CONTACT_NUMBER);
            $record = CandidateInformation::select('last_name', 'first_name', 'phone')->get();
            for ($i = 0; $i < count($record); $i++) {
                if (in_array($record[$i]['last_name'], $lname) && in_array($record[$i]['first_name'], $fname) && in_array($record[$i]['phone'], $phone)) {
                    return response()->json(['success' => 'duplicate', 'message' => 'Duplicate Data detected']);
                }
            }
            //  save data to candidate information table
            $CandidateInformation = new CandidateInformation();
            $CandidateInformation->last_name = $request->LAST_NAME;
            $CandidateInformation->middle_name = $request->MIDDLE_NAME;
            $CandidateInformation->first_name = $request->FIRST_NAME;
            $CandidateInformation->email = $request->EMAIL_ADDRESS;
            $CandidateInformation->phone = $request->CONTACT_NUMBER;
            $CandidateInformation->gender = $request->GENDER;
            $CandidateInformation->address = $request->RESIDENCE;
            $CandidateInformation->dob = $request->DATE_OF_BIRTH;
            $CandidateInformation->status = '1';

            $CandidateInformation->saved_by = Auth::user()->id;
            $CandidateInformation->save();

            //  save data to candidate education table
            $CandidateEducation = new CandidateEducation();
            $CandidateEducation->educational_attain = $request->EDUCATIONAL_ATTAINTMENT;
            $CandidateEducation->candidate_id = $CandidateInformation->id;

            // save course if according to selcteedd educational attainment
            if ($request->COURSE === null) {
                $CandidateEducation->course = 'N/A';
            } else {
                $CandidateEducation->course = $request->COURSE;
            }
            $CandidateEducation->certification = $request->CERTIFICATIONS;
            $CandidateEducation->save();

            //  save data to candidate position table
            $CandidiatePosition = new CandidatePosition();
            $CandidiatePosition->candidate_id = $CandidateInformation->id;
            $CandidiatePosition->candidate_profile = $request->CANDIDATES_PROFILE;
            $CandidiatePosition->position_applied = $request->POSITION_TITLE_APPLIED;
            $CandidiatePosition->date_invited = $request->DATE_INVITED;
            $CandidiatePosition->manner_of_invite = $request->MANNER_OF_INVITE;
            $CandidiatePosition->curr_salary = $request->CURRENT_SALARY;
            $CandidiatePosition->exp_salary = $request->EXPECTED_SALARY;
            $CandidiatePosition->off_salary = $request->OFFERED_SALARY;
            $CandidiatePosition->curr_allowance = $request->CURRENT_ALLOWANCE;
            $CandidiatePosition->off_allowance = $request->OFFERED_ALLOWANCE;

            // Upload CV of user
            if ($request->hasFile('file')) {
                $fileName = $request->CONTACT_NUMBER . time() . '.' . $request->file->extension();
                $path = 'assets/cv';
                $request->file->move($path, $fileName);
                $CandidiatePosition->cv = $fileName;
            }
            $CandidiatePosition->save();

            //  save data to candidate domain table
            $CandidiateDomain = new CandidateDomain();
            $CandidiateDomain->candidate_id = $CandidateInformation->id;
            $CandidiateDomain->date_shifted = $request->DATE_SIFTED;
            $domain_name = Domain::where('id', $request->DOMAIN)->first();
            $CandidiateDomain->domain = $domain_name->domain_name;
            $CandidiateDomain->emp_history = $request->EMPLOYMENT_HISTORY;
            $CandidiateDomain->interview_note = $request->INTERVIEW_NOTES;
            $name = Segment::where('id', $request->SEGMENT)->first();
            $CandidiateDomain->segment = $name->segment_name;
            $Sub_name = SubSegment::where('id', $request->SUB_SEGMENT)->first();
            $CandidiateDomain->sub_segment = $Sub_name->sub_segment_name;
            $CandidiateDomain->save();

            //Save Endorsement Details
            $endorsement = new Endorsement();
            $endorsement->candidate_id = $CandidateInformation->id;
            $endorsement->app_status = $request->APPLICATION_STATUS;
            $endorsement->remarks = $request->REMARKS_FROM_FINANCE;
            $endorsement->client = $request->CLIENT;
            $endorsement->status = $request->STATUS;
            $endorsement->type = $request->ENDORSEMENT_TYPE;
            $endorsement->site = $request->SITE;
            $endorsement->domain_endo = $request->DOMAIN;
            $endorsement->position_title = $request->POSITION_TITLE;
            // $endorsement->interview_date = $request->;
            $endorsement->rfp = $request->REASONS_FOR_NOT_PROGRESSING;
            $endorsement->career_endo = $request->CAREER_LEVEL;
            $endorsement->segment_endo = $request->SEGMENT;
            $endorsement->sub_segment_endo = $request->SUB_SEGMENT;
            $endorsement->endi_date = $request->DATE_ENDORSED;
            $endorsement->remarks_for_finance = $request->REMARKS_FOR_FINANCE;
            $endorsement->save();
            //start logic for cip

            $array = [
                'Final Stage' => [
                    0 => 'Scheduled for Country Head Interview',
                    1 => 'Scheduled for Final Interview',
                    2 => "Scheduled for Hiring Manager's Interview",
                    3 => 'Done Behavioral Interview / Awaiting Feedback',
                    4 => 'Done Final Interview / Awaiting Feedback',
                    5 => "Done Hiring Manager's Interview / Awaiting Feedback",
                    6 => 'Failed Country Head Interview',
                    7 => 'Failed Final Interview',
                    8 => "Failed Hiring Manager's Interview",
                    9 => "Scheduled for Job Offer",
                    10 => "Shortlisted/For Comparison",
                    11 => "Onboarded",
                    12 => "Offer accepted",
                    13 => "Offer Rejected",
                    14 => "Position Closed (Final Stage)",
                    15 => "Done Country Head Interview / Awaiting Feedback",
                    16 => "Pending Offer Approval",
                    17 => "Pending Offer Schedule",
                    18 => "Position On Hold (Final Stage)",
                    19 => "Shortlisted",
                    20 => "Fallout/Reneged",
                ],
                "Mid Stage" => [
                    0 => 'Scheduled for Skills Interview',
                    1 => 'Scheduled for Technical Interview',
                    2 => "Scheduled for Technical exam",
                    3 => 'Sheduled for Behavioral Interview',
                    4 => 'Scheduled for account validation',
                    5 => "Done Skills interview/ Awaiting Feedback",
                    6 => 'Done Techincal Interview /Awaiting Feedback',
                    7 => 'Done Technical exam /Awaiting Feedback',
                    8 => "Done Behavioral /Awaiting Feedback",
                    9 => "Failed Skills interview",
                    10 => "Failed Techincal Interview",
                    11 => "Failed Technical exam",
                    12 => "Failed Behavioral Interview",
                    13 => "Pending Country Head Interview",
                    14 => "Pending Final Interview",
                    15 => "Pending Hiring Manager's Interview",
                    16 => "Position Closed (Mid Stage)",
                    17 => "Done Skills/Technical Interview / Awaiting Feedback",
                    18 => "Failed Skills/Technical Interview",
                    19 => "Position On Hold (Mid Stage)",
                    20 => "Scheduled for Behavioral Interview",
                    21 => "Scheduled for Skills/Technical Interview",
                ],
            ];

            $user = User::find($recruiter);

            $Cipprogress = new Cipprogress();
            // find in array
            if (in_array($request->REMARKS_FOR_FINANCE, $array['Final Stage'])) {

                $Cipprogress->final_stage = 1;
                $Cipprogress->cip = 1;
            }
            if (in_array($request->REMARKS_FOR_FINANCE, $array['Mid Stage'])) {
                $Cipprogress->mid_stage = 1;
                $Cipprogress->cip = 1;
            }
            //check
            $word_1 = "Offer";
            $word_2 = "Onboarded";
            $mystring = $request->REMARKS_FOR_FINANCE;
            if (strpos($mystring, $word_1) !== false) {
                $Cipprogress->offered = 1;
            }
            if (strpos($mystring, $word_2) !== false) {
                $Cipprogress->onboarded = 1;
            }
            $Cipprogress->candidate_id = $CandidateInformation->id;
            $Cipprogress->team = $recruiter->name;
            $Cipprogress->t_id = $recruiter->id;
            $Cipprogress->save();
            //close cip
            // save data to finance tables
            $finance = new Finance();
            $finance->candidate_id = $CandidateInformation->id;
            $finance->endorsement_id = $endorsement->id;
            $finance->remarks_recruiter = $request->REMARKS;
            $finance->onboardnig_date = $request->ONBOARDING_DATE;
            $finance->invoice_number = $request->INVOICE_NUMBER;
            $finance->client_finance = $request->CLIENT_FINANCE;
            $finance->career_finance = $request->CAREER_LEVEL;
            $finance->rate = $request->RATE;
            $finance->Total_bilable_ammount = $request->TOTAL_BILLABLE_AMOUNT;
            // $finance->offered_salary = $request->
            $finance->placement_fee = $request->PLACEMENT_FEE;
            $finance->allowance = $request->ALLOWANCE;
            $finance->save();

            // return response success if data is entered
            //get last record  save data
            $last_data_save = CandidateInformation::where("id", $CandidateInformation->id)->first();
         
            // save record for logs starts
            Helper::save_log('CANDIDATE_CREATED');
            //save record for logs ends

            return response()->json(['success' => true, 'message' => 'Data added successfully', "last_data_save" => $last_data_save]);
        }
    }

    // search user data and append the new view after ajax call function
    public function SearchUserData(Request $request, $id)
    {
        $domainDrop = Domain::all();
        $segmentsDropDown = DB::table('segments')->get();
        $sub_segmentsDropDown = DB::table('sub_segments')->get();
        $user = CandidateInformation::join('candidate_educations', 'candidate_informations.id', 'candidate_educations.candidate_id')
            ->join('candidate_positions', 'candidate_informations.id', 'candidate_positions.candidate_id')
            ->join('candidate_domains', 'candidate_informations.id', 'candidate_domains.candidate_id')
            ->join('endorsements', 'candidate_informations.id', 'endorsements.candidate_id')
            ->join('finance', 'candidate_informations.id', 'finance.candidate_id')
            ->select('candidate_educations.*', 'candidate_informations.*', 'candidate_informations.id as cid', 'candidate_positions.*', 'candidate_domains.*', 'finance.*', 'endorsements.*')
            ->where('candidate_informations.id', $request->id)
            ->first();
        $data = [
            'domainDrop' => $domainDrop,
            'user' => $user,
            'segmentsDropDown' => $segmentsDropDown,
            'sub_segmentsDropDown' => $sub_segmentsDropDown,
        ];
        return view('data_entry.userSearch', $data);
    }
    public function update_data_entry(Request $request, $id)
    {

        $recruiter = Auth::user()->roles->first();
        // return $recruiter->id;
        if ($recruiter->id == 1) {
            // return 'hi';

            $arrayCheck = [
                "DOMAIN" => 'required ',
                'LAST_NAME' => 'required',
                "FIRST_NAME" => "required",
                "EMAIL_ADDRESS" => "required|email",
                "CONTACT_NUMBER" => "required",
                "GENDER" => "required",
                "CERTIFICATIONS" => "required",
                "RESIDENCE" => 'required ',
                // "EDUCATIONAL_ATTAINTMENT" => 'required ',
                // // "COURSE" => 'required ',
                "CANDIDATES_PROFILE" => 'required ',
                "INTERVIEW_NOTES" => 'required ',
                // "DATE_SIFTED" => 'required ',
                "SEGMENT" => 'required ',
                "SUB_SEGMENT" => 'required ',
                "EMPLOYMENT_HISTORY" => 'required ',
                // "POSITION_TITLE_APPLIED" => 'required ',
                // // "DATE_INVITED" => 'required ',
                // "MANNER_OF_INVITE" => 'required ',
                "CURRENT_SALARY" => 'required ',
                // "file" => 'required ',
                // "CURRENT_ALLOWANCE" => 'required ',
                "EXPECTED_SALARY" => 'required ',
                // "OFFERED_SALARY" => 'required ',
                // "OFFERED_ALLOWANCE" => 'required ',
            ];
            $status = Str::lower($request->APPLICATION_STATUS);
            if (str_contains($status, 'active') || str_contains($status, 'to be')) {
                $arrayCheck["EDUCATIONAL_ATTAINTMENT"] = "required";
            }
        } else {
            $arrayCheck = [
                'LAST_NAME' => 'required',
                "FIRST_NAME" => "required",
                "EMAIL_ADDRESS" => "required|email",
                // "CONTACT_NUMBER" => "required",
                "GENDER" => "required",
                "RESIDENCE" => 'required',
                "EDUCATIONAL_ATTAINTMENT" => 'required',
                "DOMAIN" => 'required',
                "SEGMENT" => 'required',
                "SUB_SEGMENT" => 'required',
                // // "COURSE" => 'required',
                "CANDIDATES_PROFILE" => 'required',
                "INTERVIEW_NOTES" => 'required',
                // "DATE_SIFTED" => 'required',
                "EMPLOYMENT_HISTORY" => 'required',
                "POSITION_TITLE_APPLIED" => 'required',
                // // "DATE_INVITED" => 'required',
                "MANNER_OF_INVITE" => 'required',
                "CURRENT_SALARY" => 'required',
                // "file" => 'required',
                // "CURRENT_ALLOWANCE" => 'required',
                "EXPECTED_SALARY" => 'required',
                // "OFFERED_SALARY" => 'required',
                // "OFFERED_ALLOWANCE" => 'required',
            ];
        }
        $validator = Validator::make($request->all(), $arrayCheck);

        // send response mesage if validations are not according to requierd
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()]);
        } else {
            // Update data of eantry page
            CandidateInformation::where('id', $id)->update([
                'first_name' => $request->FIRST_NAME,
                'middle_name' => $request->MIDDLE_NAME,
                'last_name' => $request->LAST_NAME,
                'email' => $request->EMAIL_ADDRESS,
                'phone' => $request->CONTACT_NUMBER,
                'address' => $request->RESIDENCE,
                'gender' => $request->GENDER,
                'dob' => $request->DATE_OF_BIRTH,
                // 'status' => $request->STATUS,

            ]);

            // update candidate education data
            CandidateEducation::where('candidate_id', $id)->update([
                'educational_attain' => $request->EDUCATIONAL_ATTAINTMENT,
                'course' => $request->COURSE,
                'certification' => $request->CERTIFICATIONS,
            ]);

            // update candidae domain data
            $domain_name = Domain::where('id', $request->DOMAIN)->first();
            $name = Segment::where('id', $request->SEGMENT)->first();
            $Sub_name = SubSegment::where('id', $request->SUB_SEGMENT)->first();

            CandidateDomain::where('candidate_id', $id)->update([
                'date_shifted' => $request->DATE_SIFTED,
                'domain' => $domain_name->name,
                'emp_history' => $request->EMPLOYMENT_HISTORY,
                'interview_note' => $request->INTERVIEW_NOTES,
                'segment' => $name->segment_name,
                'sub_segment' => $Sub_name->sub_segment_name,
            ]);

            // Upload CV of user
            if ($request->hasFile('file')) {
                $fileName = $request->CONTACT_NUMBER . time() . '.' . $request->file->extension();
                $path = 'assets/cv';
                $request->file->move($path, $fileName);
                CandidatePosition::where('candidate_id', $id)->update([
                    'cv' => $fileName,
                ]);
            }

            // update candidate position data according to requested data
            CandidatePosition::where('candidate_id', $id)->update([
                'candidate_profile' => $request->CANDIDATES_PROFILE,
                'position_applied' => $request->POSITION_TITLE_APPLIED,
                'date_invited' => $request->DATE_INVITED,
                'manner_of_invite' => $request->MANNER_OF_INVITE,
                'curr_salary' => $request->CURRENT_SALARY,
                'exp_salary' => $request->EXPECTED_SALARY,
                'off_salary' => $request->OFFERED_SALARY,
                'curr_allowance' => $request->CURRENT_ALLOWANCE,
                'off_allowance' => $request->OFFERED_ALLOWANCE,
            ]);

            //update endorsements table according to data updated
            Endorsement::where('candidate_id', $id)->update([
                'app_status' => $request->APPLICATION_STATUS,
                'remarks' => $request->REMARKS_FROM_FINANCE,
                'client' => $request->CLIENT,
                'status' => $request->STATUS,
                'type' => $request->ENDORSEMENT_TYPE,
                'site' => $request->SITE,
                'position_title' => $request->POSITION_TITLE,
                'domain_endo' => $request->DOMAIN,
                'interview_date' => $request->cv,
                'career_endo' => $request->CAREER_LEVEL,
                'rfp' => $request->REASONS_FOR_NOT_PROGRESSING,
                'segment_endo' => $request->SEGMENT,
                'sub_segment_endo' => $request->SUB_SEGMENT,
                'endi_date' => $request->DATE_ENDORSED,
                'remarks_for_finance' => $request->REMARKS_FOR_FINANCE,
            ]);

            //update data of finance table acooridngly starts
            Finance::where('candidate_id', $id)->update([
                'remarks_recruiter' => $request->REMARKS,
                'onboardnig_date' => $request->ONBOARDING_DATE,
                'invoice_number' => $request->INVOICE_NUMBER,
                'client_finance' => $request->CLIENT_FINANCE,
                'career_finance' => $request->CAREER_LEVEL,
                'rate' => $request->EXPECTED_SALARY,
                'Total_bilable_ammount' => $request->TOTAL_BILLABLE_AMOUNT,
                'srp' => $request->STANDARD_PROJECTED_REVENUE,
                'offered_salary' => $request->OFFERED_SALARY,
                'placement_fee' => $request->PLACEMENT_FEE,
                'allowance' => $request->ALLOWANCE,
            ]);
            //update data of finance table acooridngly starts

            //save candidate addeed log to table starts
            Helper::save_log('CANDIDATE_UPDATED');
            // save candidate added to log table ends

            //return success response after successfull data entry
            return response()->json(['success' => true, 'message' => 'Updated successfully']);
        }
    }

    //doanload candidate cv function starts
    public function downloadCv(Request $request)
    {
        $user = CandidatePosition::where('candidate_id', $request->id)->first();
        if (isset($user->cv)) {
            if (File::exists('assets/cv/' . $user->cv)) {
                $file = 'assets/cv/' . $user->cv;
                $headers = array(
                    'Content-Type: application/pdf',
                );
                return Response::download($file, $user->FIRST_NAME . 'Resume', $headers);
                return response()->json(['success' => true, 'message' => 'Attachment downloaded']);
            } else {
                return response()->json(['success' => false, 'message' => 'Attachment not Exists']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'No Attachment found']);
        }
    }
    // download canidate cv functon ends
}
