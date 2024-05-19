
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .custom-bg {
            background-color: #f5f5f5;
        }

        .custom-card {
            background-color: #ffffff;
            box-shadow: 0px 20px 20px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            padding: 20px;
            max-width: 800px;
            margin: auto;
        }

        .custom-btn {
            background-color: #000;
            color: #fff;
            transition: background-color 0.3s ease;
            border-radius: 30px;
        }

        .custom-btn:hover {
            background-color: #222;
        }

        .form-input, .form-control, .form-select, .form-textarea {
            border: 2px solid #ccc;
            transition: border-color 0.3s ease;
            padding: 8px;
        }

        .form-input:focus, .form-control:focus, .form-select:focus, .form-textarea:focus {
            border-color: #888;
        }

        @media (max-width: 640px) {
            .custom-logo {
                width: 80px;
                height: 80px;
            }
        }
    </style>

<div class="flex justify-center">
    <div class="w-3/4 mx-auto">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Editar Veículo</h3>
            <form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">
                    <div class="col-span-2 sm:col-span-1">
                        <label for="plate" class="block text-sm font-medium text-gray-700">Placa</label>
                        <input type="text" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" id="plate" name="plate" value="{{ $vehicle->plate }}" required>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="km" class="block text-sm font-medium text-gray-700">KM</label>
                        <input type="number" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" id="km" name="km" value="{{ $vehicle->km }}" required>
                    </div>
                    <div class="col-span-2">
                        <label for="condition" class="block text-sm font-medium text-gray-700">Condição</label>
                        <input type="text" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" id="condition" name="condition" value="{{ $vehicle->condition }}" required>
                    </div>
                    <div class="col-span-2">
                        <label for="brand" class="block text-sm font-medium text-gray-700">Marca</label>
                        <select class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="brand" name="brand" required>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ $vehicle->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label for="fuel_type_id" class="block text-sm font-medium text-gray-700">Tipo de Combustível</label>
                        <select class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="fuel_type_id" name="fuel_type_id" required>
                            @foreach($fuelTypes as $fuelType)
                                <option value="{{ $fuelType->id }}" {{ $vehicle->fuel_type_id == $fuelType->id ? 'selected' : '' }}>{{ $fuelType->type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label for="car_category_id" class="block text-sm font-medium text-gray-700">Categoria do Carro</label>
                        <select class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="car_category_id" name="car_category_id" required>
                            @foreach($carCategories as $carCategory)
                                <option value="{{ $carCategory->id }}" {{ $vehicle->car_category_id == $carCategory->id ? 'selected' : '' }}>{{ $carCategory->category }}</option>
                            @endforeach
                        </select>
                    </div>

                    @if($vehicle->is_external)
                        <div id="externalVehicleFields" class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Detalhes do Aluguer</label>
                            <div class="border rounded-md p-4">
                                <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="contract_number" class="block text-sm font-medium text-gray-700">Número do Contrato</label>
                                        <input type="text" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" id="contract_number" name="contract_number" value="{{ $vehicle->contract_number }}">
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="rental_price_per_day" class="block text-sm font-medium text-gray-700">Preço do Aluguer por Dia</label>
                                        <input type="number" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" id="rental_price_per_day" name="rental_price_per_day" value="{{ $vehicle->rental_price_per_day }}">
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="rental_start_date" class="block text-sm font-medium text-gray-700">Data de Início do Aluguer</label>
                                        <input type="date" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" id="rental_start_date" name="rental_start_date" value="{{ $vehicle->rental_start_date }}">
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="rental_end_date" class="block text-sm font-medium text-gray-700">Data de Fim do Aluguer</label>
                                        <input type="date" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" id="rental_end_date" name="rental_end_date" value="{{ $vehicle->rental_end_date }}">
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="rental_company" class="block text-sm font-medium text-gray-700">Empresa de Aluguer</label>
                                        <input type="text" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" id="rental_company" name="rental_company" value="{{ $vehicle->rental_company }}">
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="rental_contact_person" class="block text-sm font-medium text-gray-700">Pessoa de Contato do Aluguer</label>
                                        <input type="text" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" id="rental_contact_person" name="rental_contact_person" value="{{ $vehicle->rental_contact_person }}">
                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="rental_contact_number" class="block text-sm font-medium text-gray-700">Número de Contato do Aluguer</label>
                                        <input type="text" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" id="rental_contact_number" name="rental_contact_number" value="{{ $vehicle->rental_contact_number }}">
                                    </div>
                                    <div class="col-span-2">
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
                </div>
                <div class="mt-6">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Guardar
                    </button>
                    <a href="{{ url('vehicles') }}" class="ml-2 inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
