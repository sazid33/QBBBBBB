@extends('layouts.app')

@section('content-title', 'Users Page')

@section('content')

<div>
  <h2>Select Company</h2>
</div>

<div class="box">

  <div class="box-body">

    <table class ="table table-responsive">
      <tbody>
        @foreach($companies as $company)
        <tr>
          <td><a href="user_pages_list/{{ $company->id }}">{{$company->name}}</a></td>
          <td>{{$company->status}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>

  </div>
</div>
              

@endsection
