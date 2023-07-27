<?php

namespace App\Http\Controllers;

use App\Models\assetlookup;
use App\Models\M_project;
use App\Models\project_user;
use App\Models\Role;
use App\Models\sidenavbar;
use App\Models\User;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user_id = auth()->user()->userID;
        // dd(auth()->user()->name);
        $role =auth()->user()->role;
        // session(['role' => 'test']);
        // dd(session('list_navbar'));
        $d['title'] = 'PROJECT LIST';
        $d['list_navbar'] = sidenavbar::where('sidenavbar_id','=','12')->get();
        // dd($d);
        // dd($d);
       return view('project.index',$d);
    }

    public function list_member($e_projectId)
    {
        //
        $d['e_project_id']=$e_projectId;
        $d['project_id']=$projectId = decrypt($e_projectId);
        // dd($e_projectId);
        $d['title'] = "Members";
        $d['members'] = M_project::select('user.name','role.role','user.userID')
        ->join('project_user', 'project.projectID', '=', 'project_user.projectID')
        ->join('user', 'project_user.userID', '=', 'user.userID')
        ->join('role', 'user.role_id', '=', 'role.role_id')
        ->where('project.projectID', '=', $projectId)
        ->paginate(3);
        $list = array(5,7,8,9,12);
        $d['list_navbar'] = sidenavbar::whereIn('sidenavbar_id',$list)->get();
       return view('project.senarai_member',$d);
    }

    

    public function read(User $user){


        
        $role =auth()->user()->role->role;
        // dd($role);
        if($role == 'Admin'){
            $data['model'] = M_project::all();
        }else{
            $data['model'] = $user->project(auth()->user()->userID);
        }
        // dd($data['model']);
        $data['project_status'] = assetlookup::where('category','project_status')->get();
        // dd($data);
        return view('project.senarai', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        return view('project.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // die();
  
        $validate = $request->validate([
            'project_name' => 'required',
            'project_framework' => 'required',
            'project_description' => 'required'
        ],[
            'project_name.required' => 'Please enter project name',
            'project_framework.required' => 'Please enter project framework',
            'project_description.required' => 'Please enter project description'
        ]);
        try {
            

            $project = M_project::create($validate);
            project_user::create([
                'projectID' => $project->projectID,
                'userID' => auth()->user()->userID
            ]);
            return redirect(route('newproject.index'))->withSuccess('Data successfully inserted');
        } catch (\Throwable $th) {

            dd($th);
            return back()->withError('Something when wrong!');
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
        // dd($id);
        $d['show'] = 0;
        $d['project'] = M_project::find($id);
        // $d['student2'] = Student::where(['student_religion'=> 'ISLAM'])->first();
        // $d['gender'] = BankStatusHelper::getGender();
        // dd($d);

        return view('project.edit',$d);
    }

    public function view($id)
    {
        // dd($id);
        $d['show'] = 1;
        $d['project'] = M_project::find($id);
        // $d['student2'] = Student::where(['student_religion'=> 'ISLAM'])->first();
        // $d['gender'] = BankStatusHelper::getGender();
        // dd($d);

        return view('project.edit',$d);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_all($id)
    {
        // dd($id);
        $d['show'] = 0;
        $d['project'] = M_project::where('projectID',$id)
        ->leftJoin('user as u', 'project.project_leader','=','u.userID')
        ->first();
        $d['user'] = User::all();
        // $d['student2'] = Student::where(['student_religion'=> 'ISLAM'])->first();
        // $d['gender'] = BankStatusHelper::getGender();
        // dd($d['project']);

        return view('project.edit',$d);
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
        // dd($request->all());
        // dd($id);
        $validate = $request->validate([
            'project_name' => 'required',
            'project_framework' => 'required',
            'project_description' => 'required'
        ],[
            'project_name.required' => 'Please enter project name',
            'project_framework.required' => 'Please enter project framework',
            'project_description.required' => 'Please enter project description'
        ]);
        try {
            // $data= M_project::findOrFail($id);
            // $data->project_name= $request->project_name;
            // $data->project_framework= $request->project_framework;
            // $data->project_description = $request->project_description;
            // $data->save();

            M_project::where('projectID', $id)->update([
                'project_name' => $request->project_name,
                'project_description' => $request->project_description,
                'project_framework' => $request->project_framework
            ]);
            // $project->update($validate);
            return redirect(route('newproject.index'))->withSuccess('Data successfully updated');
        } catch (\Throwable $th) {

            dd($th);
            return back()->withError('Something when wrong!');
        }
    }

    public function update_all(Request $request, $id)
    {
        // dd($request->all());
        // dd($id);
        $validate = $request->validate([
            'project_name' => 'required',
            'project_framework' => 'required',
            'project_description' => 'required',
            'client_company' => 'required',
            'project_leader' => 'required'
        ],[
            'project_name.required' => 'Please enter project name',
            'project_framework.required' => 'Please enter project framework',
            'project_description.required' => 'Please enter project description',
            'client_company.required' => 'Please Enter Client Company Name',
            'project_leader.required' => 'Please Choose Project Leader'
        ]);
        try {
            // $data= M_project::findOrFail($id);
            // $data->project_name= $request->project_name;
            // $data->project_framework= $request->project_framework;
            // $data->project_description = $request->project_description;
            // $data->save();

            M_project::where('projectID', $id)->update([
                'project_name' => $request->project_name,
                'project_description' => $request->project_description,
                'project_framework' => $request->project_framework,
                'client_company' => $request->client_company,
                'project_leader' => $request->project_leader
            ]);
            // $project->update($validate);
            return redirect(route('project_about',encrypt($id)))->withSuccess('Project successfully updated');
        } catch (\Throwable $th) {

            dd($th);
            return back()->withError('Something when wrong!');
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
        // dd($id);
        try{

            M_project::destroy($id);
            return redirect(route('newproject.index'))->withSuccess('Berjaya Kemaskini');

        }catch(\Throwable $th){

        }
    }

    public function remove_member(Request $request)
    {
        //
        // dd($request->all());
        try{

            project_user::where('userID',$request->user_id)->where('projectID',$request->project_id)->delete();
            return redirect(route('project.list_member', encrypt($request->project_id)))->withSuccess('User successfully removed');

        }catch(\Throwable $th){

        }
    }

    public function remove_member2(Request $request)
    {
        //
        // dd($request->all());
        try{

            project_user::where('userID',$request->user_id)->where('projectID',$request->project_id)->delete();
            return redirect(route('project_about', encrypt($request->project_id)))->withSuccess('User successfully removed');

        }catch(\Throwable $th){

        }
    }

    public function indexuser($id)
    {
        //

        $d['title'] = 'PROJECT LIST';
        $project = M_project::all();
        $project_id = array();

        foreach ($project as $item) {
            $user_id = json_decode($item->user_id);
            if($user_id){
                foreach ($user_id as $key => $item2) {
                    if($item2==$id){
                        array_push($project_id,$item->projectID);
                        
                    }
                }
            }
        }

        

        // dd($project_id);
        $d['user'] = User::where(['id' => $id])->get();
        // dd($d);
        $d['project']  = M_project::whereIn('projectID', $project_id)->get();
        // dd($d['project']);
       return view('project.index',$d);
    }

    public function readuser($user_id){
        // dd($user_id);
        $project = M_project::all();
        $project_id = array();

        foreach ($project as $item) {
            $all_user_id = json_decode($item->user_id);
            if($all_user_id){
                foreach ($all_user_id as $key => $item2) {
                    if($item2==$user_id){
                        array_push($project_id,$item->projectID);
                        
                    }
                }
            }
        }

        

        // dd($project_id);
        $d['model']  = M_project::whereIn('projectID', $project_id)->get();
        // dd($d['model']);
       return view('project.senarai',$d);
    }

    public function assign_project_form($project_id)
    {
        //
        $data['user'] = User::all();
        $data['project_id']= $project_id;
        // dd($data);
        return view('project.assign_project',$data);
    }

    public function assign_project_form2($project_id)
    {
        //
        $data['user'] = User::all();
        $data['project_id']= $project_id;
        // dd($data);
        return view('project.assign_project2',$data);
    }

    
    public function assign_member_action(Request $request)
    {
        try {

            project_user::insert([
                'projectID' => $request->project_id,
                'userID' => $request->user_id
            ]);
            return redirect(route('project.list_member',encrypt($request->project_id)))->withSuccess('New Member Successfully Assigned');
        } catch (\Throwable $th) {

            dd($th);
            return back()->withError('Something when wrong!');
        }
    }

    public function assign_member_action2(Request $request)
    {
        try {

            project_user::insert([
                'projectID' => $request->project_id,
                'userID' => $request->user_id
            ]);
            return redirect(route('project_about',encrypt($request->project_id)))->withSuccess('New Member Successfully Assigned');
        } catch (\Throwable $th) {

            dd($th);
            return back()->withError('Something when wrong!');
        }
    }


    public function project_about($e_project_id){

        $data['project_id'] = $project_id = decrypt($e_project_id);
        $data['e_project_id'] = $e_project_id;
        $data['project'] = M_project::select('project.projectID','project.project_name','project.project_leader','project.client_company','project.project_description','project.status','u.name',)
        ->where('projectID',$project_id)
        ->leftJoin('user as u','project.project_leader','=','u.userID')
        ->first();
        $list = array(5,7,8,9,12);
        $data['list_navbar'] = sidenavbar::whereIn('sidenavbar_id',$list)->get();


        
        $data['title'] = "Project About";
        $data['members'] = M_project::select('user.name','role.role','user.userID')
        ->join('project_user', 'project.projectID', '=', 'project_user.projectID')
        ->join('user', 'project_user.userID', '=', 'user.userID')
        ->join('role', 'user.role_id', '=', 'role.role_id')
        ->where('project.projectID', '=', $project_id)
        ->paginate(3);
        // dd($data);
        // $data = 1;
        return view('project.project_about',$data);
    }

    public function update_project_status($project_id)
    {

        try{
            $project = M_project::find($project_id);
            if($project->status == 'PS01'){
                $project->status = 'PS02';
            }else{
                $project->status = 'PS01';
            }

            // dd($project);
            $project->save();
            return redirect(route('project_about',encrypt($project_id)))->withSuccess('Project Status');
        }catch(\Throwable $th){
            dd($th);
            return back()->withError('Something when wrong!');
        }
    }
}
