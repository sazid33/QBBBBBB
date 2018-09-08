@extends('layouts.app')

@section('content-title', 'Generate Question')

@section('content')

<script>
    


$(document).ready(function(){
    
    

    $(function()
    {
        var url = '/programs/getProgramAccordingToPresentUserCompany';

      $.ajax({
        url:url,
        method: 'GET',
        data:{
          
        },
        dataType:'json',
        success:function(data)
        {
            $('#programs_according_to_company').empty();
            $('#programs_according_to_company').append('<option value=0>--Select Program--</option>');

            $.each(data,function(index,programsObjectAccordingToCompany){
                
                programsObjectAccordingToCompany.forEach(function(element) {
                    $('#programs_according_to_company').append('<option value="'+element.program_id+'">'+element.program+'</option>');
                });
            });
            
        },
        error:function(data)
        {
          console.log(data);
        }
      });
    });

    $(function()
    {
        
    });

    function getChapterAccordingToSubject(subject_id)
    {      
        console.log(subject_id);
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

                console.log(data);  
                $.each(data,function(index,chaptersObjectForSelectedSubject){
                    chaptersObjectForSelectedSubject.forEach(function(element){
                        $('#chapters_for_selected_subject').append(
                            '<option value="'+element.chapter_id+'">'+element.chapter_name+'</option>'
                        );
                    });
                });
            },
            error:function(data)
            {
                //console.log(data);
            }
        });
    }

    $('#company_for_searching').on('change', function(event){
        var company_id = event.target.value;
        
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
                //console.log(data);
                $('#programs_according_to_company').empty();
                $('#programs_according_to_company').append('<option value=0>--Select Program--</option>');
                $.each(data,function(index,programsObjectForSelectedCompany){
                
                    programsObjectForSelectedCompany.forEach(function(element) {
                        $('#programs_according_to_company').append('<option value="'+element.program_id+'">'+element.program_name+'</option>');
                    });
                });
            },
            error:function(data)
            {
                
            }
        })
    });

    $('#programs_according_to_company').on('change', function(event){
        var company_id = $('#company_for_searching').val();
        var program_id = $('#programs_according_to_company').val();

        if(program_id == 0)
        {
            $('#select-subject-chapter').prop("hidden", true);
            $('#submit_button').prop("hidden", false);
        }
        
        var url = '/subjects/getSubjectAccordingToCompanyProgram';
        
        $.ajax({
            url:url,
            method:'GET',
            data:{
                company_id:company_id,
                program_id:program_id
            },
            dataType: 'json',
            success:function(data)
            {
                var i = 0;
                console.log(i);
                //console.log(data);
                $('#select-subject-chapter').prop("hidden", false);
                $('#submit_button').prop("hidden", false);
                $('#select-subject-chapter-for-exam-table-body').empty();

                $.each(data,function(index,subjectsForSelectedCompany){
                   
                    subjectsForSelectedCompany.forEach(function(element) {
                        console.log(i);
                        $('#select-subject-chapter-for-exam-table-body').append(
                            '<tr>'
                                +'<td class=text-center><input type=checkbox class="subjects_checkboxes" name=subject_select_checkbox['+i+']></td>'
                                +'<td class=text-center><label value='+element.subject_id+' name="subject_selection['+i+']" id="subject_selection">'+element.subject_name+'</label></td>'
                                +'<td class=text-center><select  name="chapters_for_selected_subject['+i+']" id="chapters_for_selected_subject"><option>--Select Chapter--</option></select></td>'
                            +'</tr>');
                        i++;

                        //console.log(i);
                    });
                });

            },
            error:function(data)
            {
                console.log(data);
            }
        });
    });



    function question_type_is_checked()
    {
        if($("input[name='question_type_checkbox[]']").is(":checked")) {
            ($(this).is(":checked") ? $('.class_marks_for_each_question').prop("disabled", false) : $('.class_marks_for_each_question').prop("disabled", true));
            ($(this).is(":checked") ? $('.class_number_of_questions').prop("disabled", false) : $('.class_number_of_questions').prop("disabled", true));
        }
    }

    function doSomething()
    {
        if ( this.checked ) 
        {
            
        }
        
        else 
        {
            // if not checked ...
        }
    }

    $(".question_type_checkboxes").click(function () {
        var question_type_checkbox = document.forms['question_types'].elements['question_type_checkbox[]'];
        
        for(var i=0; i<question_type_checkbox.length; i++)
        {
            question_type_checkbox[i].onclick = doSomething;
        }
    });


    $('#check_all_question_types').change(function () {
        ($(this).is(":checked") ? $('.question_type_checkboxes').prop("checked", true) :    $('.question_type_checkboxes').prop("checked", false));
        doSomething();   
    });

    $('#check_all_subjects').change(function(){
        ($(this).is(":checked")) ? $('.subjects_checkboxes').prop("checked", true) :  $('.subjects_checkboxes').prop("checked", false);
    });
});

