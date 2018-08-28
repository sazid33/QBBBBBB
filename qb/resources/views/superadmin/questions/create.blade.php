@extends('layouts.app')

@section('content-title', 'Add MCQ Question')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML-full"></script>


<script>

var company_id;
var program_id;
var subject_id;
var chapter_id;
var options[];
var answer[];
var topic_id;
var priority;
var difficulty;

$(document).ready(function(){

    function checkFunction(){
        topic_id = document.getElementById("topic").value;
        question = document.getElementById("mcq_question").value;
        priority = document.getElementById("priority").value;
        difficulty = document.getElementById("difficulty").value;
    }

    function checkRightAnswer(){
        
    }

    function Update_Preview(td_selector) {
        var Text = $(td_selector).children(".text-input").val();
        $(td_selector).siblings(".preview").html(Text.replace("\n", "<br/>"));
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, $(td_selector).siblings(".preview")[0]]);
    }


    $("body").on("change", ".text-input", function () {
        var selector = $(this);
        setTimeout(function () {
            Update_Preview(selector.parents("td"));
        }, 200);
    });


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

    $('#add_question').on('click', function(){

        var url = '/questions/store';

        $.ajax({
            url:url,
            method:'POST',
            data:{
                topic_id:topic_id,
                question:question,

                priority:priority,
                difficulty:difficulty,

            },
        })
    });

});

</script>

<style>
    .row{
        padding-top:20px;
        padding-bottom:10px;
    }

    .question_options{
        background-color:AliceBlue;
    }
</style>


<div id="mcq-question-section">
<div class="col-md-12">
    {{ csrf_field() }}
    <table class="table table-bordered table-striped table-condensed">
        <tbody>
            <tr>
                <td>Company</td>
                <td colspan="2">
                    <select class="form-control" name="company_id" data-style="select-with-transition" title="Select Company" id="company" >
                        <option value="0">--Select Company--</option>
                        @foreach($company_array as $company)
                            <option value="{{$company->id}}">{{$company->name}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>Program</td>
                <td colspan="2">
                    <select class="form-control" name="program_id" data-style="select-with-transition" title="Select Program" id="program" >
                        <option value="0">--Select Program--</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Subject</td>
                <td colspan="2">
                    <select class="form-control" name="subject_id" data-style="select-with-transition" title="Select Subject" id="subject" >
                        <option value="0">--Select Subject--</option> 
                    </select>
                </td>
            </tr>
            <tr>
                <td>Chapter</td>
                <td colspan="2">
                    <select class="form-control" name="chapter_id" data-style="select-with-transition" title="Select Chapter" id="chapter" >
                        <option value="0">--Select Chapter--</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Topic</td>
                <td colspan="2">
                    <select class="form-control" name="topic_id" data-style="select-with-transition" title="Select Topic" id="topic" >
                        <option value="0">--Select Topic--</option>
                    </select>
                </td>
            </tr>

            
            <tr>
                <br>
                <br>
            </tr>

            <tr>
                <td>Question</td>
                <td style="width: 45%">
                    <textarea rowspan="4" name="question_body" placeholder="Question" class="form-control text-input"></textarea>
                </td>
                <td class="preview" style="width: 45%"></td>
            </tr>
            
            <tr>
                <td>Option 1</td>
                <td style="width: 45%">
                    <textarea name="option_body[]" placeholder="Option" class="form-control text-input"></textarea>
                    <div class="checkbox"><label><input type="checkbox" class="answer" value="1" name="answer[]"> Make Answer</label></div>
                </td>
                <td class="preview" style="width: 45%"></td>
            </tr>
            <tr>
                <td>Option 2</td>
                <td style="width: 45%">
                    <textarea name="option_body[]" placeholder="Option" class="form-control text-input"></textarea>
                    <div class="checkbox"><label><input type="checkbox" class="answer" value="2" name="answer[]"> Make Answer</label></div>
                </td>
                <td class="preview" style="width: 45%"></td>
            </tr>
            <tr>
                <td>Option 3</td>
                <td style="width: 45%">
                    <textarea name="option_body[]" placeholder="Option" class="form-control text-input"></textarea>
                    <div class="checkbox"><label><input type="checkbox" class="answer" value="3" name="answer[]"> Make Answer</label></div>
                </td>
                <td class="preview" style="width: 45%"></td>
            </tr>
            <tr>
                <td>Option 4</td>
                <td style="width: 45%">
                    <textarea name="option_body[]" placeholder="Option" class="form-control text-input"></textarea>
                    <div class="checkbox"><label><input type="checkbox" class="answer" value="4" name="answer[]"> Make Answer</label></div>
                </td>
                <td class="preview" style="width: 45%"></td>
            </tr>

            <tr>
                <td>Question Priority</td>
                <td colspan="2">
                    <select class="form-control" name="priority" data-style="select-with-transition" title="Select Topic" id="priority" >
                        <option value="0">--Select Priority--</option>
                        <option value="1">1 - Lowest</option>
                        <option value="2">2 - Lower</option>
                        <option value="3">3 - Medium</option>
                        <option value="4">4 - Higher</option>
                        <option value="5">5 - Highest</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Question Difficulty</td>
                <td colspan="2">
                    <select class="form-control" name="difficulty" data-style="select-with-transition" title="Select Topic" id="difficulty" >
                        <option value="0">--Select Difficulty--</option>
                        <option value="1">Easy</option>
                        <option value="2">Medium</option>
                        <option value="3">Hard</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td class="text-center" colspan="3"><div class="col-md-12 text-center"><input id="add_question" type="submit" name="add_question" value="Add Question" class="btn btn-primary"></div></td>
            </tr>

        </tbody>
    </table>
</div>
</div>

@endsection