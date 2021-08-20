<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users   =   User::where('type',2)->get(); //get user via team
        return view('team.list',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('team.add_team');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arrayCheck =  [
            'name'      => ['required', 'string', 'max:255'],
            'email'     => 'required|unique:users,email',
            'phone'     => 'required|numeric',
            'password'  => ['required', 'string', 'min:8','confirmed']
        ];
        $validator = Validator::make($request->all(), $arrayCheck);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        } else {

            $userdata   =   [
                'name'     => $request->name,
                'email'     => $request->email,
                'phone'     => $request->phone,
                'password'  => bcrypt($request->password),
                'type'      => '2', // 2 for team

            ];

            $User = User::create($userdata);
            if($User){
                return response()->json(['success' => true, 'message' =>'Team added successfully']);
            }else{
                return response()->json(['success' => false, 'message' =>'Error while adding team']);
            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user   =   User::where('id',$id)->first();
        return view('team.edit_team',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $arrayCheck =  [
            'name'      => ['required', 'string', 'max:255'],
            'email'     => 'required|unique:users,email,'.$id,
            'phone'     => 'required|numeric',
        ];
        if($request->password && !empty($request->password)){
            $arrayCheck['password']  = ['required', 'string', 'min:8','confirmed'];
        }
        $validator = Validator::make($request->all(), $arrayCheck);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        } else {

            $userdata   =   [
                'name'     => $request->name,
                'email'     => $request->email,
                'phone'     => $request->phone,

            ];
            if($request->password && !empty($request->password)){
                $userdata['password']  = bcrypt($request->password);
            }
            $User = User::updateOrCreate(['id' => $id],$userdata);
            if($User){
                return response()->json(['success' => true, 'message' =>'Team updated successfully']);
            }else{
                return response()->json(['success' => false, 'message' =>'Error while updating team']);
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
