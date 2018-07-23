@extends('layouts.app')

@section('content-title', 'Home')

@section('content')


<div class="form-group">
    <select name="companies" id="company_id" class="form-control input-lg dynamic" data-dependent="program_id">
        <option value="">Select Company</option>
        @foreach($companies as $company)
        <option value="{{$company->company_id}}">{{$company->company_name}}</option>
        @endforeach
    </select>
    </br>
    <select name="program_id" id="program_id" class="form-control input-lg">
        <option value="">Select Program</option>
        
    </select>
    </div>
    {{ csrf_field() }}

    <script>
    $(document).ready(function(){
        $('.dynamic').change(function(){
            if($(this).val() != '')
            {
                var select = $(this).attr("id");
                var value = $(this).val();
                var dependent = $(this).data('dependent');
                var _token = $('input[name = " "]').val();

                $request = $.ajax({
                    url:"{{ route('dynamicdependent.fetch') }}",
                    method:"POST",
                    data:{'_token':_token, 'select':select, 'value':value, 'dependent':dependent},
                    success:function(result)
                    {
                        $('#'+dependent).html(result);
                    }
                });
            }
        });
    });
    </script>

@endsection