</script>



<div>
    <div>
        <div class="col-md-3">
            
        </div>

        <div class="col-md-3" id="select-company">
            <label>Select Company</label>
            <select class="form-control" name="company_for_searching" data-style="select-with-transition" title="Select Company" id="company_for_searching" >
                    
            </select>
        </div>

        <div class="col-md-3" >
            <label>Select Program</label>
            <select class="form-control" name="programs_according_to_company" data-style="select-with-transition" title="Select Program" id="programs_according_to_company" >
                <option value=0>--Select Program--</option>
            </select>    
        </div>

        <div class="col-md-3" >
            
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>


    <div>
        <div class="col-md-4">
            
        </div>

        <div id="question-headers" class="col-md-4">
            <table class="table table-responsive">
                <tbody>
                    <tr>
                        <td>Exam Name</td>
                        <td><input type="text" name="exam-name" id="exam-name"></td>
                    </tr>
                    <tr>
                        <td>Date</td>
                        <td><input type="date" name="exam-date" id="exam-date"></td>
                    </tr>
                    
                </tbody>
            </table>
        </div>

        <div class="col-md-4">
            
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    
    

    <div id="select-question-type">
        
        <div>
            <h4>Select Types of Questions</h4>
        </div>
        <table class="table table-responsive" id="question_type">
            <thead>
                <td class="text-center">
                    <input type="checkbox"  id="check_all_question_types">
                    <label>Check</label>
                </td>
                <td class="text-center" ><label>Question Type</label></td>
                <td class="text-center"><label>Number of Questions</label></td>
                <td class="text-center"><label>Marks per Question</label></td>
                <td class="text-center">
                    <label>Percentage of Question</label>
                </td>
                <td class="text-center"><label>Total Marks of Type</label></td>
            </thead>
            <form action="#" method="post" class="question_types" id="question_types">
            <tbody>
                
                @foreach($question_types as $question_type)
                
                <tr>
                    <td class="text-center">
                        <input type="checkbox" class="question_type_checkboxes" name="question_type_checkbox[]" id="question_type_checkbox" value="{{$question_type->id}}">
                    </td>
                    <td class="text-center"> 
                        {{$question_type->name}}
                    </td>
                    <td class="text-center">
                        <input class="class_number_of_questions" type="text" name="number_of_questions[]" id="number_of_questions" disabled>
                    </td>
                    <td class="text-center">
                        <input class="class_marks_for_each_question" type="text" name="marks_for_each_question[]" id="marks_for_each_question" disabled>
                    </td>
                    <td class="text-center">
                        <input class="class_percentage_of_question" type="text" name="percentage_of_question[]" id="percentage_of_question" disabled>
                    </td>
                    <td class="text-center">
                        <input  type="text" name="total_marks_of_type[{]" id="total_marks_of_type" disabled>
                    </td>
                </tr>
                <input type="hidden" value="{{$counter++}}">
                @endforeach
                
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-center">Total Marks<br><input type="text" name="exam-marks" id="exam-marks" disabled></td>
                </tr>

            </tbody>
            </form>
        </table>
        
    </div>


    <div id="select-subject-chapter" hidden>
        <div>  
            <h4>Select Your Subjects</h4>
        </div>

        <div id="select-subject">
            <table id="select-subject-chapter-for-exam" class="table table-responsive">
                <thead>
                    <td class="text-center">
                        <input type="checkbox" id="check_all_subjects" class="text-center">
                        <label>Check</label>
                    </td>
                    <td class="text-center">
                        <label>Subjects</label>
                    </td>
                    <td class="text-center">
                        <label>Chapters</label>
                    </td>
                </thead>
                
                <tbody id="select-subject-chapter-for-exam-table-body">
                    
                </tbody>
            </table>
        </div>
    </div>

    <div id="submit_button" hidden>
        <table class="table table-responsive">
            <thead>
                <td></td>
                
            </thead>
            <tbody>
                <td class="text-center">
                    <button type="submit" id="button-generate-question" name="button-generate-question" class="btn btn-success">Generate Question</button>
                </td>
            </tbody>
        </table>
    </div>



</div>

<br>
<br>
<br>
<br>
<br>
<br>

@endsection