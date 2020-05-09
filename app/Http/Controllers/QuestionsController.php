<?php

namespace App\Http\Controllers;
use App\Question;
use App\Answer;

use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public function create_question(Request $request) {
        
        
        $short_link = "";
        if(!empty($request->link) AND !empty($request->type)) {
            $link_array = explode(' ', $request->link);
            if($request->type == 'youtube') {
                if(count($link_array) > 2) {
                    $raw_link = $link_array[3];
                    $short_link = str_replace('"', "", str_replace('src="', "", $raw_link));
                }
                else {
                    
                    return redirect()->back()->with('status', "Invalid embed code!!. Input a valid embed code and choose the correct video source.");
                }
                    
            }

            else {
               
                if(count($link_array) > 1) {
                    $raw_link = $link_array[1];
                    $short_link = str_replace('"', "", str_replace('src="', "", $raw_link));
                }
                else {
                    return redirect()->back()->with('status', "Invalid embed code!!. Input a valid embed code and choose the correct video source.");
                }
                
            }
        }
            

        
        $a = str_replace('src="', " ", $short_link);
        str_replace('"', ' ', $a);
        $short_link = $a;

        $rejects = ['kill', 'faggot', 'nigger', 'nigga'];
        $question = str_replace($rejects, '', $request->question);


        
        

        Question::create([
            "question" => $question,
            "link" => $short_link,
            "type" => $request->type,
            "user_id" => Auth()->user()->id,
            "name" => Auth()->user()->name,
            "category" => $request->category
        ]);
        
        return redirect('/home');
    }

    public function question($id) {
        $question = Question::where('id', $id)->get();
        $more = Question::where('user_id', $question[0]->user_id)->where("id", "!=", $question[0]->id)->get();

 
        
        return view('pages.question', compact('question', 'more'));
    }

    public function questions() {
        
        $questions = Question::orderBy('created_at', 'DESC')->paginate(8);
        $ados = Question::where('category', 'ados')->get();
        $africa = Question::where('category', 'africa')->get();
        $arts = Question::where('category', 'arts and expression')->get();
        $business = Question::where('category', 'business')->get();
        $dating = Question::where('category', 'dating and relationship')->get();
        $education = Question::where('category', 'education')->get();
        $music = Question::where('category', 'music')->get();
        $parenting = Question::where('category', 'parenting')->get();
        $travels = Question::where('category', 'travels')->get();
        $lifestyles = Question::where('category', 'lifestyles')->get();
        $others = Question::where('category', 'others')->get();

        $politics = Question::where('category', 'politics')->get();
        $marriage = Question::where('category', 'marriage')->get();
        $work = Question::where('category', 'work')->get();
        $entrepreneurship = Question::where('category', 'entrepreneurship')->get();
        $sports = Question::where('category', 'sports')->get();
        $beauty = Question::where('category', 'beauty')->get();
        $fashion = Question::where('category', 'fashion')->get();

        return view('pages.questions',compact('questions', 'ados', 'africa', 'arts', 'business', 'dating', 'education', 'music', 'parenting', 'travels', 'lifestyles', 'others', 'politics', 'marriage', 'work', 'entrepreneurship', 'sports', 'beauty', 'fashion'));
    }

    public function edit_question(Request $request) {
        
        $short_link = "";
        $link_array = explode(' ', $request->link);
        if(count($link_array) > 1) {
            if($request->type == 'youtube') {
                if(count($link_array) > 2) {
                    $raw_link = $link_array[3];
                    $short_link = str_replace('"', "", str_replace('src="', "", $raw_link));
                }
                else {
                    
                    return redirect()->back()->with('status', "Invalid embed code!!. Input a valid embed code and choose the correct video source.");
                }
            }

            else {
                if(count($link_array) > 1) {
                    $raw_link = $link_array[1];
                    $short_link = str_replace('"', "", str_replace('src="', "", $raw_link));
                }
                else {
                    return redirect()->back()->with('status', "Invalid embed code!!. Input a valid embed code and choose the correct video source.");
                }
                
            }
        }
        else {
            $short_link = $request->link;
        }
            
        

        if(Question::where('id', $request->question_id)->update([
            "question" => $request->question,
            "link" => $short_link,
            "type" => $request->type,
            "user_id" => Auth()->user()->id,
            "category" => $request->category
        ])) {
            return redirect('/home');
        }
        
    }

    public function delete_question($id) {
        Reply::where('question_id', $id)->delete();
        Answer::where('question_id', $id)->first();
        Question::where('id', $id)->delete();
        return redirect('/home');
    }

    public function answer(Request $request) {

        $short_link = "";
        if(!empty($request->link) AND !empty($request->type)) {
            $link_array = explode(' ', $request->link);
            if(count($link_array) > 2) {
                if($request->type == 'youtube') {
                    $raw_link = $link_array[3];
                    $short_link = str_replace('"', "", str_replace('src="', "", $raw_link));
                }

                else {
                    

                    $raw_link = $link_array[1];
                    $short_link = str_replace('"', "", str_replace('src="', "", $raw_link));
                }

            }
            else {
                return redirect()->back()->with('status', "Invalid embed code!!. Input a valid embed code and choose the correct video source.");
            }
        }
            


        $rejects = ['kill', 'faggot', 'nigger', 'nigga'];
        $answer = str_replace($rejects, '', $request->answer);

        Answer::create([
            'answer' => $answer,
            'question_id' => $request->question_id,
            'user_id' => auth()->user()->id,
            'link' => $short_link,
            'type' => $request->type
        ]);

        return redirect('/question/'.$request->question_id);
    }

    public function search(Request $request) {
        
        

        if(empty($request->type) OR $request->type == 'topic') {
            $questions = Question::where('question', 'LIKE', '%'.$request->search.'%')->get();
        }
        else {
            $questions = Question::where('name', 'LIKE', '%'.$request->search.'%')->get();
        }

        
        

        
        $ados = Question::where('category', 'ados')->get();
        $africa = Question::where('category', 'africa')->get();
        $arts = Question::where('category', 'arts and expression')->get();
        $business = Question::where('category', 'business')->get();
        $dating = Question::where('category', 'dating and relationship')->get();
        $education = Question::where('category', 'education')->get();
        $music = Question::where('category', 'music')->get();
        $parenting = Question::where('category', 'parenting')->get();
        $travels = Question::where('category', 'travels')->get();
        $lifestyles = Question::where('category', 'lifestyles')->get();
        $others = Question::where('category', 'others')->get();
        $politics = Question::where('category', 'politics')->get();
        $marriage = Question::where('category', 'marriage')->get();
        $work = Question::where('category', 'work')->get();
        $entrepreneurship = Question::where('category', 'entrepreneurship')->get();
        $sports = Question::where('category', 'sports')->get();
        $beauty = Question::where('category', 'beauty')->get();
        $fashion = Question::where('category', 'fashion')->get();

        return view('pages.results',compact('questions', 'ados', 'africa', 'arts', 'business', 'dating', 'education', 'music', 'parenting', 'travels', 'lifestyles', 'others', 'politics', 'marriage', 'work', 'entrepreneurship', 'sports', 'beauty', 'fashion'));
        
    }
}