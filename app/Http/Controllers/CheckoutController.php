<?php

namespace App\Http\Controllers;


use App\Conekta\ConektaPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{

    /** @var Request $Request */
    protected $Request;

    /** @var ConektaPayment $ConektaPayment */
    protected $ConektaPayment;

    function __construct()
    {
        $this->Request = new Request();
        $this->ConektaPayment = new ConektaPayment();
    }

    public function checkout()
    {
        return view('checkout');
    }

    public function buying()
    {
        $product_name       = $this->Request->json('product_name');
        $product_price      = $this->Request->json('product_price');
        $product_qty        = $this->Request->json('product_qty');
        $product_currency   = $this->Request->json('product_currency');

        $order = $this->ConektaPayment->createOrder($product_name,$product_price, $product_qty, $product_currency);

        // insert order
        $InsertData["OrderPaymentMethodID"] = $order["OrderID"];
        $InsertData["OrderDate"]            = date("Y-m-d H:i:s");
        $InsertData["OrderUpdateDate"]      = null;
        $InsertData["OrderPaymentMethod"]   = "conekta.oxxo";

        $InsertData["OrderTotal"]           = 0;
        $InsertData["OrderTotalItems"]      = 0;

        foreach($order["items"] as $item)
        {
            $InsertData["OrderTotal"] += $item["unit_price"] / 100;
            $InsertData["OrderTotalItems"] ++;
        }

        $InsertData["OrderCurrency"] = $order["Currency"];
        $InsertData["OrderStatus"]   = $order["OrderStatus"];


        $order_id = DB::table("orders")->insertGetId($InsertData);

        foreach($order["items"] as $item)
        {
            $Insert["OrderID"] = $order_id;
            $Insert["OrderItemName"]  = $item["name"];
            $Insert["OrderItemValue"] = $item["unit_price"] / 100;
            $Insert["OrderItemCurrency"] = $order["Currency"];

            DB::table("orders_items")->insert($Insert);

        }


        $code = 200;

        if(isset($order["code"]))
        {
            $code = 400;
        }

        return response()->json($order, $code);

    }


}
