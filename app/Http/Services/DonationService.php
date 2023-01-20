<?php

namespace App\Http\Services;

use Validator;
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
        $schema = Validator::make($request, [
            'amount' => 'required|numeric',
            'message' => 'required|string',
        ]);

        if($schema->fails()){
            return Helper::error(null, $schema->errors()->first());
        }else{
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

    }

    public function payDonationCallback()
    {
        Config::$serverKey = config('key.midrans.serverKey');
        Config::$isProduction = config('key.midrans.isProduction');
        Config::$isSanitized = config('key.midrans.isSanitized');
        Config::$is3ds = config('key.midrans.is3ds');

        $notification = new Notification();

        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id;
        
        $donation = $this->donationRepository->getDonationByOrderCode($order_id);
        if ($status == 'capture') {
            if ($type == 'credit_card'){
                if($fraud == 'challenge'){
                    $donation->status = 'PENDING';
                }
                else {
                    $donation->status = 'SUCCESS';
                }
            }
        }
        else if ($status == 'settlement'){
            $donation->status = 'SUCCESS';
        }
        else if($status == 'pending'){
            $donation->status = 'PENDING';
        }
        else if ($status == 'deny') {
            $donation->status = 'CANCELLED';
        }
        else if ($status == 'expire') {
            $donation->status = 'CANCELLED';
        }
        else if ($status == 'cancel') {
            $donation->status = 'CANCELLED';
        }
        $donation->save();
        if($donation){
            return Helper::success($donation, ' Midtrans Notification Success');
        }else{
            return Helper::error(null, 'Failed when Send Callback Notification', 400);
        }
    }

    public function getCountStaticticDonation()
    {
        return $this->donationRepository->countStaticticDashboard();
    }

}