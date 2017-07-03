@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <form action="{{route('answer', [$lang, $id])}}" method="post">
          {{ csrf_field() }}
          <div class="panel-heading">Q: {{$question->question_th}}</div>
          <div class="panel-body">
            @if( $didTest )
              คุณทำข้อนี้ไปแล้ว
      
            @else 
              <div class="radio">
                <label>
                  <input type="radio" name="answer" id="optionsRadios1" value="1">
                  {{$question->choice1_th}}
                </label>
              </div>
              <div class="radio">
                <label>
                  <input type="radio" name="answer" id="optionsRadios1" value="1">
                  {{$question->choice2_th}}
                </label>
              </div>
              <div class="radio">
                <label>
                  <input type="radio" name="answer" id="optionsRadios1" value="1">
                  {{$question->choice3_th}}
                </label>
              </div>
              <div class="radio">
                <label>
                  <input type="radio" name="answer" id="optionsRadios1" value="1">
                  {{$question->choice4_th}}
                </label>
              </div>
              <button type="submit" class="btn btn-primary">ตอบ</button>
            @endif
            
          </div>
          @if( $didTest )
            <div class="panel-body">
              {{$question->description_th}}
            </div>
          @endif
          <div class="panel-body">
            <a href="{{route('home')}}" class="btn btn-primary">กลับไปหน้าแรก</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
