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
                @foreach($users as $user)
                <td>
                    
                    <input type="checkbox" 

                        @if($user->user_id==$is_actives[$counter]->user_id && 
                        $page->id==$is_actives[$counter]->page_id && 
                        $is_actives[$counter]->allowed_view==1) 
                            checked="checked"
                            
                        @endif 

                        id="{{$page->id}}+{{$user->user_id}}+view"
                        name="{{$page->id}}+{{$user->user_id}}+view"
                    >View
                    <br>
                    <input type="checkbox" 

                        @if($user->user_id==$is_actives[$counter]->user_id && 
                        $page->id==$is_actives[$counter]->page_id && 
                        $is_actives[$counter]->allowed_add==1) 
                            checked="checked" 
                            
                        @endif 

                        id="{{$page->id}}+{{$user->user_id}}+add"
                        name="{{$page->id}}+{{$user->user_id}}+add"

                    >Add
                    <br>
                    <input type="checkbox" 

                        @if($user->user_id==$is_actives[$counter]->user_id && 
                        $page->id==$is_actives[$counter]->page_id && 
                        $is_actives[$counter]->allowed_update==1) 
                            checked="checked" 
                            
                        @endif

                        id="{{$page->id}}+{{$user->user_id}}+update"
                        name="{{$page->id}}+{{$user->user_id}}+update"
                    >Update
                    <br>
                    <input type="checkbox" 

                        @if($user->user_id==$is_actives[$counter]->user_id && 
                        $page->id==$is_actives[$counter]->page_id && 
                        $is_actives[$counter]->allowed_delete==1) 
                            checked="checked" 
                            
                        @endif

                        id="{{$page->id}}+{{$user->user_id}}+delete"
                        name="{{$page->id}}+{{$user->user_id}}+delete"

                        {{ $counter++ }}
                    >Delete
                  
                </td>
                
                @endforeach
        </tr>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex flex-row-reverse">
            <button type="button" class="btn btn-default d-flex justify-content-end" >Update</button>
    </div>
    </div>
    <br>
</div>

@endsection