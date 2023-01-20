<?php

namespace App\Http\Repositories;

use App\Models\Donation;
use Illuminate\Support\Facades\DB;

interface DonationContract
{
    public function getDonationByUserId($user_id);
    public function createDonation($data);
    public function generateTransactionCode();
}

class DonationRepository implements DonationContract
{
    public function getDonationByUserId($user_id)
    {
       return Donation::where('user_id', $user_id)->get();
    }

    public function createDonation($data)
    {
        return Donation::create($data);
    }

    public function generateTransactionCode()
    {
        $day = date('d');
        $month = date('m');
        $years = date('Y');
        $yearFormat = date('y');
        $baseOrdered = "00000";
        $data = Donation::selectRaw('max(RIGHT(donate_code, 4)) as last_order')
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $years)
                ->whereDay('created_at', $day)
                ->orderBy(DB::raw('max(RIGHT(donate_code, 4))', 'DESC'))->take(1)->first();
        if ($data) $baseOrdered = $data->last_order;
        $nextOrdered = abs($baseOrdered) + 1;
        $uniqueCode = 'DONATE' . $day . $month . $yearFormat . sprintf('%05d', $nextOrdered);
        return $uniqueCode;
    }
}