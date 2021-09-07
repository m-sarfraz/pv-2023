<?php

namespace App\Http\Controllers\Admin;

use App\CandidateDomain;
use App\CandidateEducation;
use App\CandidateInformation;
use App\CandidatePosition;
use App\Endorsement;
use App\Finance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CandidateController extends Controller
{
    public function data_entry()
    {
        return view('data_entry.add');
    }
    public function save_data_entry(Request $request)
    {
        // dd($request->all());
        $arrayCheck = [
            'LAST_NAME' => 'required',
            "MIDDLE_NAME" => "required",
            "FIRST_NAME" => "required",
            "EMAIL_ADDRESS" => "required",
            "CONTACT_NUMBER" => "required",
            "GENDER" => "required",
            "RESIDENCE" => 'required ',
            "DATE_OF_BIRTH" => 'required ',
            "EDUCATIONAL_ATTAINTMENT" => 'required ',
            // "COURSE" => 'required ',
            "CERTIFICATIONS" => 'required ',
            "CANDIDATES_PROFILE" => 'required ',
            "INTERVIEW_NOTES" => 'required ',
            "DATE_SIFTED" => 'required ',
            "DOMAIN" => 'required ',
            "SEGMENT" => 'required ',
            "SUB_SEGMENT" => 'required ',
            "EMPLOYMENT_HISTORY" => 'required ',
            "POSITION_TITLE_APPLIED" => 'required ',
            "DATE_INVITED" => 'required ',
            "MANNER_OF_INVITE" => 'required ',
            "CURRENT_SALARY" => 'required ',
            "CURRENT_ALLOWANCE" => 'required ',
            "EXPECTED_SALARY" => 'required ',
            "OFFERED_SALARY" => 'required ',
            "OFFERED_ALLOWANCE" => 'required ',
        ];
        $validator = Validator::make($request->all(), $arrayCheck);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()]);
        } else {
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
            $CandidateEducation->qualification = $request->CERTIFICATIONS;
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
            $endorsement->domain = $request->DOMAIN;
            // $endorsement->interview_date = $request->;
            $endorsement->career = $request->CAREER_LEVEL;
            $endorsement->segment = $request->SEGMENT;
            $endorsement->sub_segment = $request->SUB_SEGMENT;
            $endorsement->endi_date = $request->DATE_ENDORSED;
            $endorsement->remarks_for_finance = $request->REMARKS_FOR_FINANCE;
            $endorsement->save();

            // save data to finance tables
            $finance = new Finance();
            $finance->candidate_id = $request->$CandidateInformation->id;
            $finance->endorsement_id = $request->$endorsement->id;
            $finance->remarks_recruiter = $request->REMARKS;
            $finance->onboardnig_date = $request->ONBOARDING_DATE;
            $finance->invoice_number = $request->INVOICE_NUMBER;
            $finance->client = $request->CLIENT;
            $finance->career = $request->CAREER_LEVEL;
            $finance->rate = $request->RATE;
            $finance->Total_bilable_ammount = $request->TOTAL_BILLABLE_AMOUNT;
            // $finance->offered_salary = $request->
            $finance->placement_fee = $request->PLACEMENT_FEE;
            $finance->allowance = $request->ALLOWANCE;
            $finance->save();
            return response()->json(['success' => true, 'message' => 'Data added successfully']);

        }
    }
}
