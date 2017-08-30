@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <form action="{{route('answer', [$lang, $question_id, $choice->id])}}" method="post">
          {{ csrf_field() }}
          <div class="panel-heading">
            <img style="max-width:100%;" src="{{URL::asset('uploads/' . $choice->image_name . '.' . $choice->ext)}}" alt="">
          </div>
          <!-- /.panel-heading -->
          <div class="panel-body">
            @foreach($answers->chunk(2) as $chunk) 
            <div class="form-group">
              @foreach($chunk as $answer)
                <div class="radio">
                  <label>
                  <input type="radio" name="answer" id="answer-{{$answer->id}}" value="{{$answer->id}}"> 
                    {{$answer->title_th}}
                  </label>
                </div>
              @endforeach
            </div>
            @endforeach
          </div>
          <!-- /.panel-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-lg btn-block btn-primary">ตอบ</button>
          </div>
          <!-- /.box-footer -->
          
          
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
