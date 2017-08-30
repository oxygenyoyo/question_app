@extends('admins/layout')


@section('css')
<link rel="stylesheet" href="{{URL::asset('plugins/timepicker/bootstrap-timepicker.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('plugins/select2/select2.min.css')}}">
<!-- Bootstrap Color Picker -->
<link rel="stylesheet" href="{{URL::asset('plugins/colorpicker/bootstrap-colorpicker.min.css')}}">
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
          @if (Session::has('success'))
            <div class="box-body">
              <div class="callout callout-success">
                <h4><i class="icon fa fa-check"></i> สำเร็จ</h4>
                  <p> {!! Session::get('success') !!}</p>
              </div>
            </div>
          @endif
          @if (count($errors) > 0)
            <div class="box-body">
              <div class="callout callout-danger">
                <h4><i class="icon fa fa-ban"></i> เกิดข้อผิดพลาด</h4>
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach 
                  </ul>
              </div>
            </div>
          @endif
          <div class="box-header with-border">
            <h3 class="box-title">หน้าสร้างคำตอบ</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" method="post" action="{{route('a.store')}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="box-body">
              <div class="form-group">
                <label for="title_th">คำตอบภาษาไทย</label>
                <input type="text" autofocus class="form-control" name="title_th" id="title_th" placeholder="">
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="title_en">คำตอบภาษาอังกฤษ</label>
                <input type="text" class="form-control" name="title_en" id="title_en" placeholder="">
              </div>
              <!-- /.form-group --> 
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">สร้างคำถาม</button>
            </div>
          </form>
        </div>
        <!-- /.box -->
      </div>
    </div>
  </section>
</div>

@endsection

@section('js')
<script>
  $(function () {
    $(".my-colorpicker1").colorpicker();
  });
</script>
@endsection
