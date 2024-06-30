<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\StatisticService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StatisticController extends Controller
{
    public function __construct(public StatisticService $statisticService)
    {
    }

    public function index(): View
    {
        return view('statistics.index', [
            'statistics' => $this->statisticService->getAllStatistic(auth()->user(), $search = request()->filled('search') ? request()->search : null, 10),
        ]);
    }

    public function show(User $user): View
    {
        if (auth()->user()->cannot('view', $user)) {
            abort(403);
        }

        return view('statistics.show', $this->statisticService->show($user));
    }

}
