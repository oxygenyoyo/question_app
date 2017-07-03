@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                @if( $isFirstTime )
                    <div class="panel-heading">Click button below to start</div>
                    <div class="panel-body">
                        <p>
                            You can do the test once in time. 
                        </p>
                        <a href="{{route('start', ['th'])}}" class="btn btn-primary">START !</a>
                    </div>
                @else
                    <div class="panel-heading">Your Score: {{$point}} </div>
                    <div class="panel-body">
                        All question 
                        <ul>
                        @foreach($questions as $question)
                            <li><a href="{{route('test', ['th',$question->id])}}">{{$question->question_th}}</a></li>    
                        @endforeach
                        </ul>
                    </div>
                    @if ( $isFinish )
                    <div class="panel-body">
                        <a href="{{route('finish', ['th'])}}" class="btn btn-primary">Finish Survey</a>
                    </div>
                    @endif
                @endif
                
            </div>
        </div>
    </div>
</div>
@endsection
