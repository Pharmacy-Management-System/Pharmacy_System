<?php

namespace App\Http\Controllers;

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
    public function stripe($price)
    {
        return view('stripe',["price"=>$price]);
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
         Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

         Stripe\Charge::create ([
                 "amount" => 100 * 100,
                 "currency" => "usd",
                 "source" => $request->stripeToken,
                 "description" => "Test payment from itsolutionstuff.com."
         ]);

         Session::flash('success', 'Payment successful!');

         return back();
     }
}
