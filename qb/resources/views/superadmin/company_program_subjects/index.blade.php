@extends('layouts.app')

@section('content-title', 'Assign Subjects to Programs')

@section('content')

<script>
$(document).ready(function(){

    var zero_value = 0;
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
                $('#program').empty();
                $('#program').append('<option value="'+zero_value+'">--Select Program--</option>');
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


    $('#company_for_searching').on('change', function(event){
        company_id = event.target.value;
        
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
                $('#subject').empty();
                $('#subject').append('<option value="'+zero_value+'">--Select Subject--</option>');
                $.each(data,function(index,subjectsObjectForSelectedCompany){
                
                    subjectsObjectForSelectedCompany.forEach(function(element) {
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

    });

    


});

</script>


<div>
    <div class="box-body">
            
        <table class ="table table-responsive">
        {{ csrf_field() }}
            <thead>
                <tr>
                    <th>Company Name</th>
                    <th>Program Name</th>
                    <th>Subject</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                
            </tbody>
        </table>
    </div>

    <div class="button">
        <button type="button" class="btn btn-primary btn-med" data-toggle="modal" data-target="#ssModal-create">
        Assign Subject To Program
        </button>
    </div>
</div>


<div class="modal fade" id="ssModal-create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Topic</h4>
            </div>
            
            <div class="modal-body">
            
                <form action="/company_program_subjects/store" method="POST">
                    {{ csrf_field() }}
                    <fieldset>
                
                    <div>
                        <select class="form-control" name="company_for_searching" data-style="select-with-transition" title="Select Company" id="company_for_searching" >
                            
                        </select>
                    </div>
                    <br>

                    <div>
                        <select class="form-control" name="program_id" data-style="select-with-transition" title="Select Program" id="program" >
                            
                        </select>
                    </div>
                    <br>

                    <div>
                        <select class="form-control" name="subject_id" data-style="select-with-transition" title="Select Subject" id="subject" >
                            <option>--Select Subject--</option>
                            <option value=""></option>
                        </select>
                    </div>
                    <br>
                
              <!-- Change this to a button or input when using this as a form -->
                <button id="submit" class="btn btn-med btn-success">Assign Subject</button>
            </fieldset>
            </form>
            </div>
        </div>
    </div>
</div>



@endsection