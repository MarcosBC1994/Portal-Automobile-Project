@extends('components.master.main')

@section('content')
    <div class=" mx-auto pl-10 lg:pl-64">
        @component('components.employees.edit-employees', ['employee' => $employee, 'roles' => $roles, 'drivingLicenses' => $drivingLicenses])
        @endcomponent
    </div>
@endsection
