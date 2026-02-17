<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Services\CartService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct(protected CartService $cart) {}

    public function index()
    {
        $items = $this->cart->getItems();
        $total = $this->cart->getTotal();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'السلة فارغة');
        }

        return view('checkout.index', compact('items', 'total'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_city' => 'required|string|max:255',
            'customer_address' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $items = $this->cart->getItems();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'السلة فارغة');
        }

        $total = $this->cart->getTotal();

        $order = Order::create([
            'order_number' => Order::generateOrderNumber(),
            'customer_name' => $validated['customer_name'],
            'customer_phone' => $validated['customer_phone'],
            'customer_city' => $validated['customer_city'],
            'customer_address' => $validated['customer_address'],
            'notes' => $validated['notes'] ?? null,
            'total' => $total,
            'status' => 'pending',
        ]);

        foreach ($items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->id,
                'product_name' => $item->name . ' ' . $item->volume,
                'quantity' => $item->cart_quantity,
                'price' => $item->price,
            ]);
        }

        $this->cart->clear();

        $whatsappUrl = $this->buildWhatsAppUrl($order);

        $order->update(['whatsapp_sent' => true]);

        return redirect($whatsappUrl);
    }

    protected function buildWhatsAppUrl(Order $order): string
    {
        $currency = config('store.currency');
        $phone = config('store.whatsapp_number');

        $message = "*طلب جديد #{$order->order_number}*\n";
        $message .= "━━━━━━━━━━━━━━━\n\n";
        $message .= "*الاسم:* {$order->customer_name}\n";
        $message .= "*الهاتف:* {$order->customer_phone}\n";
        $message .= "*المدينة:* {$order->customer_city}\n";
        $message .= "*العنوان:* {$order->customer_address}\n\n";
        $message .= "*المنتجات:*\n";

        $order->load('items');
        $i = 1;
        foreach ($order->items as $item) {
            $subtotal = number_format($item->price * $item->quantity, 2);
            $message .= "{$i}. {$item->product_name} x {$item->quantity} = {$subtotal} {$currency}\n";
            $i++;
        }

        $message .= "\n*الإجمالي:* " . number_format($order->total, 2) . " {$currency}\n";

        if ($order->notes) {
            $message .= "\n*ملاحظات:* {$order->notes}";
        }

        return 'https://wa.me/' . $phone . '?text=' . rawurlencode($message);
    }
}
