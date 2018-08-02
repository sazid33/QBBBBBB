@extends('layouts.app')

@section('content-title', 'Add Question')

@section('content')

<script>

var company_id;
var subject_id;

$(document).ready(function(){

    $('#company').on('change', function(event){

        company_id = event.target.value;
        $.getJSON('/programs/getProgramAccordingToCompany?company_id=' +company_id , function(data){
            $('#program').empty();
            console.log(data);

            $.each(data,function(index,programsObjectForSelectedCompany){
                
                programsObjectForSelectedCompany.forEach(function(element) {
                    $('#program').append('<option value="'+element.program_id+'">'+element.program_name+'</option>');
                });
            });
        });
    });

    $('#program').on('change', function(event){
        
        program_id = event.target.value;

        $.getJSON('/subjects/getSubjectAccordingToProgram?program_id='+ program_id, function(data){
            $('#subject').empty();
            console.log(data);
            
            $.each(data,function(index,subjectsObjectForSelectedProgram){
                subjectsObjectForSelectedProgram.forEach(function(element){
                    $('#subject').append('<option value="'+element.subject_id+'">'+element.subject_name+'</option>');
                });
            });
        });
    });

});

</script>

<div>
    <div id="choose_company">
        <h4><label>Choose Company</label></h4>
        <select class="form-control" name="company_id" data-style="select-with-transition" title="Select Company" id="company" >
            <option>--Select Company--</option>
            @foreach($company_array as $company)
            <option value="{{$company->id}}">{{$company->name}}</option>
            @endforeach
        </select>
    </div>

    <div id="choose_program">
        <h4><label>Choose Program</label></h4>
        <select class="form-control" name="program_id" data-style="select-with-transition" title="Select Program" id="program" >
            <option>--Select Program--</option>
            <option value=""></option>
        </select>
    </div>

    <div id="choose_subject">
        <h4><label>Choose Subject</label></h4>
        <select class="form-control" name="subject_id" data-style="select-with-transition" title="Select Subject" id="subject" >
            <option>--Select Subject--</option>
            <option value=""></option>
        </select>
    </div>

    <div id="choose_chapter">
        <h4><label>Choose Chapter</label></h4>
        <select class="form-control" name="chapter_id" data-style="select-with-transition" title="Select Chapter" id="chapter" >
            <option>--Select Chapter--</option>
            <option value=""></option>
        </select>
    </div>

    <div id="choose_topic">
        <h4><label>Choose Topic</label></h4>
        <select class="form-control" name="topic_id" data-style="select-with-transition" title="Select Topic" id="topic" >
            <option>--Select Topic--</option>
            <option value=""></option>
        </select>
    </div>
</div>

@endsection