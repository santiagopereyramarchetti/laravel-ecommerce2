<?php

namespace App\Services;

use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class InvoiceService{

    public function createInvoice($order){
        $client = new Party([
            'name'          => 'Coder\'s Shop',
        ]);

        $customer = new Party([
            'name'          => $order->billing_name,
            'custom_fields' => [
                'email' => $order->billing_email,
            ],
        ]);

        foreach($order->products as $product){
            
            $items[] = (new InvoiceItem())->title($product->name)->description($product->description)->pricePerUnit($product->price/100)->quantity($product->pivot->quantity);
        }

        $invoice = Invoice::make()
        ->seller($client)
        ->buyer($customer)
        ->series('Coder\'s Shop')
        ->filename('Coders_Shop_' . $order->confirmation_number)
        ->totalDiscount($order->billing_discount/100)
        ->taxRate(config('cart.tax'))
        ->shipping(0)
        ->serialNumberFormat('{SEQUENCE}/{SERIES}')
        ->addItems($items)
        ->logo(public_path('vendor/invoices/sample-logo.png'));

        // And return invoice itself to browser or have a different view
        return $invoice;
    }

}