@vite(['resources/js/Trips/edit.js'])
<script type="application/json" id="vehicles-data">@json($vehicles)</script>

<div class="flex justify-center items-start h-screen custom-bg">
    <div class="max-w-lg w-full bg-white rounded-xl shadow-md p-8 custom-card mt-12">
        <div class="flex items-center justify-between mb-4">
            <a href="{{ route('trips.index') }}" class="flex items-center">
                <button type="button"
                    class="flex items-center px-5 py-2 text-sm text-gray-700 transition-colors duration-200 bg-gray-600 border rounded-lg gap-x-2 hover:bg-gray-500">
                    <svg class="w-5 h-5 rtl:rotate-180 text-white" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                    </svg>
                </button>
            </a>
            <div class="flex-grow text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Editar viagem</h3>
            </div>
            <div class="w-10 h-10"></div>
        </div>

        <form action="{{ route('trips.update', $trip->id) }}" method="POST" id="trip-form">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">
                <div class="col-span-2 sm:col-span-1">
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Data de início</label>
                    <input type="date" name="start_date" id="start_date" value="{{ $trip->start_date }}"
                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    <div id="start_date_error" class="text-red-500"></div>
                    @error('start_date')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-span-2 sm:col-span-1">
                    <label for="end_date" class="block text-sm font-medium text-gray-700">Data de fim</label>
                    <input type="date" name="end_date" id="end_date" value="{{ $trip->end_date }}"
                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    <div id="end_date_error" class="text-red-500"></div>
                    @error('end_date')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-span-2">
                    <label for="destination" class="block text-sm font-medium text-gray-700">Destino</label>
                    <input type="text" name="destination" id="destination" value="{{ $trip->destination }}"
                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                </div>

                <div class="col-span-2">
                    <label for="purpose" class="block text-sm font-medium text-gray-700">Propósito</label>
                    <textarea name="purpose" id="purpose" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        required>{{ $trip->purpose }}</textarea>
                </div>

                <div class="col-span-2">
                    <label for="employee_id" class="block text-sm font-medium text-gray-700">Funcionário</label>
                    <select name="employee_id" id="employee_id"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}"
                                {{ $trip->employees->contains($employee->id) ? 'selected' : '' }}>
                                {{ $employee->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-span-2">
                    <label for="project_id" class="block text-sm font-medium text-gray-700">Projeto</label>
                    <select name="project_id" id="project_id"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}"
                                {{ $trip->project_id == $project->id ? 'selected' : '' }}>{{ $project->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-span-2">
                    <label for="type_trip_id" class="block text-sm font-medium text-gray-700">Tipo de Viagem</label>
                    <select name="type_trip_id" id="type_trip_id"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required>
                        @foreach ($typeTrips as $typeTrip)
                            <option value="{{ $typeTrip->id }}"
                                {{ $trip->type_trip_id == $typeTrip->id ? 'selected' : '' }}>{{ $typeTrip->type }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-span-2">
                    <label for="search_vehicle" class="block text-sm font-medium text-gray-700">Pesquisar veículo por
                        matrícula</label>
                    <input type="text" name="search_vehicle" id="search_vehicle"
                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                        placeholder="Escreva Aqui">
                </div>

                <div class="col-span-2">
                    <label for="vehicle_id" class="block text-sm font-medium text-gray-700">Veículo</label>
                    <select name="vehicle_id" id="vehicle_id"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="" disabled selected>Selecione um veículo</option>
                        @foreach ($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}"
                                {{ $trip->vehicles->contains($vehicle->id) ? 'selected' : '' }}>{{ $vehicle->plate }}
                            </option>
                        @endforeach
                    </select>
                    <div id="vehicle-error" class="text-red-500"></div>
                </div>

                <div class="col-span-2">
                    <button type="submit" id="submit-button"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700">Atualizar</button>
                </div>
            </div>
        </form>
    </div>
</div>
