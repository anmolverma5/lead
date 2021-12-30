<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Lead;
use App\Models\Note;
use App\Http\Requests\NoteRequest;
use Illuminate\Support\Facades\DB;

class NotesController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        //print_R(auth()->user()->id);die;
         $data = Lead::with('source')->where(['status'=>'1','asign_to'=>auth()->user()->id])->get()->toArray();
         return view('notes.list')->with(['data'=>$data]);
    }

    
    public function create()
    {
        //
    }

    public function add($id)
    {
        $data =  Lead::where(['id'=>$id])->first();
        return view('notes.add')->with(['data'=>$data]);
    }

    
    public function store(NoteRequest $request)
    {
         $data = array(
            'user_id'=>auth()->user()->id,
            'lead_id'=>$request->lead_id,
            'reminder_date'=>$request->reminder_date,
            'reminder_for'=>$request->reminder_for,
            'feedback'=>$request->note,
        );

        Note::create($data);

        return Redirect::back()->with('success', 'Note Added Successfully.');
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {

        //$data =  Lead::where(['id'=>$id])->with('note')->first()->toArray();
       //dd($data['note']);
        $data =  Note::where(['id'=>$id])->first()->toArray();

        return view('notes.edit')->with(['data'=>$data]);
    }

    
    public function update(NoteRequest $request, $id)
    {
         $data = array(
            'reminder_date'=>$request->reminder_date,
            'reminder_for'=>$request->reminder_for,
            'feedback'=>$request->note,
        );

         Note::where('id', $id)->update($data);

        return Redirect::back()->with('success', 'Note Updated Successfully.');
    }

    
    public function destroy($id)
    {
        //
    }

    public function view($id)
    {

        $data =  Lead::where(['id'=>$id])->with('source')->with('notes')->first();
        return view('notes.view')->with(['data'=>$data]);
    }
    public function camp_assign_emp(){

        $data =  Lead::where(['asign_to'=>auth()->user()->id])->with('source')->select('*', DB::raw('COUNT(source_id) as totalLeads'))->groupBy('source_id')->get();
        return view('notes.camp_assign_emp')->with(['data'=>$data]);
    }
    public function view_camp($id){
        
        $data = Lead::with('source')->where(['status'=>'1','asign_to'=>auth()->user()->id,'source_id'=>$id])->get()->toArray();
        return view('notes.particular_camp_assign_emp')->with(['data'=>$data]);
    }

    
}
