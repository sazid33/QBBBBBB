@extends('layouts.app')

@section('content-title', 'Subjects')

@section('content')

<script>

$(document).ready(function(){

    var company_id;
    var subject_id;

    function searchFunction()
    {
        company_id = $("#company").val();
        subject_id = $("#subject").val();

        if(company_id == 0 && subject_id == 0)
        {
            $("#search").prop('disabled', true);
            console.log(data);
            var url = '/subjects/searchSubjects';
            
            $.ajax({
                url:url,
                method:'GET',
                data:{
            
                },
                dataType: 'json',
                success:function(data){
                    console.log(data);
                    $('#user_table').empty();
                    $.each(data,function(index,usersBasedOnSearch){
                        usersBasedOnSearch.forEach(function(element){
                            $('#user_table').append('<tr><td>'+element.user_name+'</td><td>'+element.user_email+'</td><td>'+element.company_name+'</td><td>'+element.role_name+'</td></tr>');
                        });
                    });
                },

                error:function(data){
            
                }

            })
        }

        else
        {
            $("#search").prop('disabled', false);
        }
    }

    $("#company").on('change', function(){
        searchFunction();
    });

    $("#subject").on('change', function(){
        searchFunction();
    });

    $("#search").on('click', function(){

        url = '/subjects/searchSubjects';

        $.ajax({
            url:url,
            method:'GET',
            data:{
                company_id:company_id,
                subject_id:subject_id,
            },
            dataType: 'json',
            sucess:function(data){
                console.log(data);
                $("#subject_table").empty();
            }
        });
        
    });

});

</script>


<div>
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-3">
            <div id="choose_company">
                <h4><label>Search By Company</label></h4>
                <select class="form-control" name="company_for_searching" data-style="select-with-transition" title="Select Company" id="company_for_searching" >
                    
                </select>
            </div>
        </div>
        
        <div class="col-md-3">
            <div id="choose_program">
                <h4><label>Search By Subject</label></h4>
                <select class="form-control" name="subject_id" data-style="select-with-transition" title="Select Subject" id="subject" >
                    <option value="0">--Select Subject--</option>
                    @foreach($subject_array as $subject)
                    <option value="{{$subject->id}}">{{$subject->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-3">

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
                    <th>Company Name</th>
                    <th>Name</th>
                    <th class="text-center">Action</th>
                    
                </tr>
                </thead>

                <tbody id="subject_table">
                    @foreach($subjects as $subject)
                    <tr>
                        <td>{{$subject->company}}</td>
                        <td>{{$subject->name}}</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-xs btn-success view" id="{{ $subject->id }}"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                            <a href="#" class="btn btn-xs btn-primary edit" id="{{ $subject->id }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                            <a href="#" class="btn btn-xs btn-danger delete" id="{{ $subject->id }}"><i class="glyphicon glyphicon-warning-sign"></i> Delete</a>
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
                    <select class="form-control" name="current_user_company" data-style="select-with-transition" title="Select Company" id="current_user_company" >

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