@if($insurances->isNotEmpty())
    <div class="bg-white p-6 rounded-lg shadow-md max-w-4xl mx-auto">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">Detalhes dos Seguros</h2>

        <!-- Resumo dos seguros -->
        <div class="mb-6">
            <span class="text-xl font-bold text-gray-700">Total de Seguros:</span>
            <span class="text-xl font-semibold text-green-600">{{ $totalResults }}</span>
        </div>
        <div class="mb-6">
            <span class="text-xl font-bold text-gray-700">Custo Total dos Seguros:</span>
            <span class="text-xl font-semibold text-green-600">{{ $totalCost }}</span>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                <thead>
                <tr class="bg-gray-100">
                    <th class="py-3 px-4 border-b text-left text-gray-600">Companhia de Seguros</th>
                    <th class="py-3 px-4 border-b text-left text-gray-600">Número da Apólice</th>
                    <th class="py-3 px-4 border-b text-left text-gray-600">Data de Início</th>
                    <th class="py-3 px-4 border-b text-left text-gray-600">Data de Término</th>
                    <th class="py-3 px-4 border-b text-left text-gray-600">Matrícula</th>
                    <th class="py-3 px-4 border-b text-left text-gray-600">Custo</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($insurances as $insurance)
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-4 border-b">{{ $insurance->insurance_company }}</td>
                        <td class="py-3 px-4 border-b">{{ $insurance->policy_number }}</td>
                        <td class="py-3 px-4 border-b">{{ \Carbon\Carbon::parse($insurance->start_date)->format('d/m/Y') }}</td>
                        <td class="py-3 px-4 border-b">{{ \Carbon\Carbon::parse($insurance->end_date)->format('d/m/Y') }}</td>
                        <td class="py-3 px-4 border-b">{{ $insurance->vehicle->plate }}</td>
                        <td class="py-3 px-4 border-b">{{ number_format($insurance->cost, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Botão para download do PDF -->
        <div class="mt-6 text-right">
            <form action="{{ route('insurance.report.generate') }}" method="GET">
                @csrf
                <input type="hidden" name="start_date" value="{{ $startDate }}">
                <input type="hidden" name="end_date" value="{{ $endDate }}">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Baixar Relatório PDF</button>
            </form>
        </div>

        <div class="mt-6">
            {{ $insurances->appends(request()->input())->links() }}
        </div>
    </div>
@else
    <div class="mt-8 bg-white p-6 rounded-lg shadow-md max-w-4xl mx-auto">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                <thead>
                <tr class="bg-gray-100">
                    <th class="py-3 px-4 border-b text-left text-gray-600">Companhia de Seguros</th>
                    <th class="py-3 px-4 border-b text-left text-gray-600">Número da Apólice</th>
                    <th class="py-3 px-4 border-b text-left text-gray-600">Data de Início</th>
                    <th class="py-3 px-4 border-b text-left text-gray-600">Data de Término</th>
                    <th class="py-3 px-4 border-b text-left text-gray-600">Matrícula</th>
                    <th class="py-3 px-4 border-b text-left text-gray-600">Custo</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="py-3 px-4 border-b text-center text-gray-500" colspan="6">Nenhum seguro encontrado</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endif
