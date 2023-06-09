<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use Illuminate\Http\Request;
use App\Models\Donation;
use Stripe\Stripe;
use Stripe\Charge;

class ContributeController extends Controller
{
    public function donate(Request $request)
    {
        // Валидация данных пожертвования
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'amount' => 'required|numeric|min:0.01',
            'token' => 'required',
        ]);

        // Получение данных из формы
        $projectId = $request->project_id;
        $amount = $request->amount;
        $token = $request->token;

        // Отправка платежа через Stripe
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $charge = Charge::create([
                'amount' => $amount * 100, // Сумма в центах
                'currency' => 'usd',
                'source' => $token,
            ]);

            // Создание записи о пожертвовании
            $donation = new Contribution();
            $donation->user_id = auth()->user()->id;
            $donation->project_id = $projectId;
            $donation->amount = $amount;
            $donation->transaction_id = $charge->id;
            $donation->save();

            return redirect()->back()->with('success', 'Thank you for your donation!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Payment failed. Please try again later.');
        }
    }
}
