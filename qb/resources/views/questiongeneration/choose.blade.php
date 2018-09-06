@extends('layouts.app')

@section('content-title', 'Generate Question')

@section('content')

<script>

$(document).ready(function(){
    var i=0;
  
    $("input[name='question_type_checkbox[]']").each(function(){
        var j=0;
        $(this).click(function() {
            $("input[name='number_of_questions[]']").each(function(){
                if(i==j)
                {
                    $(this).prop('disabled',false);
                }
                j++;

            });
        });
        i++;
    });
    
});

</script>



<div>
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
                <td class="text-center"><label>Check</label></td>
                <td class="text-center"><label>Question Type</label></td>
                <td class="text-center"><label>Number of Questions</label></td>
                <td class="text-center"><label>Marks per Question</label></td>
                <td class="text-center">
                    <input type="checkbox">
                    <label>Percentage of Question</label>
                </td>
                <td class="text-center"><label>Total Marks of Type</label></td>
            </thead>
            <tbody>
                @foreach($question_types as $question_type)
                <tr>
                    <td class="text-center"><input type="checkbox" name="question_type_checkbox[]" id="question_type_checkbox"></td>
                    <td class="text-center"> 
                        {{$question_type->name}}
                    </td>
                    <td class="text-center">
                        <input type="text" name="number_of_questions[]" id="number_of_questions" disabled>
                    </td>
                    <td class="text-center">
                        <input type="text" name="marks_for_each_question[]" id="marks_for_each_question" disabled>
                    </td>
                    <td class="text-center">
                        <input type="text" name="percentage_of_question[]" id="percentage_of_question" disabled>
                    </td>
                    <td class="text-center">
                        <input type="text" name="total_marks_of_type[]" id="total_marks_of_type" disabled>
                    </td>
                </tr>
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
        </table>
    </div>
</div>



@endsection