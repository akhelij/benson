<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Client;
use App\Models\Item;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $dateRange = '30'; // days
    public $selectedPeriod = 'month';

    public function render()
    {
        $startDate = $this->getStartDate();
        $endDate = now();

        // Basic statistics
        $totalOrders = Order::whereBetween('created_at', [$startDate, $endDate])->count();
        $totalRevenue = Order::whereBetween('created_at', [$startDate, $endDate])->sum('total_amount');
        $totalQuantity = OrderLine::whereHas('order', function($query) use ($startDate, $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        })->sum(DB::raw('p5 + p5x + p6 + p6x + p7 + p7x + p8 + p8x + p9 + p9x + p10 + p10x + p11 + p11x + p12 + p13'));

        $averageOrderValue = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;

        // Orders by status/delivery
        $pendingOrders = Order::where('livraison', '>', now())->count();
        $overdueOrders = Order::where('livraison', '<', now())->count();

        // Top clients by revenue
        $topClients = Order::select('firm', DB::raw('SUM(total_amount) as total_revenue'), DB::raw('COUNT(*) as order_count'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('firm')
            ->orderBy('total_revenue', 'desc')
            ->limit(5)
            ->get();

        // Popular articles
        $popularArticles = OrderLine::select('article', DB::raw('SUM(p5 + p5x + p6 + p6x + p7 + p7x + p8 + p8x + p9 + p9x + p10 + p10x + p11 + p11x + p12 + p13) as total_quantity'))
            ->whereHas('order', function($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->groupBy('article')
            ->orderBy('total_quantity', 'desc')
            ->limit(5)
            ->get();

        // Monthly revenue trend (last 6 months)
        $monthlyRevenue = Order::select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total_amount) as revenue'),
                DB::raw('COUNT(*) as orders')
            )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->map(function($item) {
                $item->month_name = Carbon::createFromDate($item->year, $item->month, 1)->format('M Y');
                return $item;
            });

        // Size distribution
        $sizeDistribution = OrderLine::select(
                DB::raw('SUM(p5 + p5x) as size_35_36'),
                DB::raw('SUM(p6 + p6x) as size_37'),
                DB::raw('SUM(p7 + p7x) as size_38'),
                DB::raw('SUM(p8 + p8x) as size_39'),
                DB::raw('SUM(p9 + p9x) as size_40'),
                DB::raw('SUM(p10 + p10x) as size_41'),
                DB::raw('SUM(p11 + p11x) as size_42'),
                DB::raw('SUM(p12) as size_43'),
                DB::raw('SUM(p13) as size_44')
            )
            ->whereHas('order', function($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->first();

        return view('livewire.statistics', [
            'totalOrders' => $totalOrders,
            'totalRevenue' => $totalRevenue,
            'totalQuantity' => $totalQuantity,
            'averageOrderValue' => $averageOrderValue,
            'pendingOrders' => $pendingOrders,
            'overdueOrders' => $overdueOrders,
            'topClients' => $topClients,
            'popularArticles' => $popularArticles,
            'monthlyRevenue' => $monthlyRevenue,
            'sizeDistribution' => $sizeDistribution,
            'dateRange' => $this->getDateRangeLabel(),
        ])->layout('layouts.app');
    }

    public function setPeriod($period)
    {
        $this->selectedPeriod = $period;
        switch($period) {
            case 'week':
                $this->dateRange = '7';
                break;
            case 'month':
                $this->dateRange = '30';
                break;
            case 'quarter':
                $this->dateRange = '90';
                break;
            case 'year':
                $this->dateRange = '365';
                break;
        }
    }

    private function getStartDate()
    {
        return now()->subDays((int)$this->dateRange);
    }

    private function getDateRangeLabel()
    {
        switch($this->selectedPeriod) {
            case 'week':
                return 'Cette semaine';
            case 'month':
                return 'Ce mois';
            case 'quarter':
                return 'Ce trimestre';
            case 'year':
                return 'Cette année';
            default:
                return 'Derniers ' . $this->dateRange . ' jours';
        }
    }
}
