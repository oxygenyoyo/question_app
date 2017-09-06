@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <form action="{{route('q.result', [$lang, $question->id, $choice->id])}}" method="post">
          {{ csrf_field() }}
          
          <div class="panel-heading">
            @isset($hint) 
              <div class="box-body">
                <div class="callout callout-danger">
                  <h4><i class="icon fa fa-ban"></i> 
                    @if( $lang == 'th')
                    เฉลย
                    @else 
                    The answer is
                    @endif
                  </h4>
                    <p>{{$hint}}</p>
                </div>
              </div>
            @endif
            <img style="max-width:100%;" src="{{URL::asset('uploads/' . $choice->image_name . '.' . $choice->ext)}}" alt="">
          </div>
          <!-- /.panel-heading -->
          <div class="panel-body">
            <p class="text-large">
            @if($lang == 'th')
              โปรดเลือกหนึ่งในพฤติกรรมต่อไปนี้ที่เกี่ยวข้องกับข้อความในภาพด้านบนมากที่สุด
            @else 
              Please select one of the following behavior items that matches with the caption in the picture.
            @endif
            </p>
            
            @foreach($answers->chunk(2) as $chunk) 
            <div class="form-group row">
              @foreach($chunk as $answer)
              <?php
              $disabled = false;
              if ( !empty(Session::get('answer')) ) {
                if (array_search( $answer->id, Session::get('answer')) !== false ) {
                  $disabled = true ;
                }
              }
              ?>
              <div class="col-md-6">
                <div class="radio">
                  <label>
                    @if ($disabled == false)
                      <input type="radio" name="answer" id="answer-{{$answer->id}}" value="{{$answer->id}}"> 
                    @endif
                    <span class="text-large">
                      @if($lang == 'th')
                        {{$answer->title_th}}
                      @else 
                        {{$answer->title_en}}
                      @endif
                    </span>
                  </label>
                </div>
              </div>
              @endforeach
            </div>
            @endforeach
          </div>
          <!-- /.panel-body -->
          <div class="box-footer">
            @isset($hint) 
              <a href="{{$nextQuestion}}" class="btn btn-lg btn-block btn-primary">
                @if($lang == 'th')
                  ไปทำข้อต่อไป
                @else 
                  Next question
                @endif
              </a>
            @else
              <button type="submit" class="btn btn-lg btn-block btn-primary">
                
                @if($lang == 'th')
                  ตอบ
                @else 
                  Answer
                @endif
              </button>
            @endisset
            
          </div>
          <!-- /.box-footer -->
          
          
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
