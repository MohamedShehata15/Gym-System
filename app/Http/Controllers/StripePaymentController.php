<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Session;
use Stripe;

class StripePaymentController extends Controller {
    public function stripe() {
        $cities = City::all();
        return view('admin.stripe', ['cities' => $cities]);
    }

    public function stripePost(Request $request) {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            'amount' => 100 * 100,
            'currency' => 'usd',
            'source' => $request->stripeToken,
            'description' => "Payment Package for user"
        ]);

        Session::flash('success', 'Payment successful!');

        return back();
    }
}