@extends('components.master.main')

@section('content')
    <div class="mx-auto pl-10 lg:pl-64">
        @component('components.trip-details.show-trip-detail', [
            'tripDetail' => $tripDetail,
            'trip' => $trip,
            'project' => $project,
        ])
        @endcomponent
    </div>
@endsection



