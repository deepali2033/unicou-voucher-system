<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

DB::statement('SET FOREIGN_KEY_CHECKS=0');
DB::statement('DROP TABLE IF EXISTS voucher_audit_logs');
DB::statement('DROP TABLE IF EXISTS coupons');
DB::statement('DROP TABLE IF EXISTS redemptions');
DB::statement('DROP TABLE IF EXISTS bonuses');
DB::statement('DROP TABLE IF EXISTS referrals');
DB::statement('SET FOREIGN_KEY_CHECKS=1');
echo 'Tables dropped successfully' . PHP_EOL;
