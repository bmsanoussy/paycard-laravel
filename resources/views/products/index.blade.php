@extends('layouts.app')

@section('title', 'Produits')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($products as $product)
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
        
        <div class="p-4">
            <h2 class="text-xl font-bold mb-2">{{ $product->name }}</h2>
            <p class="text-gray-600 mb-4">{{ $product->description }}</p>
            <p class="text-2xl font-bold text-green-600 mb-4">{{ number_format($product->price, 0, ',', ' ') }} GNF</p>
            
            <form action="{{ route('payment.initiate') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                
                <select name="payment_method" class="w-full p-2 border rounded mb-4">
                    <option value="ORANGE_MONEY">Orange Money</option>
                    <option value="MOMO">MTN MoMo</option>
                    <option value="CREDIT_CARD">Carte bancaire</option>
                    <option value="PAYCARD">Paycard</option>
                </select>
                
                <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
                    Payer maintenant
                </button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endsection