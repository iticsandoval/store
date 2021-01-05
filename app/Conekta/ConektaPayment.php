<?php


namespace App\Conekta;

use App\Core\User;
use Conekta\Conekta;


class ConektaPayment
{

    function __construct()
    {
        Conekta::setApiKey(env('CONEKTA_SECRET'));
        Conekta::setApiVersion(env('CONEKTA_API_VERSION'));
    }

    function createOrder($product_name,$product_price, $product_qty, $product_currency)
    {
        // request body

        $line_items = [];

        $line_items[0]["name"]          = $product_name;
        $line_items[0]["unit_price"]    = $product_price * 100;
        $line_items[0]["quantity"]      = $product_qty;

        $expires_at = (new \DateTime())->add(new \DateInterval('P5D'))->getTimestamp();

        $charges[0]["payment_method"]["type"]       = "oxxo_cash";
        $charges[0]["payment_method"]["expires_at"] = $expires_at;

        $order["line_items"]                = $line_items;
        $order["currency"]                  = $product_currency;
        $order["customer_info"]["name"]     = User::$Info["UserName"];
        $order["customer_info"]["email"]    = User::$Info["UserEmail"];
        $order["customer_info"]["phone"]    = User::$Info["UserPhone"];
        $order["charges"]                   = $charges;

        try {

            $conekta_order = \Conekta\Order::create($order);

            if(isset($conekta_order->id))
            {
                return $this->buildStub($conekta_order);
            }

        }

        catch (\Conekta\ParameterValidationError $error)
        {
            $err["code"]    = $error->getCode();
            $err["message"] = $error->getMessage();

            return $err;
        }

        catch (\Conekta\Handler $error)
        {
            $err["code"]    = $error->getCode();
            $err["message"] = $error->getMessage();

            return $err;
        }

    }

    function getOrder($order_id)
    {
        return  \Conekta\Order::find($order_id);
    }

    function buildStub($order)
    {

        // guardar detalle de la orden en la base de datos


        $stub["OrderID"]        = $order->id;
        $stub["OrderStatus"]    = $order->payment_status;
        $stub["items"]      = $order->line_items;
        $stub["Total"]      = $order->amount / 100;
        $stub["Currency"]   = $order->currency;
        $stub["Reference"]  = $order->charges[0]->payment_method->reference;

        return $stub;

    }

}
