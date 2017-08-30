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
            <h3 class="box-title">หน้าสร้างชุดคำถาม</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" enctype="multipart/form-data" method="post" action="{{route('q.store')}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
            
            <div class="box-body">
              <div class="form-group">
                <label for="title_th">ชื่อของชุดคำถาม</label>
                <input type="text" autofocus class="form-control" name="title_th" id="title_th" placeholder="">
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="title_en">ชื่อของชุดคำถามภาษาอังกฤษ</label>
                <input type="text" class="form-control" name="title_en" id="title_en" placeholder="">
              </div>
              <!-- /.form-group --> 
              <div class="row form-group">
                  <div class="col-md-6">
                    <label for="background_color">เลือกสีพื้นหลังของชุดคำถาม ถ้ารู้รหัสสีให้ใส่เองได้เลย หรือเลือกจากด้านขวามือเมื่อคลิกที่ช่อง</label>
                    <input type="text" class="form-control my-colorpicker1 colorpicker-element" name="background_color" id="background_color" placeholder="">  
                  </div>
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="cover_file">รูป cover จะแสดงเมื่อเข้าหน้าแรกของชุดคำถาม</label>
                <input type="file" id="cover_file" name="cover_file">
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
