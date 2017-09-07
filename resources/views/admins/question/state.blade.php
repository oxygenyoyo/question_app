@extends('admins/layout')


@section('css')
<link rel="stylesheet" href="{{URL::asset('plugins/timepicker/bootstrap-timepicker.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('plugins/select2/select2.min.css')}}">

@endsection

@section('content')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <div class="col-md-2">
              <h3 class="box-title">List</h3>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <th>Email</th>
                    <th>Score</th>
                  </tr>

                  @foreach ($aus as $au)

                  <tr>
                    <td>{{$au->guest->email}}</td>
                    <td>{{$au->question_id}}</td>
                  </tr>

                  @endforeach

                </tbody>
              </table>
              <div class="text-center">
                {{ $aus->links() }}  
              </div>
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.box -->
      </div>
    </div>
  </section>
</div>

<!-- csrf-token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

