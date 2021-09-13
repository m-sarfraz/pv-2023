<?php

namespace App\Http\Controllers\Admin;

use App\CandidateDomain;
use App\CandidateEducation;
use App\CandidateInformation;
use App\CandidatePosition;
use App\Domain;
use App\Endorsement;
use App\Finance;
use App\Http\Controllers\Controller;
use App\Segment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Response;

class CandidateController extends Controller
{
    public function data_entry()
    {
        $user = CandidateInformation::all();
        $domainDrop = Domain::all();
        $segmentsDropDown = DB::table('segments')->get();
        $sub_segmentsDropDown = DB::table('sub_segments')->get();
        // return $sub_segmentsDropDown;
        $data = [
            'user' => $user,
            'domainDrop' => $domainDrop,
            'segmentsDropDown' => $segmentsDropDown,
            'sub_segmentsDropDown' => $sub_segmentsDropDown,
        ];

        return view('data_entry.add', $data);
    }
    public function save_data_entry(Request $request)
    {
        // dd($request->all());
        $arrayCheck = [
            'LAST_NAME' => 'required',
            // "FIRST_NAME" => "required",
            // "EMAIL_ADDRESS" => "required",
            // "CONTACT_NUMBER" => "required",
            // "GENDER" => "required",
            // "RESIDENCE" => 'required ',
            // "EDUCATIONAL_ATTAINTMENT" => 'required ',
            // // "COURSE" => 'required ',
            // "CANDIDATES_PROFILE" => 'required ',
            // "INTERVIEW_NOTES" => 'required ',
            // "DATE_SIFTED" => 'required ',
            // "DOMAIN" => 'required ',
            // "SEGMENT" => 'required ',
            // "SUB_SEGMENT" => 'required ',
            // "EMPLOYMENT_HISTORY" => 'required ',
            // "POSITION_TITLE_APPLIED" => 'required ',
            // "DATE_INVITED" => 'required ',
            // "MANNER_OF_INVITE" => 'required ',
            // "CURRENT_SALARY" => 'required ',
            // "CURRENT_ALLOWANCE" => 'required ',
            // "EXPECTED_SALARY" => 'required ',
            // "OFFERED_SALARY" => 'required ',
            // "OFFERED_ALLOWANCE" => 'required ',
        ];
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
            $CandidateInformation->save();

            //  save data to candidate education table
            $CandidateEducation = new CandidateEducation();
            $CandidateEducation->educational_attain = $request->EDUCATIONAL_ATTAINTMENT;
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
            $CandidiateDomain->domain = $request->DOMAIN;
            $CandidiateDomain->emp_history = $request->EMPLOYMENT_HISTORY;
            $CandidiateDomain->interview_note = $request->INTERVIEW_NOTES;
            $CandidiateDomain->segment = $request->SEGMENT;
            $CandidiateDomain->sub_segment = $request->SUB_SEGMENT;
            $CandidiateDomain->save();

            //Save Endorsement Details
            $endorsement = new Endorsement();
            $endorsement->app_status = $request->APPLICATION_STATUS;
            $endorsement->remarks = $request->REMARKS_FROM_FINANCE;
            $endorsement->client = $request->CLIENT;
            $endorsement->status = $request->STATUS;
            $endorsement->type = $request->ENDORSEMENT_TYPE;
            $endorsement->site = $request->SITE;
            $endorsement->domain_endo = $request->DOMAIN;
            $endorsement->position_title = $request->POSITION_TITLE;
            // $endorsement->interview_date = $request->;
            $endorsement->career_endo = $request->CAREER_LEVEL;
            $endorsement->segment_endo = $request->SEGMENT;
            $endorsement->sub_segment_endo = $request->SUB_SEGMENT;
            $endorsement->endi_date = $request->DATE_ENDORSED;
            $endorsement->remarks_for_finance = $request->REMARKS_FOR_FINANCE;
            $endorsement->save();

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

            return response()->json(['success' => true, 'message' => 'Data added successfully']);

        }
    }
    public function SearchUserData(Request $request, $id)
    {
        $user = CandidateInformation::
            join('candidate_educations', 'candidate_informations.id', 'candidate_educations.candidate_id')
            ->join('candidate_positions', 'candidate_informations.id', 'candidate_positions.candidate_id')
            ->join('candidate_domains', 'candidate_informations.id', 'candidate_domains.candidate_id')
            ->join('endorsements', 'candidate_informations.id', 'endorsements.candidate_id')
            ->join('finance', 'candidate_informations.id', 'finance.candidate_id')
            ->select('candidate_educations.*', 'candidate_informations.*', 'candidate_positions.*', 'candidate_domains.*', 'finance.*', 'endorsements.*')
            ->where('candidate_informations.id', $request->id)
            ->first();
        // return $user;
        $data = [
            'user' => $user,
        ];
        return view('data_entry.userSearch', $data);

    }
    public function update_data_entry(Request $request, $id)
    {
        // return $request->all();
        $arrayCheck = [
            'LAST_NAME' => 'required',
            // "FIRST_NAME" => "required",
            // "EMAIL_ADDRESS" => "required",
            // "CONTACT_NUMBER" => "required",
            // "GENDER" => "required",
            // "RESIDENCE" => 'required ',
            // "EDUCATIONAL_ATTAINTMENT" => 'required ',
            // // "COURSE" => 'required ',
            // "CANDIDATES_PROFILE" => 'required ',
            // "INTERVIEW_NOTES" => 'required ',
            // "DATE_SIFTED" => 'required ',
            // "DOMAIN" => 'required ',
            // "SEGMENT" => 'required ',
            // "SUB_SEGMENT" => 'required ',
            // "EMPLOYMENT_HISTORY" => 'required ',
            // "POSITION_TITLE_APPLIED" => 'required ',
            // "DATE_INVITED" => 'required ',
            // "MANNER_OF_INVITE" => 'required ',
            // "CURRENT_SALARY" => 'required ',
            // "CURRENT_ALLOWANCE" => 'required ',
            // "EXPECTED_SALARY" => 'required ',
            // "OFFERED_SALARY" => 'required ',
            // "OFFERED_ALLOWANCE" => 'required ',
        ];
        $validator = Validator::make($request->all(), $arrayCheck);
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
                'status' => $request->STATUS,

            ]);
            CandidateEducation::where('candidate_id', $id)->update([
                'educational_attain' => $request->EDUCATIONAL_ATTAINTMENT,
                'course' => $request->COURSE,
                'certification' => $request->CERTIFICATIONS,
            ]);
            CandidateDomain::where('candidate_id', $id)->update([
                'date_shifted' => $request->DATE_SIFTED,
                'domain' => $request->DOMAIN,
                'emp_history' => $request->EMPLOYMENT_HISTORY,
                'interview_note' => $request->INTERVIEW_NOTES,
                'segment' => $request->SEGMENT,
                'sub_segment' => $request->SUB_SEGMENT,
            ]);

            // Upload CV of user
            if ($request->hasFile('file')) {
                $fileName = $request->CONTACT_NUMBER . time() . '.' . $request->file->extension();
                $path = 'assets/cv';
                $request->file->move($path, $fileName);
                CandidatePosition::where('candidate_id', $id)->update([
                    'cv' => $request->cv,
                ]);
            }
            CandidatePosition::where('candidate_id', $id)->update([
                'candidate_profile' => $request->CANDIDATES_PROFILE,
                'position_applied' => $request->POSITION_TITLE_APPLIED,
                'date_invited' => $request->DATE_INVITED,
                'manner_of_invite' => $request->MANNER_OF_INVITE,
                'curr_salary' => $request->CURRENT_SALARY,
                'exp_salary' => $request->EXPECTED_SALARY,
                'off_salary' => $request->OFFERED_SALARY,
                'curr_allowance' => $request->CURRENT_ALLOWANCE,
                'cv' => $request->cv,
                'off_allowance' => $request->OFFERED_ALLOWANCE,
            ]);
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
                'segment_endo' => $request->SEGMENT,
                'sub_segment_endo' => $request->SUB_SEGMENT,
                'endi_date' => $request->DATE_ENDORSED,
                'remarks_for_finance' => $request->REMARKS_FOR_FINANCE,
            ]);
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
            return response()->json(['success' => true, 'message' => 'Updated successfully']);
        }
    }
    public function downloadCv(Request $request, $id)
    {
        // return $id;
        $user = CandidatePosition::where('candidate_id', $id)->first();
        $file = 'assets/cv/' . $user->cv;
        $headers = array(
            'Content-Type: application/pdf',
        );
        return Response::download($file, $user->FIRST_NAME . "'s Resume'", $headers);
    }
}
