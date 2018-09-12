@extends('layouts.app')

@section('content-title', 'Topics')

@section('content')

<script>
$(document).ready(function(){

    $('#current_user_company_program_subject').on('change', function(event){

        var subject_id = event.target.value;

        $.getJSON('/topics/getChapterAccordingToSubject?subject_id=' +subject_id , function(data){
            $('#chapter').empty();
            $('#chapter').append('<option value=0>--Select Chapter--</option>');

            $.each(data,function(index,chaptersObjectForSelectedSubject){
                
                chaptersObjectForSelectedSubject.forEach(function(element) {
                    $('#chapter').append('<option value="'+element.chapter_id+'">'+element.chapter_name+'</option>');
                });

            });
        });
    });

});


</script>


<div class="">
    <div class="box">

        <div class="box-body">

            <table class ="table table-responsive">
                <thead>
                <tr>
                    <th>Subject Name</th>
                    <th>Chapter Name</th>
                    <th>Topic Name</th>
                    <th class="text-center">Action</th>
                    
                </tr>
                </thead>

                <tbody>
                    @foreach($topics as $topic)
                    <tr>
                        <td>{{$topic->subject}}</td>
                        <td>{{$topic->chapter}}</td>
                        <td>{{$topic->name}}</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-xs btn-success view" id="{{ $topic->id }}"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                            <a href="#" class="btn btn-xs btn-primary edit" id="{{ $topic->id }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                            <a href="#" class="btn btn-xs btn-danger delete" id="{{ $topic->id }}"><i class="glyphicon glyphicon-warning-sign"></i> Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
        <br>
    <div class="button">
        <button type="button" class="btn btn-primary btn-med" data-toggle="modal" data-target="#ssModal-create">
        Add New Topic
        </button>
    </div>
  </div>

    <div class="modal fade" id="ssModal-create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                    <select class="form-control" name="current_user_company_program_subject" data-style="select-with-transition" title="Select Subject" id="current_user_company_program_subject" >
                        
                    </select>
                
                    @if ($errors->has('subject'))
                    <span class="help-block">
                        <strong>{{ $errors->first('subject') }}</strong>
                    </span>
                    @endif
                </div>
                <br>
                <div>
                    <select class="form-control" name="chapter" data-style="select-with-transition" title="Select Chapter" id="chapter" >
                        <option>--Select Chapter--</option>
                        <option value=""></option>
                    </select>
                
                    @if ($errors->has('chapter'))
                    <span class="help-block">
                        <strong>{{ $errors->first('chapter') }}</strong>
                    </span>
                    @endif
                </div>
                <br>
                <div class="form-group">
                    <input class="form-control" placeholder="Topic Name" name="name" type="text" autofocus value="{{ old('name') }}">
                    @if ($errors->has('name'))
                    <span class="help-block">{{ $errors->first('name') }}</span>
                    @endif
                </div>

              <!-- Change this to a button or input when using this as a form -->
                <button type="submit" class="btn btn-med btn-success">Add Topic</button>
            </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>

  @endsection