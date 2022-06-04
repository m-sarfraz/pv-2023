<?php

namespace App\Http\Controllers\Admin;

use App\CandidateDomain;
use App\CandidateEducation;
use App\CandidateInformation;
use App\CandidatePosition;
use App\Cipprogress;
use App\Domain;
use App\DropDownOption;
use App\Endorsement;
use App\Finance;
use App\Finance_detail;
use App\Http\Controllers\Controller;
use App\Segment;
use App\User;
use Auth;
use Cache;
use File;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Response;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Str;

class CandidateController extends Controller
{

    //index function for data entry page showing starts
    public function data_entry()
    {
        $profile = Helper::get_dropdown('candidates_profile');
        $candidateDetail = null;
        $number_of_endorsements = 0;
        if (isset($_GET['id'])) {
            $candidateDetail = CandidateInformation::join('candidate_educations', 'candidate_informations.id', 'candidate_educations.candidate_id')
                ->join('candidate_positions', 'candidate_informations.id', 'candidate_positions.candidate_id')
                ->join('candidate_domains', 'candidate_informations.id', 'candidate_domains.candidate_id')
                ->join('endorsements', 'candidate_informations.id', 'endorsements.candidate_id')
                ->join('finance', 'candidate_informations.id', 'finance.candidate_id')
                ->select('candidate_educations.*', 'candidate_informations.*', 'candidate_informations.id as cid', 'candidate_positions.*', 'candidate_domains.*', 'finance.*', 'endorsements.*')
                ->where('candidate_informations.id', $_GET['id'])
                ->first();
            // $countEndo = DB::table('candidate_informations')
            //     ->leftJoin('endorsements', 'candidate_informations.id', 'endorsements.candidate_id')
            //     ->join('finance', 'candidate_informations.id', 'finance.candidate_id')
            //     ->select('endorsements.*', 'finance.*', 'endorsements.id as E_id', 'finance.id as F_id')
            //     ->where(['candidate_informations.id' => $_GET['id'], 'endorsements.saved_by' => Auth::user()->id])
            //     ->groupBy('endorsements.id')->get();
            $number_of_endorsements = Endorsement::where([
                'saved_by' => Auth::user()->id,
                'candidate_id' => $_GET['id'],
                'is_deleted' => 0,
            ])->get();
            // return $number_of_endorsements;
        }
        // $user = DB::table('candidate_informations')->select('id', 'last_name')->where('saved_by', Auth::user()->id)->get();

        $domainDrop = Domain::all();
        $segmentsDropDown = DB::table('segments')->get();
        $sub_segmentsDropDown = DB::table('sub_segments')->get();
        // $pos_title = DB::table('taverse2')->distinct()->select('position')->get();
        // $client = DB::table('taverse2')->distinct()->select('client')->get();
        // return $sub_segmentsDropDown;
        $data = [
            // 'user' => $user,
            'domainDrop' => $domainDrop,
            'segmentsDropDown' => $segmentsDropDown,
            'candidateDetail' => $candidateDetail,
            'number_of_endorsements' => $number_of_endorsements,
            'sub_segmentsDropDown' => $sub_segmentsDropDown,
        ];

        return view('data_entry.add', $data);
    }
    // close

