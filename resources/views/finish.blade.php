@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <form action="{{route('finish')}}" method="post">
          {{ csrf_field() }}
          <!-- /.panel-heading -->
          <div class="panel-body">
            <h1>
              Congratulation your score is {{$score}}
            </h1>
            <div class="form-group">
                <label for="email">
                  @if( $lang == 'th')
                    กรุณาใส่อีเมล์ของคุณเพื่อโอกาสในการรับรางวัล
                  @else 
                    Please fill in your email for opportunity to gain a gift
                  @endif
                </label>
                <input type="text" class="form-control" name="email" id="email" placeholder="">
              </div>
              <!-- /.form-group --> 
          </div>
          <!-- /.panel-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-lg btn-block btn-primary">
              
              @if( $lang == 'th')
              ตอบ
              @else 
              Submit
              @endif
            </button>
          </div>
          <!-- /.box-footer -->
          
          
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
