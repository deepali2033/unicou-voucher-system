<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Voucher;
use Carbon\Carbon;

class UpdateExpiredVouchers extends Command
{
    protected $signature = 'vouchers:update-expired';

    protected $description = 'Automatically mark vouchers as expired when end date passes';

    public function handle()
    {
        $expired = Voucher::where('status', '!=', 'expired')
            ->where('end_date', '<', Carbon::today())
            ->update(['status' => 'expired']);

        $this->info("✅ Updated $expired expired vouchers");
    }
}
