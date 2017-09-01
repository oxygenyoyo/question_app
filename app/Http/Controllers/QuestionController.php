<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Choice;
use App\Answer;
use App\Guest;
use App\Answer_users;
use Session;
use Image;

class QuestionController extends Controller
{
    function __construct() 
    {
        $this->middleware('auth', ['except' => 
            ['test', 'answer', 'show', 'finish_page', 'finish']
        ]);
    }

    public function finish(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);   
        
        $guest = Guest::find(Session::get('user_id'));
        $guest->email = $request->email;
        $guest->update();
        
        Session::forget('user_id');
        Session::forget('username');
        Session::forget('answer');
        Session::forget('score');
        return view('thankyou');
    }

    public function finish_page()
    {
        $score = (Session::get('score') > 0)?Session::get('score'):0;
        return view('finish', ['score' => $score]);
    }

    public function answer(Request $request, $lang, $question_id, $choice_id) 
    {
        if ( empty(Session::get('user_id'))) {
            return redirect()->route('q.show', [$lang, $question_id]);
        }
        // var_dump($lang, $question_id, $choice_id);die();
        $this->validate($request, [
            'answer' => 'required'
        ]);
        
        
        $is_correct = false;
        $c = Choice::find($choice_id);
        $isAnswerCorrectThenAddScore =  $c->answer_id == $request->answer;
        if ( $isAnswerCorrectThenAddScore ) {
            Session::put('score', Session::get('score') + 1);
            $is_correct = true;


            $au = new Answer_users();
            $au->question_id = $question_id;
            $au->answer = $request->answer;
            $au->choice_id = $choice_id;
            $au->is_correct = $is_correct;
            $au->user_id = Session::get('user_id');
            $au->save();

            // correct answer 
            if ( !empty(Session::get('answer'))) {
                $test = Session::get('answer');
                array_push($test, $c->answer_id);
                Session::put('answer', $test);
            } else {
                Session::put('answer', [$request->answer]);
            }
            

            // check has next question
            $answeredRows = Answer_users::where([
                'question_id' => $question_id,
                'user_id' => Session::get('user_id')
            ])->get();
            $answered = [];
            foreach($answeredRows as $answeredRow) {
                array_push($answered, $answeredRow->choice_id);
            }
            
            $nextChoice = Choice::where('question_id', $question_id)
            ->whereNotIn('id', $answered)
            ->orderBy('order', 'ASC')
            ->orderBy('id', 'ASC')
            ->first();
            
            

            if ( empty($nextChoice) ) {
                return redirect()->route('finish.page');
            } else {
                return redirect()->route('q.test',[$lang, $question_id, $nextChoice->id]);
            }
        } else {
            $au = new Answer_users();
            $au->question_id = $question_id;
            $au->answer = $request->answer;
            $au->choice_id = $choice_id;
            $au->is_correct = $is_correct;
            $au->user_id = Session::get('user_id');
            $au->save();

            $choice = Choice::where('id', $choice_id)->with('answer')->first();
            $question = Question::find($question_id);
            $answers = Answer::all();
            $score = (Session::get('score'))? Session::get('score'):0;
    
            if ($lang == 'th') {
                $hint = $choice->answer->title_th;
            } else {
                $hint = $choice->answer->title_en;
            }

            // check has next question
            $answeredRows = Answer_users::where([
                'question_id' => $question_id,
                'user_id' => Session::get('user_id')
            ])->get();
            $answered = [];
            foreach($answeredRows as $answeredRow) {
                array_push($answered, $answeredRow->choice_id);
            }
            
            $nextChoice = Choice::where('question_id', $question_id)
            ->whereNotIn('id', $answered)
            ->orderBy('order', 'ASC')
            ->orderBy('id', 'ASC')
            ->first();
            

            if ( empty($nextChoice) ) {
                return redirect()->route('finish.page');
            } else {
                return view('survey', [
                    'choice' => $choice,
                    'question' => $question,
                    'answers' => $answers,
                    'lang' => $lang,
                    'score' => $score,
                    'hint' => $hint,
                    'nextQuestion' => route('q.test',[$lang, $question_id, $nextChoice->id])
                ]);
            }
        }
    }

    public function test($lang, $question_id, $choice_id) 
    {
        // echo '<pre>';
        // print_r(Session::all());die();
        if ( empty( Session::get('user_id') ) ) {
            return redirect()->route('q.show', [$lang, $question_id]);
        }

        // if client do the test already then redirect to the last question
        $hasEverDoThisTestThenRedirectToLastQuestion = Answer_users::where([
            'question_id' => $question_id,
            'user_id' => Session::get('user_id'),
            'choice_id' => $choice_id
        ])->exists();

        if ( $hasEverDoThisTestThenRedirectToLastQuestion ) {
            $choice = Choice::where('id', $choice_id)->with('answer')->first();
            $question = Question::find($question_id);
            $answers = Answer::all();
            $score = (Session::get('score'))? Session::get('score'):0;
    
            if ($lang == 'th') {
                $hint = $choice->answer->title_th;
            } else {
                $hint = $choice->answer->title_en;
            }

            // check has next question
            $answeredRows = Answer_users::where([
                'question_id' => $question_id,
                'user_id' => Session::get('user_id')
            ])->get();
            $answered = [];
            foreach($answeredRows as $answeredRow) {
                array_push($answered, $answeredRow->choice_id);
            }
            
            $nextChoice = Choice::where('question_id', $question_id)
            ->whereNotIn('id', $answered)
            ->orderBy('order', 'ASC')
            ->orderBy('id', 'ASC')
            ->first();
            

            if ( empty($nextChoice) ) {
                return redirect()->route('finish.page');
            } else {
                return view('survey', [
                    'choice' => $choice,
                    'question' => $question,
                    'answers' => $answers,
                    'lang' => $lang,
                    'score' => $score,
                    'hint' => $hint,
                    'nextQuestion' => route('q.test',[$lang, $question_id, $nextChoice->id])
                ]);
            }
        }

        $choice = Choice::find($choice_id);
        $question = Question::find($question_id);
        $answers = Answer::all();
        $score = (Session::get('score'))? Session::get('score'):0;

        
        
        return view('survey', [
            'choice' => $choice,
            'question' => $question,
            'answers' => $answers,
            'lang' => $lang,
            'score' => $score
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::paginate(15);
        return view('admins/question/index', ['questions' => $questions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins/question/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           'title_th' => 'required',
           'title_en' => 'required',
           'background_color' => 'required',
           'cover_file' => 'required|max:8192|image|mimes:jpeg,png,jpg'
       ]);

       $rand = rand();
       $imageOriginalName = $rand . time();
       $ext = $request->cover_file->getClientOriginalExtension();

       Image::make($request->cover_file)
       ->orientate()
       ->save('uploads/' . $imageOriginalName. '.' . $ext);

        $q = new Question();
        $q->title_th = $request->title_th;
        $q->title_en = $request->title_en;
        $q->background_color = $request->background_color;
        $q->cover_name = $imageOriginalName;
        $q->cover_ext = $ext;
        $q->save();

        Session::flash('success', 'เพิ่มคำถามสำเร็จ');
        return redirect()->route('q.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($lang, $id)
    {
        
        // gen guest user
        if ( empty( Session::get('user_id') ) ) {
            $username = 'guest' . sha1(time());
            $g = new Guest();
            $g->name = $username;
            $g->save();
            
            Session::put('username' , $username);
            Session::put('user_id' , $g->id);
        } 
        
        echo 'Session: ' . Session::get('user_id');
        
        $question = Question::find($id);
        $choice = Choice::where('question_id', $question->id)
                    ->orderBy('order', 'ASC')
                    ->first();
        return view('test', [
            'question' => $question,
            'choice' => $choice,
            'lang' => $lang
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $q = Question::find($id);
        return view('admins/question/edit', ['q' => $q]);
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
        $this->validate($request, [
            'title_th' => 'required',
            'title_en' => 'required',
            'background_color' => 'required',
            'cover_file' => 'max:8192|image|mimes:jpeg,png,jpg'
        ]);

         $q = Question::find($id);
         
        if( $request->cover_file) 
        {
            $rand = rand();
            $imageOriginalName = $rand . time();
            $ext = $request->cover_file->getClientOriginalExtension();
     
            Image::make($request->cover_file)
            ->orientate()
            ->save('uploads/' . $imageOriginalName. '.' . $ext);
 
        } else {
            $imageOriginalName = $q->cover_name;
            $ext = $q->cover_ext;
        }

        $q->title_th = $request->title_th;
        $q->title_en = $request->title_en;
        $q->background_color = $request->background_color;
        $q->cover_name = $imageOriginalName;
        $q->cover_ext = $ext;
        $q->save();

        Session::flash('success', 'แก้ไขคำถามสำเร็จ');
        return redirect()->route('q.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Question::destroy($id);
        Session::flash('success', 'ลบชุดคำถามสำเร็จแล้ว');
        return json_encode(['success' => 'true']);
    }
}
