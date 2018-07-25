@extends('layouts.app')

@section('content-title', 'Topics')

@section('content')

<div class="">
    <div class="box">
        <div class="box-body">

            <table class ="table table-responsive">
                <thead>
                <tr>
                    <th>Program Name</th>
                    <th>Degree Name</th>
                </tr>
                </thead>

                <tbody>
                    @foreach($programs as $program)
                    <tr>
                    <td>{{$program->name}}</td>
                    <td>{{$program->degree}}</td>
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
        Add New Program
        </button>
    </div>
  </div>


  <!-- Modal -->
    <div class="modal fade" id="ssModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                <div class="form-group">
                    <label>Enter Program Name</label>
                    <input class="form-control" placeholder="Program Name" name="name" type="text" autofocus value="{{ old('name') }}">
                    @if ($errors->has('name'))
                    <span class="help-block">{{ $errors->first('name') }}</span>
                    @endif
                </div>

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
                
              <!-- Change this to a button or input when using this as a form -->
                <button type="submit" class="btn btn-med btn-success">Add Program</button>
            </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>

  @endsection