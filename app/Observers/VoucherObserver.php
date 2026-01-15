<?php

namespace App\Observers;

use App\Models\Voucher;
use Carbon\Carbon;

class VoucherObserver
{
    public function retrieved(Voucher $voucher)
    {
        if ($voucher->status !== 'expired' && Carbon::now()->isAfter($voucher->end_date)) {
            $voucher->status = 'expired';
            $voucher->saveQuietly();
        }
    }
}
