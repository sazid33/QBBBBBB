@extends('sb-admin-2::layouts.main')

@section('sidebar-menu')
<ul class="nav" id="side-menu">
  <li>
    <a href="{{ url('superadmin/companies') }}" class="active"><i class="fa fa-building fa-fw"></i> Companies</a>
    <a href="{{ url('superadmin/users') }}" class="active"><i class="fa fa-users fa-fw"></i> Users</a>
    <a href="{{ url('superadmin/degrees') }}" class="active"><i class="fa fa-bookmark fa-fw"></i> Degrees</a>
    <a href="{{ url('superadmin/programs') }}" class="active"><i class="fa fa-tasks fa-fw"></i> Programs</a>
    <a href="{{ url('superadmin/subjects') }}" class="active"><i class="fa fa-book fa-fw"></i> Subjects</a>
    <a href="{{ url('superadmin/chapters') }}" class="active"><i class="fa fa-book fa-fw"></i> Chapters</a>
    <a href="{{ url('superadmin/topics') }}" class="active"><i class="fa fa-book fa-fw"></i> Topics</a>
    <a href="{{ url('superadmin/roles') }}" class="active"><i class="fa fa-users fa-fw"></i> Roles</a>
    <a href="{{ url('superadmin/pages') }}" class="active"><i class="fa fa-file fa-fw"></i> Pages</a>
    <a href="{{ url('superadmin/company_programs') }}" class="active"><i class="fa fa-building fa-fw"></i>-
    <i class="fa fa-tasks fa-fw"></i> Company Programs</a>
    <a href="{{ url('superadmin/user_pages_list') }}" class="active"><i class="fa fa-users fa-fw"></i>-
    <i class="fa fa-file fa-fw"></i>Users Page</a>
  </li>
</ul>
@endsection
