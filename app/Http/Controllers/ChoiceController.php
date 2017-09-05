<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Choice;
use App\Answer;
use App\Question;
use Session;
use Image;

class ChoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $c = Choice::paginate(15);
        
        return view('admins/choice/index', [
            'choices' => $c
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $answers = Answer::all();
        $questions = Question::all();
        return view('admins/choice/create', [
            'answers' => $answers,
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
            'answer_id' => 'required',
            'question_id' => 'required',
            'order' => 'required',
            'image_file' => 'required|max:8192|image|mimes:jpeg,png,jpg'
        ]);
 
        $rand = rand();
        $imageOriginalName = $rand . time();
        $ext = $request->image_file->getClientOriginalExtension();
 
        Image::make($request->image_file)
        ->orientate()
        ->save('uploads/' . $imageOriginalName. '.' . $ext);
 
         $c = new Choice();
         $c->title_th = $request->title_th;
         $c->title_en = $request->title_en;
         $c->answer_id = $request->answer_id;
         $c->question_id = $request->question_id;
         $c->order = $request->order;
         $c->image_name = $imageOriginalName;
         $c->ext = $ext;
         $c->save();
 
         Session::flash('success', 'เพิ่มตัวเลือกสำเร็จ');
         return redirect()->route('c.create');
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
        $c = Choice::find($id);
        $answers = Answer::all();
        $questions = Question::all();
        
        return view('admins/choice/edit', [
            'c' => $c,
            'answers' => $answers,
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
            'answer_id' => 'required',
            'question_id' => 'required',
            'order' => 'required',
            'image_file' => 'max:8192|image|mimes:jpeg,png,jpg'
        ]);

        $c = Choice::find($id);
        
        if( $request->image_file) 
        {
            $rand = rand();
            $imageOriginalName = $rand . time();
            $ext = $request->image_file->getClientOriginalExtension();
     
            Image::make($request->image_file)
            ->orientate()
            ->save('uploads/' . $imageOriginalName. '.' . $ext);
 
        } else {
            $imageOriginalName = $c->image_name;
            $ext = $c->ext;
        }
        
    
        
        $c->title_th = $request->title_th;
        $c->title_en = $request->title_en;
        $c->answer_id = $request->answer_id;
        $c->question_id = $request->question_id;
        $c->order = $request->order;
        $c->image_name = $imageOriginalName;
        $c->ext = $ext;
        $c->save();

        Session::flash('success', 'แก้ไขตัวเลือกสำเร็จ');
        return redirect()->route('c.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Choice::destroy($id);
        Session::flash('success', 'ลบคำถามสำเร็จแล้ว');
        return json_encode(['success' => 'true']);
    }
}
