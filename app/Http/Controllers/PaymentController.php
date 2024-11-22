<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Services\PaycardService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    private $paycardService;

    public function __construct(PaycardService $paycardService)
    {
        $this->paycardService = $paycardService;
    }

    public function initiate(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'payment_method' => 'required|in:CREDIT_CARD,MOMO,ORANGE_MONEY,PAYCARD'
        ]);

        $product = Product::findOrFail($request->product_id);
        $reference = 'ORD-' . Str::random(10);

        // Create order in database
        $order = Order::create([
            'product_id' => $product->id,
            'user_id' => null,
            'amount' => $product->price,
            'payment_reference' => $reference,
            'payment_method' => $request->payment_method,
            'status' => 'pending'
        ]);

        // Initialize payment with Paycard
        $paymentData = [
            'amount' => $product->price,
            'description' => "Paiement du produit {$product->name}",
            'reference' => $reference,
            'payment_method' => $request->payment_method,
            'callback_url' => route('payment.callback'),
            'auto_redirect' => true,
            'redirect_with_get' => true
        ];

        try {
            $response = $this->paycardService->createPayment($paymentData);
            return redirect($response['payment_url']);
        } catch (\Exception $e) {
            $order->update(['status' => 'failed']);
            return back()->with('error', $e->getMessage());
        }
    }

    public function callback(Request $request)
    {
        $reference = $request->input('paycard-operation-reference');
        $order = Order::where('payment_reference', $reference)->firstOrFail();

        try {
            $status = $this->paycardService->getPaymentStatus($reference);

            $order->update([
                'status' => $status['status'] === 'success' ? 'completed' : 'failed'
            ]);

            $message = $status['status'] === 'success' ? 'Paiement effectué avec succès' : 'Le paiement a échoué';

            return redirect()->route('orders.show', $order)
                ->with('success', $message);
        } catch (\Exception $e) {
            $order->update(['status' => 'failed']);
            return redirect()->route('orders.show', $order)
                ->with('error', 'Une erreur est survenue lors du traitement du paiement');
        }
    }
}
