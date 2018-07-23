@extends('layouts.app')

@section('content-title', 'Users Page')

@section('content')



<div class="">
      <div class="box">

        <div class="box-body">

          <table class ="table table-responsive">
            <thead>
              <tr>
                <th>User</th>
                @foreach($pages as $page)
                <th>{{$page->name}}</th>
                @endforeach
              </tr>
            </thead>

            <tbody>
              @foreach($users as $user)
              <tr>
                <td>{{$user->name}}</td>
                @foreach($pages as $page)
                <th>
                <span class="">
                    <input type="checkbox">
                </span>
                </th>
                @endforeach
              </tr>
              @endforeach
            </tbody>
          </table>

        </div>
      </div>

    <div class="button" pull-right>
        <button type="button" class="btn btn-default">Update</button>
    </div>

@endsection