    // save data entruy data
    public function save_data_entry(Request $request)
    {
        if ($request->checkDuplicate == 1) {
            $check = CandidateInformation::where(['phone' => $request->CONTACT_NUMBER, 'last_name' => $request->LAST_NAME])->exists();
            if ($check == true) {
                return response()->json(['success' => false, 'message' => 'A Record with this Phone & Last name already Exists!', 'status' => '1']);
            }
        }
        if (Auth::user()->agent == 1) {
            $arrayCheck = [
                "EMPLOYMENT_HISTORY" => 'required ',
                // "DOMAIN" => 'required ',
                'LAST_NAME' => 'required',
                "FIRST_NAME" => "required",
                "EMAIL_ADDRESS" => "required|email",
                "CONTACT_NUMBER" => "required",
                "GENDER" => "required",
                // "CERTIFICATIONS" => "required",
                "RESIDENCE" => 'required ',
                "APPLICATION_STATUS" => 'required ',
                "SOURCE" => 'required ',
                // "EDUCATIONAL_ATTAINTMENT" => 'required ',
                // // "COURSE" => 'required ',
                "MANNER_OF_INVITE" => 'required ',
                "CANDIDATES_PROFILE" => 'required ',
                // "INTERVIEW_NOTES" => 'required ',
                "DATE_SIFTED" => 'required|date|after:1970-01-01',
                // "SEGMENT" => 'required ',
                // "SUB_SEGMENT" => 'required ',
                "POSITION_TITLE_APPLIED" => 'required ',
                // // "DATE_INVITED" => 'required ',
                // "MANNER_OF_INVITE" => 'required ',
                // "CURRENT_SALARY" => 'required ',
                // "file" => 'required ',
                // "CURRENT_ALLOWANCE" => 'required ',
                // "EXPECTED_SALARY" => 'required ',
                // "OFFERED_SALARY" => 'required ',
                // "OFFERED_ALLOWANCE" => 'required ',
            ];
            $status = Str::lower($request->APPLICATION_STATUS);
            if (str_contains($status, 'active') || str_contains($status, 'to be')) {
                $arrayCheck["EDUCATIONAL_ATTAINTMENT"] = "required";
                $arrayCheck["EXPECTED_SALARY"] = "required";
                $arrayCheck["CURRENT_SALARY"] = "required";
                $arrayCheck["INTERVIEW_NOTES"] = "required";
            }
            $manner_of_invite = Str::lower($request->MANNER_OF_INVITE);
            if (
                str_contains($manner_of_invite, 'sms') || str_contains($manner_of_invite, 'email') || str_contains($manner_of_invite, 'call')
                || str_contains($manner_of_invite, 'viber') || str_contains($manner_of_invite, 'skype') || str_contains($manner_of_invite, 'mess')
                || str_contains($manner_of_invite, 'sms')
            ) {
                $arrayCheck["DATE_INVITED"] = "required|date|after:1970-01-01";
            }
            if ($request->rfp == 1) {
                $arrayCheck["REASONS_FOR_NOT_PROGRESSING"] = "required";
            }
            if ($request->interview_schedule == 1) {
                $arrayCheck["INTERVIEW_SCHEDULE"] = "required";
            }
            if ($request->salary_field == 1) {
                $arrayCheck["OFFERED_SALARY"] = "required";
                $arrayCheck["OFFERED_ALLOWANCE"] = "required";
            }
            if ($request->EDUCATIONAL_ATTAINTMENT == 'HIGH SCHOOL GRADUATE' || $request->EDUCATIONAL_ATTAINTMENT == "") {
            } else {
                $arrayCheck["COURSE"] = "required";
            }

            if ($request->endorsement_field == 'active') {
                $arrayCheck["POSITION_TITLE"] = "required";
                $arrayCheck["ENDORSEMENT_TYPE"] = "required";
                $arrayCheck["POSITION_TITLE"] = "required";
                $arrayCheck["CAREER_LEVEL"] = "required";
                $arrayCheck["DATE_ENDORSED"] = "required|date|after:1970-01-01";
                $arrayCheck["STATUS"] = "required";
                $arrayCheck["CLIENT"] = "required";
                $arrayCheck["SITE"] = "required";
                $arrayCheck["REMARKS_FOR_FINANCE"] = "required";
                // $arrayCheck["REMARKS_FROM_FINANCE"] = "required";
            }
            $array = Str::lower($request->REMARKS_FOR_FINANCE);

            if (str_contains($array, 'onboarder') || str_contains($array, 'accepted')) {
                // $arrayCheck["REMARKS"] = "required";
                // $arrayCheck["ONBOARDING_DATE"] = "required|date|after:1970-01-01";
                $arrayCheck["TOTAL_BILLABLE_AMOUNT"] = "required";
                $arrayCheck["RATE"] = "required";
                // $arrayCheck["PLACEMENT_FEE"] = "required";
            }
        } else {
            $arrayCheck = [
                'LAST_NAME' => 'required',
                "FIRST_NAME" => "required",
                "EMAIL_ADDRESS" => "required|email",
                "SOURCE" => 'required ',
                // "CONTACT_NUMBER" => "required",
                "GENDER" => "required",
                "RESIDENCE" => 'required ',
                "EDUCATIONAL_ATTAINTMENT" => 'required ',
                // "DOMAIN" => 'required ',
                // "SEGMENT" => 'required ',
                // "SUB_SEGMENT" => 'required ',
                // // "COURSE" => 'required ',
                "CANDIDATES_PROFILE" => 'required ',
                "APPLICATION_STATUS" => 'required ',
                // "INTERVIEW_NOTES" => 'required ',
                "DATE_SIFTED" => 'required ',
                "EMPLOYMENT_HISTORY" => 'required ',
                "POSITION_TITLE_APPLIED" => 'required ',
                // // "DATE_INVITED" => 'required ',
                "MANNER_OF_INVITE" => 'required ',
                // "CURRENT_SALARY" => 'required ',
                // "file" => 'required ',
                // "CURRENT_ALLOWANCE" => 'required ',
                // "EXPECTED_SALARY" => 'required ',
                // "OFFERED_SALARY" => 'required ',
                // "OFFERED_ALLOWANCE" => 'required ',
            ];
            if ($request->EDUCATIONAL_ATTAINTMENT == 'HIGH SCHOOL GRADUATE' || $request->EDUCATIONAL_ATTAINTMENT == "" || $request->EDUCATIONAL_ATTAINTMENT == 'SENIOR HIGH SCHOOL GRADUATE') {
            } else {
                $arrayCheck["COURSE"] = "required";
            }

            if ($request->endorsement_field == 'active') {
                $arrayCheck["POSITION_TITLE"] = "required";
                $arrayCheck["ENDORSEMENT_TYPE"] = "required";
                $arrayCheck["POSITION_TITLE"] = "required";
                $arrayCheck["CAREER_LEVEL"] = "required";
                $arrayCheck["DATE_ENDORSED"] = "required";
                $arrayCheck["STATUS"] = "required";
                $arrayCheck["CLIENT"] = "required";
                $arrayCheck["SITE"] = "required";
                $arrayCheck["REMARKS_FOR_FINANCE"] = "required";
                // $arrayCheck["REMARKS_FROM_FINANCE"] = "required";
            }
            if ($request->finance_field == 1) {
                // $arrayCheck["REMARKS"] = "required";
                // $arrayCheck["ONBOARDING_DATE"] = "required";
                $arrayCheck["TOTAL_BILLABLE_AMOUNT"] = "required";
                $arrayCheck["RATE"] = "required";
                // $arrayCheck["PLACEMENT_FEE"] = "required";
            }
            $status = Str::lower($request->APPLICATION_STATUS);
            if (str_contains($status, 'active') || str_contains($status, 'to be')) {
                $arrayCheck["EDUCATIONAL_ATTAINTMENT"] = "required";
                $arrayCheck["EXPECTED_SALARY"] = "required";
                $arrayCheck["CURRENT_SALARY"] = "required";
                $arrayCheck["INTERVIEW_NOTES"] = "required";
            }
            $manner_of_invite = Str::lower($request->MANNER_OF_INVITE);
            if (
                str_contains($manner_of_invite, 'sms') || str_contains($manner_of_invite, 'email') || str_contains($manner_of_invite, 'call')
                || str_contains($manner_of_invite, 'viber') || str_contains($manner_of_invite, 'skype') || str_contains($manner_of_invite, 'mess')
                || str_contains($manner_of_invite, 'sms')
            ) {
                $arrayCheck["DATE_INVITED"] = "required";
            }
        }

        $validator = Validator::make($request->all(), $arrayCheck);
        if ($validator->fails()) {
            //     if (
            //         !isset($request->INTERVIEW_NOTES) ||
            //         !isset($request->CURRENT_SALARY) ||
            //         !isset($request->EXPECTED_SALARY)
            //     ) {
            //         $arrayCheck["EXPECTED_SALARY"] = "required";
            //         $arrayCheck["CURRENT_SALARY"] = "required";
            //         $arrayCheck["INTERVIEW_NOTES"] = "required";
            //         $validator = Validator::make($request->all(), $arrayCheck);
            //         return response()->json(['success' => false, 'message' => $validator->errors(), 'status' => '1']);
            //     } else {

            return response()->json(['success' => false, 'message' => $validator->errors()]);
            // }
        } else {

            if ($request->tap == 0) {
                $candidate_id = 0;
                $CandidateInformation = new CandidateInformation();
                $CandidateEducation = new CandidateEducation();
                $CandidiatePosition = new CandidatePosition();
                $CandidiateDomain = new CandidateDomain();
                $numberOfEndo = 1;
            } else {
                $candidate_id = trim($request->candidate_id, "id=");
                $CandidateInformation = CandidateInformation::find($candidate_id);
                $CandidateEducation = CandidateEducation::where('candidate_id', $candidate_id)->firstOrFail();
                $CandidiatePosition = CandidatePosition::where('candidate_id', $candidate_id)->firstOrFail();
                $CandidiateDomain = CandidateDomain::where('candidate_id', $candidate_id)->firstOrFail();
                $numberOfEndo = 0;
            }
            $id = explode('-', $request->candidate_id);
            if ($request->tap == 0 && $id[0] != 'null') {
                $candidate_id = $id[0];
                $CandidateInformation = CandidateInformation::find($id[0]);
                $CandidateEducation = CandidateEducation::where('candidate_id', $id[0])->firstOrFail();
                $CandidiatePosition = CandidatePosition::where('candidate_id', $id[0])->firstOrFail();
                $CandidiateDomain = CandidateDomain::where('candidate_id', $id[0])->firstOrFail();
                $numberOfEndo = $id[1] + 1;
            }

            // return $candidate_id;
            // if ($candidate_id > 0) {
            //     // if record is being updated from Tap

            // } else {
            //     // if new record insertion is happening

            // }

            // save data to candidate information table
            $CandidateInformation->last_name = $request->LAST_NAME;
            $CandidateInformation->middle_name = $request->MIDDLE_NAME;
            $CandidateInformation->first_name = $request->FIRST_NAME;
            $CandidateInformation->email = $request->EMAIL_ADDRESS;
            $CandidateInformation->phone = $request->CONTACT_NUMBER;
            $CandidateInformation->gender = $request->GENDER;
            $CandidateInformation->address = $request->RESIDENCE;
            $CandidateInformation->dob = $request->DATE_OF_BIRTH;
            $CandidateInformation->status = '1';
            $CandidateInformation->save();

            //  save data to candidate education table
            // $CandidateEducation = CandidateEducation::find($candidate_id);
            $CandidateEducation->educational_attain = $request->EDUCATIONAL_ATTAINTMENT;
            $CandidateEducation->candidate_id = $CandidateInformation->id;

            // save course if according to selcteedd educational attainment
            if ($request->COURSE === null) {
                $CandidateEducation->course = 'N/A';
            } else {
                $CandidateEducation->course = $request->COURSE;
            }
            if (isset($request->CERTIFICATIONS)) {
                $certification = implode(",", $request->CERTIFICATIONS);
                $CandidateEducation->certification = $certification;
            }
            $CandidateEducation->save();

            //  save data to candidate position table
            // $CandidiatePosition = CandidatePosition::find($candidate_id);
            $CandidiatePosition->candidate_id = $CandidateInformation->id;
            $CandidiatePosition->candidate_profile = $request->CANDIDATES_PROFILE;
            $CandidiatePosition->position_applied = $request->POSITION_TITLE_APPLIED;
            $CandidiatePosition->date_invited = $request->DATE_INVITED;
            $CandidiatePosition->manner_of_invite = $request->MANNER_OF_INVITE;
            $CandidiatePosition->source = $request->SOURCE;
            $CandidiatePosition->curr_salary = $request->CURRENT_SALARY;
            $CandidiatePosition->exp_salary = $request->EXPECTED_SALARY;
            $CandidiatePosition->off_salary = $request->OFFERED_SALARY;
            $CandidiatePosition->curr_allowance = $request->CURRENT_ALLOWANCE;
            $CandidiatePosition->off_allowance = $request->OFFERED_ALLOWANCE;

            // Upload CV of user
            if ($request->hasFile('file')) {
                $path = base_path();
                $path = str_replace("laravel", "public_html", $path); // <= This one !
                $destinationPath = $path . '/public/assets/cv'; // upload path
                $fileName = $request->CONTACT_NUMBER . time() . '.pdf';
                // $path = 'assets/cv';
                $request->file->move($destinationPath, $fileName);
                $CandidiatePosition->cv = $fileName;
            }
            $CandidiatePosition->save();
            if (is_numeric(isset($request->Domainsegment))) {
                $name = (DropDownOption::where('id', $request->Domainsegment)->first())->option_name;
            } else {
                $name = $request->Domainsegment;
            }
            if (is_numeric(isset($request->Domainsub))) {
                $Sub_name = (DropDownOption::where('id', $request->Domainsub)->first())->option_name;
            } else {
                $Sub_name = $request->Domainsub;
            }
            if (is_numeric(isset($request->DOMAIN))) {
                $domain = (Domain::where('id', $request->DOMAIN)->first())->domain_name;
            } else {
                $domain = $request->DOMAIN;
            }
            // return $name;
            //  save data to candidate domain table
            // $CandidiateDomain = CandidateDomain::find($candidate_id);
            $CandidiateDomain->candidate_id = $CandidateInformation->id;
            $CandidiateDomain->date_shifted = $request->DATE_SIFTED;
            // $domain_name = Domain::where('domain_name', $request->DOMAIN)->first();
            $CandidiateDomain->domain = $domain;
            $CandidiateDomain->emp_history = $request->EMPLOYMENT_HISTORY;
            $CandidiateDomain->interview_note = $request->INTERVIEW_NOTES;
            // $name = Segment::where('segment_name', $request->SEGMENT)->first();
            $CandidiateDomain->segment = $name;
            // $Sub_name = SubSegment::where('sub_segment_name', $request->SUB_SEGMENT)->first();
            $CandidiateDomain->sub_segment = $Sub_name;
            $CandidiateDomain->save();
            // save category of remarks for finance
            $array = Str::lower($request->REMARKS_FOR_FINANCE);
            $category = Helper::getCategory($array);
            // set number fo endo if candidate is being re endorsed
            if ($candidate_id > 0) {
                $lastEndo = Endorsement::where(['saved_by' => Auth::user()->id, 'candidate_id' => $CandidateInformation->id])->count();
                if ($lastEndo == 0) {
                    $numberOfEndo = 1;
                } else {
                    $numberOfEndo = $lastEndo + 1;
                }
            }
            if (is_numeric(isset($request->endo_SEGMENT))) {
                $e_name = (DropDownOption::where('id', $request->endo_SEGMENT)->first())->option_name;
            } else {
                $e_name = $request->endo_SEGMENT;
            }
            if (is_numeric(isset($request->Endo_SUB_SEGMENT))) {

                $e_sub_name = (DropDownOption::where('id', $request->Endo_SUB_SEGMENT)->first())->option_name;
            } else {
                $e_sub_name = $request->Endo_SUB_SEGMENT;
            }
            if (is_numeric(isset($request->DOMAIN_ENDORSEMENT))) {
                $e_domain = (Domain::where('id', $request->DOMAIN_ENDORSEMENT)->first())->domain_name;

            } else {
                $e_domain = $request->DOMAIN_ENDORSEMENT;

            }
            // return  $e_name;
            // insert data in endorsement table
            $endorsement = new Endorsement();
            $endorsement->candidate_id = $CandidateInformation->id;
            $endorsement->app_status = $request->APPLICATION_STATUS;
            $endorsement->remarks = $request->REMARKS_FROM_FINANCE;
            $endorsement->client = $request->CLIENT;
            $endorsement->status = $request->STATUS;
            $endorsement->type = $request->ENDORSEMENT_TYPE;
            $endorsement->site = $request->SITE;
            $endorsement->domain_endo = $e_domain;
            $endorsement->position_title = $request->POSITION_TITLE;
            $endorsement->timestamp = time();
            $endorsement->numberOfEndo = $numberOfEndo;
            $endorsement->interview_date = $request->INTERVIEW_SCHEDULE;
            $endorsement->rfp = $request->REASONS_FOR_NOT_PROGRESSING;
            $endorsement->career_endo = $request->CAREER_LEVEL;
            $endorsement->segment_endo = $e_name;
            $endorsement->sub_segment_endo = $e_sub_name;
            $endorsement->endi_date = $request->DATE_ENDORSED;
            $endorsement->remarks_for_finance = $request->REMARKS_FOR_FINANCE;
            $endorsement->saved_by = Auth::user()->id;
            $endorsement->category = $category;
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

            // $user = User::find($recruiter);


            // save data to finance tables
            $finance = new Finance();
            $finance->candidate_id = $CandidateInformation->id;
            $finance->endorsement_id = $endorsement->id;
            $finance->remarks_recruiter = $request->REMARKS;
            $finance->onboardnig_date = $request->ONBOARDING_DATE;
            $finance->invoice_number = $request->INVOICE_NUMBER;
            $finance->client_finance = $request->CLIENT_FINANCE;
            $finance->career_finance = $request->CAREER_LEVEL;
            $finance->rate = preg_replace('/%/', '', $request->RATE);
            $finance->srp = $request->STANDARD_PROJECTED_REVENUE;
            $finance->Total_bilable_ammount = $request->TOTAL_BILLABLE_AMOUNT;
            $finance->offered_salary = $request->OFFERED_SALARY_finance;
            $finance->allowance = $request->ALLOWANCE;
            $finance->placement_fee = $request->PLACEMENT_FEE;
            $recruiter = Auth::user()->roles->pluck('id');
            $finance->t_id = $recruiter[0];
            $finance->save();

            // insert data to finance detail
            $finance_detail = new Finance_detail();
            $finance_detail->candidate_id = $CandidateInformation->id;
            $finance_detail->offered_salary = $request->OFFERED_SALARY_finance;
            $finance_detail->placementFee = $request->PLACEMENT_FEE;
            $finance_detail->allowance = $request->ALLOWANCE;
            $finance_detail->rate_per = preg_replace('/%/', '', $request->RATE);
            $finance_detail->finance_id = $finance->id;
            $finance_detail->save();

            // return response success if data is entered
            //get last record  save data
            $last_data_save = CandidateInformation::where("id", $CandidateInformation->id)->first();

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
            $recruiter = Auth::user()->roles->first();
            // return $recruiter;
            $Cipprogress->candidate_id = $CandidateInformation->id;
            $Cipprogress->team = $recruiter->name;
            $Cipprogress->t_id = $recruiter->id;
            $Cipprogress->endorsement_id = $endorsement->id;
            $Cipprogress->finance_id = $finance->id;
            $Cipprogress->save();
            //close cip
            
            // save record for logs starts
            Helper::save_log('CANDIDATE_CREATED');
            //save record for logs ends
            // Cache::forget('users');
            return response()->json(['success' => true, 'message' => 'Record Saved successfully', "last_data_save" => $last_data_save]);
            return 'updated';
            // } else {
            //     return 'no';
            // }
            // return $request->all();

            // if (
            //     !isset($request->INTERVIEW_NOTES) ||
            //     !isset($request->CURRENT_SALARY) ||
            //     !isset($request->EXPECTED_SALARY)
            // ) {
            //     $arrayCheck["EXPECTED_SALARY"] = "required";
            //     $arrayCheck["CURRENT_SALARY"] = "required";
            //     $arrayCheck["INTERVIEW_NOTES"] = "required";
            //     $validator = Validator::make($request->all(), $arrayCheck);
            //     return response()->json(['success' => false, 'message' => $validator->errors(), 'status' => '1']);
            // } else {
            //get users data for matching duplicates

            // $lname = explode(" ", $request->LAST_NAME);
            // $fname = explode(" ", $request->FIRST_NAME);
            // $phone = explode(" ", $request->CONTACT_NUMBER);
            // $record = CandidateInformation::select('last_name', 'first_name', 'phone')->get();
            // for ($i = 0; $i < count($record); $i++) {
            //     if (in_array($record[$i]['last_name'], $lname) && in_array($record[$i]['first_name'], $fname) && in_array($record[$i]['phone'], $phone)) {
            //         return response()->json(['success' => 'duplicate', 'message' => 'Duplicate Data detected']);
            //     }
            // }
            // return $request->all();
            //  save data to candidate information table
            // $CandidateInformation = new CandidateInformation();
            // $CandidateInformation->last_name = $request->FIRST_NAME . ' ' . $request->MIDDLE_NAME . ' ' . $request->LAST_NAME;
            // $CandidateInformation->middle_name = $request->MIDDLE_NAME;
            // $CandidateInformation->first_name = $request->FIRST_NAME;
            // $CandidateInformation->email = $request->EMAIL_ADDRESS;
            // $CandidateInformation->phone = $request->CONTACT_NUMBER;
            // $CandidateInformation->gender = $request->GENDER;
            // $CandidateInformation->address = $request->RESIDENCE;
            // $CandidateInformation->dob = $request->DATE_OF_BIRTH;
            // $CandidateInformation->status = '1';

            // $CandidateInformation->saved_by = Auth::user()->id;
            // $CandidateInformation->save();

            // //  save data to candidate education table
            // $CandidateEducation = new CandidateEducation();
            // $CandidateEducation->educational_attain = $request->EDUCATIONAL_ATTAINTMENT;
            // $CandidateEducation->candidate_id = $CandidateInformation->id;

            // // save course if according to selcteedd educational attainment
            // if ($request->COURSE === null) {
            //     $CandidateEducation->course = 'N/A';
            // } else {
            //     $CandidateEducation->course = $request->COURSE;
            // }
            // if (isset($request->CERTIFICATIONS)) {
            //     $certification = implode(",", $request->CERTIFICATIONS);
            //     $CandidateEducation->certification = $certification;
            // }
            // $CandidateEducation->save();

            // //  save data to candidate position table
            // $CandidiatePosition = new CandidatePosition();
            // $CandidiatePosition->candidate_id = $CandidateInformation->id;
            // $CandidiatePosition->candidate_profile = $request->CANDIDATES_PROFILE;
            // $CandidiatePosition->position_applied = $request->POSITION_TITLE_APPLIED;
            // $CandidiatePosition->date_invited = $request->DATE_INVITED;
            // $CandidiatePosition->manner_of_invite = $request->MANNER_OF_INVITE;
            // $CandidiatePosition->source = $request->SOURCE;
            // $CandidiatePosition->curr_salary = $request->CURRENT_SALARY;
            // $CandidiatePosition->exp_salary = $request->EXPECTED_SALARY;
            // $CandidiatePosition->off_salary = $request->OFFERED_SALARY;
            // $CandidiatePosition->curr_allowance = $request->CURRENT_ALLOWANCE;
            // $CandidiatePosition->off_allowance = $request->OFFERED_ALLOWANCE;

            // // Upload CV of user
            // if ($request->hasFile('file')) {
            //     $path = base_path();
            //     $path = str_replace("laravel", "public_html", $path); // <= This one !
            //     $destinationPath = $path . '/public/assets/cv'; // upload path
            //     $fileName = $request->CONTACT_NUMBER . time() . '.pdf';
            //     // $path = 'assets/cv';
            //     $request->file->move($destinationPath, $fileName);
            //     $CandidiatePosition->cv = $fileName;
            // }
            // $CandidiatePosition->save();

            // //  save data to candidate domain table
            // $CandidiateDomain = new CandidateDomain();
            // $CandidiateDomain->candidate_id = $CandidateInformation->id;
            // $CandidiateDomain->date_shifted = $request->DATE_SIFTED;
            // // $domain_name = Domain::where('domain_name', $request->DOMAIN)->first();
            // $CandidiateDomain->domain = $request->DOMAIN;
            // $CandidiateDomain->emp_history = $request->EMPLOYMENT_HISTORY;
            // $CandidiateDomain->interview_note = $request->INTERVIEW_NOTES;
            // // $name = Segment::where('segment_name', $request->SEGMENT)->first();
            // $CandidiateDomain->segment = $request->SEGMENT;
            // // $Sub_name = SubSegment::where('sub_segment_name', $request->SUB_SEGMENT)->first();
            // $CandidiateDomain->sub_segment = $request->SUB_SEGMENT;
            // $CandidiateDomain->save();
            // // save category of remarks for finance
            // // close

            //Save Endorsement Details
            // return $request->REMARKS_FROM_FINANCE;
            // $array = Str::lower($request->REMARKS_FOR_FINANCE);
            // $category = Helper::getCategory($array);
            // $endorsement = new Endorsement();
            // $endorsement->candidate_id = $CandidateInformation->id;
            // $endorsement->app_status = $request->APPLICATION_STATUS;
            // $endorsement->remarks = $request->REMARKS_FROM_FINANCE;
            // $endorsement->client = $request->CLIENT;
            // $endorsement->status = $request->STATUS;
            // $endorsement->type = $request->ENDORSEMENT_TYPE;
            // $endorsement->site = $request->SITE;
            // $endorsement->domain_endo = $request->DOMAIN;
            // $endorsement->position_title = $request->POSITION_TITLE;
            // // $endorsement->interview_date = $request->;
            // $endorsement->rfp = $request->REASONS_FOR_NOT_PROGRESSING;
            // $endorsement->career_endo = $request->CAREER_LEVEL;
            // $endorsement->segment_endo = $request->SEGMENT;
            // $endorsement->sub_segment_endo = $request->SUB_SEGMENT;
            // $endorsement->endi_date = $request->DATE_ENDORSED;
            // $endorsement->remarks_for_finance = $request->REMARKS_FOR_FINANCE;
            // $endorsement->saved_by = Auth::user()->id;
            // $endorsement->category = $category;
            // $endorsement->save();
            // //start logic for cip

            // $array = [
            //     'Final Stage' => [
            //         0 => 'Scheduled for Country Head Interview',
            //         1 => 'Scheduled for Final Interview',
            //         2 => "Scheduled for Hiring Manager's Interview",
            //         3 => 'Done Behavioral Interview / Awaiting Feedback',
            //         4 => 'Done Final Interview / Awaiting Feedback',
            //         5 => "Done Hiring Manager's Interview / Awaiting Feedback",
            //         6 => 'Failed Country Head Interview',
            //         7 => 'Failed Final Interview',
            //         8 => "Failed Hiring Manager's Interview",
            //         9 => "Scheduled for Job Offer",
            //         10 => "Shortlisted/For Comparison",
            //         11 => "Onboarded",
            //         12 => "Offer accepted",
            //         13 => "Offer Rejected",
            //         14 => "Position Closed (Final Stage)",
            //         15 => "Done Country Head Interview / Awaiting Feedback",
            //         16 => "Pending Offer Approval",
            //         17 => "Pending Offer Schedule",
            //         18 => "Position On Hold (Final Stage)",
            //         19 => "Shortlisted",
            //         20 => "Fallout/Reneged",
            //     ],
            //     "Mid Stage" => [
            //         0 => 'Scheduled for Skills Interview',
            //         1 => 'Scheduled for Technical Interview',
            //         2 => "Scheduled for Technical exam",
            //         3 => 'Sheduled for Behavioral Interview',
            //         4 => 'Scheduled for account validation',
            //         5 => "Done Skills interview/ Awaiting Feedback",
            //         6 => 'Done Techincal Interview /Awaiting Feedback',
            //         7 => 'Done Technical exam /Awaiting Feedback',
            //         8 => "Done Behavioral /Awaiting Feedback",
            //         9 => "Failed Skills interview",
            //         10 => "Failed Techincal Interview",
            //         11 => "Failed Technical exam",
            //         12 => "Failed Behavioral Interview",
            //         13 => "Pending Country Head Interview",
            //         14 => "Pending Final Interview",
            //         15 => "Pending Hiring Manager's Interview",
            //         16 => "Position Closed (Mid Stage)",
            //         17 => "Done Skills/Technical Interview / Awaiting Feedback",
            //         18 => "Failed Skills/Technical Interview",
            //         19 => "Position On Hold (Mid Stage)",
            //         20 => "Scheduled for Behavioral Interview",
            //         21 => "Scheduled for Skills/Technical Interview",
            //     ],
            // ];

            // // $user = User::find($recruiter);

            // $Cipprogress = new Cipprogress();
            // // find in array
            // if (in_array($request->REMARKS_FOR_FINANCE, $array['Final Stage'])) {

            //     $Cipprogress->final_stage = 1;
            //     $Cipprogress->cip = 1;
            // }
            // if (in_array($request->REMARKS_FOR_FINANCE, $array['Mid Stage'])) {
            //     $Cipprogress->mid_stage = 1;
            //     $Cipprogress->cip = 1;
            // }
            // //check
            // $word_1 = "Offer";
            // $word_2 = "Onboarded";
            // $mystring = $request->REMARKS_FOR_FINANCE;
            // if (strpos($mystring, $word_1) !== false) {
            //     $Cipprogress->offered = 1;
            // }
            // if (strpos($mystring, $word_2) !== false) {
            //     $Cipprogress->onboarded = 1;
            // }
            // $recruiter = Auth::user()->roles->first();
            // // return $recruiter;
            // $Cipprogress->candidate_id = $CandidateInformation->id;
            // $Cipprogress->team = $recruiter->name;
            // $Cipprogress->t_id = $recruiter->id;
            // $Cipprogress->save();
            // //close cip
            // // save data to finance tables
            // $finance = new Finance();
            // $finance->candidate_id = $CandidateInformation->id;
            // $finance->endorsement_id = $endorsement->id;
            // $finance->remarks_recruiter = $request->REMARKS;
            // $finance->onboardnig_date = $request->ONBOARDING_DATE;
            // $finance->invoice_number = $request->INVOICE_NUMBER;
            // $finance->client_finance = $request->CLIENT_FINANCE;
            // $finance->career_finance = $request->CAREER_LEVEL;
            // $finance->rate = $request->RATE;
            // $finance->srp = $request->STANDARD_PROJECTED_REVENUE;
            // $finance->Total_bilable_ammount = $request->TOTAL_BILLABLE_AMOUNT;
            // $finance->offered_salary = $request->OFFERED_SALARY_finance;
            // $finance->placement_fee = $request->PLACEMENT_FEE;
            // $finance->allowance = $request->ALLOWANCE;
            // $recruiter = Auth::user()->roles->pluck('id');
            // $finance->t_id = $recruiter[0];
            // $finance->save();
            // $finance_detail = new Finance_detail();
            // $finance_detail->candidate_id = $CandidateInformation->id;
            // $finance_detail->save();

            // // return response success if data is entered
            // //get last record  save data
            // $last_data_save = CandidateInformation::where("id", $CandidateInformation->id)->first();

            // // save record for logs starts
            // Helper::save_log('CANDIDATE_CREATED');
            // //save record for logs ends
            // Cache::forget('users');
            // return response()->json(['success' => true, 'message' => 'Record Saved successfully', "last_data_save" => $last_data_save]);
        }
    }
    // close

