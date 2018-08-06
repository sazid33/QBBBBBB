@extends('layouts.app')

@section('content-title', 'Add MCQ Question')

@section('content')

<script>

var company_id;
var program_id;
var subject_id;
var chapter_id;
var topic_id;

$(document).ready(function(){

    $('#company').on('change', function(event){
        
        company_id = event.target.value;
        
        $('#program').empty();
        $('#program').append('<option>--Select Program--</option>');
        $('#subject').empty();
        $('#subject').append('<option>--Select Subject--</option>');
        $('#chapter').empty();
        $('#chapter').append('<option>--Select Chapter--</option>');
        $('#topic').empty();
        $('#topic').append('<option>--Select Topic--</option>');

        var url = '/programs/getProgramAccordingToCompany';
        
        $.ajax({
            url:url,
            method:'GET',
            data:{
                company_id:company_id,
            },
            dataType: 'json',
            success:function(data)
            {
                $.each(data,function(index,programsObjectForSelectedCompany){
                
                    programsObjectForSelectedCompany.forEach(function(element) {
                        $('#program').append('<option value="'+element.program_id+'">'+element.program_name+'</option>');
                    });
                });
            },
            error:function(data)
            {
                
            }
        })
    });

    $('#program').on('change', function(event){
        
        program_id = event.target.value;
        $('#subject').empty();
        $('#subject').append('<option>--Select Subject--</option>');
        $('#chapter').empty();
        $('#chapter').append('<option>--Select Chapter--</option>');
        $('#topic').empty();
        $('#topic').append('<option>--Select Topic--</option>');
        var url = '/subjects/getSubjectAccordingToProgram';
        $.ajax({
            url:url,
            method:'GET',
            data:{
                company_id:company_id,
                program_id:program_id,
            },
            dataType: 'json',
            success:function(data)
            {
                
                            
                $.each(data,function(index,subjectsObjectForSelectedProgram){
                    
                    subjectsObjectForSelectedProgram.forEach(function(element){
                        $('#subject').append('<option value="'+element.subject_id+'">'+element.subject_name+'</option>');
                    });
                });
            },
            error:function(data)
            {
                
            }
        })
    });

    $('#subject').on('change', function(event){
        
        subject_id = event.target.value;
        $('#chapter').empty();
        $('#chapter').append('<option>--Select Chapter--</option>');
        $('#topic').empty();
        $('#topic').append('<option>--Select Topic--</option>');
        var url = '/chapters/getChapterAccordingToSubject';
        $.ajax({
            url:url,
            method:'GET',
            data:{
                subject_id:subject_id,
            },
            dataType: 'json',
            success:function(data)
            {    
                $.each(data,function(index,chaptersObjectForSelectedSubject){
                    chaptersObjectForSelectedSubject.forEach(function(element){
                        $('#chapter').append('<option value="'+element.chapter_id+'">'+element.chapter_name+'</option>');
                    });
                });
            },
            error:function(data)
            {
                
            }
        })
    });

    $('#chapter').on('change', function(event){
        
        chapter_id = event.target.value;
        $('#topic').empty();
        $('#topic').append('<option>--Select Topic--</option>');
        var url = '/topics/getTopicAccordingToChapter';
        $.ajax({
            url:url,
            method:'GET',
            data:{
                chapter_id:chapter_id,
            },
            dataType: 'json',
            success:function(data)
            {              
                $.each(data,function(index,topicsObjectForSelectedChapter){
                    topicsObjectForSelectedChapter.forEach(function(element){
                        $('#topic').append('<option value="'+element.topic_id+'">'+element.topic_name+'</option>');
                    });
                });
            },
            error:function(data)
            {
                
            }
        })
    });

    $('#topic').on('change', function(){
        topic_id = event.target.value;
    });

    $('#submit').on('click', function(){
        var question = document.getElementById("mcq_question").value;
        var url = '/questions/store';
        
        $.ajax({
            url:url,
            method:'POST',
            data:{
                topic_id:topic_id,
                question:question,
                option1:option1,
                option2:option2,
                option3:option3,
                option4:option4,
                priority:priority,
                difficulty:difficulty,

            },
        })
    });

});

</script>

<div>
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-4">
            <div id="choose_company">
                <h4><label>Choose Company</label></h4>
                <select class="form-control" name="company_id" data-style="select-with-transition" title="Select Company" id="company" >
                    <option>--Select Company--</option>
                    @foreach($company_array as $company)
                    <option value="{{$company->id}}">{{$company->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="col-md-4">
            <div id="choose_program">
                <h4><label>Choose Program</label></h4>
                <select class="form-control" name="program_id" data-style="select-with-transition" title="Select Program" id="program" >
                    <option>--Select Program--</option>
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div id="choose_subject">
                <h4><label>Choose Subject</label></h4>
                <select class="form-control" name="subject_id" data-style="select-with-transition" title="Select Subject" id="subject" >
                    <option>--Select Subject--</option> 
                </select>
            </div>
        </div>
    </div>
    

   

    <div class="row">
        <div class="col-md-4">
            <div id="choose_chapter">
                <h4><label>Choose Chapter</label></h4>
                <select class="form-control" name="chapter_id" data-style="select-with-transition" title="Select Chapter" id="chapter" >
                    <option>--Select Chapter--</option>
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div id="choose_topic">
                <h4><label>Choose Topic</label></h4>
                <select class="form-control" name="topic_id" data-style="select-with-transition" title="Select Topic" id="topic" >
                    <option>--Select Topic--</option>
                </select>
            </div>
        </div>
    </div>
</div>

<br>
<div id="mcq-question-section">

    <div class="row">
        <div class="col-md-6">

            <div id="question">
                <h4><label>Enter Your Question Here</label></h4>
                <textarea rows="9" class="form-control" id="mcq_question"></textarea>
            </div>
        </div>
        
        <div class="col-md-6">
            <div id="options">
                <h4><label>Enter Your Options Here</label></h4>
                <input type="text" class="form-control" placeholder="Option 1" id="mcq_option_1">
                <br>
                <input type="text" class="form-control" placeholder="Option 2" id="mcq_option_2">
                <br>
                <input type="text" class="form-control" placeholder="Option 3" id="mcq_option_3">
                <br>
                <input type="text" class="form-control" placeholder="Option 4" id="mcq_option_4">
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-6">
            <div id="choose-priority">
                <h4><label>Select Priority</label></h4>
                <select class="form-control" name="priority" data-style="select-with-transition" title="Select Topic" id="priority" >
                    <option>--Select Priority--</option>
                    <option value="1">1 - Lowest</option>
                    <option value="2">2 - Lower</option>
                    <option value="3">3 - Medium</option>
                    <option value="4">4 - Higher</option>
                    <option value="5">5 - Highest</option>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div id="choose-priority">
                <h4><label>Select Difficulty</label></h4>
                <select class="form-control" name="difficulty" data-style="select-with-transition" title="Select Topic" id="difficulty" >
                    <option>--Select Difficulty--</option>
                    <option value="1">Easy</option>
                    <option value="2">Medium</option>
                    <option value="3">Hard</option>
                </select>
            </div>
        </div>
    </div>
    <br>
<br>
<div>
    <button type="submit" class="btn btn-med btn-primary">Add Question</button>
</div>
<br>

@endsection