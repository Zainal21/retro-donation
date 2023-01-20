<?php

namespace App\Http\Services;

use Midtrans\Snap;
use Midtrans\Config;
use App\Helpers\Helper;
use Midtrans\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Repositories\DonationRepository;

class DonationService
{
    public $donationRepository;

    public function __construct()
    {
        $this->donationRepository = new DonationRepository;
    }

    public function payDonation($request)
    {
        Config::$serverKey = config('key.midrans.serverKey');
        Config::$isProduction = config('key.midrans.isProduction');
        Config::$isSanitized = config('key.midrans.isSanitized');
        Config::$is3ds = config('key.midrans.is3ds');

        $user = Auth::user();
        $data = [
            'user_id_donate' => $user->id,
            'user_name_donate' => $user->name,
            'donate_code' =>  $this->donationRepository->generateTransactionCode(),
            'user_id' => $request['user_id'],
            'user_name' => $request['user_name'],
            'gross_amount' => Helper::priceToNumber($request['amount']),
            'status' => 'PENDING',
            'message' => $request['message']
        ];
        // write code here
        $midtransPayload = [
            'transaction_details' => [
                'order_id' =>  $data['donate_code'],
                'gross_amount' => (float) $data['gross_amount'],
            ],
            'customer_details' => [
                'first_name'    => $data['user_name_donate'],
                'email'         =>$user->email
            ],
            'enabled_payments' => ['gopay','bank_transfer'],
            'vtweb' => []
        ];
        DB::beginTransaction();
        try {
            $this->donationRepository->createDonation($data);
            $paymentUrl = Snap::createTransaction($midtransPayload)->redirect_url;
            $finalResponse = [
                'success' => true,
                'paymentUrl' => $paymentUrl,
                'transaction_detail' => $midtransPayload['transaction_details'],
                'customer_details' => $midtransPayload['customer_details'],
            ];
            DB::commit();
            return Helper::success($finalResponse, 'Donation Transaction Successfully');
        } catch (\Exception $th) {
            DB::rollBack();
            return Helper::error(null, $th->getMessage() ?? 'Failed when Connected to Midrans Payment Gateway', 500);
        }
    }

    public function payDonationCallback()
    {
        // write code here
    }

}