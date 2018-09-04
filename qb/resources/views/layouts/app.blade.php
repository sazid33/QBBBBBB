@extends('sb-admin-2::layouts.main')

@section('sidebar-menu')
<ul class="nav" id="side-menu">
  <li class="active treeview">
    <a href="#">
      <i class="fa fa-dashboard"></i> <span>Super Admin</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="active treeview-menu" style="display: block;">
      <li class="active"><a href="{{ url('superadmin/companies') }}" class="active"> Add Companies</a></li>
      <li class="active"><a href="{{ url('superadmin/degrees') }}" class="active">Degrees</a></li>
      <li class="active"><a href="{{ url('superadmin/programs') }}" class="active"><i class="fa fa-tasks fa-fw"></i> Programs</a></li>
      <li class="active"><a href="{{ url('superadmin/question_types') }}" class="active"><i class="fa fa-question fa-fw"></i>Question Types</a></li>
      <li class="active"><a href="{{ url('superadmin/company_programs') }}" class="active"><i class="fa fa-building fa-fw"></i> Company Programs</a></li>
      <li class="active"><a href="{{ url('superadmin/roles') }}" class="active"><i class="fa fa-users fa-fw"></i> Roles</a></li>
      <li class="active"><a href="{{ url('superadmin/pages') }}" class="active"><i class="fa fa-file fa-fw"></i> Pages</a></li>
      <li class="active"><a href="{{ url('superadmin/user_pages_list') }}" class="active"><i class="fa fa-users fa-fw"></i>-<i class="fa fa-file fa-fw"></i>Users Page</a></li>
      <li><a href="{{ url('superadmin/company_program_subjects') }}" class="active"><i class="fa fa-users fa-fw"></i>-<i class="fa fa-file fa-fw"></i>Assign Subjects to Program</a></li>
    </ul>
  </li>


  <li>
    
    <a href="{{ url('superadmin/users') }}" class="active"><i class="fa fa-users fa-fw"></i> Users</a>
    
    
    <a href="{{ url('superadmin/subjects') }}" class="active"><i class="fa fa-book fa-fw"></i> Subjects</a>
    <a href="{{ url('superadmin/chapters') }}" class="active"><i class="fa fa-book fa-fw"></i> Chapters</a>
    <a href="{{ url('superadmin/topics') }}" class="active"><i class="fa fa-book fa-fw"></i> Topics</a>

    <a href="{{ url('superadmin/questions') }}" class="active"><i class="fa fa-question fa-fw"></i>Questions</a>
  </li>
</ul>
@endsection
