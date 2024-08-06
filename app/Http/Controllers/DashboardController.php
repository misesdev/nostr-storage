<?php

namespace App\Http\Controllers;

use App\Models\Metrics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;

        $metrics = $this->getMetrics($user_id);
        $file_list = $this->getMetricsTable($user_id);

        return view('dashboard.index', ['metrics' => $metrics, 'file_list' => $file_list]);
    }

    private function getMetrics($user_id)
    {
        $query =
            "select count(id) as quantity, ".
            "   to_char(created_at, 'DD/MM') as month ".
            "from metrics where user_id = ? ".
            "   and created_at > (current_date - interval '7 days') ".
            "   and created_at is not null ".
            "group by ".
            "   to_char(created_at, 'DD/MM') "
        ;

        return DB::select($query, [$user_id]);
    }

    private function getMetricsTable($user_id)
    {
        $query =
            "select id, ".
            "   archive, ".
            "   user_id, ".
            "   to_char(created_at, 'dd/mm/yyyy') as created_at ".
            "from metrics ".
            "where user_id = ? ".
            "   and created_at > (current_date - interval '7 days') ".
            "   and created_at is not null "
        ;

        return DB::select($query, [$user_id]);
    }
}
