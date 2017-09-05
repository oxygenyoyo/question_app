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
            <div class="form-group">
                <label for="email">Fill an email to get reward.</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="">
              </div>
              <!-- /.form-group --> 
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
