@extends('layouts.app')

@section('content-title', 'Companies')

@section('content')



<div class="">
      <div class="box">

        <div class="box-body">

          <table class ="table table-responsive">
            <thead>
              <tr>
                <th>Name</th>
                <th>Status</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>

            <tbody>
              @foreach($companies as $company)
              <tr>
                <td>{{$company->name}}</td>
                <td>{{$company->status}}</td>
                <td class="text-center">
                  <a href="#" class="btn btn-xs btn-success view" id="{{ $company->id }}"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                  <a href="#" class="btn btn-xs btn-primary edit" id="{{ $company->id }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                  <a href="#" class="btn btn-xs btn-danger delete" id="{{ $company->id }}"><i class="glyphicon glyphicon-warning-sign"></i> Delete</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

        </div>
      </div>

    
        </br>
    <div>
      <button type="button" class="btn btn-primary btn-med" data-toggle="modal" data-target="#ssModal-create">
        Add New Company
      </button>
    </div>
    

      <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="ssModal-create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Company Details</h4>
          </div>
          <div class="modal-body">
            
            <form action="{{ route('companies.store') }}" method="POST">
            {{ csrf_field() }}
            <fieldset>
              <div class="form-group">
                <label>Enter Company Name</label>
                <input class="form-control" placeholder="Company Name" name="company_name" type="text" autofocus value="{{ old('name') }}">
                @if ($errors->has('name'))
                <span class="help-block">{{ $errors->first('name') }}</span>
                @endif
              </div>
                
              <div class="form-group has-feedback {{ $errors->has('status') ? 'has-error' : '' }}">
                <input type="radio" name="status" value="active"> Active<br>
                <input type="radio" name="status" value="inactive"> Inactive
              </div>

              <label>Register An User for this Company</label>
              
              <div class="form-group">
                <input class="form-control" placeholder="Full name" name="user_name" type="text" autofocus value="{{ old('name') }}">
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
              
              <div>
                <label>Select Role</label>
                <select class="form-control" name="role_user_create" data-style="select-with-transition" title="Select Role" id="role_user_create" >
                
                </select>
              </div>

              </br>
              <!-- Change this to a button or input when using this as a form -->
                <button type="submit" class="btn btn-med btn-success">Add Company</button>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>

    

  @endsection

  