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
            <h3 class="box-title">ลงทะเบียนเครื่อง Scaner ใหม่</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" method="post" action="{{action('ScanController@update', ['id' => $data->id])}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            {{ method_field('PUT') }}
            <div class="box-body">
              <div class="form-group">
                <label for="scan_id">หมายเลขเครื่อง</label>
                <input type="text" value="{{$data->scan_id}}" autofocus class="form-control" name="scan_id" id="scan_id" placeholder="">
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="scan_ip">IP ของเครื่อง</label>
                <input type="text" value="{{$data->scan_ip}}" class="form-control" name="scan_ip" id="scan_ip" placeholder="">
              </div>
              <!-- /.form-group --> 
              
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">แก้ไข scan</button>
            </div>
          </form>
        </div>
        <!-- /.box -->
      </div>
    </div>
  </section>
</div>

@endsection
