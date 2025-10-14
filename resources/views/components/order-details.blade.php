{{-- resources/views/components/order-details.blade.php --}}
@props(['order'])

<div>
    {{-- Order Information --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
            <h4 class="text-sm font-semibold text-gray-700 mb-3">Informations Client</h4>
            <dl class="space-y-2">
                <div class="flex justify-between">
                    <dt class="text-sm text-gray-500">Entreprise:</dt>
                    <dd class="text-sm font-medium text-gray-900">{{ $order->firm ?: '-' }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-sm text-gray-500">Ville:</dt>
                    <dd class="text-sm font-medium text-gray-900">{{ $order->ville ?: '-' }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-sm text-gray-500">Téléphone:</dt>
                    <dd class="text-sm font-medium text-gray-900">{{ $order->telephone ?: '-' }}</dd>
                </div>
            </dl>
        </div>
        
        <div>
            <h4 class="text-sm font-semibold text-gray-700 mb-3">Détails Commande</h4>
            <dl class="space-y-2">
                <div class="flex justify-between">
                    <dt class="text-sm text-gray-500">Date Livraison:</dt>
                    <dd class="text-sm font-medium text-gray-900">
                        {{ $order->livraison ? $order->livraison->format('d/m/Y') : '-' }}
                    </dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-sm text-gray-500">Statut:</dt>
                    <dd>
                        <span class="px-2 py-1 text-xs rounded-full {{ $order->status_color }}">
                            {{ $order->status_label }}
                        </span>
                    </dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-sm text-gray-500">Total:</dt>
                    <dd class="text-sm font-bold text-gray-900">
                        €{{ number_format($order->total_amount ?: 0, 2, ',', ' ') }}
                    </dd>
                </div>
            </dl>
        </div>
    </div>

    @if($order->notes)
        <div class="mb-6">
            <h4 class="text-sm font-semibold text-gray-700 mb-2">Notes</h4>
            <p class="text-sm text-gray-600 bg-gray-50 p-3 rounded">{{ $order->notes }}</p>
        </div>
    @endif

    {{-- Order Lines --}}
    <div>
        <h4 class="text-sm font-semibold text-gray-700 mb-4">Articles Commandés</h4>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Article</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Spécifications</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pointures</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Imprimer</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($order->orderLines as $line)
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ $line->article }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-600">
                                <div class="space-y-1">
                                    <span class="text-xs">Forme: {{ $line->forme }}</span><br>
                                    <span class="text-xs">Semelle: {{ $line->semelle }}</span><br>
                                    <span class="text-xs">Cuir: {{ $line->cuir }}</span><br>
                                    <span class="text-xs">Doublure: {{ $line->doublure }}</span><br>
                                    <span class="text-xs">Construction: {{ $line->construction }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="grid grid-cols-3 gap-1 text-xs">
                                    @foreach($line->active_sizes as $size => $qty)
                                        <span class="bg-gray-100 px-1 rounded">
                                            {{ str_replace('p', '', str_replace('x', '.5', $size)) }}: {{ $qty }}
                                        </span>
                                    @endforeach
                                </div>
                                <div class="mt-1 text-xs text-gray-500">
                                    Total: {{ $line->total_quantity }} paires
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm text-right text-gray-900">                                
                                <a href="{{ route('print.order-line', ['orderId' => $order->id, 'lineId' => $line->id]) }}" target="_blank" 
                                    class="text-purple-600 hover:text-purple-900" title="Imprimer ligne détaillée">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-50">
                    <tr>
                        <td colspan="4" class="px-4 py-3 text-sm text-right font-semibold text-gray-700">
                            Total Commande:
                        </td>
                        <td class="px-4 py-3 text-sm text-right font-bold text-gray-900">
                            €{{ number_format($order->total_amount ?: 0, 2, ',', ' ') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>