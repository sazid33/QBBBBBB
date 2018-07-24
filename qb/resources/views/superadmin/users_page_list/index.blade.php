@extends('layouts.app')

@section('content-title', 'Users Page')

@section('content')

<style>
    .test {

      /* Safari */
      -webkit-transform: rotate(-90deg);

      /* Firefox */
      -moz-transform: rotate(-90deg);

      /* IE */
      -ms-transform: rotate(-90deg);

      /* Opera */
      -o-transform: rotate(-90deg);

      
    }
</style>
<script>
  function test()
  {
    company_id = document.getElementById("company_id").value;
 
    alert("get_user_page/"+company_id);
        $.ajax({
          type="GET",
          url: "get_user_page/"+company_id,
          success: function(response){
            $("#divresult").html(response);
            alert(response);
        }});
  }

  /* Load positions into postion <selec> */

</script>
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
