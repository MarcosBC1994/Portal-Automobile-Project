<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Projeto</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
    <style>
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

        .form-input:focus,
        .form-control:focus {
            border-color: #888;
        }

        @media (max-width: 640px) {
            .custom-logo {
                width: 80px;
                height: 80px;
            }
        }
    </style>
</head>

<body>
    <div class="flex justify-center items-start h-screen custom-bg">
        <div class="max-w-md w-full bg-white rounded-xl p-7 custom-card mt-12">
            <div class="flex justify-center mb-6">
                <h1>Editar Projeto</h1>
            </div>

            <form method="POST" action="{{ url('projects/' . $project->id) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nome do Projeto</label>
                    <input id="name" type="text"
                        class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('name') border-red-500 @enderror p-1"
                        name="name" value="{{ old('name', $project->name) }}" required autocomplete="name" autofocus>
                    <!-- Adicionei P-1-->
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">Endereço do
                        Projeto</label>
                    <input id="address" type="text"
                        class="form-input w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('address') border-red-500 @enderror p-1"
                        name="address" value="{{ old('address', $project->address) }}" required autocomplete="address">
                    @error('address')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="projectstatus" class="block text-sm font-semibold text-gray-700 mb-2">Status do
                        Projeto</label>
                    <select id="projectstatus" name="projectstatus"
                        class="form-select w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('projectstatus') border-red-500 @enderror p-1"
                        required autocomplete="projectstatus" autofocus>
                        <option value="" selected>Selecione o Status</option>
                        @foreach ($projectstatuses as $status)
                            <option value="{{ $status->id }}" @if (old('projectstatus', $project->project_status_id) == $status->id) selected @endif>
                                {{ $status->status_name }}</option>
                        @endforeach
                    </select>
                    @error('projectstatus')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="country" class="block text-sm font-semibold text-gray-700 mb-2">País</label>
                    <select id="country" name="country"
                        class="form-select w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('country') border-red-500 @enderror p-1"
                        required autocomplete="country" autofocus>
                        <option value="" selected>Selecione o País</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}" @if (old('country', $project->country_id) == $country->id) selected @endif>
                                {{ $country->name }}</option>
                        @endforeach
                    </select>
                    @error('country')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="district" class="block text-sm font-semibold text-gray-700 mb-2">Distrito</label>
                    <select id="district" name="district"
                        class="form-select w-full rounded-md border-gray-300 focus:border-gray-400 focus:ring focus:ring-gray-200 @error('district') border-red-500 @enderror p-1"
                        required autocomplete="district" autofocus>
                        <option value="" selected>Selecione o Distrito</option>
                    </select>
                    @error('district')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="custom-btn w-full py-2 rounded-md">
                        Salvar
                    </button>
                    <a href="{{ url('projects') }}" class="block text-center mt-4 text-sm font-semibold text-gray-700">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const districts = @json($districts);
            const countrySelect = document.getElementById('country');
            const districtSelect = document.getElementById('district');
            const selectedDistrictId = {{ $project->district_id ?? 'null' }};

            function updateDistricts() {
                const selectedCountry = countrySelect.value;
                const districtOptions = districts[selectedCountry] || [];

                districtSelect.innerHTML = '<option value="" selected>Selecione o Distrito</option>';
                districtOptions.forEach(district => {
                    const option = document.createElement('option');
                    option.value = district.id;
                    option.textContent = district.name;
                    if (district.id == selectedDistrictId) {
                        option.selected = true;
                    }
                    districtSelect.appendChild(option);
                });
            }

            countrySelect.addEventListener('change', updateDistricts);
            updateDistricts();
        });
    </script>
</body>

</html>
