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
    public function index($fileid="",$e_project_id)
    {
        $d['e_project_id']=$e_project_id;
        $d['file_id'] = $file_id = decrypt($fileid);
        $d['functionList'] = M_Function::getAllFunc($file_id);
        $file = File::where(['file_id' => $file_id])->first();
        // dd($file);

        $list = array(5,7,8,9,12);
        $d['list_navbar'] = sidenavbar::whereIn('sidenavbar_id',$list)->get();
        // $d['funcName'] = $file->file_name;
        // $d['title'] = "File " . $file->file_name;
        if($file->file_type == 'View'){
            $d['user'] = User::all()->pluck('name', 'userID');
            $d['file'] = $file = File::where(['file_id' => $file_id])->first();
            $d['funcDetail'] = M_Function::getview($file_id);
            // dd($d['funcDetail']);
            return view('function.create_view', $d);
        }else{
            return view('function.senarai', $d);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($file_id, $e_project_id)
    {
        $file_id = decrypt($file_id);
        $d['e_project_id']=$e_project_id;
        $d['file'] = File::where(['file_id' => $file_id])->first();
        $d['user'] = User::all()->pluck('name', 'userID');
        // dd($d['user']);
        $list = array(12);
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
        // dd($request->all());
        $validate = $request->validate([
            'func_name'=>'required',
            'func_desc'=>'required',
            'user'=>'required',
            'source_code'=>'required',
            // 'role'=>'required',
            'file'=>'nullable',
            //'user_password'=>'required',
        ],[
            'func_name.required'=>' Function Name is required',
            'func_desc.required'=>' Function Description is required',
            'user.required'=>'User Name is required',
            'source_code.required'=>'Source Code is required',
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
                'source_code' => $request->source_code,
                //'user_password'=> Hash::make($request->user_password),
            ];
            $sql = M_Function::insert($data);
            return redirect(route('functionindex', ['fileId' => encrypt($file_id), 'e_project_id' => $request->e_project_id]))->withSucces('Berjaya Kemaskini');
        }catch(\Throwable $th){
            dd($th);
            return back()->withError('Something when wrong!');
        }
    }

    
    public function store_view(Request $request)
    {
        // dd($request->all());
        $validate = $request->validate([
            'func_desc'=>'required',
            'user'=>'required',
            'source_code'=>'required',
            // 'role'=>'required',
            'file'=>'nullable',
            //'user_password'=>'required',
        ],[
            'func_desc.required'=>' Function Description is required',
            'user.required'=>'User Name is required',
            'source_code.required'=>'Source Code is required',
            // 'role.required'=>'Role is required',
            // 'file.required'=>'required',
            //'user_password.required'=>'required',
        ]);

        try{
            $file_id = $request->file;
            $data=[
                'functionDesc' => $request->func_desc,
                'userID' => $request->user,
                // 'roleID'=>$request->role,
                'file_ID' => $request->file,
                'source_code' => $request->source_code,
                //'user_password'=> Hash::make($request->user_password),
            ];
            $sql = M_Function::insert($data);
            return redirect(route('functionindex', ['fileId' => encrypt($file_id), 'e_project_id' => $request->e_project_id]))->withSucces('View Detail Inserted');
        }catch(\Throwable $th){
            dd($th);
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
        $list = array(12);
        $d['list_navbar'] = sidenavbar::whereIn('sidenavbar_id',$list)->get();

        return view('function.detail', $d);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Function  $function
     * @return \Illuminate\Http\Response
     */
    public function edit($function, $e_project_id)
    {
        $d['funcDetail'] = M_Function::getFunc($function);
        $d['e_project_id'] = $e_project_id;
        // dd($d['funcDetail']);
        $d['user'] = User::all()->pluck('name', 'userID');
        $list = array(12);
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
            'func_desc'=>'required',
            'user'=>'required',
            'source_code'=>'required',
            // 'role'=>'required',
            'file'=>'nullable',
            //'user_password'=>'required',
        ],[
            'func_name.required'=>' Function Name is required',
            'func_desc.required'=>' Function Description is required',
            'user.required'=>'User Name is required',
            'source_code.required'=>'Source Code is required',
            // 'role.required'=>'Role is required',
            // 'file.required'=>'required',
            //'user_password.required'=>'required',
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
            
            //****************send_notification*************** */
            $func_detail= M_Function::getview($file_id);
            // dd(auth()->user()->userID,$func_detail->userID);
            if(auth()->user()->userID != $func_detail->userID){
                $user =  User::find(auth()->user()->userID);
                $title = 'Function Changed!';
                $body = $user->user_name.' just now update your function';
                $this->sendNotification($request->user);
            }
            return redirect(route('functionindex', ['fileId' => encrypt($file_id), 'e_project_id' => $request->e_project_id]))->withSucces('Function updated');
            // return redirect(route('functionindex', encrypt($file_id)))->withSuccess('Function updated');
        }catch(\Throwable $th){
            return back()->withError('Something when wrong!');
            
        }
    }



    public function update_view(Request $request)
    {
        // dd($request->all());
        $validate = $request->validate([
            'func_desc'=>'required',
            'user'=>'required',
            'source_code'=>'required',
            // 'role'=>'required',
            'file'=>'nullable',
            //'user_password'=>'required',
        ],[
            'func_desc.required'=>' Function Description is required',
            'user.required'=>'User Name is required',
            'source_code.required'=>'Source Code is required',
            // 'role.required'=>'Role is required',
            // 'file.required'=>'required',
            //'user_password.required'=>'required',
        ]);

        try{
            $file_id = $request->file;
            $data=[
                'function_name' => $request->func_name,
                'functionDesc' => $request->func_desc,
                'userID'=>$request->user
                // 'file_ID'=>$request->file,
            ];
            $sql = M_Function::where('functionID',$request->function_id)->update($data);


            //****************send_notification*************** */
            $func_detail= M_Function::getview($file_id);
            // dd(auth()->user()->userID,$func_detail->userID);
            if(auth()->user()->userID != $func_detail->userID){
                $user =  User::find(auth()->user()->userID);
                $title = 'Function Changed!';
                $body = $user->user_name.' just now update your function';
                $this->sendNotification($request->user);
            }



            return redirect(route('functionindex', ['fileId' => encrypt($file_id), 'e_project_id' => $request->e_project_id]))->withSucces('Function updated');
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
    public function destroy(Request $request, M_Function $function)
    {
        // dd($request->all());
        $file_id = $request->file_id;
        $e_project_id = $request->e_project_id;
        try {
            $function->delete();
            return redirect(route('functionindex', ['fileId' => encrypt($file_id), 'e_project_id' => $e_project_id]))->withSucces('Function Deleted');
            return redirect(route('functionindex', encrypt($file_id)))->withSuccess('Function Deleted');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function sendNotification1($user_id, $title, $body)
    {
        $user = User::find($user_id);
        // dd($user);
        $firebaseToken = json_decode(User::find(auth()->user()->userID)->all_token) ;
        // $firebaseToken2 = array(0=>($user->device_token));
        // dd($firebaseToken);
        // $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();
        
        $SERVER_API_KEY = 'AAAA8Xl2TBM:APA91bGO31QIbfoOXYEWi8ShRhQCYzlCyWHn52Jv87iRSfAASpzMZTIWW0L5lbc2s0jS1HLW70Lvwi0TG6V2QPinfLLEKaNhdWJ3dgvjGvwxGbT5qnoNAJM_dhkwM8_aArUD1rDy4TSj';

        $data = [
            "registration_ids" =>$firebaseToken,
            "notification" => [
                "title" => $title,
                "body" => $body,
                "content_available" => true,
                "priority" => "high",
                "icon"=> asset('alert.png')
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

        dd($response);
        // return redirect(route('profile'));
    }

    public function sendNotification($user_id)
    {
        $user = User::find($user_id);
        $firebaseToken = json_decode(User::find($user_id)->all_token) ;
        // $firebaseToken2 = ["f4UYoTlnJv8MIql_pbmDIW:APA91bG3_q7-VaCNn_TkvpZim91tZEYxiqcmIg-lZ4hhMTjxIdsDoB7-_d6H8FrpghCIpQ4t1R2mQbVpTk3Waa4mtdG5xMQ5-oA6mfgrENM6JvxLDF94iNWN9zI2TLyUZt2EbJcloCLr", "fIpzTcLjhxxi_FM-bqlXGp:APA91bEXGJgziAZmeS3a5UO862--Ia8Jf259v8fxU9Pz4SoSUDcIOxZTytfBtK5qxDXOkivaUWpTRHRFrPvyNRP626IoIxuVbr4zq6yUep5YnxlU61frgWx-HGbBx9bNi6GlD3dBiD0z"];
        // $all_array = array($firebaseToken, $firebaseToken2);
        // dd($all_array);
        // $firebaseToken = {"0"} "['f4UYoTlnJv8MIql_pbmDIW:APA91bG3_q7-VaCNn_TkvpZim91tZEYxiqcmIg-lZ4hhMTjxIdsDoB7-_d6H8FrpghCIpQ4t1R2mQbVpTk3Waa4mtdG5xMQ5-oA6mfgrENM6JvxLDF94iNWN9zI2TLyUZt2EbJcloCLr']";
        // dd($firebaseToken);
        foreach($firebaseToken as $token){
            // dd($token);
            $title = 'Function Changed!';
                $body = $user->user_name.' just now update your function';
            $SERVER_API_KEY = 'AAAA8Xl2TBM:APA91bGO31QIbfoOXYEWi8ShRhQCYzlCyWHn52Jv87iRSfAASpzMZTIWW0L5lbc2s0jS1HLW70Lvwi0TG6V2QPinfLLEKaNhdWJ3dgvjGvwxGbT5qnoNAJM_dhkwM8_aArUD1rDy4TSj';
    
            $data = [
                // "registration_ids" =>$firebaseToken,
                "to" => $token,
                "notification" => [
                    "title" => $title,
                    "body" => $body,
                    "content_available" => true,
                    "priority" => "high",
                    "icon"=> asset('alert.png')
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
        }
       

        // dd($response);
        // return redirect(route('profile'));
    }

    public function getfunction($file_id){

        $all_function = M_Function::where('file_ID',$file_id)->get();
        // dd($all_function);
        return response()->json([
            'data_function' => $all_function
        ]);

    }

    
    public function getfunction_detail($function_id){

        $function = M_Function::where('function.functionID',$function_id)
        ->join('file as f', 'function.file_ID','=','f.file_ID')
        ->first();
        // dd($all_function);
        return response()->json([
            'data_function' => $function
        ]);

    }
    
    public function getfunction_detail_byfile($file_id){

        $function = M_Function::where('function.file_ID',$file_id)
        ->join('file as f', 'function.file_ID','=','f.file_ID')
        ->first();
        // dd($all_function);
        return response()->json([
            'data_function' => $function
        ]);

    }
}
