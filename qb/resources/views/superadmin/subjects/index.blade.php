@extends('layouts.app')

@section('content-title', 'Subjects')

@section('content')

<div class="">
    <div class="box">

        <div class="box-body">

            <table class ="table table-responsive">
                <thead>
                <tr>
                    <th>Company Name</th>
                    <th>Name</th>
                    
                </tr>
                </thead>

                <tbody>
                    @foreach($subjects as $subject)
                    <tr>
                        <td>{{$subject->company}}</td>
                        <td>{{$subject->name}}</td>
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
        Add New Subject
        </button>
    </div>
  </div>

  <div class="modal fade" id="ssModal-create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add Subject</h4>
          </div>
          <div class="modal-body">
            
            <form action="{{ route('subjects.store') }}" method="POST">
            {{ csrf_field() }}
            <fieldset>
                
                <div>
                    <select class="form-control" name="company" data-style="select-with-transition" title="Select Company" id="company" >
                        @foreach($company_array as $data)
                        <option value="{{$data->id}}">{{$data->name}}</option>
                        @endforeach
                    </select>
                
                    @if ($errors->has('company'))
                    <span class="help-block">
                        <strong>{{ $errors->first('company') }}</strong>
                    </span>
                    @endif
                </div>
                </br>
                </br>
                <div class="form-group">
                    <input class="form-control" placeholder="Subject Name" name="subject_name" type="text" autofocus value="{{ old('name') }}">
                    @if ($errors->has('subject'))
                    <span class="help-block">{{ $errors->first('subject') }}</span>
                    @endif
                </div>

              <!-- Change this to a button or input when using this as a form -->
                <button type="submit" class="btn btn-med btn-success">Add Subject</button>
            </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>

  @endsection