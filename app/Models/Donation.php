<?php

namespace App\Models;

use App\Http\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donation extends Model
{
    use HasFactory,Uuids;
    
    protected $table = 'donations';

    protected $guarded = [];

    public function setPending()
    {
        $this->arrtibute['status'] = 'PENDING';
        $this->arrtibute['is_verif'] = 0;
        self::save();
    }

    public function setExpired()
    {
        $this->arrtibute['status'] = 'CANCELLED';
        $this->arrtibute['is_verif'] = 0;
        $this->arrtibute['expired_time'] = now();
        self::save();
    }

    public function setSuccess()
    {
        $this->arrtibute['status'] = 'SUCCESS';
        $this->arrtibute['is_verif'] = 1;
        $this->arrtibute['payment_time'] = now();
        self::save();
    }

}
