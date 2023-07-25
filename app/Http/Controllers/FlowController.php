<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Flow;
use App\Models\Modul;
use App\Models\sidenavbar;
use App\Models\assetlookup;
use App\Models\project_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class FlowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $emodul_id, $e_projectId)
    {
        $d['e_project_id']=$e_projectId;
        $d['modul_id'] = decrypt($emodul_id);
        $d['flow_name']=$request->flow_name;
        $d['flow_owner']=$request->flow_owner;
        $list = array(1,5,2,3,4);
        $d['list_navbar'] = sidenavbar::whereIn('sidenavbar_id',$list)->get();
        // dd($d['modul_id']);

        return view('flow.index',$d);
    }

    public function read(Request $request, $modul_id, $flow_name, $flow_owner){
        // dd($modul_id);
        // dd(session()->pull('flow_name'));
        // if(session('flow_name')==null){
        //     dd('test');
        // }

        // dd(auth()->user()->role->role == 'Admin');

        $d['flow'] = Flow::where('flow.modul_id',$modul_id)
        ->filter(['flow.flow_name'=>$flow_name,'flow.flow_owner'=>$flow_owner])
        ->join('user','flow.user_id_owner' ,'=', 'user.userID')
        ->get();
        // dd($d['flow']);
        $d['modul_id'] = $modul_id;
        $module = Modul::find($modul_id)->get();
        $project_id = $module[0]->project_id;
        $d['e_project_id']  = encrypt($project_id);
        $d['list_member'] = project_user::where('project_user.projectID',$project_id)
        ->join('user','project_user.userID' ,'=', 'user.userID')
        ->get();
        $project_id = Modul::where('modul_id', $modul_id)->get();
        // dd($project_id[0]->project_id);
        $d['file'] = File::where('projectID',$project_id[0]->project_id)->get();
        // dd($d['file']);

        // $list= json_decode($d['flow'][1]->all_id);
        $l = array(
            0 => array(
                'id' => 2,
                'type' => 'function'
            ),
            1 => array(
                'id' => 1,
                'type' => 'file'
            ),
            2 => array(
                'id' => 2,
                'type' => 'file'
            ),
        );
        // dd(json_encode($l));
        // $d['list'] = $list;
        // dd($d);  

        return view('flow.list',$d);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($modul_id)
    {
        // dd($modul_id);
        $modul = Modul::where('modul_id', $modul_id)->get();
        $project_id = $modul[0]->project_id;
        $d['flow'] = null;
        // dd($project_id[0]->project_id);
        $d['modul_id'] = $modul_id;
        $d['e_project_id'] = encrypt($project_id);
        $d['all_file'] = File::where('projectID',$project_id)->get();
        $d['type_file'] = assetlookup::where(['category'=>'type of file'])->get();
        $d['controller'] = File::where(['file_type'=>'controller', 'projectID'=>$project_id])->get();
        $d['view'] = File::where(['file_type'=>'view', 'projectID'=>$project_id])->get();
        $d['model'] = File::where(['file_type'=>'model', 'projectID'=>$project_id])->get();
        $d['helper'] = File::where(['file_type'=>'helper', 'projectID'=>$project_id])->get();
        // dd($t);
        return view('flow.form2', $d);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->file_name);

        $dataencode = array();
        for ($y = 0; $y < count($request->file_id); $y++) {
            $dataencode[$y]['file_id'] = $request->file_id[$y];
            $dataencode[$y]['function_id'] = $request->function_id[$y];
            $dataencode[$y]['file_type'] = $request->file_type[$y];
        }
        $json = json_encode($dataencode);

        // dd($all_id);
        Flow::insert([
            'flow_name' => $request->flow_name,
            'flow_description' => $request->flow_description,
            'all_id' => $json,
            'modul_id' => $request->modul_id,
            'user_id_owner' => auth()->user()->userID
        ]);

        $d['modul_id'] = $request->modul_id;

        return redirect(route('flowindex', [encrypt($request->modul_id),encrypt($request->e_project_id)]))->withSuccess('Flow Created');
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
        $d['show'] = 1;
        $d['flow'] = $flow = Flow::find($id);
        // dd($d['flow']);
        // dd(json_decode($d['flow']->all_id, true));k

        // foreach (json_decode($d['flow']->all_id, true) as $item) {
        //     dd($item['type']);
        // }

        $modul_id = $flow->modul_id;
        $modul = Modul::where('modul_id', $modul_id)->get();
        $project_id = $modul[0]->project_id;
        // dd($project_id[0]->project_id);
        $d['modul_id'] = $modul_id;
        $d['all_file'] = File::where('projectID',$project_id)->get();
        $d['type_file'] = assetlookup::where(['category'=>'type of file'])->get();
        $d['controller'] = File::where(['file_type'=>'controller', 'projectID'=>$project_id])->get();
        $d['view'] = File::where(['file_type'=>'view', 'projectID'=>$project_id])->get();
        $d['model'] = File::where(['file_type'=>'model', 'projectID'=>$project_id])->get();
        $d['helper'] = File::where(['file_type'=>'helper', 'projectID'=>$project_id])->get();
        // dd($t);
        return view('flow.form2', $d);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         // dd($id);
         $d['edit'] = 1;
         $d['flow'] = $flow = Flow::find($id);
         $d['flow_id'] = $id;
        $test = json_decode($flow->all_id);
        //  dd($test);
        //  foreach($test as $item ){
        //     dd($item["type"]);
        //  }
         $modul_id = $flow->modul_id;
         $modul = Modul::where('modul_id', $modul_id)->get();
         $project_id = $modul[0]->project_id;
         // dd($project_id[0]->project_id);
         $d['modul_id'] = $modul_id;
         $d['all_file'] = File::where('projectID',$project_id)->get();
         $d['type_file'] = assetlookup::where(['category'=>'type of file'])->get();
         $d['controller'] = File::where(['file_type'=>'controller', 'projectID'=>$project_id])->get();
         $d['view'] = File::where(['file_type'=>'view', 'projectID'=>$project_id])->get();
         $d['model'] = File::where(['file_type'=>'model', 'projectID'=>$project_id])->get();
         $d['helper'] = File::where(['file_type'=>'helper', 'projectID'=>$project_id])->get();
         // dd($t);
         return view('flow.form2', $d);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request->all());

        $dataencode = array();
        for ($y = 0; $y < count($request->file_id); $y++) {
            $dataencode[$y]['file_id'] = $request->file_id[$y];
            $dataencode[$y]['function_id'] = $request->function_id[$y];
            $dataencode[$y]['file_type'] = $request->file_type[$y];
        }
        $json = json_encode($dataencode);

        Flow::where('flow_id', $request->flow_id)->update([
            'flow_name' => $request->flow_name,
            'flow_description' => $request->flow_description,
            'all_id' => $json,
            'modul_id' => $request->modul_id,
            // 'user_id_owner' => auth()->user()->userID
        ]);
        

        $d['modul_id'] = $request->modul_id;

        return redirect(route('flowindex', [encrypt($request->modul_id),encrypt($request->e_project_id)]))->withSuccess('Flow Created');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        // dd($request->all());
        try{

            Flow::destroy($id);
            return redirect(route('flow_senarai',$request->modul_id))->withSuccess('Berjaya Kemaskini');

        }catch(\Throwable $th){

        }
    }
}
