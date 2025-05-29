<?php
require_once 'vendor/autoload.php';
\Stripe\Stripe::setApiKey('your_stripe_secret_key');

$cartItems = getCartItems($pdo);
$total = array_sum(array_map(fn($i) => $i['quantity'] * $i['price'], $cartItems)) * 100;

$session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => array_map(function ($item) {
        return [
            'price_data' => [
                'currency' => 'usd',
                'product_data' => ['name' => $item['name']],
                'unit_amount' => $item['price'] * 100,
            ],
            'quantity' => $item['quantity'],
        ];
    }, $cartItems),
    'mode' => 'payment',
    'success_url' => 'http://localhost/index.php?page=checkout',
    'cancel_url' => 'http://localhost/index.php?page=cart',
]);
header("Location: " . $session->url);
exit;
