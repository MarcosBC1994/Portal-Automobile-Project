<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use TCPDF;
use Carbon\Carbon;

class ExternalCarReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = null;
        $endDate = null;
        $totalVehicles = 0;
        $totalCost = 0.00;

        if ($request->has(['start_date', 'end_date'])) {
            $startDate = $request->start_date;
            $endDate = $request->end_date;

            $query = Vehicle::whereBetween('rental_start_date', [$startDate, $endDate])
                ->whereNotNull('rental_company');

            // Paginação com 10 itens por página
            $vehicles = $query->paginate(10);

            // Calcula o total de veículos e o custo total fora da paginação
            $totalVehicles = $query->count();
            $totalCost = $query->sum('rental_price_per_day');
        } else {
            // Retorna uma instância paginada vazia se não houver datas de início e fim
            $vehicles = Vehicle::whereNotNull('rental_company')->paginate(10);
        }

        return view('pages.ExternalCarReport.index', compact('vehicles', 'startDate', 'endDate', 'totalVehicles', 'totalCost'));
    }

    public function filter(Request $request)
    {
        $this->validateDate($request);

        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $query = Vehicle::whereBetween('rental_start_date', [$startDate, $endDate])
            ->whereNotNull('rental_company');

        $vehicles = $query->paginate(10);

        $totalVehicles = $query->count();
        $totalCost = $query->sum('rental_price_per_day');

        return view('pages.ExternalCarReport.index', compact('vehicles', 'startDate', 'endDate', 'totalVehicles', 'totalCost'));
    }

    public function generateExternalCarReport(Request $request)
    {
        $this->validateDate($request);

        $startDate = $request->start_date;
        $endDate = $request->end_date;

        // Obtenha os veículos no intervalo de datas fornecido
        $vehicles = Vehicle::whereBetween('rental_start_date', [$startDate, $endDate])
            ->whereNotNull('rental_company')
            ->get();

        $totalVehicles = $vehicles->count();
        // Substitua 'total_rental_cost' pela coluna correta
        $totalCost = $vehicles->sum('rental_price_per_day');

        $data = [
            'vehicles' => $vehicles,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'totalCost' => $totalCost,
        ];

        // Configurar o PDF
        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('InnoDrive');
        $pdf->SetTitle('Relatório de Carros Externos');
        $pdf->SetSubject('Relatório de Carros Externos');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // Remover cabeçalho e rodapé padrão
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Adicionar uma página
        $pdf->AddPage();

        // Definir o conteúdo do PDF
        $html = view('components.ExternalCarReport.pdf-report', $data)->render();

        $pdf->writeHTML($html, true, false, true, false, '');

        // Fechar e gerar o PDF
        $pdf->lastPage();
        return $pdf->Output('external_car_report.pdf', 'D'); // 'D' força o download
    }

    private function validateDate(Request $request)
    {
        $request->validate([
            'start_date' => [
                'required',
                'date',
                'before_or_equal:end_date',
                function ($attribute, $value, $fail) {
                },
            ],
            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date',
                function ($attribute, $value, $fail) {
                },
            ],
        ], [
            'start_date.required' => 'A data inicial é obrigatória.',
            'start_date.date' => 'A data inicial deve ser uma data válida.',
            'start_date.before_or_equal' => 'A data inicial deve ser anterior ou igual à data final.',
            'end_date.required' => 'A data final é obrigatória.',
            'end_date.date' => 'A data final deve ser uma data válida.',
            'end_date.after_or_equal' => 'A data final deve ser posterior ou igual à data inicial.',
        ]);
    }
}
