<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Interview;
use App\Models\InterviewsAnswer;
use Illuminate\Support\Facades\Validator;

class AnswersController extends Controller
{ 
    function index(Request $request){  
        $user = $request->user()->id;
        $interviews = Interview::leftJoin('interviews_answers', function($join)use ($user) { 
                        $join->on('interviews_answers.interview_id', '=', 'interviews.id')
                        ->where('user_id', '=', $user);
                    }) 
                    ->select('interviews.*', 'interviews_answers.answer_audio_file')
                    ->latest('interviews.created_at')->paginate(5);
        //  echo 'interview<pre>';print_r($interviews);exit;            
        return view('admin.answers.index', compact('interviews'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);  
    }

    
    public function edit(Request $request,$id)
    {   
        $user = $request->user()->id;
        $interview = Interview::leftJoin('interviews_answers', function($join)use ($user) { 
                        $join->on('interviews_answers.interview_id', '=', 'interviews.id')
                        ->where('user_id', '=', $user);
                    }) 
                    ->where(['interviews.id'=>$id])
                    ->first();
                    //  echo 'interview<pre>';print_r($interview);exit;
        if(isset($interview->answer_audio_file)){
            return redirect()->route('/admin/answers')->with('danger', 'Answers already submitted.');
        }
        return view('admin.answers.action', compact('interview','id'));
    }

    public function update(Request $request,  $interview_id)
    {   
        $validator = Validator::make($request->all(), [
            'answer_audio_file' => 'required|mimes:mp3,mpeg|max:10240', // Max 10MB
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->hasFile('answer_audio_file')) { 
            if (isset($interview->answer_audio_file)) {
                Interview::delete('public/' . $interview->answer_audio_file);
            }
            $imagePath = $request->file('answer_audio_file')->store('answer_audio_files', 'public');
 
            if($imagePath){
                
                $interview['answer_audio_file'] = $imagePath;
                $interview['interview_id']= $interview_id;
                $interview['user_id'] = $request->user()->id;

                $InterviewsAnswer = InterviewsAnswer::where('interview_id', $interview_id)
                    ->where('user_id', $request->user()->id)
                    ->first();
                //   echo 'InterviewsAnswer<pre>';print_r($InterviewsAnswer);exit;
                if(isset($InterviewsAnswer->id)){ 
                    InterviewsAnswer::where(['id'=> $InterviewsAnswer->id,'user_id' => $request->user()->id])->update($interview); 
                }else{ 
                    InterviewsAnswer::create($interview); 
                } 
            }   
            
        } 

        return redirect()->route('/admin/answers')->with('success', 'Answers updated successfully.');

    }
}
