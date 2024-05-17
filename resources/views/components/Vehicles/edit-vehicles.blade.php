@extends('layouts.app')

@section('content')
    <div class="container mx-auto text-center">
        <h1 class="text-2xl font-bold mb-4">Editar Veículo</h1>
    </div>
    <div class="max-w-lg mx-auto shadow-lg p-6 bg-white rounded-lg">
        <form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST" enctype="multipart/form-data" class="max-w-lg mx-auto">
            @csrf
            @method('PUT')

            <!-- Common fields -->
            <div class="mb-4">
                <label for="plate" class="block text-sm font-medium text-gray-700">Placa</label>
                <input type="text" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" id="plate" name="plate" value="{{ $vehicle->plate }}" required>
            </div>

            <div class="mb-4">
                <label for="km" class="block text-sm font-medium text-gray-700">KM</label>
                <input type="number" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" id="km" name="km" value="{{ $vehicle->km }}" required>
            </div>

            <div class="mb-4">
                <label for="condition" class="block text-sm font-medium text-gray-700">Condição</label>
                <input type="text" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" id="condition" name="condition" value="{{ $vehicle->condition }}" required>
            </div>

            <div class="mb-4">
                <label for="brand" class="block text-sm font-medium text-gray-700">Marca</label>
                <select class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="brand" name="brand" required>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ $vehicle->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="fuel_type_id" class="block text-sm font-medium text-gray-700">Tipo de Combustível</label>
                <select class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="fuel_type_id" name="fuel_type_id" required>
                    @foreach($fuelTypes as $fuelType)
                        <option value="{{ $fuelType->id }}" {{ $vehicle->fuel_type_id == $fuelType->id ? 'selected' : '' }}>{{ $fuelType->type }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="car_category_id" class="block text-sm font-medium text-gray-700">Categoria do Carro</label>
                <select class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="car_category_id" name="car_category_id" required>
                    @foreach($carCategories as $carCategory)
                        <option value="{{ $carCategory->id }}" {{ $vehicle->car_category_id == $carCategory->id ? 'selected' : '' }}>{{ $carCategory->category }}</option>
                    @endforeach
                </select>
            </div>

            <!-- External vehicle fields -->
            @if($vehicle->is_external)
                <div id="externalVehicleFields" class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Detalhes do Aluguer</label>
                    <div class="border rounded-md p-4">
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <label for="contract_number" class="block text-sm font-medium text-gray-700">Número do Contrato</label>
                                <input type="text" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" id="contract_number" name="contract_number" value="{{ $vehicle->contract_number }}">
                            </div>
                            <div>
                                <label for="rental_price_per_day" class="block text-sm font-medium text-gray-700">Preço do Aluguer por Dia</label>
                                <input type="number" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" id="rental_price_per_day" name="rental_price_per_day" value="{{ $vehicle->rental_price_per_day }}">
                            </div>
                            <div>
                                <label for="rental_start_date" class="block text-sm font-medium text-gray-700">Data de Início do Aluguer</label>
                                <input type="date" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" id="rental_start_date" name="rental_start_date" value="{{ $vehicle->rental_start_date }}">
                            </div>
                            <div>
                                <label for="rental_end_date" class="block text-sm font-medium text-gray-700">Data de Fim do Aluguer</label>
                                <input type="date" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" id="rental_end_date" name="rental_end_date" value="{{ $vehicle->rental_end_date }}">
                            </div>
                            <div>
                                <label for="rental_company" class="block text-sm font-medium text-gray-700">Empresa de Aluguer</label>
                                <input type="text" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" id="rental_company" name="rental_company" value="{{ $vehicle->rental_company }}">
                            </div>
                            <div>
                                <label for="rental_contact_person" class="block text-sm font-medium text-gray-700">Pessoa de Contato do Aluguer</label>
                                <input type="text" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" id="rental_contact_person" name="rental_contact_person" value="{{ $vehicle->rental_contact_person }}">
                            </div>
                            <div>
                                <label for="rental_contact_number" class="block text-sm font-medium text-gray-700">Número de Contato do Aluguer</label>
                                <input type="text" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" id="rental_contact_number" name="rental_contact_number" value="{{ $vehicle->rental_contact_number }}">
                            </div>
                            <div>
                                <label for="pdf_file" class="block text-sm font-medium text-gray-700">PDF do Contrato</label>
                                <input type="file" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" id="pdf_file" name="pdf_file">
                                @if($vehicle->pdf_file)
                                    <div class="mt-2 flex items-center">
                                        <p class="text-sm text-gray-700">PDF atual:</p>
                                        <a href="{{ route('vehicles.downloadPdf', $vehicle->id) }}" class="ml-2 px-3 py-1 bg-blue-500 hover:bg-blue-700 text-white font-semibold rounded">Download</a>
                                        <input type="hidden" name="current_pdf" value="{{ $vehicle->pdf_file }}">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Guardar</button>
        </form>
    </div>
@endsection

