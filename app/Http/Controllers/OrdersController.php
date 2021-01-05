<?php

namespace App\Http\Controllers;

use App\Conekta\ConektaPayment;
use Conekta\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{

    /** @var Request $Request */
    protected $Request;

    function __construct()
    {
        $this->Request = new Request();
    }


    public function list()
    {

        $orders = DB::table("orders")->get();

        return view("orders")->with(["orders" => $orders]);
    }

    public function info($order_id)
    {
        $Conekta = new ConektaPayment();
        return $Conekta->getOrder($order_id);
    }

    public function webhook()
    {
        $order = @file_get_contents('php://input');
        $order = json_decode($order, true);


        $order_id     = isset($order["id"]) ? $order["id"] : null;
        $order_status = isset($order["payment_status"]) ? $order["payment_status"] : null;

        if(!$order_id || !$order_status)
        {
            return false;
        }

        // buscar orden en nuestra bd
        $order_info = DB::table("orders")->where("OrderPaymentMethodID", $order_id)->first();

        if(isset($order_info->OrderID))
        {

            if($order_info->OrderStatus != $order_status)
            {
                $UpdateData["OrderStatus"]     = $order_status;
                $UpdateData["OrderUpdateDate"] = date("Y-m-d H:i:s");

                if(DB::table("orders")->where("OrderPaymentMethodID", $order_id)->update($UpdateData))
                {
                    // re
                    return response()->json("Orden actualizada.", 200);
                }
            }

            else
            {
                return response()->json("No hay nada que actualizar", 200);
            }

        }


    }



}
