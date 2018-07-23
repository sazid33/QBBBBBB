@extends('layouts.app')

@section('content-title', 'Companies')

@section('content')



<div class="">
      <div class="box">

        <div class="box-body">

          <table class ="table table-responsive">
            <thead>
              <tr>
                <th>Company ID</th>
                <th>Name</th>
                <th>Status</th>
              </tr>
            </thead>

            <tbody>
              @foreach($companies as $company)
              <tr>
                <td>{{$company->id}}</td>
                <td>{{$company->name}}</td>
                <td>{{$company->status}}</td>
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
      <button type="button" class="btn btn-primary btn-med" data-toggle="modal" data-target="#ssModal">
        Add New Company
      </button>
    </div>
    

      <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="ssModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                <button type="submit" class="btn btn-med btn-success">Add Company</button>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>

    

  @endsection

  