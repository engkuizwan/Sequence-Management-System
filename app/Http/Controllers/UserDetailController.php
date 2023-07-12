<?php

namespace App\Http\Controllers;

use App\Models\userDetail;
use App\Models\assetlookup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$data['user_detail'] = userDetail::all();
        $data['user_role'] = assetlookup::where(['category'=>'user role'])->get();
        $data['user_detail'] = userDetail::filter(request(['name','user_email']))->paginate(10);
        return view('userdetail.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         $data['user_role'] = assetlookup::where(['category'=>'user role'])->get();
        // $data['user_detail'] = userDetail::filter(request(['name','user_email']))->paginate(10);
        return view('userdetail.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validate = $request->validate([
            'name'=>'required',
            'user_role'=>'required',
            'user_email'=>'required',
            'user_name'=>'required',
            'user_password'=>'required',
        ],[
            'name.required'=>' Name is required',
            'user_role.required'=>'required',
            'user_email.required'=>'required',
            'user_name.required'=>'required',
            'user_password.required'=>'required',
        ]);

        try{
            userDetail::create($validate);
            return redirect(route('userdetail.index'))->withSucces('Berjaya Kemaskini');
        }catch(\Throwable $th){
            return back()->withError('Something when wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\userDetail  $userDetail
     * @return \Illuminate\Http\Response
     */
    public function show($userDetail)
    {
        //
        $data['user_detail'] = userDetail::find($userDetail);
        return view('userdetail.show',$data);//pergike view >userdetail >show.blade.php
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\userDetail  $userDetail
     * @return \Illuminate\Http\Response
     */
    public function edit( $userDetail)
    {
        //
        $data['user_role'] = assetlookup::where(['category'=>'user role'])->get();
        $data['user_detail'] = userDetail::find($userDetail);
        return view('userdetail.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\userDetail  $userDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $userDetail)
    {
        //
        $validate = $request->validate([
            'name'=>'required',
            'user_role'=>'required',
            'user_email'=>'required',
            'user_name'=>'required',
            'user_password'=>'required',
        ],[
            'name.required'=>' Name is required',
            'user_role.required'=>'required',
            'user_email.required'=>'required',
            'user_name.required'=>'required',
            'user_password.required'=>'required',
        ]);

        try{
            //$userDetail->update($validate);
            $data=[
                'name' => $request->name,
                'user_role'=>$request->user_role,
                'user_email'=>$request->user_email,
                'user_name'=>$request->user_name,
                'user_password'=>$request->user_password,
            ];
            userDetail::where('id',$userDetail)->update($data);
            return redirect(route('userdetail.index'))->withSucces('Berjaya Kemaskini');
        }catch(\Throwable $th){
            return back()->withError('Something when wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\userDetail  $userDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy($userDetail)
    {
        //
        //dd("ayam");
        try{
            userDetail::where('userID',$userDetail)->delete();
            return redirect(route('userdetail.index'))->withSucces('Berjaya Kemaskini');
        }catch(\Throwable $th){
            return back()->withError('Something when wrong!');
        }

    }

    public function login(Request $request){
        $check = $request->all();
        dd($check);

        if(Auth()->user->role == 0){
            return redirect()->route('projectindex')->with('error','Account created successfully');
        }

        if(Auth()->user->role == 1){
            return redirect()->route('projectindex.admin')->with('error','Account created successfully');
        }


    }
}
