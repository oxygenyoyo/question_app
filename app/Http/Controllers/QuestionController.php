<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use Session;

class QuestionController extends Controller
{
    function __construct() 
    {
        $this->middleware('auth');
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
           'question_th' => 'required',
           'choice1_th' => 'required',
           'choice2_th' => 'required',
           'choice3_th' => 'required',
           'choice4_th' => 'required',
           'answer_th' => 'required',
           'description_th' => 'required',

           'question_en' => 'required',
           'choice1_en' => 'required',
           'choice2_en' => 'required',
           'choice3_en' => 'required',
           'choice4_en' => 'required',
           'answer_en' => 'required',
           'description_en' => 'required',

           'question_vn' => 'required',
           'choice1_vn' => 'required',
           'choice2_vn' => 'required',
           'choice3_vn' => 'required',
           'choice4_vn' => 'required',
           'answer_vn' => 'required',
           'description_vn' => 'required',

           'order' => 'required',


       ]);

        $q = new Question();
        $q->order = $request->order;
        $q->question_th = $request->question_th;
        $q->choice1_th = $request->choice1_th;
        $q->choice2_th = $request->choice2_th;
        $q->choice3_th = $request->choice3_th;
        $q->choice4_th = $request->choice4_th;
        $q->answer_th = $request->answer_th;
        $q->description_th = $request->description_th;
        $q->question_en = $request->question_en;
        $q->choice1_en = $request->choice1_en;
        $q->choice2_en = $request->choice2_en;
        $q->choice3_en = $request->choice3_en;
        $q->choice4_en = $request->choice4_en;
        $q->answer_en = $request->answer_en;
        $q->description_en = $request->description_en;
        $q->question_vn = $request->question_vn;
        $q->choice1_vn = $request->choice1_vn;
        $q->choice2_vn = $request->choice2_vn;
        $q->choice3_vn = $request->choice3_vn;
        $q->choice4_vn = $request->choice4_vn;
        $q->answer_vn = $request->answer_vn;
        $q->description_vn = $request->description_vn;
        $q->save();

        Session::flash('success', 'เพิ่มคำถามสำเร็จ');

        return redirect()->action('QuestionController@create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
    }
}
