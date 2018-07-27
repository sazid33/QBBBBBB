@extends('layouts.app')

@section('content-title', 'Add Chapter')

@section('content')



<script>

    var counter=1;

    $(function(){

        
        $("#add_more").click(function(){

            counter++;
            chapter = "chapter_name"+ counter;
            $("#tbody").append(
                '<input type="text" class ="form-control" placeholder="Chapter Name"'+
                    'id='+chapter+' required/>'+
                '<br>');

        })
    })

    //     $("#submit").click(function(){
    //         all_chapters = [];
            
    //         for(let i=1; i<=counter; i++)
    //         {
    //             chapter = "chapter_name"+i;
    //             alert(chapter);
    //             all_chapters.push(document.getElementById(chapter).value);
    //         }
    //         alert(all_chapters);
        
    //     })
    // })
    function button_press(){
        all_chapters = [];
        subject = "subject";
        for(let i=1; i<=counter; i++)
        {
            chapter = "chapter_name"+i;
            all_chapters.push(document.getElementById(chapter).value);
        }
        

        $.ajax({
            url: 'chapters.store',
            method:'POST',
            data: {"chapters": all_chapters,
                    "subject_id": subject},
            dataType: 'json',

            error:function(data){
                console.log(data);
            }
        })    

    }

    
</script>


<form>
    {{ csrf_field() }}

<div>

    <label>Select Subject</label>
    <br>
    <br>
    <div>
        <select class="form-control" name="subject" data-style="select-with-transition" title="Select Subject" id="subject" >
            @foreach($subject_array as $data)
                <option value="{{$data->id}}">{{$data->name}}</option>
            @endforeach
        </select>
                
        @if ($errors->has('company'))
        <span class="help-block">
            <strong>{{ $errors->first('company') }}</strong>
        </span>
         @endif
    </div>
</div>

<br>
<br>

<div>
    
    <div class="panel panel-default"  >
        <div class="panel-heading"id = "tbody">
            Add Chapter
            <br>
            <br>
            <input type="text" class ="form-control" placeholder="Chapter Name"
                id="chapter_name1"  required/>
            <br>
        </div>

    </div>
            <button class="btn btn-primary" id="add_more">Add More</button>
            <button class="btn btn-info" id="submit" onclick="button_press()">Submit</button>
    <br>
</div>

</form>
@endsection