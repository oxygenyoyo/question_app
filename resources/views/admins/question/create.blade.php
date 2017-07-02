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
            <h3 class="box-title">Create a new question</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" method="post" action="{{action('QuestionController@store')}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
            
            <div class="box-header with-border">
              <h3 class="box-title">Thai Section</h3>
            </div>
            
            <div class="box-header with-border">
              <div class="form-group">
                <label for="order">ลำดับของคำถาม</label>
                <input type="text" autofocus class="form-control" name="order" id="order" placeholder="">
              </div>
            </div>
            
            <div class="box-body">
              <div class="form-group">
                <label for="question_th">Question Thai</label>
                <input type="text" autofocus class="form-control" name="question_th" id="question_th" placeholder="">
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="choice1_th">Choice 1 Thai</label>
                <input type="text" class="form-control" name="choice1_th" id="choice1_th" placeholder="">
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="choice2_th">Choice 2 Thai</label>
                <input type="text" class="form-control" name="choice2_th" id="choice2_th" placeholder="">
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="choice3_th">Choice 3 Thai</label>
                <input type="text" class="form-control" name="choice3_th" id="choice3_th" placeholder="">
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="choice4_th">Choice 4 Thai</label>
                <input type="text" class="form-control" name="choice4_th" id="choice4_th" placeholder="">
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="answer_th">Awnser Thai (ใส่เป็นตัวเลข)</label>
                <input type="number" min="1" max="4" class="form-control" name="answer_th" id="answer_th" placeholder="">
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="description_th">Description Thai</label>
                <textarea class="form-control" rows="5" name="description_th" id="description_th" placeholder=""></textarea>
              </div>
              <!-- /.form-group --> 
            </div>
            <!-- /.box-body -->
          
            <div class="box-header with-border">
              <h3 class="box-title">English Section</h3>
            </div>
              
            
            <div class="box-body">
              <div class="form-group">
                <label for="question_en">Question English</label>
                <input type="text" autofocus class="form-control" name="question_en" id="question_en" placeholder="">
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="choice1_en">Choice 1 English</label>
                <input type="text" class="form-control" name="choice1_en" id="choice1_en" placeholder="">
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="choice2_en">Choice 2 English</label>
                <input type="text" class="form-control" name="choice2_en" id="choice2_en" placeholder="">
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="choice3_en">Choice 3 English</label>
                <input type="text" class="form-control" name="choice3_en" id="choice3_en" placeholder="">
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="choice4_en">Choice 4 English</label>
                <input type="text" class="form-control" name="choice4_en" id="choice4_en" placeholder="">
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="answer_en">Awnser English (ใส่เป็นตัวเลข)</label>
                <input type="text" class="form-control" name="answer_en" id="answer_en" placeholder="">
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="description_en">Description English</label>
                <textarea class="form-control" rows="5" name="description_en" id="description_en" placeholder=""></textarea>
              </div>
              <!-- /.form-group --> 
            </div>
            <!-- /.box-body -->

            <div class="box-header with-border">
              <h3 class="box-title">Vietnam Section</h3>
            </div>
              
            
            <div class="box-body">
              <div class="form-group">
                <label for="question_vn">Question Vietnam</label>
                <input type="text" autofocus class="form-control" name="question_vn" id="question_vn" placeholder="">
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="choice1_vn">Choice 1 Vietnam</label>
                <input type="text" class="form-control" name="choice1_vn" id="choice1_vn" placeholder="">
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="choice2_vn">Choice 2 Vietnam</label>
                <input type="text" class="form-control" name="choice2_vn" id="choice2_vn" placeholder="">
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="choice3_vn">Choice 3 Vietnam</label>
                <input type="text" class="form-control" name="choice3_vn" id="choice3_vn" placeholder="">
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="choice4_vn">Choice 4 Vietnam</label>
                <input type="text" class="form-control" name="choice4_vn" id="choice4_vn" placeholder="">
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="answer_vn">Awnser Vietnam (ใส่เป็นตัวเลข)</label>
                <input type="text" class="form-control" name="answer_vn" id="answer_vn" placeholder="">
              </div>
              <!-- /.form-group --> 
              <div class="form-group">
                <label for="description_vn">Description Vietnam</label>
                <textarea class="form-control" rows="5" name="description_vn" id="description_vn" placeholder=""></textarea>
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
