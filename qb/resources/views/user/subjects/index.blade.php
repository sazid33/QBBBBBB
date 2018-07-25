@extends('layouts.app')

@section('content-title', 'Subjects')

@section('content')

<div class="">
    <div class="box">

        <div class="box-body">

            <table class ="table table-responsive">
                <thead>
                <tr>
                    <th>Subject ID</th>
                    <th>Name</th>
                </tr>
                </thead>

                <tbody>
                    @foreach($subjects as $subject)
                    <tr>
                    <td>{{$subject->id}}</td>
                    <td>{{$subject->name}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
  </div>

  @endsection