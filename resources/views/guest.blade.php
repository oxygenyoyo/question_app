@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Please, login before do the survey</div>
                <div class="panel-body">
                    <p>
                        You can register or login at the top right menu.
                    </p>
                    @if ( Auth::check() )
                    	<a href="{{route('home')}}" class="btn btn-primary">Do the survey</a>
                    @endif 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
