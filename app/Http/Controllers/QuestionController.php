<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Choice;
use App\Answer;
use Session;
use Image;

class QuestionController extends Controller
{
    function __construct() 
    {
        $this->middleware('auth', ['except' => 'test']);
    }

    public function test($lang, $q_id, $choice_id) 
    {
        $choice = Choice::find($choice_id);
        $answers = Answer::all();
        return view('survey', [
            'choice' => $choice,
            'question_id' => $q_id,
            'answers' => $answers,
            'lang' => $lang
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
