<?php

namespace App\Http\Controllers\Admin;

use App\CandidateEducation;
use App\CandidateInformation;
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
        ];
        $validator = Validator::make($request->all(), $arrayCheck);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()]);
        } else {
            //  dd( $request->COURSE );
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
            $CandidateEducation = new CandidateEducation();
            $CandidateEducation->educational_attain = $request->EDUCATIONAL_ATTAINTMENT;
            if ($request->COURSE === null) {
                $CandidateEducation->course = 'N/A';
            } else {
                $CandidateEducation->course = $request->COURSE;
            }
            $CandidateEducation->qualification = $request->CERTIFICATIONS;
            $CandidateEducation->save();
            return response()->json(['success' => true, 'message' => 'Data added successfully']);

        }
    }
}
