@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">
          @isset($hint) 
            <div class="box-body">
              <?php 
              $alert = 'callout-danger';
              $icon = 'ban';
              if ($is_correct) {
                $alert = 'callout-success';
                $icon = 'check';
              }
              ?>
              <div class="callout {{$alert}}">
                <h4><i class="icon fa fa-{{$icon}}"></i> 
                  @if( $lang == 'th')
                  เฉลย
                  @else 
                  The answer is
                  @endif
                </h4>
                  <p class="result-text">{{$hint}}</p>
              </div>
            </div>
          @endif
          <img style="max-width:100%;" src="{{URL::asset('uploads/' . $choice->image_name . '.' . $choice->ext)}}" alt="">
        </div>
        <!-- /.panel-heading -->
        <div class="box-footer">
          @isset($hint) 
            <a href="{{$nextQuestion}}" class="btn btn-lg btn-block btn-primary">
              @if($lang == 'th')
                ไปทำข้อต่อไป
              @else 
                Next question
              @endif
            </a>
          @endisset
          
        </div>
        <!-- /.box-footer -->
      </div>
    </div>
  </div>
</div>
@endsection
