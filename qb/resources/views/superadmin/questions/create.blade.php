@extends('layouts.app')

@section('content-title', 'Add MCQ Question')

@section('content')

<script>

var company_id;
var program_id;
var subject_id;
var chapter_id;
var topic_id;
var question;
var option1; 
var option2;
var option3;
var option4;
var option1_is_answer;
var option2_is_answer;
var option3_is_answer;
var option4_is_answer;
var priority;
var difficulty;

$(document).ready(function(){

    function checkFunction(){
        topic_id = document.getElementById("topic").value;
        question = document.getElementById("mcq_question").value;
        option1 = document.getElementById("mcq_option_1").value;
        option2 = document.getElementById("mcq_option_2").value;
        option3 = document.getElementById("mcq_option_3").value;
        option4 = document.getElementById("mcq_option_4").value;
        priority = document.getElementById("priority").value;
        difficulty = document.getElementById("difficulty").value;

        if(topic_id != 0 && question != 0 && option1 != 0 && option2 != 0 && option3 != 0 && option4 != 0 && priority != 0 && difficulty != 0)
        {
            if(option1_is_answer != 0 || option2_is_answer != 0 || option3_is_answer != 0 || option4_is_answer != 0)
            {
                $("#add_question").prop('disabled', false);
            }
        }

        else
        {
            $('#add_question').prop('disabled', true);
        }
    }


    $('#company').on('change', function(event){
        
        company_id = event.target.value;
        
        $('#program').empty();
        $('#program').append('<option value="0">--Select Program--</option>');
        $('#subject').empty();
        $('#subject').append('<option value="0">--Select Subject--</option>');
        $('#chapter').empty();
        $('#chapter').append('<option value="0">--Select Chapter--</option>');
        $('#topic').empty();
        $('#topic').append('<option value="0">--Select Topic--</option>');

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
        $('#subject').append('<option value="0">--Select Subject--</option>');
        $('#chapter').empty();
        $('#chapter').append('<option value="0">--Select Chapter--</option>');
        $('#topic').empty();
        $('#topic').append('<option value="0">--Select Topic--</option>');
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
        $('#chapter').append('<option value="0">--Select Chapter--</option>');
        $('#topic').empty();
        $('#topic').append('<option value="0">--Select Topic--</option>');
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
        $('#topic').append('<option value="0">--Select Topic--</option>');
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

    $('#mcq_question').on('change', function(){
        checkFunction();
    });

    $('#priority').on('change', function(){
        checkFunction();
    });

    $('#difficulty').on('change', function(){
        checkFunction();
    });

    $('#add_question').on('click', function(){

        var url = '/questions/store';

        if(question == 0)
        {
            console.log("Enter Question");
        }
        
        console.log(topic_id);
        console.log(question);
        console.log(option1);
        console.log(option2);
        console.log(option3);
        console.log(option4);
        console.log(priority);
        console.log(difficulty);

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
                    <option value="0">--Select Company--</option>
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
                    <option value="0">--Select Program--</option>
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div id="choose_subject">
                <h4><label>Choose Subject</label></h4>
                <select class="form-control" name="subject_id" data-style="select-with-transition" title="Select Subject" id="subject" >
                    <option value="0">--Select Subject--</option> 
                </select>
            </div>
        </div>
    </div>
    

   

    <div class="row">
        <div class="col-md-4">
            <div id="choose_chapter">
                <h4><label>Choose Chapter</label></h4>
                <select class="form-control" name="chapter_id" data-style="select-with-transition" title="Select Chapter" id="chapter" >
                    <option value="0">--Select Chapter--</option>
                </select>
            </div>
        </div>

        <div class="col-md-4">
            <div id="choose_topic">
                <h4><label>Choose Topic</label></h4>
                <select class="form-control" name="topic_id" data-style="select-with-transition" title="Select Topic" id="topic" >
                    <option value="0">--Select Topic--</option>
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
                <textarea rows="9" class="form-control" id="mcq_question" value="0"></textarea>
            </div>
        </div>
        
        <div class="col-md-6">
            <div id="options">
                <h4><label>Enter Your Options Here</label></h4>

                <div class="col-md-12">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <input type="checkbox" name="right_answer_1">
                        </span>
                        <input type="text" class="form-control pull-left" placeholder="Option 1" id="mcq_option_1">
                    </div><!-- /input-group --><br>
                </div><!-- /.col-lg-6 -->

                

                <div class="col-md-12">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <input type="checkbox" name="right_answer_2">
                        </span>
                        <input type="text" class="form-control pull-left" placeholder="Option 2" id="mcq_option_2">
                    </div><!-- /input-group --><br>
                </div><!-- /.col-lg-6 -->


                <div class="col-md-12">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <input type="checkbox" name="right_answer_3">
                        </span>
                        <input type="text" class="form-control pull-left" placeholder="Option 3" id="mcq_option_3">
                    </div><!-- /input-group --><br>
                </div><!-- /.col-lg-6 -->

                <div class="col-md-12">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <input type="checkbox" name="right_answer_4">
                        </span>
                        <input type="text" class="form-control pull-left" placeholder="Option 4" id="mcq_option_4">
                    </div><!-- /input-group --><br>
                </div><!-- /.col-lg-6 -->

            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-6">
            <div id="choose-priority">
                <h4><label>Select Priority</label></h4>
                <select class="form-control" name="priority" data-style="select-with-transition" title="Select Topic" id="priority" >
                    <option value="0">--Select Priority--</option>
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
                    <option value="0">--Select Difficulty--</option>
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
    <button type="submit" id="add_question" class="btn btn-med btn-primary" disabled>Add Question</button>
</div>
<br>

@endsection