@extends('layouts.app')

@section('title', 'Détails de la commande')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-6">Détails de la commande #{{ $order->id }}</h1>
        
        <div class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div class="font-semibold">Référence :</div>
                <div>{{ $order->payment_reference }}</div>
                
                <div class="font-semibold">Statut :</div>
                <div>
                    @if($order->status === 'completed')
                        <span class="text-green-600 font-semibold">Payé</span>
                    @elseif($order->status === 'pending')
                        <span class="text-yellow-600 font-semibold">En attente</span>
                    @else
                        <span class="text-red-600 font-semibold">Échoué</span>
                    @endif
                </div>
                
                <div class="font-semibold">Produit :</div>
                <div>{{ $order->product->name }}</div>
                
                <div class="font-semibold">Montant :</div>
                <div>{{ number_format($order->amount, 0, ',', ' ') }} GNF</div>
                
                <div class="font-semibold">Méthode de paiement :</div>
                <div>
                    @switch($order->payment_method)
                        @case('ORANGE_MONEY')
                            Orange Money
                            @break
                        @case('MOMO')
                            MTN MoMo
                            @break
                        @case('CREDIT_CARD')
                            Carte bancaire
                            @break
                        @case('PAYCARD')
                            Paycard
                            @break
                        @default
                            {{ $order->payment_method }}
                    @endswitch
                </div>
                
                <div class="font-semibold">Date de commande :</div>
                <div>{{ $order->created_at->format('d/m/Y H:i') }}</div>
            </div>
            
            <div class="mt-8 flex justify-between items-center">
                <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800">
                    ← Retour aux produits
                </a>
            </div>
        </div>
    </div>
</div>
@endsection