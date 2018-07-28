@extends('layouts.app')

@section('content-title', 'Chapters')

@section('content')


<script>
$(document).ready(function(){


    $(document).on('click', '.edit', function(){
        var id = $(this).attr("id");
        $('#form_output').html('');
        var url = '/ajaxController/fetchChapter';
        $.ajax({
            url:url,
            method:'GET',
            data:{
                id:id,
            },
            dataType: 'json',
            success:function(data)
            {
                console.log(data);
                console.log(url);
                //$('#chapter_id').val(data.chapter_id);
                $('#chapter_name_edit').val(data.chapter_name);
                //$('#subject_id').val(data.subject_id);
                $('#ssModal-update').modal('show');
            },
            error:function(data)
            {
                console.log(data);
            }
        })
    });
})
</script>
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
            {{ csrf_field() }}
                <thead>
                <tr>
                    <th>Subject</th>
                    <th>Chapter Name</th>
                    <th>Action</th>
                    
                    
                </tr>
                </thead>

                <tbody>
                    @foreach($chapters as $chapter)
                    <tr>
                        <td>{{$chapter->subject}}</td>
                        <td id="">{{$chapter->name}}</td>
                        <td><a href="#" class="btn btn-xs btn-primary edit" id="{{ $chapter->id }}"><i class="glyphicon glyphicon-edit"></i> Edit</a></td>
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
      <button type="button" class="btn btn-primary btn-med" data-toggle="modal" data-target="#ssModal-create">
        Add New Chapter
      </button>
    </div>
</div>


<div class="modal fade" id="ssModal-create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Chapter</h4>
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
                        <label>Enter Chapter Name</label>
                        <input class="form-control" placeholder="Chapter Title" name="chapter_name" type="text" autofocus value="{{ old('name') }}">
                        @if ($errors->has('chapter'))
                        <span class="help-block">{{ $errors->first('chapter') }}</span>
                        @endif
                    </div>

                <!-- Change this to a button or input when using this as a form -->
                    <button type="submit" class="btn btn-med btn-success">Add Chapter</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </fieldset>
                </form>
            </div>
        </div>
      </div>
</div>



<div class="modal fade" id="ssModal-update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Chapter</h4>
            </div>
          
            <div class="modal-body">
            
                <form method="POST" id="chapter_form">
                {{ csrf_field() }}
                <span id="form_output"></span>
                <fieldset>
                
                    <div class="form-group">
                        <label>Enter Chapter Name</label>
                        <input class="form-control" placeholder="Chapter Title" value="" id="chapter_name_edit" name="chapter_name_edit" type="text">
                        @if ($errors->has('chapter'))
                        <span class="help-block">{{ $errors->first('chapter') }}</span>
                        @endif
                    </div>

                    <input type="hidden" name="chapter_id" id="chapter_id" value="" />
                    <input type="hidden" name="subject_id" id="subject_id" value="" />

                <!-- Change this to a button or input when using this as a form -->
                    <button type="submit" class="btn btn-med btn-success">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
