<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Illuminate\Contracts\View\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function home(): View
    {
        return view('index');
    }

    /**
     * Display the scanner page.
     */
    public function scanner(): View
    {
        if (request()->is('dashboard/*'))
            return view('dashboard.scanner');
        return view('scanner');
    }

    /**
     * Display a listing of all plants.
     */
    public function index(): View
    {
        $plants = Plant::latest()->paginate(12);
        return view('plants.index', compact('plants'));
    }

    /**
     * Display the specified plant.
     */
    public function show(Plant $plant): View
    {
        return view('plants.show', compact('plant'));
    }


    /**
     * Display the QR code for the specified plant.
     */
    public function download(Plant $plant): Response
    {
        $svg = QrCode::format('svg')->size(500)->generate(route('plants.show', $plant));
        $slug = Str::of($plant->name)->slug('-');

        return new Response($svg, 200, [
            'Content-Type' => 'image/svg+xml',
            'Content-Disposition' => 'attachment; filename="' . $slug . '.svg"',
        ]);
    }

    /**
     * Display the dashboard.
     */
    public function dashboard(): View
    {
        $total = Plant::count();
        $week = Plant::where('created_at', '>=', now()->subWeek())->count();
        $month = Plant::where('created_at', '>=', now()->subMonth())->count();

        $count = [
            'total' => $total,
            'week' => $week,
            'month' => $month,
        ];

        return view('dashboard.index', compact('count'));
    }
}
