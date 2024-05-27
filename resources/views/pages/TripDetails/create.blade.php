@extends('components.master.main')
@vite('resources/css/Trips/trip-create.css')

@section('content')
    <div class=" mx-auto pl-10 lg:pl-64">
        @component('components.trip-details.create-trip-detail', [
            'costTypes' => $costTypes,
            'trips' => $trips,
            'employees' => $employees,
        ])
        @endcomponent
    </div>
@endsection
