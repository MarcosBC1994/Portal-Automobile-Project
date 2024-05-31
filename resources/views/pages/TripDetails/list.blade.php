@extends('components.master.main')
@vite(['resources/css/Employees/employee-list.css'])
@vite(['resources/css/Modals/Modal.css'])

@section('content')
    <div class="mx-auto pl-10 lg:pl-64">
        @component('components.trip-details.list-trip-details', [
            'tripDetails' => $tripDetails,
            'projects' => $projects,
            'costTypes' => $costTypes,
            'trips'=> $trips,
            'employees' => $employees
        ])
        @endcomponent
    </div>
@endsection
