<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Session;
use Stripe;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe($order_id)
    {
        //dd($id);
        $order = Order::where('id', $order_id)->first();
        return view('stripe', ["order" => $order]);
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    // public function stripePost(Request $request)
    // {
    //     Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    //     Stripe\Charge::create([
    //         "amount" => 100 * 100,
    //         "currency" => "usd",
    //         "source" => $request->stripeToken,
    //         "description" => "Test payment from itsolutionstuff.com."
    //     ]);

    //     Session::flash('success', 'Payment successful!');

    //     return back();
    // }

    /**

     * success response method.

     *

     * @return \Illuminate\Http\Response

     */

    public function stripePost(Request $request)
    {
        //dd($request->all());
        $order_id = $request->order_id;
        if (is_numeric($order_id)) {
            /* Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            Stripe\Charge::create([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com."
            ]);
            Session::flash('success', 'Payment successful!'); */


            $order = Order::where('id', $order_id)->first();
            if ($order->status == "WaitingForUserConfirmation") {
                $order->update([
                    "status" =>  "Confirmed"
                ]);
                return view('actions.confirm', ['order' => $order, 'state' => "Confirmednow"]);
            } elseif ($order->status == "Canceled") {
                return view('actions.confirm', ['order' => $order, 'state' => "Canceled"]);
            } elseif ($order->status == "Confirmed") {
                return view('actions.confirm', ['order' => $order, 'state' => "Confirmed"]);
            } elseif ($order->status == "Delivered") {
                return view('actions.confirm', ['order' => $order, 'state' => "Delivered"]);
            }
        }
    }
}
