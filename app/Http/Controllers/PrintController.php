<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderLine;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    /**
     * Print order summary (similar to imprimer_commande.php)
     */
    public function printOrder($id)
    {
        $order = Order::with('orderLines')->findOrFail($id);
        $totalPairs = $order->calculateTotalQuantity();
        
        return view('print.order-summary', compact('order', 'totalPairs'));
    }

    /**
     * Print detailed line item (similar to imprimer_ligne.php)
     */
    public function printOrderLine($orderId, $lineId)
    {
        $order = Order::findOrFail($orderId);
        $orderLine = OrderLine::with([
            'formeItem', 
            'articleItem', 
            'semelleItem', 
            'constructionItem', 
            'cuirItem', 
            'doublureItem',
            'supplementItem'
        ])->where('order_id', $orderId)->findOrFail($lineId);
        
        return view('print.order-line-detail', compact('order', 'orderLine'));
    }
}
