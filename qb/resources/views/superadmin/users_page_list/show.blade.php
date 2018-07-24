@extends('layouts.app')

@section('content-title', 'Users Page')

@section('content')

<div class="box">

    <div class="box-body">

    <table class ="table table-responsive">
        <thread>
        <tr>
            <th>Pages/User</th>
            @foreach($users as $user)
                <th>{{ $user->user_name }}</th>
            @endforeach
        </tr>
        </thread>
        <tbody>
        @foreach($pages as $page)
        <tr>
            <td>{{ $page->name }}</td>
            <td>
                <input type="checkbox" >
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

    </div>
</div>

@endsection