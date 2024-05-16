<style>
    .custom-bg {
        background-color: #f5f5f5;
    }

    .custom-card {
        background-color: #ffffff;
        box-shadow: 0px 20px 20px rgba(0, 0, 0, 0.1);
        border-radius: 20px;
    }

    .custom-logo {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
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
    .form-input, .form-control {
        border: 2px solid #ccc;
        transition: border-color 0.3s ease;
    }

    .form-input:focus, .form-control:focus {
        border-color: #888;
    }

    @media (max-width: 640px) {
        .custom-logo {
            width: 80px;
            height: 80px;
        }
    }
</style>

<div class="flex justify-center items-start h-screen custom-bg">
    <div class="max-w-md w-full bg-white rounded-xl p-7 custom-card mt-12">
        <div class="flex justify-center mb-6">
            <h1>Registro de Veículo</h1>
        </div>

        <form method="POST" action="{{ route('vehicles.store') }}" class="space-y-6">
            @csrf

            <div>
                <label for="plate" class="block text-sm font-semibold text-gray-700 mb-2">Matrícula</label>
                <input id="plate" type="text" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('plate') border-red-500 @enderror" name="plate" value="{{ old('plate') }}" required autocomplete="plate" autofocus>
                @error('plate')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="km" class="block text-sm font-semibold text-gray-700 mb-2">Quilometragem</label>
                <input id="km" type="number" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('km') border-red-500 @enderror" name="km" value="{{ old('km') }}" required autocomplete="km">
                @error('km')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="condition" class="block text-sm font-semibold text-gray-700 mb-2">Condição</label>
                <input id="condition" type="text" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('condition') border-red-500 @enderror" name="condition" value="{{ old('condition') }}" required autocomplete="condition">
                @error('condition')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="brand" class="block text-sm font-semibold text-gray-700 mb-2">Marca</label>
                <select id="brand" name="brand" class="form-select w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('brand') border-red-500 @enderror" required autocomplete="brand" autofocus>
                    <option value="" disabled selected>Selecione a Marca</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" @if(old('brand') == $brand->id) selected @endif>{{ $brand->name }}</option>
                    @endforeach
                </select>
                @error('brand')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for=" carCategory" class="block text-sm font-semibold text-gray-700 mb-2">Categoria</label>
                <select id=" carCategory" name=" carCategory" class="form-select w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error(' carCategory') border-red-500 @enderror" required autocomplete=" carCategory" autofocus>
                    <option value="" disabled selected>Selecione a Categoria</option>
                    @foreach($carCategories as $carCategory)
                        <option value="{{ $carCategory->id }}" @if(old(' carCategory') == $carCategory->id) selected @endif>{{ $carCategory->category }}</option>
                    @endforeach
                </select>
                @error(' carCategory')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="fuelTypes" class="block text-sm font-semibold text-gray-700 mb-2">Tipo de Combustível</label>
                <select id="fuelTypes" name="fuelTypes" class="form-select w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('fuelTypes') border-red-500 @enderror" required autocomplete="fuelTypes" autofocus>
                    <option value="" disabled selected>Selecione o Tipo de Combustível</option>
                    @foreach($fuelTypes as $fuelType)
                        <option value="{{ $fuelType->id }}" @if(old('type_fuel') == $fuelType->id) selected @endif>{{ $fuelType->type }}</option>
                    @endforeach
                </select>
                @error('fuelTypes')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="notes" class="block text-sm font-semibold text-gray-700 mb-2">Notas</label>
                <textarea id="notes" class="form-textarea w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('notes') border-red-500 @enderror" name="notes" required autocomplete="notes" rows="4">{{ old('notes') }}</textarea>
                @error('notes')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="is_external" class="block text-sm font-semibold text-gray-700 mb-2">É externo?</label>
                <input id="is_external" type="checkbox" class="form-checkbox" name="is_external" value="1" @if(old('is_external')) checked @endif>
                @error('is_external')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>


            <div class="external-field" style="display: none;">
                <div>
                    <label for="contract_number" class="block text-sm font-semibold text-gray-700 mb-2">Número de Contrato</label>
                    <input id="contract_number" type="text" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('contract_number') border-red-500 @enderror" name="contract_number" value="{{ old('contract_number') }}">
                    @error('contract_number')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="rental_price_per_day" class="block text-sm font-semibold text-gray-700 mb-2">Preço de Aluger por Dia</label>
                    <input id="rental_price_per_day" type="text" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('rental_price_per_day') border-red-500 @enderror" name="rental_price_per_day" value="{{ old('rental_price_per_day') }}"  autocomplete="rental_price_per_day">
                    @error('rental_price_per_day')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="rental_start_date" class="block text-sm font-semibold text-gray-700 mb-2">Data de Início do Aluger</label>
                    <input id="rental_start_date" type="date" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('rental_start_date') border-red-500 @enderror" name="rental_start_date" value="{{ old('rental_start_date') }}"   autocomplete="rental_start_date">
                    @error('rental_start_date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="rental_end_date" class="block text-sm font-semibold text-gray-700 mb-2">Data de Fim do Aluger</label>
                    <input id="rental_end_date" type="date" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('rental_end_date') border-red-500 @enderror" name="rental_end_date" value="{{ old('rental_end_date') }}"   autocomplete="rental_end_date">
                    @error('rental_end_date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="rental_company" class="block text-sm font-semibold text-gray-700 mb-2">Empresa de RentCar</label>
                    <input id="rental_company" type="text" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('rental_company') border-red-500 @enderror" name="rental_company" value="{{ old('rental_company') }}"   autocomplete="rental_company">
                    @error('rental_company')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="rental_contact_person" class="block text-sm font-semibold text-gray-700 mb-2">Pessoa de Contato do RentCar</label>
                    <input id="rental_contact_person" type="text" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('rental_contact_person') border-red-500 @enderror" name="rental_contact_person" value="{{ old('rental_contact_person') }}"   autocomplete="rental_contact_person">
                    @error('rental_contact_person')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="rental_contact_number" class="block text-sm font-semibold text-gray-700 mb-2">Número de Contato do RentCar</label>
                    <input id="rental_contact_number" type="text" class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('rental_contact_number') border-red-500 @enderror" name="rental_contact_number" value="{{ old('rental_contact_number') }}"   autocomplete="rental_contact_number">
                    @error('rental_contact_number')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>


            </div>

            <div>
                <button type="submit" class="custom-btn w-full py-2 rounded-md">
                    Criar
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const isExternalCheckbox = document.getElementById('is_external');
        const externalFields = document.querySelectorAll('.external-field');

        function toggleExternalFields() {
            if (isExternalCheckbox.checked) {
                externalFields.forEach(field => {
                    field.style.display = 'block';
                });
            } else {
                externalFields.forEach(field => {
                    field.style.display = 'none';
                });
            }
        }

        isExternalCheckbox.addEventListener('change', toggleExternalFields);


        toggleExternalFields();
    });
</script>