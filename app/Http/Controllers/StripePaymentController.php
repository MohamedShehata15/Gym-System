<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\TrainingPackage;
use App\Models\User;
use App\Models\UserTrainingPackage;
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

        $trainingPackage = TrainingPackage::find($request->training_package);
        $user = User::find($request->user);

        $user->update(['remaining_sessions' => $trainingPackage->session_number]);

        UserTrainingPackage::create([
            'date' => $trainingPackage->updated_at,
            'price' => $trainingPackage->price,
            'training_package_id' => $trainingPackage->id,
            'user_id' => $user->id
        ]);

        Session::flash('success', 'Payment successful!');

        return back();
    }
}