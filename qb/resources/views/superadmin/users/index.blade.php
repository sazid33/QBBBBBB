@extends('layouts.app')

@section('content-title', 'Users')

@section('content')


<script>

$(document).ready(function(){

  var user_id;
  var company_id;
  var role_id;

  
  
  function searchFunction()
  {
    user_id = $("#user").val();
    company_id = $("#company").val();
    role_id = $("#role").val();

    if(user_id == 0 && company_id == 0 && role_id == 0)
    {
      $("#search").prop('disabled', true);
      var url = '/users/searchUsers';
      $.ajax({
        url:url,
        method:'GET',
        data:{
          
        },
        dataType: 'json',
        success:function(data){
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

  $('#user').on('change', function(){
    searchFunction();
  });

  $('#company').on('change', function(){
    searchFunction();
  });

  $('#role').on('change', function(){
    searchFunction();
  });


  $('#search').on('click', function(){
    var url = '/users/searchUsers';
    $.ajax({
      url:url,
      method:'GET',
      data:{
        user_id:user_id,
        company_id:company_id,
        role_id:role_id,
      },
      dataType: 'json',
      success:function(data){
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
  });
});

</script>


<div>
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-3">
            <div id="choose_company">
                <h4><label>Search By Name</label></h4>
                <select class="form-control" name="user_id" data-style="select-with-transition" title="Select User" id="user" >
                    <option value="0">--Select User Name--</option>
                    @foreach($user_array as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="col-md-3">
            <div id="choose_program">
                <h4><label>Search By Company</label></h4>
                <select class="form-control" name="company_id" data-style="select-with-transition" title="Select Company" id="company" >
                    <option value="0">--Select Company--</option>
                    @foreach($company_array as $company)
                    <option value="{{$company->id}}">{{$company->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div id="choose_subject">
                <h4><label>Search By User Role</label></h4>
                <select class="form-control" name="role_id" data-style="select-with-transition" title="Select Subject" id="role" >
                    <option value="0">--Select User Role--</option>
                    @foreach($role_array as $role)
                    <option value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                </select>
            </div>
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
                <th>Name</th>
                <th>Email</th>
                <th>Company</th>
                <th>Role</th>
              </tr>
            </thead>

            <tbody id="user_table">
              @foreach($users as $user)
              <tr>
                <td id>{{$user->user_name}}</td>
                <td id>{{$user->user_email}}</td>
                <td id>{{$user->company_name}}</td>
                <td id>{{$user->role_name}}</td>
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
    <div>
      <button type="button" class="btn btn-primary btn-med" data-toggle="modal" data-target="#ssModal-create">
        Add New User
      </button>
    </div>


    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="ssModal-create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">User Details</h4>
          </div>
          <div class="modal-body">
            
          <form action="{{ route('users.store') }}" method="POST">
          {{ csrf_field() }}
          <fieldset>
            <div>
                <label>Select Company</label>
                <select class="form-control" name="company" data-style="select-with-transition" title="Select Company" id="company" >
                    @foreach($company_array as $data)
                        <option value="{{$data->id}}">{{$data->name}}</option>
                    @endforeach
                </select>
                
                @if ($errors->has('company'))
                <span class="help-block">
                    <strong>{{ $errors->first('company') }}</strong>
                </span>
                @endif
            </div>
            </br>
            <div>
                <label>Select Role</label>
                <select class="form-control" name="role_user_create" data-style="select-with-transition" title="Select Role" id="role_user_create" >
                  
                </select>
            </div>
            </br>



            <div class="form-group">
              <input class="form-control" placeholder="Full name" name="name" type="text" autofocus value="{{ old('name') }}">
              @if ($errors->has('name'))
              <span class="help-block">{{ $errors->first('name') }}</span>
              @endif
            </div>
            
            <div class="form-group">
              <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus value=" {{ old('email') }} ">
              @if ($errors->has('email'))
              <span class="help-block">{{ $errors->first('email') }}</span>
              @endif
            </div>
            <div class="form-group">
              <input class="form-control" placeholder="Password" name="password" type="password" value="">
              @if ($errors->has('password'))
              <span class="help-block">{{ $errors->first('password') }}</span>
              @endif
            </div>
            <div class="form-group">
              <input class="form-control" placeholder="Password Confirmation" name="password_confirmation" type="password" value="">
              @if ($errors->has('password_confirmation'))
              <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
              @endif
            </div>
            <br>
            
            <!-- Change this to a button or input when using this as a form -->
            <button type="submit" class="btn btn-lg btn-success btn-block">Register</button>
          </fieldset>
        </form>
          </div>
        </div>
      </div>
    </div>

@endsection