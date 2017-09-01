<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use App\Question;
use Session;
use Image;

class AnswerController extends Controller
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
        $answers = Answer::paginate(15);
        return view('admins/answer/index', [
            'answers' => $answers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $questions = Question::all();
        return view('admins/answer/create',[
            'questions' => $questions
        ]);
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
            'question_id' => 'required'
        ]);

        $a = new Answer();
        $a->title_th = $request->title_th;
        $a->title_en = $request->title_en;
        $a->question_id = $request->question_id;
        $a->save();

        Session::flash('success', 'เพิ่มคำตอบสำเร็จ');
        return redirect()->route('a.create');
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
        $a = Answer::find($id);
        $questions = Question::all();
        return view('admins/answer/edit', [
            'a' => $a,
            'questions' => $questions
        ]);
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
            'question_id' => 'required'
        ]);

        $a = Answer::find($id);
        $a->title_th = $request->title_th;
        $a->title_en = $request->title_en;
        $a->question_id = $request->question_id;
        $a->update();

        Session::flash('success', 'แก้ไขคำตอบสำเร็จ');
        return redirect()->route('a.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Answer::destroy($id);
        return json_encode(['success' => 'true']);
    }
}
