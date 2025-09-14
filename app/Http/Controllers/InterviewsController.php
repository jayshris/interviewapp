<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Interview;

class InterviewsController extends Controller
{
    function index(){  
         $interviews = Interview::latest()->paginate(5);

        return view('admin.answers.index', compact('interviews'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);  
    }

    public function create()
    {
        return view('admin.interviews.action');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'questions' => 'required|string|max:255',
        ]);

        Interview::create($request->all());
        return redirect()->route('/admin/interviews')->with('success', 'Interviews created successfully.');
    }

    public function destroy(Request $request,$id)
    { 
        // $interview->delete();
        Interview::find($id)->delete();
        return redirect()->route('/admin/interviews')->with('success', 'Interviews deleted successfully.');
    }

    public function edit(Request $request,$id)
    {   
        $interview = Interview::find($id);
        // echo '<pre>';print_r($interview);exit;
        return view('admin.interviews.action', compact('interview'));
    }

    public function update(Request $request, Interview $interview)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'questions' => 'required|string|max:255',
        ]);

        $interview->update($request->all());

        return redirect()->route('/admin/interviews')->with('success', 'Interviews updated successfully.');
    }

}
