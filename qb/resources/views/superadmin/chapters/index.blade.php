@extends('layouts.app')

@section('content-title', 'Chapters')

@section('content')

<!--
<div class="button">
    <a type="button" class="btn btn-primary btn-med" href="chapters/create">
       Add New Chapter
</a>
</div>
-->
<div class="">
    <div class="box">

        <div class="box-body">

            <table class ="table table-responsive">
                <thead>
                <tr>
                    <th>Subject</th>
                    <th>Chapter Name</th>
                    
                </tr>
                </thead>

                <tbody>
                    @foreach($chapters as $chapter)
                    <tr>
                        <td>{{$chapter->subject}}</td>
                        <td>{{$chapter->name}}</td>
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
    <div>
      <button type="button" class="btn btn-primary btn-med" data-toggle="modal" data-target="#ssModal">
        Add New Chapter
      </button>
    </div>
</div>


<div class="modal fade" id="ssModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add Subject</h4>
          </div>
          
          <div class="modal-body">
            
            <form action="{{ route('chapters.store') }}" method="POST">
            {{ csrf_field() }}
            <fieldset>
                
                <div>
                    <select class="form-control" name="subject" data-style="select-with-transition" title="Select Subject" id="subject" >
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
                </br>
                <div class="form-group">
                    <input class="form-control" placeholder="Chapter Title" name="chapter_name" type="text" autofocus value="{{ old('name') }}">
                    @if ($errors->has('chapter'))
                    <span class="help-block">{{ $errors->first('chapter') }}</span>
                    @endif
                </div>

              <!-- Change this to a button or input when using this as a form -->
                <button type="submit" class="btn btn-med btn-success">Add Chapter</button>
            </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>
  
@endsection