    // search user data and append the new view after ajax call function
    public function SearchUserData(Request $request, $id)
    {
        // exploding string for endorsement number and candidate id to get selected data
        $str_arr = explode('-', $request->id);
        // return $str_arr[1] ;
        $endoID = $str_arr[1];
        $number_of_endorsements = Endorsement::where(['saved_by' => Auth::user()->id, 'candidate_id' => $str_arr[0], 'is_deleted' => 0])->get();
        $domainDrop = Domain::all();
        // $segmentsDropDown = DB::table('segments')->get();
        // $sub_segmentsDropDown = DB::table('sub_segments')->get();
        $user = CandidateInformation::join('candidate_educations', 'candidate_informations.id', 'candidate_educations.candidate_id')
            ->join('candidate_positions', 'candidate_informations.id', 'candidate_positions.candidate_id')
            ->join('candidate_domains', 'candidate_informations.id', 'candidate_domains.candidate_id')
            ->join('endorsements', 'candidate_informations.id', 'endorsements.candidate_id')
            ->join('finance', 'endorsements.id', 'finance.endorsement_id')
            ->select('candidate_educations.*', 'finance.id as f_id', 'candidate_informations.*', 'candidate_informations.id as cid', 'candidate_positions.*', 'candidate_domains.*', 'finance.*', 'endorsements.*')
            ->where(['candidate_informations.id' => $str_arr[0], 'endorsements.numberofEndo' => $endoID, 'endorsements.saved_by' => Auth::user()->id])
            ->first();
        // return $user;
        $financeDetail = DB::table('finance_detail')->where('finance_id', $user->f_id)->first();
        $finance_remark = $financeDetail->remarks;
        $inputDetail = $user->last_name . '-' . $user->candidate_profile . '-' . $user->client . '-' . $user->endi_date;
        $title = $user->position_title;
        $data = [
            'title' => $title,
            'finance_remark' => $finance_remark,
            'financeDetail' => $financeDetail,
            'domainDrop' => $domainDrop,
            'user' => $user,
            'number' => $endoID,
            'number_of_endorsements' => $number_of_endorsements,
            // 'segmentsDropDown' => $segmentsDropDown,
            // 'sub_segmentsDropDown' => $sub_segmentsDropDown,
            'inputDetail' => $inputDetail,
        ];
        return view('data_entry.userSearch', $data);
    }
    // close

