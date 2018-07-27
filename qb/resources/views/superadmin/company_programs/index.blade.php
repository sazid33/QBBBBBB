@extends('layouts.app')

@section('content-title', 'Company-Programs')

@section('content')

<div class="">
      <div class="box">

        <div class="box-body">

          <table class ="table table-responsive">
  <thead>
    <tr>
      <th>Company Name</th>
      <th>Program Name</th>
      <th>Status</th>
    </tr>
  </thead>

  <tbody>
    @foreach($company_programs as $com_pro)
    <tr>
      <td>{{$com_pro->company}}</td>
      <td>{{$com_pro->program}}</td>
      <td>{{$com_pro->status}}</td>
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
    <button type="button" class="btn btn-primary btn-med" data-toggle="modal" data-target="#ssModal-create">
        Add Program To Company
    </button>
  </div>

  <div class="modal fade" id="ssModal-create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Company Details</h4>
          </div>
          <div class="modal-body">
            
            <form action="{{ route('company_programs.store') }}" method="POST">
            {{ csrf_field() }}
              <fieldset>

              <div>
                <select class="form-control" name="company_id" data-style="select-with-transition" title="Select Company" id="company" >
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
                <select class="form-control" name="program_id" data-style="select-with-transition" title="Select Program" id="program" >
                  @foreach($programs_array as $data)
                  <option value="{{$data->id}}">{{$data->name}}</option>
                  @endforeach
                </select>
                
                @if ($errors->has('program'))
                <span class="help-block">
                <strong>{{ $errors->first('program') }}</strong>
                </span>
                @endif
              </div>

              <div class="form-group">
                <label>Enter Number of Subjects to be Allowed</label>
                <input class="form-control" placeholder="Allowed Subject Number" name="allowed_subject" type="text" autofocus value="{{ old('name') }}">
                @if ($errors->has('allowed_subject'))
                <span class="help-block">{{ $errors->first('allowed_subject') }}</span>
                @endif
              </div>

              </br>

              <div class="form-group has-feedback {{ $errors->has('status') ? 'has-error' : '' }}">
                <input type="radio" name="status" value="active"> Active<br>
                <input type="radio" name="status" value="inactive"> Inactive
              </div>

                <!-- Change this to a button or input when using this as a form -->
                <button type="submit" class="btn btn-med btn-success" >Assign</button>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>

    

  @endsection