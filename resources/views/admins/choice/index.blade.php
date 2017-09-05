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
              <h3 class="box-title">Choice List</h3>
            </div>
            <div class="col-md-3">
              <a href="{{ route('c.create') }}" class="btn btn-primary"> Add new Choice</a>
            </div>
            <div class="col-md-7">
              <form action="" method="get">
                <div class="box-tools">
                  <div class="input-group input-group-sm">
                    <input type="text" name="search" class="form-control pull-right" placeholder="Search">
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <th>id</th>
                    <th>text th</th>
                    <th>text en</th>
                    <th>Action</th>
                  </tr>

                  @foreach ($choices as $choice)

                  <tr>
                    <td>{{$choice->id}}</td>
                    <td>{{$choice->title_th}}</td>
                    <td>{{$choice->title_en}}</td>
                    <td>
                      <a href="{{route('c.edit', $choice->id)}}" class="btn btn-default">Edit</a>
                      <button data-del-url="{{ route('c.destroy',$choice->id)}}" class="btn btn-danger del-btn" data-toggle="modal" data-target="#delConfirmModal">
                        Delete
                      </button>
                    </td>
                  </tr>

                  @endforeach

                </tbody>
              </table>
              <div class="text-center">
                {{ $choices->links() }}  
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
<!-- Modal -->
<div class="modal modal-danger" id="delConfirmModal" tabindex="-1" role="dialog" aria-labelledby="delConfirmModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">ยืนยันการดำเนินการ</h4>
      </div>
      <div class="modal-body">
        <p>ต้องการดำเนินการลย ใช่หรือไม่ ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left cancel-del" data-dismiss="modal">Close</button>
        <button data-url="" id="del-btn" class="btn btn-outline">ลบ</button>
      </div>
    </div>
  </div>
</div>
<!-- csrf-token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('js')

<script src="{{URL::asset('plugins/select2/select2.full.min.js')}}"></script>
<script src="{{URL::asset('plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<script>

$('.del-btn').on('click', function() {
  removeDelClass();
  $(this).addClass('del-clicked');
})

$(document).keyup(function(e) {
    if (e.keyCode == 27) { // escape key maps to keycode `27`
       removeDelClass() 
    }
});
$('.cancel-del').on('click', function() {
  removeDelClass();
})

var removeDelClass = function() {
  $('.del-btn').removeClass('del-clicked');
}

$('#delConfirmModal').on('shown.bs.modal', function () {

  var delUrl = $('.del-clicked').data('del-url');
  
  $('#del-btn').data('url',delUrl);
})

$('#del-btn').on('click', function(e) {
  e.preventDefault();
  var url = $(this).data('url');
  $.ajax({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: url,
    dataType: 'JSON',
    method: 'DELETE',
    success: function(res) {
      if(res.success == 'true') {
        $('.del-clicked').closest('tr').remove()
        $('#delConfirmModal').modal('toggle');
        alert('ลบคำถามสำเร็จแล้ว');
      }
    }
  });
})

</script>
@endsection