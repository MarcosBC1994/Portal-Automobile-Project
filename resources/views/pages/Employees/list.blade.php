@extends('components.master.main')
@vite(['resources/css/Employees/employee-list.css'])


@section('content')
        <div class=" mx-auto pl-10 lg:pl-64">
               @component('components.Employees.list-employees',  ['employees' => $employees, 'roles' => $roles])
               @endcomponent
        </div>

@endsection

