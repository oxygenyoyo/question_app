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
            <h3 class="box-title">หน้าแก้ไขตัวเลือกคำถาม</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" enctype="multipart/form-data" method="post" action="{{route('c.update', $c->id)}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="PUT">
            <div class="box-body">
              <div class="form-group">
                <label for="title_th">คำถามภาษาไทย</label>
                <input value="{{$c->title_th}}" type="text" autofocus class="form-control" name="title_th" id="title_th" placeholder="">
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="title_en">คำถามภาษาอังกฤษ</label>
                <input value="{{$c->title_en}}" type="text" class="form-control" name="title_en" id="title_en" placeholder="">
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <div>
                  <p>รูปแสดงด้านล่างคือรูปปัจจุบัน ถ้าจะเปลี่ยนให้ upload รูปใหม่ ถ้าไม่เปลี่ยนปล่อยว่างไว้</p>
                  <img style="max-width:30%;" src="{{URL::asset('uploads/' . $c->image_name . '.' . $c->ext)}}" alt="">
                </div>
                <label for="image_file">ใส่รูปตัวเลือก คนตอบจะเห็นรูปนี้เพื่อเลือกคำตอบให้ตรง</label>
                <input type="file" id="image_file" name="image_file">
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="order">ลำดับของตัวเลือกในชุดคำถามเลขน้อยจะขึ้นก่อน ถ้าเลขเท่ากันจะนับอันไหนสร้างก่อน</label>
                <input value="{{$c->order}}" type="number" min="1" class="form-control" name="order" id="order" placeholder="">
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>เลือกชุดคำถามที่จะเอาตัวเลือกไปอยู่ในชุดคำถามนั้น</label>
                <select name="question_id" class="form-control">
                  @foreach($questions as $question)
                    <?php 
                      $checked = '';
                      if ($question->id == $c->question_id) {
                        $checked = ' selected ';
                      }
                    ?>
                    <option {{$checked}} value="{{$question->id}}">{{$question->title_th}} | {{$question->title_en}}</option>
                  @endforeach
                </select>
              </div>
              <!-- /.form-group -->  
              <div class="form-group">
                <label>เลือกคำตอบสำหรับคำถามนี้</label>
                <select name="answer_id" class="form-control">
                  @foreach($answers as $answer)
                    <?php 
                      $checked = '';
                      if ($answer->id == $c->answer_id) {
                        $checked = ' selected ';
                      }
                    ?>
                    <option {{$checked}} value="{{$answer->id}}">{{$answer->title_th}} | {{$answer->title_en}}</option>
                  @endforeach
                </select>
              </div>
              <!-- /.form-group --> 

            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">แก้ไขตัวเลือก</button>
            </div>
          </form>
        </div>
        <!-- /.box -->
      </div>
    </div>
  </section>
</div>

@endsection

