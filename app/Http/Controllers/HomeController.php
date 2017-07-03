<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UsersSurvay;
use App\Question;
use Auth;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'guest']);
    }

    public function guest() 
    {
        return view('guest');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('id', Auth::id())->first();   
        $isFirstTime = ( !empty($user->start_time) )? false : true;
        $isFinish = ( !empty($user->end_time) )? false : true;
        $questions = Question::all();
        $point = UsersSurvay::where([
                'user_id' => Auth::id(),
                'isCorrect' => true
            ])->count();
        return view('home', [
            'isFirstTime' => $isFirstTime,
            'questions' => $questions,
            'point' => $point,
            'isFinish' => $isFinish,
        ]);
    }

    public function start($lang)
    {
        $user = User::where('id', Auth::id())->update(['start_time' => date('Y-d-m H:i:s')]);

        $question = Question::orderBy('order','asc')->first();

        return redirect()->route('test', [$lang, $question->id]);
    }

    public function finish($lang)
    {
        $user = User::where('id', Auth::id())->update(['end_time' => date('Y-d-m H:i:s')]);

        

        return redirect()->route('home');
    }

    public function test($lang, $id) 
    {
        $didTest = UsersSurvay::where([
                                            'user_id' => Auth::id(),
                                            'question_id' => $id
                                            ])->count() > 0;
        $question = Question::where('id', $id)->first();

        return view('survey', [
            'didTest' => $didTest,
            'question' => $question,
            'lang' => $lang,
            'id' => $id,
        ]);
    }

    public function answer(Request $request, $lang, $id) 
    {
        $this->validate($request, [
            'answer' => 'required'
        ]);

        $question = Question::where('id', $id)->first();

        $isCorrect = ($question->answer == $request->answer)? true:false;

        $log = new UsersSurvay();
        $log->user_id = Auth::id();
        $log->question_id = $id;
        $log->isCorrect = $isCorrect;
        $log->save();

        return redirect()->route('test', [$lang, $id]);
    }
}
