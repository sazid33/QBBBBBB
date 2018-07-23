@extends('layouts.app')

@section('content-title', 'User Roles')

@section('content')

<div class="">
    <div class="box">
        <div class="box-body">

            <table class ="table table-responsive">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                </tr>
                </thead>

                <tbody>
                    @foreach($roles as $role)
                    <tr>
                    <td>{{$role->name}}</td>
                    <td>{{$role->description}}</td>
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
        <button type="button" class="btn btn-primary btn-med" data-toggle="modal" data-target="#ssModal">
        Add New Role
        </button>
    </div>
  </div>


    <div class="modal fade" id="ssModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add Role</h4>
          </div>
          <div class="modal-body">
            
            <form action="{{ route('roles.store') }}" method="POST">
            {{ csrf_field() }}
            <fieldset>
              <div class="form-group">
                <label>Enter Role Name</label>
                <input class="form-control" placeholder="Role Name" name="name" type="text" autofocus value="{{ old('name') }}">
                @if ($errors->has('name'))
                <span class="help-block">{{ $errors->first('name') }}</span>
                @endif
              </div>

              <div class="form-group">
                <label>Enter Description</label>
                <input class="form-control" placeholder="Description" name="description" type="text">
                @if ($errors->has('description'))
                <span class="help-block">{{ $errors->first('description') }}</span>
                @endif
              </div>
                
              <!-- Change this to a button or input when using this as a form -->
              <button type="submit" class="btn btn-med btn-success">Add Role</button>
            </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>

  @endsection