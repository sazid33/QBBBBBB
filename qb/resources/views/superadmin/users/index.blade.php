@extends('layouts.app')

@section('content-title', 'Users')

@section('content')



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

            <tbody>
              @foreach($users as $user)
              <tr>
                <td>{{$user->user_name}}</td>
                <td>{{$user->user_email}}</td>
                <td>{{$user->company_name}}</td>
                <td>{{$user->role_name}}</td>
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
      <button type="button" class="btn btn-primary btn-med" data-toggle="modal" data-target="#ssModal2">
        Add New User
      </button>
    </div>


    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="ssModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
            <div>
                <label>Select Company</label>
                <select class="form-control" name="company" data-style="select-with-transition" title="Select Degree" id="" >
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
                <select class="form-control" name="role" data-style="select-with-transition" title="Select Degree" id="" >
                    @foreach($role_array as $data)
                    <option value="{{$data->id}}">{{$data->name}}</option>
                    @endforeach
                </select>
                
                @if ($errors->has('role'))
                <span class="help-block">
                    <strong>{{ $errors->first('role') }}</strong>
                </span>
                @endif
            </div>
            </br>
            <!-- Change this to a button or input when using this as a form -->
            <button type="submit" class="btn btn-lg btn-success btn-block">Register</button>
            <a href="{{ route('login') }}" class="btn btn-lg btn-primary btn-block">Login</a>
          </fieldset>
        </form>
          </div>
        </div>
      </div>
    </div>

@endsection