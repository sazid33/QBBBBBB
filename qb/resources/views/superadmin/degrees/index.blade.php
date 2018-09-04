@extends('layouts.app')

@section('content-title', 'Degrees')

@section('content')

<div class="">
    <div class="box">

        <div class="box-body">

            <table class ="table table-responsive">
                <thead>
                <tr>
                    <th>Name</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>

                <tbody>
                    @foreach($degrees as $degree)
                    <tr>
                    <td>{{$degree->name}}</td>
                    <td class="text-center">
                        <a href="#" class="btn btn-xs btn-success view" id="{{ $degree->id }}"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                        <a href="#" class="btn btn-xs btn-primary edit" id="{{ $degree->id }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                        <a href="#" class="btn btn-xs btn-danger delete" id="{{ $degree->id }}"><i class="glyphicon glyphicon-warning-sign"></i> Delete</a>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <div class="button" pull-right>
        <button type="button" class="btn btn-default">Update</button>
    </div>
        </br>
    <div class="button">
        <button type="button" class="btn btn-primary btn-med" data-toggle="modal" data-target="#ssModal-create">
        Add New Degree
        </button>
    </div>
  </div>

       <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="ssModal-create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add Degree</h4>
          </div>
          <div class="modal-body">
            
            <form action="{{ route('degrees.store') }}" method="POST">
            {{ csrf_field() }}
            <fieldset>
              <div class="form-group">
                <label>Enter Degree Name</label>
                <input class="form-control" placeholder="" name="name" type="text" autofocus value="{{ old('name') }}">
                @if ($errors->has('name'))
                <span class="help-block">{{ $errors->first('name') }}</span>
                @endif
              </div>
                
              <!-- Change this to a button or input when using this as a form -->
                <button type="submit" class="btn btn-med btn-success">Add Degree</button>
            </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>

  @endsection