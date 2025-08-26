<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderLine;
use Livewire\Component;
use Carbon\Carbon;

class Planning extends Component
{
    public $selectedDate;
    public $viewMode = 'month'; // month, week, day

    public function mount()
    {
        $this->selectedDate = now()->format('Y-m-d');
    }

    public function render()
    {
        $startDate = Carbon::parse($this->selectedDate);
        $endDate = $startDate->copy();

        switch ($this->viewMode) {
            case 'week':
                $startDate->startOfWeek();
                $endDate->endOfWeek();
                break;
            case 'day':
                $endDate = $startDate->copy();
                break;
            default: // month
                $startDate->startOfMonth();
                $endDate->endOfMonth();
                break;
        }

        $orders = Order::with(['orderLines'])
            ->whereBetween('livraison', [$startDate, $endDate])
            ->orderBy('livraison')
            ->get();

        $ordersByDate = $orders->groupBy(function($order) {
            return $order->livraison->format('Y-m-d');
        });

        // Generate calendar days for month view
        $calendarDays = [];
        if ($this->viewMode === 'month') {
            $monthStart = Carbon::parse($this->selectedDate)->startOfMonth();
            $monthEnd = Carbon::parse($this->selectedDate)->endOfMonth();
            
            // Start from the first day of the week containing the first day of the month
            $calendarStart = $monthStart->copy()->startOfWeek();
            $calendarEnd = $monthEnd->copy()->endOfWeek();
            
            $current = $calendarStart->copy();
            while ($current <= $calendarEnd) {
                $calendarDays[] = [
                    'date' => $current->format('Y-m-d'),
                    'day' => $current->day,
                    'isCurrentMonth' => $current->month === $monthStart->month,
                    'isToday' => $current->isToday(),
                    'orders' => $ordersByDate->get($current->format('Y-m-d'), collect())
                ];
                $current->addDay();
            }
        }

        return view('livewire.planning', [
            'orders' => $orders,
            'ordersByDate' => $ordersByDate,
            'calendarDays' => $calendarDays,
            'currentMonth' => Carbon::parse($this->selectedDate)->format('F Y'),
        ])->layout('layouts.app');
    }

    public function setViewMode($mode)
    {
        $this->viewMode = $mode;
    }

    public function previousPeriod()
    {
        $date = Carbon::parse($this->selectedDate);
        
        switch ($this->viewMode) {
            case 'week':
                $this->selectedDate = $date->subWeek()->format('Y-m-d');
                break;
            case 'day':
                $this->selectedDate = $date->subDay()->format('Y-m-d');
                break;
            default: // month
                $this->selectedDate = $date->subMonth()->format('Y-m-d');
                break;
        }
    }

    public function nextPeriod()
    {
        $date = Carbon::parse($this->selectedDate);
        
        switch ($this->viewMode) {
            case 'week':
                $this->selectedDate = $date->addWeek()->format('Y-m-d');
                break;
            case 'day':
                $this->selectedDate = $date->addDay()->format('Y-m-d');
                break;
            default: // month
                $this->selectedDate = $date->addMonth()->format('Y-m-d');
                break;
        }
    }

    public function goToToday()
    {
        $this->selectedDate = now()->format('Y-m-d');
    }
}
