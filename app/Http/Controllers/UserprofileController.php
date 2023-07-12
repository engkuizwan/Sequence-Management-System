<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\sidenavbar;
use App\Models\userDetail;
use App\Models\assetlookup;
use App\Models\Role;
use App\Models\userprofile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserprofileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //muka depan
    {
        //
        $data['user_detail'] = userDetail::find(1);//hardcode
        $data['user_role'] = assetlookup::where(['category'=>'user role'])->get();
        $data['disabled'] = "disabled";
        return view('userprofile.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user) //add
    {
        //
        // $data['disabled'] = " ";
        $data['role'] = Role::all();
        $data['user'] = $user->user_role();
        // dd($data['user']);
        $data['list_navbar'] = sidenavbar::where('sidenavbar_id','=','1')->get();
         return view('userprofile.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)// add action
    {
        // dd($request->all());
        //
        $validate = $request->validate([
            'name'=>'required',
            'role_id'=>'required',
            'user_email'=>'required',
            'user_name'=>'required',
            'user_password'=>'required',
        ],[
            'name.required'=>'required',
            'role_id.required'=>'required',
            'user_email.required'=>'required',
            'user_name.required'=>'required',
            'user_password.required'=>'required',
        ]);

        try{
            //userprofile::create($validate);
            User::create([
                'user_name'=>$request->user_name,
                'user_email'=>$request->user_email,
                'user_password'=> Hash::make($request->user_password),
                'name'=> $request->name,
                'role_id'=> $request->role_id,
            ]);
            return redirect(route('userprofile.create'))->withSuccess('User Successfully Created');
        }catch(\Throwable $th){
            dd($th);
            return back()->withError('Something when wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\userprofile  $userprofile
     * @return \Illuminate\Http\Response
     */
    
     public function profile(){
        $user_id = auth()->user()->userID;
        $d['user'] = User::find($user_id);
        $d['role'] = User::find($user_id)->role;
        // dd($d['role']);
        $d['project_status'] = assetlookup::where('category','project_status')->get();
        $d['project'] = User::find($user_id)->project($user_id);
        // $d['role'] = User::find($user_id)->role1($user_id);
        // dd($d['project']);
        $d['list_navbar'] = sidenavbar::where('sidenavbar_id','=','1')->get();
        return view('userprofile.profile', $d);
    }
/**
     * Display the specified resource.
     *
     * @param  \App\Models\userprofile  $userprofile
     * @return \Illuminate\Http\Response
     */
    public function show_profile($user_id){
        // dd('test');
        // $user_id = $user_id;
        $d['user'] = User::find($user_id);
        $d['project_status'] = assetlookup::where('category','project_status')->get();
        $d['project'] = User::find($user_id)->project($user_id);
        $d['role'] = User::find($user_id)->role1($user_id);
        // dd($d['project']);
        $d['list_navbar'] = sidenavbar::where('sidenavbar_id','=','1')->get();
        return view('userprofile.profile', $d);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\userprofile  $userprofile
     * @return \Illuminate\Http\Response
     */
    public function edit( $userprofile)
    {
        //
        $data['user_detail'] = userDetail::find($userprofile);
        //$data['disabled'] = " ";
        $data['user_role'] = assetlookup::where(['category'=>'user role'])->get();
        return view('userprofile.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\userprofile  $userprofile
     * @return \Illuminate\Http\Response
     */
    public function update_user(Request $request, $userprofile)
    {
        //dd
        dd($request->all());
        $validate = $request->validate([
            'name'=>'required',
            'user_email'=>'required',
            'user_name'=>'required'
            //'user_password'=>'required',
        ],[
            'name.required'=>' Name is required',
            'user_role.required'=>'required',
            'user_email.required'=>'required',
            'user_name.required'=>'required'
            // 'user_password.required'=>'required',
        ]);

        try{
            //$userDetail->update($validate);
            if($request->user_password){
                $data=[
                    'name' => $request->name,
                    'user_email'=>$request->user_email,
                    'user_name'=>$request->user_name,
                    'user_password'=> Hash::make($request->user_password),
                ];
            }else{
                $data=[
                    'name' => $request->name,
                    'user_email'=>$request->user_email,
                    'user_name'=>$request->user_name
                    // 'user_password'=> Hash::make($request->user_password),
                ];
            }
            User::where('userID',$userprofile)->update($data);
            return redirect(route('profile'))->withSuccess('User Details Updated');
        }catch(\Throwable $th){
            // dd($th);
            return back()->withError('Something when wrong!');
        }
    }

    public function saveToken(Request $request)
    {
        // dd($request->all());
        $userid = auth()->user()->userID;
        try{
            User::where('userID',$userid)->update(['device_token'=>$request->new_token]);
            return redirect(route('profile'))->withSuccess('Device Token Registred');
        }catch(\Throwable $th){
            dd($th);
            return back()->withError('Something when wrong!');
        };
    }

    public function sendNotification(Request $request)
    {
        $firebaseToken = User::find(auth()->user()->userID)->device_token;
        // $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();
        // dd($firebaseToken);
        $title = $request->notification_title??'Notification Testing';
        $body = $request->notification_body??'Successfully Send!';
        $SERVER_API_KEY = 'AAAA8Xl2TBM:APA91bGO31QIbfoOXYEWi8ShRhQCYzlCyWHn52Jv87iRSfAASpzMZTIWW0L5lbc2s0jS1HLW70Lvwi0TG6V2QPinfLLEKaNhdWJ3dgvjGvwxGbT5qnoNAJM_dhkwM8_aArUD1rDy4TSj';

        $data = [
            "to" => $firebaseToken,
            "notification" => [
                "title" => $title,
                "body" => $body,
                "content_available" => true,
                "priority" => "high",
            ]
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        // dd($response);
        // return redirect(route('profile'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\userprofile  $userprofile
     * @return \Illuminate\Http\Response
     */
    public function destroy(userprofile $userprofile)
    {
        //
    }
}
