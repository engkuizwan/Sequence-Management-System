<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use App\Models\M_Function;
use App\Models\sidenavbar;
use Illuminate\Http\Request;

class FunctionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($fileid="")
    {
        $d['file_id'] = $file_id = decrypt($fileid);
        $d['functionList'] = M_Function::getAllFunc($file_id);
        $file = File::where(['file_id' => $file_id])->first();

        $list = array(1);
        $d['list_navbar'] = sidenavbar::whereIn('sidenavbar_id',$list)->get();
        // $d['funcName'] = $file->file_name;
        // $d['title'] = "File " . $file->file_name;

        return view('function.senarai', $d);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $file_id = decrypt($_GET['id']);
        $d['file'] = File::where(['file_id' => $file_id])->first();
        $d['user'] = User::all()->pluck('name', 'userID');
        // dd($d['user']);
        $list = array(1);
        $d['list_navbar'] = sidenavbar::whereIn('sidenavbar_id',$list)->get();

        return view('function.create', $d);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'func_name'=>'required',
            'func_desc'=>'required',
            'user'=>'required',
            // 'role'=>'required',
            'file'=>'nullable',
            //'user_password'=>'required',
        ],[
            'func_name.required'=>' Function Name is required',
            'func_desc.required'=>' Function Description is required',
            'user.required'=>'User Name is required',
            // 'role.required'=>'Role is required',
            // 'file.required'=>'required',
            //'user_password.required'=>'required',
        ]);

        try{
            $file_id = $request->file;
            $data=[
                'function_name' => $request->func_name,
                'functionDesc' => $request->func_desc,
                'userID' => $request->user,
                // 'roleID'=>$request->role,
                'file_ID' => $request->file,
                //'user_password'=> Hash::make($request->user_password),
            ];
            $sql = M_Function::insert($data);
            return redirect(route('functionindex', encrypt($file_id)))->withSucces('Berjaya Kemaskini');
        }catch(\Throwable $th){
            return back()->withError('Something when wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Function  $function
     * @return \Illuminate\Http\Response
     */
    public function show($function)
    {
        $d['funcDetail'] = M_Function::getFunc($function);
        $d['user'] = User::all()->pluck('name', 'id');
        $d['disabled'] = "disabled";
        $list = array(1);
        $d['list_navbar'] = sidenavbar::whereIn('sidenavbar_id',$list)->get();

        return view('function.detail', $d);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Function  $function
     * @return \Illuminate\Http\Response
     */
    public function edit($function)
    {
        $d['funcDetail'] = M_Function::getFunc($function);
        $d['user'] = User::all()->pluck('name', 'userID');
        $list = array(1);
        $d['list_navbar'] = sidenavbar::whereIn('sidenavbar_id',$list)->get();

        return view('function.edit', $d);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Function  $function
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $function)
    {
        $validate = $request->validate([
            'func_name'=>'required',
            'func_desc' => 'required',
            'user'=>'required',
            // 'role'=>'required',
            'file'=>'nullable',
        ],[
            'func_name.required'=>' Function Name is required',
            'func_desc.required'=>' Function Description is required',
            'user.required'=>'User Name is required',
            // 'role.required'=>'Role is required',
            // 'file.required'=>'required',
        ]);

        try{
            $file_id = $request->file;
            $data=[
                'function_name' => $request->func_name,
                'functionDesc' => $request->func_desc,
                'userID'=>$request->user
                // 'file_ID'=>$request->file,
            ];
            $sql = M_Function::where('functionID',$function)->update($data);
            $user =  User::find(auth()->user()->userID);
            $title = 'Function Changed!';
            $body = $user->user_name.' just now update your function';
            $this->sendNotification($request->user, $title, $body);
            return redirect(route('functionindex', encrypt($file_id)))->withSuccess('Function updated');
        }catch(\Throwable $th){
            return back()->withError('Something when wrong!');
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Function  $function
     * @return \Illuminate\Http\Response
     */
    public function destroy(M_Function $function)
    {
        $file_id = $_POST['function_id'];
        try {
            $function->delete();
            return redirect(route('functionindex', encrypt($file_id)))->withSuccess('Function Deleted');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function sendNotification($user_id, $title, $body)
    {
        $user = User::find($user_id);
        // dd($user);
        $firebaseToken = User::find($user_id)->device_token;;
        // $firebaseToken2 = array(0=>($user->device_token));
        // dd($firebaseToken);
        // $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();
        
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
}
