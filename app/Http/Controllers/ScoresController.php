<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Interview;
use App\Models\InterviewsAnswer;
use Illuminate\Support\Facades\Validator;

class ScoresController extends Controller
{
    function index(){    
        $interviews = Interview::join('interviews_answers', function($join){ 
                        $join->on('interviews_answers.interview_id', '=', 'interviews.id'); 
                    })
                    ->join('users', function($join){  
                        $join->on('users.id', '=', 'interviews_answers.user_id');
                    })
                    ->select('interviews_answers.id as interviews_answers_id', 'interviews.*', 'interviews_answers.*','users.*')
                    ->latest('interviews.created_at')
                    ->paginate(5);
                    //  echo 'interview<pre>';print_r($interviews);exit;
        return view('admin.scores.index', compact('interviews'));  
    } 

    public function edit(Request $request,$interviews_answers_id)
    {     
        $interview = Interview::join('interviews_answers', function($join){ 
                        $join->on('interviews_answers.interview_id', '=', 'interviews.id'); 
                    })
                    ->join('users', function($join){  
                        $join->on('users.id', '=', 'interviews_answers.user_id');
                    })
                    ->where(['interviews_answers.id'=>$interviews_answers_id])
                    ->first();
                    // ->ddRawSql();
        // echo $interview_id.' == '.$user_id.'interview<pre>';print_r($interview);exit;
      
        return view('admin.scores.action', compact('interview','interviews_answers_id'));
    }

    public function update(Request $request,$InterviewsAnswerId)
    {
        // echo  $InterviewsAnswerId.' InterviewsAnswerId<pre>';print_r($request->all());exit;
        $request->validate([
            'score' => 'required|integer|max:10',
            'comment' => 'required|string|max:255'
        ]);
 
        InterviewsAnswer::where(['id'=> $InterviewsAnswerId])->update(['score' => $request->score,'comment' => $request->comment]); 
        return redirect()->route('/admin/scores')->with('success', 'Interview scores updated successfully.');
    }
     
}
