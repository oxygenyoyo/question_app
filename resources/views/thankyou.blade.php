@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
          <!-- /.panel-heading -->
          <div class="panel-heading">
            <h1>
              Congratulation your score is {{$score}}
            </h1>
            <h2>Thank you. you can do it again, if you want more score</h2>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
