@extends('layouts.app')

@section('content-title', 'Programs')

@section('content')

<div>
    {{ csrf_field() }}
    <div class="row">  
        <div class="col-md-3">
            <div id="choose_program">
                <h4><label>Search By Company</label></h4>
                <select class="form-control" name="company_for_searching" data-style="select-with-transition" title="Select Company" id="company_for_searching" >
                    
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div id="choose_subject">
                <h4><label>Search By User Role</label></h4>
                <select class="form-control" name="role_id" data-style="select-with-transition" title="Select Subject" id="role" >
                    <option value="0">--Select User Role--</option>
                    @foreach($role_array as $role)
                    <option value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-3">
          <div class="button" pull-right>
            <h4><label>Search</label></h4>
            <button type="button" id="search" name="search" class="btn btn-primary btn-block" disabled>Search</button>
          </div>
        </div>
    </div><br>
</div>


<div class="">
    <div class="box">
        <div class="box-body">

            <table class ="table table-responsive">
                <thead>
                <tr>

                    <th>Degree Name</th>
                    <th>Program Name</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>

                <tbody>
                    @foreach($programs as $program)
                    <tr>
                        <td>{{$program->degree}}</td>
                        <td>{{$program->name}}</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-xs btn-success view" id="{{ $program->id }}"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                            <a href="#" class="btn btn-xs btn-primary edit" id="{{ $program->id }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                            <a href="#" class="btn btn-xs btn-danger delete" id="{{ $program->id }}"><i class="glyphicon glyphicon-warning-sign"></i> Delete</a>
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
        Add New Program
        </button>
    </div>
  </div>


  <!-- Modal -->
    <div class="modal fade" id="ssModal-create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add Program</h4>
          </div>
          <div class="modal-body">
            
            <form action="{{ route('programs.store') }}" method="POST">
            {{ csrf_field() }}
            <fieldset>
                <div>
                    <label>Select Degree Name</label>
                    <select class="form-control" name="degree" data-style="select-with-transition" title="Select Degree" id="" >
                        @foreach($degree_array as $data)
                        <option value="{{$data->id}}">{{$data->name}}</option>
                        @endforeach
                    </select>
                
                    @if ($errors->has('degree'))
                    <span class="help-block">
                        <strong>{{ $errors->first('degree') }}</strong>
                    </span>
                    @endif
                </div>
                </br>


                <div class="form-group">
                    <label>Enter Program Name</label>
                    <input class="form-control" placeholder="Program Name" name="name" type="text" autofocus value="{{ old('name') }}">
                    @if ($errors->has('name'))
                    <span class="help-block">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                
                
              <!-- Change this to a button or input when using this as a form -->
                <button type="submit" class="btn btn-med btn-success">Add Program</button>
            </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>

  @endsection