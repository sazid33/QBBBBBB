@extends('layouts.app')

@section('content-title', 'Chapters')

@section('content')


<script>
$(document).ready(function(){

    $('#company').on('change', function(event){
        company_id = event.target.value;
        $('#subject').empty();
        $('#subject').append('<option>--Select Subject--</option>');
        
        var url = '/subjects/getSubjectAccordingToCompany';
        $.ajax({
            url:url,
            method:'GET',
            data:{
                company_id:company_id,
            },
            dataType: 'json',
            success:function(data)
            {
                $.each(data,function(index,subjectsObjectForSelectedCompany){
                
                    subjectsObjectForSelectedCompany.forEach(function(element) {
                        $('#subject_id').append('<option value="'+element.subject_id+'">'+element.subject_name+'</option>');
                    });
                });
            },
            error:function(data)
            {
                
            }
        })
    });

    $(document).on('click', '.edit', function(){
        var id = $(this).attr("id");
        $('#form_output').html('');
        var url = '/chapters/fetchChapter';
        $.ajax({
            url:url,
            method:'GET',
            data:{
                id:id,
            },
            dataType: 'json',
            success:function(data)
            {
                $('#chapter_id_update').val(data.chapter_id);
                $('#chapter_name_update').val(data.chapter_name);
                $('#subject_id_update').val(data.subject_id);
                $('#ssModal-update').modal('show');
            },
            error:function(data)
            {
                
            }
        })
    });


    $(document).on('click', '.delete', function(){
        var id = $(this).attr("id");
        //alert(id);
        var url = '/chapters/delete';

        $.ajax({
            url:url,
            method:'DELETE',
            data:{
                id:id,
            },
            dataType:'json',
            success:function(data)
            {
                console.log(data);
                window.location.reload();
            },

            error:function(data)
            {
                console.log(data);
            }
        })
    });

    $(document).on('click', '.view', function(){
        var id = $(this).attr("id");
        $('#form_output').html('');
        var url = '/chapters/fetchChapterforView';
        $.ajax({
            url:url,
            method:'GET',
            data:{
                id:id,
            },
            dataType: 'json',
            success:function(data)
            {
                $('#view_company_name').val(data.view_company_name);
                $('#view_chapter_name').val(data.view_chapter_name);
                $('#view_subject_name').val(data.view_subject_name);
                $('#ssModal-view').modal('show');
            },
            error:function(data)
            {
                console.log(data);  
            }
        })
    });

    $('#button-update').on('click', function(event){
       
        var chapter_name_updated = $('#chapter_name_update').val();
        var chapter_id_updated = $('#chapter_id_update').val();
        var subject_id_updated = $('#subject_id_update').val();
        
        var url = '/chapters/update';
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })
        
        
            $.ajax({
                url:url, 
                method:'PUT',
                data:{
                    chapter_id_update:chapter_id_updated,
                    chapter_name_update:chapter_name_updated,
                    subject_id_update:subject_id_updated,
                },
                dataType: 'json',
                success:function(data)
                {
                    if(data == 1)
                    {
                        $('#ssModal-update').modal('hide');
                        window.location.reload();
                    }

                    else if(data == 0)
                    {
                        console.log(status);
                        window.location.href =  ('/unauthorizedAlert');
                    }
                    
                    
                },
            })       
    });

})
</script>

<div class="">
    <div class="box">

        <div class="box-body">
            
            <table class ="table table-responsive">
            {{ csrf_field() }}
                <thead>
                <tr>
                    <th>Company</th>
                    <th>Subject</th>
                    <th>Chapter Name</th>
                    <th class="text-center">Action</th>
                    
                    
                </tr>
                </thead>

                <tbody>
                    @foreach($chapters as $chapter)
                    <tr>
                        <td>{{$chapter->company}}</td>
                        <td>{{$chapter->subject}}</td>
                        <td id="">{{$chapter->name}}</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-xs btn-success view" id="{{ $chapter->id }}"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                            <a href="#" class="btn btn-xs btn-primary edit" id="{{ $chapter->id }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                            <a href="#" class="btn btn-xs btn-danger delete" id="{{ $chapter->id }}"><i class="glyphicon glyphicon-warning-sign"></i> Delete</a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    
    <div>
      <button type="button" class="btn btn-primary btn-med" data-toggle="modal" data-target="#ssModal-create">
        Add New Chapter
      </button>
      <br>
      <br>
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
                        <select class="form-control" name="current_user_company" data-style="select-with-transition" title="Select Company" id="current_user_company" >
                            
                        </select>
                    </div>
                    <br>
                    
                    <div>
                        <select class="form-control" name="current_user_company_program_subject" data-style="select-with-transition" title="Select Subject" id="current_user_company_program_subject" >
                            
                        </select>
                    </div>
                    <br>
                    <br>
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
            
                <form id="chapter_form">
                <span id="form_output"></span>
                <fieldset>
                
                    <div class="form-group">
                        <label>Edit Chapter Name</label>
                        <input type="text" class="form-control" placeholder="Chapter Title" id="chapter_name_update" name="chapter_name_update"  value="Subject 2 - Chapter 3">
                    </div>

                    <input type="hidden" name="chapter_id_update" id="chapter_id_update" value="" />
                    <input type="hidden" name="subject_id_update" id="subject_id_update" value="" />

                <!-- Change this to a button or input when using this as a form -->
                    <button id="button-update" type="submit" class="btn btn-med btn-success">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ssModal-view" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Selected Chapter</h4>
            </div>
          
            <div class="modal-body">
            
                <form id="chapter_form">
                <span id="form_output"></span>
                <fieldset>
                    <div class="form-group">
                        <label>Company Name</label>
                        <input type="text" class="form-control" placeholder="Chapter Title" id="view_company_name" name="view_company_name"  value="" disabled>
                    </div>

                    <div class="form-group">
                        <label>Subject Name</label>
                        <input type="text" class="form-control" placeholder="Chapter Title" id="view_subject_name" name="view_subject_name"  value="" disabled>
                    </div>

                    <div class="form-group">
                        <label>Chapter Name</label>
                        <input type="text" class="form-control" placeholder="Chapter Title" id="view_chapter_name" name="view_chapter_name"  value="" disabled>
                    </div>

                <!-- Change this to a button or input when using this as a form -->
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
