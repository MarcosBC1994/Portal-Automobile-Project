@extends('components.master.main')

@section('content')
    <div class=" mx-auto pl-10 lg:pl-64">
        @component('components.projects.edit-projects', [
            'project' => $project,
            'countries' => $countries,
            'districts' => $districts,
            'projectstatuses' => $projectstatuses,
        ])
        @endcomponent
    </div>
@endsection
