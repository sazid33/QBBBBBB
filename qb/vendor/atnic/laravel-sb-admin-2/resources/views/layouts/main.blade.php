<!DOCTYPE html>
<html lang="@yield('lang', config('app.locale', 'en'))">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Atnic">
  <meta name="_token" content="{!! csrf_token() !!}" />

  <title>@yield('SS QB', config('app.name', 'SS QB'))</title>

  
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!--JQuery-->
  <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous">
  
  </script>
  
  <script>

  $(document).ready(function(){
    
    

    var zero_value =0;
    
    function getUserAccordingToPresentUser(present_user_company_id)
    {
      var url='/users/getUsersAccordingToCurrentUser';

      $.ajax({
        url:url,
        method:'GET',
        data:{
          id:present_user_company_id
        },
        success:function(data)
        { 
          
          $('#user_table').empty();
          $('#user_for_searching').empty;
          $('#user_for_searching').append('<option value="'+zero_value+'">--Select User--</option>');
          $.each(data,function(index,companiesObjectAccordingToPresentUser){                      
            companiesObjectAccordingToPresentUser.forEach(function(element){
                $('#user_table').append('<tr><td>'+element.user_name+'</td><td>'+element.user_email+'</td><td>'+element.company_name+'</td><td>'+element.role_name+'</td><td class="text-center"><a href="#" class="btn btn-xs btn-success view" id="'+element.user_id+'"><i class="glyphicon glyphicon-eye-open"></i> View</a> <a href="#" class="btn btn-xs btn-primary edit" id="'+element.user_id+'"><i class="glyphicon glyphicon-edit"></i> Edit </a> <a href="#" class="btn btn-xs btn-danger delete" id="'+element.user_id+'"><i class="glyphicon glyphicon-warning-sign"></i> Delete</a></td></tr>');
                $('#user_for_searching').append('<option value="'+element.id+'">'+element.user_name+'</option>');
            });
          });
        },
        error:function(data)
        {
          console.log(data);
        }

      });
    }

    function getProgramAccordingToPresentUserCompany(present_user_company_id)
    {
      var url = '/programs/getProgramAccordingToPresentUserCompany';

      $.ajax({
        url:url,
        method:'GET',
        data:{
          id:present_user_company_id
        },
        dataType:'json',
        success:function(data)
        {
          console.log(data);
          $.each(data,function(index,programsObjectAccordingToPresentUser){                      
            programsObjectAccordingToPresentUser.forEach(function(element){
                $('#current_user_company_program').append('<option value="'+element.program_id+'">'+element.program+'</option>');
            });
          });
        },
        error:function(data)
        {
          console.log(data);
        }
      });
    }

    function getSubjectAccordingToPresentUser(present_user_company_id)
    {
      var url='/subjects/getSubjectAccordingToPresentUser';

      $.ajax({
        url:url,
        method:'GET',
        data:{
          id:present_user_company_id
        },
        success:function(data)
        {
          $('#current_user_company_program_subject').empty();
          $('#current_user_company_program_subject').append('<option value="'+zero_value+'">--Select Subject--</option>');
          
          //console.log(data);
          $.each(data,function(index,subjectsObjectAccordingToPresentUser){                      
            subjectsObjectAccordingToPresentUser.forEach(function(element){
                $('#current_user_company_program_subject').append('<option value="'+element.subject_id+'">'+element.subject_name+'</option>');
            });
          });
        },
        error:function(data)
        {
          console.log(data);
        }

      });
    }

    $(function getCurrentUserCompany()
    {
      var url='/companies/getCurrentUserCompany';

      $.ajax({
        url:url,
        method:'GET',
        data:{

        },
        dataType:'json',
        success:function(data)
        {

          $('#current_user_company').empty();
          $('#current_user_company').prop("disabled", false);
          $('#company_for_searching').empty();
          $('#company_for_searching').prop("disabled", false);
          if(data.company.length > 1)
          {
            $('#current_user_company').append('<option value="'+zero_value+'">--Select Company--</option>');
            $('#company_for_searching').append('<option value="'+zero_value+'">--Select Company--</option>');
            
          }

          else
          {
            $("#company_for_searching").prop("disabled", true);
            $("#current_user_company").prop("disabled", true);

          }

          $.each(data,function(index,companiesObjectAccordingToPresentUser){
              
            companiesObjectAccordingToPresentUser.forEach(function(element){
              $('#current_user_company').append('<option value="'+element.company_id+'">'+element.company_name+'</option>');
              $('#company_for_searching').append('<option value="'+element.company_id+'">'+element.company_name+'</option>');
            });
          });
          getUserAccordingToPresentUser(data.company[0].company_id);
          getSubjectAccordingToPresentUser(data.company[0].company_id);
          getProgramAccordingToPresentUserCompany(data.company[0].company_id);
        },
        error:function(data)
        {
          console.log(data);
        },
      });
    });
    
    

    $(function getRoleAccordingToPresentUserRole()
    {
      var url='/roles/getRoleAccordingToPresentUsersRole';
      $.ajax({
          url:url,
          method:'GET',
          data:{

          },
          dataType:'json',
          success:function(data)
          { 
            $('#role_user_create').append('<option value = "'+zero_value+'">--Select Role--</option>');
            $('#role_for_searching').append('<option value = "'+zero_value+'">--Select Role--</option>');
            $.each(data,function(index,rolesObjectAccordingToPresentUser){
              
              rolesObjectAccordingToPresentUser.forEach(function(element){
                $('#role_user_create').append('<option value="'+element.role_id+'">'+element.role_name+'</option>');
                $('#role_for_searching').append('<option value="'+element.role_id+'">'+element.role_name+'</option>');
              });
            });
            
          },
          error:function(data)
          {
            console.log(data);
          }
      })
    });

    
  });

  </script>


  <!-- Styles -->
  @section('styles')
  <link href="{{ mix('/css/sb-admin-2.css') }}" rel="stylesheet">
  @show

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  @stack('head')
</head>
<body>
  <div id="app" class="wrapper">

    <!-- Navigation -->
    @include('sb-admin-2::layouts.navigation.main')

    <!-- Page Wrapper -->
    @include('sb-admin-2::layouts.page-wrapper.main')

  </div>
  <!-- /#wrapper -->

  @section('scripts')
  <script src="{{ mix('/js/manifest.js') }}" charset="utf-8"></script>
  <script src="{{ mix('/js/vendor.js') }}" charset="utf-8"></script>
  <script src="{{ mix('/js/sb-admin-2.js') }}" charset="utf-8"></script>
  @show
  @stack('body')
  
</body>
</html>
