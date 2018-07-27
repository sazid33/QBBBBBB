@extends('layouts.app')

@section('content-title', 'Topics')

@section('content')

<div class="">
    <div class="box">

        <div class="box-body">

            <table class ="table table-responsive">
                <thead>
                <tr>
                    <th>Subject Name</th>
                    <th>Chapter Name</th>
                    <th>Topic Name</th>
                    
                </tr>
                </thead>

                <tbody>
                    @foreach($topics as $topic)
                    <tr>
                        <td>{{$topic->subject}}</td>
                        <td>{{$topic->chapter}}</td>
                        <td>{{$topic->name}}</td>
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
        Add New Topic
        </button>
    </div>
  </div>

  <div class="modal fade" id="ssModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add Topic</h4>
          </div>
          <div class="modal-body">
            
            <form action="{{ route('topics.store') }}" method="POST">
            {{ csrf_field() }}
            <fieldset>
                
                <div>
                    <select class="form-control" name="subject_id" data-style="select-with-transition" title="Select Subject" id="subject" >
                        @foreach($subject_array as $data)
                        <option value="{{$data->id}}">{{$data->name}}</option>
                        @endforeach
                    </select>
                
                    @if ($errors->has('subject'))
                    <span class="help-block">
                        <strong>{{ $errors->first('subject') }}</strong>
                    </span>
                    @endif
                </div>
                </br>
                <div>
                    <select class="form-control" name="chapter" data-style="select-with-transition" title="Select Chapter" id="chapter" >
                        @foreach($chapter_array as $data)
                        <option value="{{$data->id}}">{{$data->name}}</option>
                        @endforeach
                    </select>
                
                    @if ($errors->has('chapter'))
                    <span class="help-block">
                        <strong>{{ $errors->first('chapter') }}</strong>
                    </span>
                    @endif
                </div>
                </br>
                <div class="form-group">
                    <input class="form-control" placeholder="Topic Name" name="name" type="text" autofocus value="{{ old('name') }}">
                    @if ($errors->has('name'))
                    <span class="help-block">{{ $errors->first('name') }}</span>
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