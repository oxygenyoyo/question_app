@extends('admins/layout')


@section('css')

<style>
  #show-time {
    display: inline-block;
  }
</style>
@endsection


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="treeview active">Dashboard</li>
    </ol>
    <div class="">
      <label for="">Date:</label> {{date('d-m-Y')}}  
    </div>
    
  </section>

  <section class="content">
  </section>
  <!-- /.section -->
</div>

  
@endsection

