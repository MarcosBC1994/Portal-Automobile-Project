@extends('components.master.main')

@section('content')

    <div class=" mx-auto pl-10 lg:pl-64">

    @component('components.Insurance.show-insurance', ['insurance' => $insurance])
    @endcomponent

    </div>

@endsection



