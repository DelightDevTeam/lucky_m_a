<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Models\Admin\GameType;
use App\Models\Admin\Product;
use App\Models\FinicalReport;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $reports = $this->makeJoinTable()->select(
            'users.user_name',
            'users.id as user_id',
            'reports.agent_commission',
            DB::raw('SUM(reports.commission_amount) as total_commission_amount'),
            DB::raw('SUM(reports.bet_amount) as total_bet_amount'),
            DB::raw('SUM(reports.valid_bet_amount) as total_valid_bet_amount'),
            DB::raw('SUM(reports.payout_amount) as total_payout_amount'))
            ->groupBy('users.user_name', 'users.id', 'reports.agent_commission')
            ->when(isset($request->player_name), function ($query) use ($request) {
                $query->where('reports.member_name', $request->player_name);
            })
            ->when(isset($request->fromDate) && isset($request->toDate), function ($query) use ($request) {
                $query->whereBetween('reports.created_at', [$request->fromDate. ' 00:00:00', $request->toDate. ' 23:59:59']);
            })
            ->get();

        return view('report.show', compact('reports'));
    }

    // amk
    // public function detail(Request $request, $userName)
    // {

    //     $userName = (string) $userName;
    //     $report = $this->makeJoinTable()->select(
    //         'users.user_name',
    //         'users.id as user_id',
    //         'products.name as product_name',
    //         'products.code as product_code',
    //         DB::raw('SUM(reports.bet_amount) as total_bet_amount'),
    //         DB::raw('SUM(reports.valid_bet_amount) as total_valid_bet_amount'),
    //         DB::raw('SUM(reports.payout_amount) as total_payout_amount'))
    //         ->groupBy('users.user_name', 'product_name', 'product_code')
    //         ->where('reports.member_name', $userName)
    //         ->get();
    //     //$player = User::find($userId);
    //      $player = User::where('user_name', $userName)->first();

    //     return view('report.detail', compact('report', 'player'));
    // }

    public function detail(Request $request, $userName)
{
    // Ensure $userName is a string
    $userName = (string) $userName;

    // Query to get individual bet details for the player
    $report = $this->makeJoinTable()->select(
        'users.user_name',
        'users.id as user_id',
        'products.name as product_name',
        'products.code as product_code',
        'reports.wager_id',
        'reports.settlement_date',
        'reports.bet_amount',
        'reports.valid_bet_amount',
        'reports.payout_amount',
        'reports.game_name as game_list_name'
    )
    ->where('reports.member_name', $userName) // Filter by player's user_name
    ->get();

    // Find the player by user_name
    $player = User::where('user_name', $userName)->first();

    dd($report);

    // Return the view with report and player data
    return view('report.detail', compact('report', 'player'));
}



    public function view($user_name)
    {
        $reports = $this->makeJoinTable()->select(
            'users.user_name',
            'users.id as user_id',
            'products.name as product_name',
            'products.code as product_code',
            DB::raw('SUM(reports.bet_amount) as total_bet_amount'),
            DB::raw('SUM(reports.valid_bet_amount) as total_valid_bet_amount'),
            DB::raw('SUM(reports.payout_amount) as total_payout_amount'))
            ->groupBy('users.user_name', 'product_name', 'product_code')
            ->where('reports.member_name', $user_name)
            ->get();

        return view('report.view', compact('reports'));
    }

    // amk
    private function makeJoinTable()
    {
        $query = User::query()->roleLimited();
        $query->join('reports', 'reports.member_name', '=', 'users.user_name')
            ->join('products', 'reports.product_code', '=', 'products.code')
            ->join('game_lists', 'reports.game_name', '=', 'game_lists.code')
            ->where('reports.status', '101');

        return $query;
    }


}