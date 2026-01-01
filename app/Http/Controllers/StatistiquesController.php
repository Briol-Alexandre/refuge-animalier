<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Models\Adoption;
use App\Models\Animal;
use App\Models\Notifications;
use App\Models\User;
use App\Models\Volunteer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

use Barryvdh\DomPDF\Facade\Pdf as DomPDF;

class StatistiquesController extends Controller
{
    public function index()
    {
        $animals = Animal::pluck('created_at');
        $animals_count = $animals->count();

        $available_animals = Animal::byStatus(Status::AVAILABLE)->pluck('created_at');
        $available_animals_count = $available_animals->count();

        $cure_animals = Animal::byStatus(Status::IN_CURE)->pluck('created_at');
        $cure_animals_count = $cure_animals->count();

        $adoptions = Animal::byStatus(Status::ADOPTED)->pluck('created_at');
        $adoptions_count = $adoptions->count();

        $files = Storage::disk('public')->files('pdfs');
        $pdfs = collect($files)->map(function ($file) {
            return [
                'name' => basename($file),
                'url' => route('statistiques.download', ['filename' => basename($file)]),
                'size' => Storage::disk('public')->size($file),
            ];
        });

        return Inertia::render(
            'Statistiques',
            [
                'title' => 'Statistiques',
                'animals' => $animals_count,
                'available' => $available_animals_count,
                'cures' => $cure_animals_count,
                'adoptions' => $adoptions_count,
                'animal_model' => $animals,
                'available_model' => $available_animals,
                'cure_model' => $cure_animals,
                'adoption_model' => $adoptions,
                'pdfs' => $pdfs,
            ]
        );
    }


    public function show($id)
    {
    }

    public function exportPDF(Request $request)
    {
        $validated = $request->validate([
            'selected_month' => 'nullable',
            'selected_year' => 'required'
        ]);

        $month = $validated['selected_month'];
        $year = $validated['selected_year'];
        if ($month) {
            $parsedMonth = ucfirst(Carbon::createFromFormat('m', $month)->TranslatedFormat('F'));
            $filename = "{$parsedMonth} {$year}.pdf";
        } else {
            $filename = "Rapport {$year}.pdf";
        }
        if ($month) {
            $adopted = Animal::byStatus(Status::ADOPTED)
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->count();
            $available = Animal::byStatus(Status::AVAILABLE)
                ->count();
            $animal = Animal::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->count();
            $cure = Animal::byStatus(Status::IN_CURE)
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->count();
            $volunteer = User::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->count();
        } else {
            $adopted = Animal::byStatus(Status::ADOPTED)
                ->whereYear('created_at', $year)
                ->count();
            $available = Animal::byStatus(Status::AVAILABLE)
                ->count();
            $animal = Animal::whereYear('created_at', $year)
                ->count();
            $cure = Animal::byStatus(Status::IN_CURE)
                ->whereYear('created_at', $year)
                ->count();
            $volunteer = User::whereYear('created_at', $year)
                ->count();
        }
        $animal_total = Animal::count();

        $datas = [
            'month' => $month,
            'year' => $year,
            'adopted' => $adopted,
            'available' => $available,
            'animal' => $animal,
            'cure' => $cure,
            'volunteer' => $volunteer,
            'animal_total' => $animal_total
        ];

        Storage::disk('public')->makeDirectory('pdfs');
        $pdf = DomPDF::loadView('pdf.export', ['datas' => $datas]);
        Storage::disk('public')->put('pdfs/' . $filename, $pdf->output());

        $absolutePath = Storage::disk('public')->path('pdfs/' . $filename);
        return response()->download($absolutePath, $filename, [
            'Content-Type' => 'application/pdf',
        ]);
    }
    public function downloadPDF($filename)
    {
        $filename = basename($filename);

        $path = Storage::disk('public')->path('pdfs/' . $filename);

        if (!file_exists($path)) {
            abort(404, 'PDF non trouvé');
        }

        return response()->download($path, $filename, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}
