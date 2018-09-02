@extends('layouts.app')

@section('content-title', 'Unauthorized Person Alert')

@section('content')
<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
      <div class="panel-heading">!!!Alert!!!</div>

      <div class="panel-body alert alert-error">
        <h4>You are not Allowed to Perform this Action</h4>
      </div>
    </div>
  </div>
</div>
@endsection