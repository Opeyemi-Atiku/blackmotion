<?php

namespace App\Http\Controllers;
use App\Question;
use App\User;
use App\Reply;
use App\Email;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
        $questions = Question::orderBy('created_at', 'DESC')->limit(12)->get();
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
        
        return view('welcome', compact('questions', 'ados', 'africa', 'arts', 'business', 'dating', 'education', 'music', 'parenting', 'travels', 'lifestyles', 'others', 'politics', 'marriage', 'work', 'entrepreneurship', 'sports', 'beauty', 'fashion'));
    }

    

    public function category($category) {
        $questions = Question::where('category', $category)->get();

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
        
        return view('pages.category', compact('questions', 'category', 'ados', 'africa', 'arts', 'business', 'dating', 'education', 'music', 'parenting', 'travels', 'lifestyles', 'others', 'politics', 'marriage', 'work', 'entrepreneurship', 'sports', 'beauty', 'fashion'));
    }

    public function user($id) {
        $user = User::where('id', $id)->get();
        $questions = Question::where('user_id', $id)->orderBy('created_at', 'DESC')->get();
        return view('pages.user', compact('user', 'questions'));
    }
    
    public function profile() {
        $questions = Question::where('user_id', Auth()->user()->id)->orderBy('created_at', 'DESC')->get();
        return view('pages.profile', compact('questions'));
    }

    public function edit_question(Request $request) {
        return $request->all();
    }

    public function edit_profile(Request $request) {
        

        if(!empty($request->profile_picture)) {
            $file = $request->profile_picture->getClientOriginalName();
            
            $filename_without_extension = pathinfo($file, PATHINFO_FILENAME);

            $extension = $request->profile_picture->getClientOriginalExtension();

            $filename_to_store = $filename_without_extension.'_'.time().'.'.$extension;

            $path = $request->profile_picture->move('profile_pictures/', $filename_to_store);


            User::where('id', Auth()->user()->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'profile_picture' => $filename_to_store
            ]);
        }
        else {
            User::where('id', Auth()->user()->id)->update([
                'name' => $request->name,
                'email' => $request->email
            ]);

            
        }

        return redirect('/home');



        
    }

    public function reply(Request $request) {
        Reply::create([
            'reply' => $request->reply,
            'user_id' => Auth()->user()->id,
            'question_id' => $request->question_id,
            'answer_id' => $request->answer_id
        ]);
        return redirect()->back();
    }

    public function newsletter($email) {
        $record = Email::where('email', $email)->get();
        if($record->count() < 1) {
            Email::create([
                "email" => $email
            ]);
            return "You've successfully subscribed for our newsletter";
        }
        else {
            return "You've already subscribed for our newsletter!!";
        }
            

        
    }

    public function contactUs() {
        return view('pages.contact');
    }

    public function contact(Request $request) {
       
        $to = "contact@blackmotion.com";
        $subject = $request->subject;
        $txt = $request->message;
        $headers = "From: ".$request->email."\r\n";

        if(mail($to,$subject,$txt,$headers)) {
            return redirect()->back()->with('status', 'We have received your messasge, we will get back to you shortly!');
        }
        
    }

    

}