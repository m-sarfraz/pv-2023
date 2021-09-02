<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\Gl;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function show()
    {
        $company = DB::table('companies')
            ->join('gl', 'companies.id', 'gl.company_id')
            ->select('companies.*', 'gl.*')
            ->get();
        // return $company;
        $data = [
            'company' => $company,
        ];
        return view('companies.company_profile', $data);
    }
    public function add_company(Request $request)
    {
        if ($request->isMethod('get')) {

            return view('companies.add_company_profile');
        }
        if ($request->isMethod('post')) {
            // $data = $request->all();
            // return $data;
            $arrayCheck = [
                'company' => ['required', 'numeric'],
                "startDate" => "required",
                "endDate" => "required",
                "candidate_ownership" => "required",
                "replacement_gurantee_A" => "required",
                "replacement_gurantee_NA" => "required",
                "A_EL_rates" => "required",
                "A_entry_complex_specialized_rates" => "required",
                "A_seasonal_programs_project_base_contractualHires" => "required",
                "A_complex_voice_relay_programs_TSR_collections" => "required",
                "A_high_priority_account_night_shift" => "required",
                "A_gateway_hire_SET" => "required",
                "A_google_NA_sales_representative" => "required",
                "A_sales_CSR_TSR_airBNB_google" => "required", 'numeric',
                "international_account_luzon" => "required", 'numeric',
                "international_account_visayas" => "required", 'numeric',
                "local_account" => "required", 'numeric',
                "archieve_academy_international" => "required", 'numeric',
                "archieve_academy_local" => "required", 'numeric',
                "trainee_visayas_mindanao" => "required", 'numeric',
                "premium_financial_services_account" => "required", 'numeric',
                "CL_13_voice" => "required", 'numeric',
                "CL_13_non_voice" => "required", 'numeric',
                "CL_12_voice" => "required", 'numeric',
                "CL_12_non_voice" => "required", 'numeric',
                "CL_11" => "required", 'numeric',
                "CL_10_SR_analyst" => "required", 'numeric',
                "CL_10_usrn" => "required", 'numeric',
                "CL_9" => "required", 'numeric',
                "CL_8" => "required", 'numeric',
                "CL_7" => "required", 'numeric',
                "CL_6" => "required", 'numeric',
                "CL_5" => "required", 'numeric',
                "executive" => "required", 'numeric',
                "MD" => "required", 'numeric',
                "director" => "required", 'numeric',
                "analyst" => "required", 'numeric',
                "SR_analyst" => "required", 'numeric',
                "assoc_analyst" => "required", 'numeric',
                "junior_level" => "required", 'numeric',
                "mid_level" => "required", 'numeric',
                "senior_level" => "required", 'numeric',
                "advisor" => "required", 'numeric',
                "associate" => "required", 'numeric',
                "specialist" => "required", 'numeric',
                "specialized_account" => "required", 'numeric',
                "entry_non_agent_level" => "required", 'numeric',
                "NCLEX" => "required", 'numeric',
                "healthcare_USRN_inactive_license" => "required", 'numeric',
                "bilingual" => "required", 'numeric',
                "healthcare_USRN_active_licence" => "required", 'numeric',
                "multilingual" => "required", 'numeric',
                "level_2_technical_non_supervisory" => "required", 'numeric',
                "supervisor" => "required", 'numeric',
                "team_lead" => "required", 'numeric',
                "asst_assoc_manager" => "required", 'numeric',
                "manager" => "required", 'numeric',
                "senior_manager" => "required", 'numeric',
                "AVP" => "required", 'numeric',
                "VP" => "required", 'numeric',
                "SME_level" => "required", 'numeric',
                "b6" => "required", 'numeric',
                "b7" => "required", 'numeric',
                "b8" => "required", 'numeric',
                "b9" => "required", 'numeric',
                "b10" => "required", 'numeric',
                "advisor2" => "required", 'numeric',
                "advisor1" => "required", 'numeric',
                "GL_23_tech" => "required", 'numeric',
                "GL_24_tech" => "required", 'numeric',
                "GL_25_tech" => "required", 'numeric',
                "GL_26_tech" => "required", 'numeric',
                "GL_27_tech" => "required", 'numeric',
                "GL_28_tech" => "required", 'numeric',
                "GL_24_business_OPS_USRN" => "required", 'numeric',
                "GL_29_tech" => "required", 'numeric',
                "GL_30_tech" => "required", 'numeric',
                "GL_22_business_OPS" => "required", 'numeric',
                "GL_23_business_OPS" => "required", 'numeric',
                "GL_24_business_OPS" => "required", 'numeric',
                "GL_25_business_OPS" => "required", 'numeric',
                "GL_26_business_OPS" => "required", 'numeric',
                "GL_27_business_OPS" => "required", 'numeric',
                "GL_28_business_OPS" => "required", 'numeric',
                "GL_29_business_OPS" => "required", 'numeric',
                "GL_29_business_OPS" => "required", 'numeric',
                "GL_30_shared_services" => "required", 'numeric',
                "GL_29_shared_services" => "required", 'numeric',
                "GL_28_shared_services" => "required", 'numeric',
                "GL_27_shared_services" => "required", 'numeric',
                "GL_26_shared_services" => "required", 'numeric',
                "GL_25_shared_services" => "required", 'numeric',
                "GL_24_shared_services" => "required", 'numeric',
                "GL_23_shared_services" => "required", 'numeric',
                "GL_22_shared_services" => "required", 'numeric',
                "GL_30_business_OPS" => "required", 'numeric',
                "trainee_NCR" => "required", 'numeric',

            ];
            $validator = Validator::make($request->all(), $arrayCheck);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            } else {
                return $request->all();
                $company = new Company;
                $company->company_name = $request->company;
                // $start_date = Carbon::parse($request->startDate)->format('d-m-Y H:i:s');
                $company->start_date = $request->startDate;
                // $end_date = Carbon::parse()->format('d-m-Y H:i:s');
                $company->end_Date = $request->endDate;
                $company->candidate_ownership = $request->candidate_ownership;
                $company->a_entry_level = $request->replacement_gurantee_A;
                $company->executive_level = $request->replacement_gurantee_NA;
                $company->e_rates = $request->A_EL_rates;
                $company->e_c_s_rates = $request->A_entry_complex_specialized_rates;
                $company->c_v_r_programs = $request->A_complex_voice_relay_programs_TSR_collections;
                $company->c_hires = $request->A_seasonal_programs_project_base_contractualHires;
                $company->night_shift = $request->A_high_priority_account_night_shift;
                $company->gateway_hire = $request->A_gateway_hire_SET;
                $company->google_sr = $request->A_google_NA_sales_representative;
                $company->csr_tsr = $request->A_sales_CSR_TSR_airBNB_google;
                $company->in_luzon = $request->international_account_luzon;
                $company->in_visayas = $request->international_account_visayas;
                $company->local_acccount = $request->local_account;
                $company->aa_intl = $request->archieve_academy_international;
                $company->aa_local = $request->archieve_academy_local;
                $company->trainee_ncr = $request->trainee_NCR;
                $company->trainee_vm = $request->trainee_visayas_mindanao;
                $company->pfsc = $request->premium_financial_services_account;
                $company->cl13_v = $request->CL_13_voice;
                $company->cl13_nv = $request->CL_13_non_voice;
                $company->cl12_v = $request->CL_12_voice;
                $company->cl12_nv = $request->CL_12_non_voice;
                $company->cl11 = $request->CL_11;
                $company->cl10_sa = $request->CL_10_SR_analyst;
                $company->cl10_usrn = $request->CL_10_usrn;
                $company->cl9 = $request->CL_9;
                $company->cl8 = $request->CL_8;
                $company->cl7 = $request->CL_7;
                $company->cl6 = $request->CL_6;
                $company->cl5 = $request->CL_5;
                $company->executive = $request->executive;
                $company->md = $request->MD;
                $company->director = $request->director;
                $company->vp = $request->VP;
                $company->avp = $request->AVP;
                $company->sm = $request->senior_manager;
                $company->m = $request->manager;
                $company->am = $request->asst_assoc_manager;
                $company->team_lead = $request->team_lead;
                $company->supervisor = $request->supervisor;
                $company->non_supervisory = $request->level_2_technical_non_supervisory;
                $company->multilingual = $request->multilingual;
                $company->bilingual = $request->bilingual;
                $company->usrn_active_license = $request->healthcare_USRN_active_licence;
                $company->usrn_inactive_license = $request->healthcare_USRN_inactive_license;
                $company->nclex = $request->NCLEX;
                $company->na_entry_level = $request->entry_non_agent_level;
                $company->specialized_account = $request->specialized_account;
                $company->associate = $request->associate;
                $company->advisor = $request->advisor;
                $company->senior_level = $request->senior_level;
                $company->mid_level = $request->mid_level;
                $company->junior_level = $request->junior_level;
                $company->assoc_analyst = $request->assoc_analyst;
                $company->sen_analyst = $request->SR_analyst;
                $company->analyst = $request->analyst;
                $company->b6 = $request->b6;
                $company->b7 = $request->b7;
                $company->b8 = $request->b8;
                $company->b9 = $request->b9;
                $company->b10 = $request->b10;
                $company->sme_level = $request->SME_level;
                $company->advisor_2 = $request->advisor2;
                $company->advisor_1 = $request->advisor1;
                $gl = new Gl;
                $gl->company_id = $request-> $company->id;
                $gl->gl23_tech = $request->GL_23_tech;
                $gl->gl24_tech = $request->GL_24_tech;
                $gl->gl25_tech = $request->GL_25_tech;
                $gl->gl26_tech = $request->GL_26_tech;
                $gl->gl27_tech = $request->GL_27_tech;
                $gl->gl28_tech = $request->GL_28_tech;
                $gl->gl29_tech = $request->GL_29_tech;
                $gl->gl30_tech = $request->GL_30_tech;
                $gl->gl22_bo = $request->GL_22_business_OPS;
                $gl->gl23_bo = $request->GL_22_business_OPS;
                $gl->gl24_bo_usrn = $request->GL_24_business_OPS_USRN;
                $gl->gl_24_bo = $request->GL_24_business_OPS;
                $gl->gl_25_bo = $request->GL_25_business_OPS;
                $gl->gl_26_bo = $request->GL_26_business_OPS;
                $gl->gl_27_bo = $request->GL_27_business_OPS;
                $gl->gl_28_bo = $request->GL_28_business_OPS;
                $gl->gl_29_bo = $request->GL_29_business_OPS;
                $gl->gl_30_bo = $request->GL_30_business_OPS;
                $gl->gl22_ss = $request->GL_22_shared_services;
                $gl->gl23_ss = $request->GL_23_shared_services;
                $gl->gl24_ss = $request->GL_24_shared_services;
                $gl->gl25_ss = $request->GL_25_shared_services;
                $gl->gl26_ss = $request->GL_26_shared_services;
                $gl->gl27_ss = $request->GL_27_shared_services;
                $gl->gl28_ss = $request->GL_28_shared_services;
                $gl->gl29_ss = $request->GL_29_shared_services;
                $gl->gl30_ss = $request->GL_30_shared_services;
                $company->save();
                $gl->save();

                return redirect()->route('companies')->with('message', 'Congratulations! Company has been added sucessfully');
            }

        }
    }
}
