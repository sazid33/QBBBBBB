@extends('layouts.app')

@section('content-title', 'Question Type')

@section('content')

<div class="">
    <div class="box">

        <div class="box-body">

            <table class ="table table-responsive">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Header Text</th>
                </tr>
                </thead>

                <tbody>
                    @foreach($types as $type)
                    <tr>
                    <td>{{$type->name}}</td>
                    <td>{{$type->header_text}}</td>
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
    <div class="button">
        <button type="button" class="btn btn-primary btn-med" data-toggle="modal" data-target="#ssModal-create">
        Add New Question Type
        </button>
    </div>
  </div>

       <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="ssModal-create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add Question Type</h4>
          </div>
          <div class="modal-body">
            
            <form action="{{ route('question_types.store') }}" method="POST">
            {{ csrf_field() }}
            <fieldset>
              <div class="form-group">
                <label>Enter Question Type</label>
                <input class="form-control" placeholder="" name="name" type="text" autofocus value="{{ old('name') }}">
                @if ($errors->has('name'))
                <span class="help-block">{{ $errors->first('name') }}</span>
                @endif
              </div>

              <div class="form-group">
                <label>Enter Question Header</label>
                <input class="form-control" placeholder="" name="header_text" type="text" autofocus value="{{ old('name') }}">
                
              </div>
                
              <!-- Change this to a button or input when using this as a form -->
                <button type="submit" class="btn btn-med btn-success">Add Question Type</button>
            </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>

  @endsection