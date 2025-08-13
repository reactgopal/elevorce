<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class VisaExpiry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'visa:expiry-check';

    /**
    * The console command description.
    *
    * @var string
    */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */



    public function handle()
    {
        $today = \Carbon\Carbon::today();

        $visas = \App\Models\VisaDetail::with('employee')
        ->whereNotNull('visa_expiry_date')
        ->get()
        ->filter(function ($visa) {
            return !empty($visa->employee);
        });

            $notifyDays = [30, 15, 10, 5, 4, 3, 2, 1];
            $notifyList = [];

            foreach ($visas as $visa) {
                $expiryDate = \Carbon\Carbon::parse($visa->visa_expiry_date);
                $diffDays = $today->diffInDays($expiryDate, false);

                // 2) Notification mate qualify thayela visas collect karva
                if (in_array($diffDays, $notifyDays)) {
                    $notifyList[] = $visa;
                }

                // 3) Expire today
                if ($diffDays === 0) {
                    $visa->status = 'expired';
                    $visa->save();
                    Log::info("Visa expired today for employee: {$visa->employee->name}");
                }

                // 4) Already expired
                if ($diffDays < 0 && $visa->status !== 'expired') {
                    $visa->status = 'expired';
                    $visa->save();
                    Log::info("Visa already expired for employee: {$visa->employee->name}");
                }
            }

            // 5) Notification ek var ma moklvi
            if (!empty($notifyList)) {
                // Notification::send($notifyList, new VisaExpiryNotification($today));
                Log::info("Notification sent for " . count($notifyList) . " visas");
            }

        Log::info('Visa expiry check completed.');
        return 0;
    }

}