    // update candidate function
    public function update_data_entry(Request $request, $id)
    {
        // return $request->all();
        $candidate_id = trim($request->candidate_id, "id=");
        $endo_number = $request->endo_number;
        // return $candidate_id;
        if ($request->tap == 0) {
            $ids = explode('-', $candidate_id);
            $candidate_id = $ids[0];
            $endo_number = $ids[1];
        }
        if (Auth::user()->agent == 1) {
            $arrayCheck = [
                "EMPLOYMENT_HISTORY" => 'required ',
                // "DOMAIN" => 'required ',
                'LAST_NAME' => 'required',
                "FIRST_NAME" => "required",
                "EMAIL_ADDRESS" => "required|email",
                "CONTACT_NUMBER" => "required",
                "GENDER" => "required",
                // "CERTIFICATIONS" => "required",
                "RESIDENCE" => 'required ',
                "APPLICATION_STATUS" => 'required ',
                "SOURCE" => 'required ',
                // "EDUCATIONAL_ATTAINTMENT" => 'required ',
                // // "COURSE" => 'required ',
                "MANNER_OF_INVITE" => 'required ',
                "CANDIDATES_PROFILE" => 'required ',
                // "INTERVIEW_NOTES" => 'required ',
                "DATE_SIFTED" => 'required|date|after:1970-01-01',
                // "SEGMENT" => 'required ',
                // "SUB_SEGMENT" => 'required ',
                "POSITION_TITLE_APPLIED" => 'required ',
                // // "DATE_INVITED" => 'required ',
                // "MANNER_OF_INVITE" => 'required ',
                // "CURRENT_SALARY" => 'required ',
                // "file" => 'required ',
                // "CURRENT_ALLOWANCE" => 'required ',
                // "EXPECTED_SALARY" => 'required ',
                // "OFFERED_SALARY" => 'required ',
                // "OFFERED_ALLOWANCE" => 'required ',
            ];
            $status = Str::lower($request->APPLICATION_STATUS);
            if (str_contains($status, 'active') || str_contains($status, 'to be')) {
                $arrayCheck["EDUCATIONAL_ATTAINTMENT"] = "required";
                $arrayCheck["EXPECTED_SALARY"] = "required";
                $arrayCheck["CURRENT_SALARY"] = "required";
                $arrayCheck["INTERVIEW_NOTES"] = "required";
            }
            $manner_of_invite = Str::lower($request->MANNER_OF_INVITE);
            if (
                str_contains($manner_of_invite, 'sms') || str_contains($manner_of_invite, 'email') || str_contains($manner_of_invite, 'call')
                || str_contains($manner_of_invite, 'viber') || str_contains($manner_of_invite, 'skype') || str_contains($manner_of_invite, 'mess')
                || str_contains($manner_of_invite, 'sms')
            ) {
                $arrayCheck["DATE_INVITED"] = "required|date|after:1970-01-01";
            }
            if ($request->rfp == 1) {
                $arrayCheck["REASONS_FOR_NOT_PROGRESSING"] = "required";
            }
            if ($request->interview_schedule == 1) {
                $arrayCheck["INTERVIEW_SCHEDULE"] = "required";
            }
            if ($request->salary_field == 1) {
                $arrayCheck["OFFERED_SALARY"] = "required";
                $arrayCheck["OFFERED_ALLOWANCE"] = "required";
            }
            if ($request->EDUCATIONAL_ATTAINTMENT == 'HIGH SCHOOL GRADUATE' || $request->EDUCATIONAL_ATTAINTMENT == "") {
            } else {
                $arrayCheck["COURSE"] = "required";
            }

            if ($request->endorsement_field == 'active') {
                $arrayCheck["POSITION_TITLE"] = "required";
                $arrayCheck["ENDORSEMENT_TYPE"] = "required";
                $arrayCheck["POSITION_TITLE"] = "required";
                $arrayCheck["CAREER_LEVEL"] = "required";
                $arrayCheck["DATE_ENDORSED"] = "required|date|after:1970-01-01";
                $arrayCheck["STATUS"] = "required";
                $arrayCheck["CLIENT"] = "required";
                $arrayCheck["SITE"] = "required";
                $arrayCheck["REMARKS_FOR_FINANCE"] = "required";
                // $arrayCheck["REMARKS_FROM_FINANCE"] = "required";
            }
            $array = Str::lower($request->REMARKS_FOR_FINANCE);

            if (str_contains($array, 'onboarder') || str_contains($array, 'accepted')) {
                // $arrayCheck["REMARKS"] = "required";
                // $arrayCheck["ONBOARDING_DATE"] = "required|date|after:1970-01-01";
                $arrayCheck["TOTAL_BILLABLE_AMOUNT"] = "required";
                $arrayCheck["RATE"] = "required";
                // $arrayCheck["PLACEMENT_FEE"] = "required";
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
                "SOURCE" => 'required ',
                // "DOMAIN" => 'required ',
                // "SEGMENT" => 'required ',
                // "SUB_SEGMENT" => 'required ',
                // // "COURSE" => 'required ',
                "CANDIDATES_PROFILE" => 'required ',
                "APPLICATION_STATUS" => 'required ',
                // "INTERVIEW_NOTES" => 'required ',
                "DATE_SIFTED" => 'required ',
                "EMPLOYMENT_HISTORY" => 'required ',
                "POSITION_TITLE_APPLIED" => 'required ',
                // // "DATE_INVITED" => 'required ',
                "MANNER_OF_INVITE" => 'required ',
                // "CURRENT_SALARY" => 'required ',
                // "file" => 'required ',
                // "CURRENT_ALLOWANCE" => 'required ',
                // "EXPECTED_SALARY" => 'required ',
                // "OFFERED_SALARY" => 'required ',
                // "OFFERED_ALLOWANCE" => 'required ',
            ];
            if ($request->EDUCATIONAL_ATTAINTMENT == 'HIGH SCHOOL GRADUATE' || $request->EDUCATIONAL_ATTAINTMENT == "" || $request->EDUCATIONAL_ATTAINTMENT == 'SENIOR HIGH SCHOOL GRADUATE') {
            } else {
                $arrayCheck["COURSE"] = "required";
            }
            if ($request->salary_field == 1) {
                $arrayCheck["OFFERED_SALARY"] = "required";
                $arrayCheck["OFFERED_ALLOWANCE"] = "required";
            }
            if ($request->endorsement_field == 'active') {
                $arrayCheck["POSITION_TITLE"] = "required";
                $arrayCheck["ENDORSEMENT_TYPE"] = "required";
                $arrayCheck["POSITION_TITLE"] = "required";
                $arrayCheck["CAREER_LEVEL"] = "required";
                $arrayCheck["DATE_ENDORSED"] = "required";
                $arrayCheck["STATUS"] = "required";
                $arrayCheck["CLIENT"] = "required";
                $arrayCheck["SITE"] = "required";
                $arrayCheck["REMARKS_FOR_FINANCE"] = "required";
                // $arrayCheck["REMARKS_FROM_FINANCE"] = "required";
            }
            if ($request->finance_field == 1) {
                // $arrayCheck["REMARKS"] = "required";
                // $arrayCheck["ONBOARDING_DATE"] = "required";
                $arrayCheck["TOTAL_BILLABLE_AMOUNT"] = "required";
                $arrayCheck["RATE"] = "required";
                // $arrayCheck["PLACEMENT_FEE"] = "required";
            }
            $status = Str::lower($request->APPLICATION_STATUS);
            if (str_contains($status, 'active') || str_contains($status, 'to be')) {
                $arrayCheck["EDUCATIONAL_ATTAINTMENT"] = "required";
                $arrayCheck["EXPECTED_SALARY"] = "required";
                $arrayCheck["CURRENT_SALARY"] = "required";
                $arrayCheck["INTERVIEW_NOTES"] = "required";
            }
            $manner_of_invite = Str::lower($request->MANNER_OF_INVITE);
            if (
                str_contains($manner_of_invite, 'sms') || str_contains($manner_of_invite, 'email') || str_contains($manner_of_invite, 'call')
                || str_contains($manner_of_invite, 'viber') || str_contains($manner_of_invite, 'skype') || str_contains($manner_of_invite, 'mess')
                || str_contains($manner_of_invite, 'sms')
            ) {
                $arrayCheck["DATE_INVITED"] = "required";
            }
        }
        $validator = Validator::make($request->all(), $arrayCheck);
        if ($validator->fails()) {
            // if (
            //     !isset($request->INTERVIEW_NOTES) ||
            //     !isset($request->CURRENT_SALARY) ||
            //     !isset($request->EXPECTED_SALARY)
            // ) {
            //     $arrayCheck["EXPECTED_SALARY"] = "required";
            //     $arrayCheck["CURRENT_SALARY"] = "required";
            //     $arrayCheck["INTERVIEW_NOTES"] = "required";
            //     $validator = Validator::make($request->all(), $arrayCheck);
            //     return response()->json(['success' => false, 'message' => $validator->errors(), 'status' => '1']);
            // } else {
            return response()->json(['success' => false, 'message' => $validator->errors()]);
            // }
        } else {
            // $lname = explode(" ", $request->LAST_NAME);
            // $fname = explode(" ", $request->FIRST_NAME);
            // $phone = explode(" ", $request->CONTACT_NUMBER);
            // $record = CandidateInformation::select('last_name', 'first_name', 'phone')->get();
            // for ($i = 0; $i < count($record); $i++) {
            //     if (in_array($record[$i]['last_name'], $lname) && in_array($record[$i]['first_name'], $fname) && in_array($record[$i]['phone'], $phone)) {
            //         return response()->json(['success' => 'duplicate', 'message' => 'Duplicate Data detected']);
            //     }
            // }
            // Update data of eantry page
            // return $request->SOURCE;
            // $CandidateInformation = CandidateInformation::find($candidate_id);
            // $CandidateEducation = CandidateEducation::find($candidate_id);
            // $CandidiatePosition = CandidatePosition::find($candidate_id);
            // $CandidiateDomain = CandidateDomain::find($candidate_id);
            // $endorsement = Endorsement::where('numberOfEndo', $endo_number)->first();
            // $finance = Finance::where('endorsement_id', $endorsement->id)->first();

            // $endorsement->app_status = 'hello';
            // return 'ko';
            CandidateInformation::where('id', $candidate_id)->update([
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
            if (isset($request->CERTIFICATIONS)) {
                $certification = implode(",", $request->CERTIFICATIONS);
                CandidateEducation::where('candidate_id', $candidate_id)->update([
                    'certification' => $certification,
                ]);
            }
            // update candidate education data
            CandidateEducation::where('candidate_id', $candidate_id)->update([
                'educational_attain' => $request->EDUCATIONAL_ATTAINTMENT,
                'course' => $request->COURSE,
                // 'certification' => $certification,
            ]);

            // update candidae domain data
            // $domain_name = Domain::where('id', $request->DOMAIN)->first();
            // return $request->Domainsub;
            if (is_numeric(isset($request->Domainsegment))) {
                $name = (DropDownOption::where('id', $request->Domainsegment)->first())->option_name;
            } else {
                $name = $request->Domainsegment;
            }
            if (is_numeric(isset($request->Domainsub))) {
                $Sub_name = (DropDownOption::where('id', $request->Domainsub)->first())->option_name;
            } else {
                $Sub_name = $request->Domainsub;
            }
            if (is_numeric(isset($request->DOMAIN))) {
                $domain = (Domain::where('id', $request->DOMAIN)->first())->domain_name;
            } else {
                $domain = $request->DOMAIN;
            }
            if (is_numeric(isset($request->SEGMENT))) {
                $e_name = (DropDownOption::where('id', $request->SEGMENT)->first())->option_name;
            } else {
                $e_name = $request->SEGMENT;

            }
            if (is_numeric(isset($request->SUB_SEGMENT))) {

                $e_sub_name = (DropDownOption::where('id', $request->SUB_SEGMENT)->first())->option_name;
            } else {
                $e_sub_name = $request->SUB_SEGMENT;
            }
            if (is_numeric(isset($request->DOMAIN_ENDORSEMENT))) {
                $e_domain = (Domain::where('id', $request->DOMAIN_ENDORSEMENT)->first())->domain_name;

            } else {
                $e_domain = $request->DOMAIN_ENDORSEMENT;

            }

            CandidateDomain::where('candidate_id', $candidate_id)->update([
                'date_shifted' => $request->DATE_SIFTED,
                'domain' => $domain,
                'emp_history' => $request->EMPLOYMENT_HISTORY,
                'interview_note' => $request->INTERVIEW_NOTES,
                'segment' => $name,
                'sub_segment' => $Sub_name,
            ]);

            // Upload CV of user
            if ($request->hasFile('file')) {
                $path = base_path();
                $path = str_replace("laravel", "public_html", $path); // <= This one !
                $destinationPath = $path . '/public/assets/cv'; // upload path
                $fileName = $request->CONTACT_NUMBER . time() . '.pdf';
                // $path = 'assets/cv';
                $request->file->move($destinationPath, $fileName);
                // update candidate position data according to requested data
                CandidatePosition::where('candidate_id', $candidate_id)->update([
                    'candidate_profile' => $request->CANDIDATES_PROFILE,
                    'position_applied' => $request->POSITION_TITLE_APPLIED,
                    'date_invited' => $request->DATE_INVITED,
                    'manner_of_invite' => $request->MANNER_OF_INVITE,
                    'source' => $request->SOURCE,
                    'curr_salary' => $request->CURRENT_SALARY,
                    'exp_salary' => $request->EXPECTED_SALARY,
                    'off_salary' => $request->OFFERED_SALARY,
                    'curr_allowance' => $request->CURRENT_ALLOWANCE,
                    'off_allowance' => $request->OFFERED_ALLOWANCE,
                    'cv' => $fileName,
                ]);
            } else {
                // update candidate position data according to requested data
                CandidatePosition::where('candidate_id', $candidate_id)->update([
                    'candidate_profile' => $request->CANDIDATES_PROFILE,
                    'position_applied' => $request->POSITION_TITLE_APPLIED,
                    'date_invited' => $request->DATE_INVITED,
                    'manner_of_invite' => $request->MANNER_OF_INVITE,
                    'curr_salary' => $request->CURRENT_SALARY,
                    'exp_salary' => $request->EXPECTED_SALARY,
                    'source' => $request->SOURCE,
                    'off_salary' => $request->OFFERED_SALARY,
                    'curr_allowance' => $request->CURRENT_ALLOWANCE,
                    'off_allowance' => $request->OFFERED_ALLOWANCE,
                ]);
            }
            $array = $request->REMARKS_FOR_FINANCE;
            $category = Helper::getCategory($array);
            //update endorsements table according to data updated
            $endorsement = Endorsement::where(['candidate_id' => $candidate_id, 'numberOfEndo' => $endo_number, 'saved_by' => Auth::user()->id])->first();
            //    return $candidate_id;
            Endorsement::where(['candidate_id' => $candidate_id, 'numberOfEndo' => $endo_number, 'saved_by' => Auth::user()->id])->update([
                'app_status' => $request->APPLICATION_STATUS,
                'remarks' => $request->REMARKS_FROM_FINANCE,
                'client' => $request->CLIENT,
                'status' => $request->STATUS,
                'type' => $request->ENDORSEMENT_TYPE,
                'site' => $request->SITE,
                'position_title' => $request->POSITION_TITLE,
                'interview_date' => $request->INTERVIEW_SCHEDULE,
                'career_endo' => $request->CAREER_LEVEL,
                'rfp' => $request->REASONS_FOR_NOT_PROGRESSING,
                'domain_endo' => $e_domain,
                'segment_endo' => $e_name,
                'sub_segment_endo' => $e_sub_name,
                'endi_date' => $request->DATE_ENDORSED,
                'category' => $category,
                'remarks_for_finance' => $request->REMARKS_FOR_FINANCE,
            ]);
            //update data of finance table acooridngly starts
            Finance::where(['candidate_id' => $candidate_id, 'endorsement_id' => $endorsement->id])->update([
                'remarks_recruiter' => $request->REMARKS,
                'onboardnig_date' => $request->ONBOARDING_DATE,
                'invoice_number' => $request->INVOICE_NUMBER,
                'client_finance' => $request->CLIENT_FINANCE,
                'career_finance' => $request->CAREER_LEVEL,
                'rate' => preg_replace('/%/', '', $request->RATE),
                'Total_bilable_ammount' => $request->TOTAL_BILLABLE_AMOUNT,
                'srp' => $request->STANDARD_PROJECTED_REVENUE,
                'offered_salary' => $request->OFFERED_SALARY_finance,
                'placement_fee' => $request->PLACEMENT_FEE,
                'allowance' => $request->ALLOWANCE,
            ]);
            //update data of finance table acooridngly starts
            $fid_detail = (Finance::where(['candidate_id' => $candidate_id, 'endorsement_id' => $endorsement->id])->first())->id;
            DB::table('finance_detail')->where('finance_id', $fid_detail)->update([
                'offered_salary' => $request->OFFERED_SALARY_finance,
                'placementFee' => $request->PLACEMENT_FEE,
                'allowance' => $request->ALLOWANCE,
                'rate_per' =>  preg_replace('/%/', '', $request->RATE),
            ]);
            
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

            $Cipprogress = Cipprogress::where('endorsement_id', $endorsement->id)->firstOrFail();
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
            $recruiter = Auth::user()->roles->first();
            // return $recruiter;
            $Cipprogress->candidate_id = $candidate_id;
            $Cipprogress->team = $recruiter->name;
            $Cipprogress->t_id = $recruiter->id;
            $Cipprogress->endorsement_id = $endorsement->id;
            $Cipprogress->save();

            //save candidate addeed log to table starts
            Helper::save_log('CANDIDATE_UPDATED');
            // save candidate added to log table ends
            Cache::forget('users');

            //return success response after successfull data entry
            return response()->json(['success' => true, 'message' => 'Updated successfully']);
        }
    }
    // close

    //doanload candidate cv function starts
    public function downloadCv(Request $request)
    {
        $user = CandidatePosition::where('candidate_id', $request->id)->first();
        if (isset($user->cv)) {
            if (File::exists('public/assets/cv/' . $user->cv)) {
                $file = 'public/assets/cv/' . $user->cv;
                $headers = array(
                    'Content-Type: application/pdf',
                );

                return Response::download($file, 'filename.pdf', $headers);
                return response()->json(['success' => true, 'message' => 'Attachment downloaded']);
            } else {
                return response()->json(['success' => false, 'message' => 'Attachment not Exists']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'No Attachment found']);
        }
    }
    // close

    // get candidate profile data from ajax call
    public function traveseDataByClientProfile(Request $request)
    {

        if ($request->c_profile) {
            $request->position == null;
            $response = DB::table('gettravesels')->where("c_profile", $request->c_profile)->first();
            if ($response) {

                return response()->json(['data' => $response]);
            }
        }
        if ($request->position) {
            $request->c_profile == null;
            $response = DB::table('jdl')->where("p_title", $request->position)->where('status', 'like', 'open')
                ->select('client', 'domain', 'segment', 'subsegment', 'p_title', 'c_level')->orderBy('p_title')->get();
            if ($response) {

                return response()->json(['data' => $response]);
            }
        }
        if ($request->client_dropdown) {
            $response = DB::table('jdl')->where("client", $request->client_dropdown)->where('status', 'like', 'open')
                ->select('client', 'domain', 'segment', 'subsegment', 'p_title', 'c_level')->orderBy('p_title')->get();
            if ($response) {
                return response()->json(['data' => $response]);
            }
        }
        return response()->json(['data' => "no data found"]);
    }
    // close

    // show data when QR is scanned
    public function QRCodeDetail(Request $request, $id, $endoID)
    {

        $user = CandidateInformation::join('candidate_educations', 'candidate_informations.id', 'candidate_educations.candidate_id')
            ->join('candidate_positions', 'candidate_informations.id', 'candidate_positions.candidate_id')
            ->join('candidate_domains', 'candidate_informations.id', 'candidate_domains.candidate_id')
            ->join('endorsements', 'candidate_informations.id', 'endorsements.candidate_id')
        // ->join('finance', 'candidate_informations.id', 'finance.candidate_id')
            ->select('candidate_educations.*', 'candidate_informations.*', 'candidate_informations.id as cid', 'candidate_positions.*', 'candidate_domains.*', 'endorsements.*')
            ->where(['candidate_informations.id' => $id, 'endorsements.numberOfEndo' => $endoID])
            ->first();
        $data = [
            'user' => $user,
        ];
        return view('data_entry.qr', $data);
    }
    // close
    // Qr code function
    public function QRCodeGenerator(Request $request, $id)
    {
        $arr = explode('-', $id);
        // return $arr;
        $image = QrCode::size(250)
            ->backgroundColor(255, 255, 255)
            ->generate(url('admin/candidate_detail') . '/' . $arr[0] . '/' . $arr[1]);
        // ->generate(view('data_entry.qr', $data)->render());
        // $png = base64_encode($image);
        // dd($image);
        CandidateInformation::where('id', $request->id)->update([
            'qrImage' => $image,
        ]);
        // dd('done');
        // echo "<img src='data:image/png;base64," . $png . "'>";
        return response($image)->header('Content-type', 'image/png');
    }
    // close

    //ajax call for getting candidate list
    public function get_candidateList()
    {
        $user = DB::table('candidate_informations')->join('endorsements', 'candidate_informations.id', 'endorsements.candidate_id')
            ->join('candidate_positions', 'candidate_informations.id', 'candidate_positions.candidate_id')
            ->select('candidate_informations.id', 'candidate_informations.last_name', 'candidate_positions.candidate_profile', 'candidate_informations.first_name',
                'endorsements.client', 'endorsements.position_title', 'endorsements.endi_date', 'endorsements.numberOfEndo as number')
            ->where('endorsements.is_deleted', 0)
            ->where('endorsements.saved_by', Auth::user()->id)->get()->toArray();
        return response()->json($user);
    }
    //close

    // get position titles with ajax
    public function Get_Position_title(Request $request)
    {
        $position_title = DB::table('jdl')->get('p_title');
        return response()->json($position_title);
    }
    // close

    //endorsemnt detail view append for multiple endorsemtns
    public function endorsementDetailView(Request $request)
    {
        try {
            if ($request->id == '') {
                $detail = null;
                $detail_f = null;
                $remarks_f = null;
                $financeDetail = null;
            } else {
                $endoID = $request->id;
                $cid = explode(',', $request->user);
                $detail = DB::table('endo_finance_view')
                    ->where(['numberOfEndo' => $endoID, 'candidate_id' => $cid[0], 'saved_by' => Auth::user()->id])->first();
                $detail_f = DB::table('finance_detail')->where('finance_id', $detail->f_id)->first();
                $remarks_f = $detail_f->remarks;
                $financeDetail = DB::table('finance_detail')->where('finance_id', $detail->f_id)->first();
            }
            $domainDrop = Domain::all();
            $segmentsDropDown = DB::table('segments')->get();
            $sub_segmentsDropDown = DB::table('sub_segments')->get();
            $data = [
                'financeDetail' => $financeDetail,
                'remarks_f' => $remarks_f,
                'detail_f' => $detail_f,
                'user' => $detail,
                'domainDrop' => $domainDrop,
                'segmentsDropDown' => $segmentsDropDown,
                'sub_segmentsDropDown' => $sub_segmentsDropDown,
            ];
            return response()->view('data_entry.endo_detail', $data);
        } catch (\Exception$e) {
            return $e->getMessage();
        }

    }
    // close

    // get reamnrks for finance options function
    public function get_remarksForFinance_options()
    {
        $remarks = Helper::get_dropdown('remarks_for_finance');
        return response()->json($remarks);
    }

    // close

}
