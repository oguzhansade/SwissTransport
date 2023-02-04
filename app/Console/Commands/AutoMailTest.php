<?php

namespace App\Console\Commands;

use App\Mail\TestMail;
use App\Models\Customer;
use App\Models\LagerungMailer;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class AutoMailTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $lagerunMailer = LagerungMailer::where('startTime',Carbon::now()->format('Y-m-d'))
        ->get();

        if ($lagerunMailer->count() > 0) {
        foreach ($lagerunMailer as $lagerunMailer) {
            $CustomerMail = Customer::where('id',$lagerunMailer['customerId'])->first();
            Mail::to($CustomerMail['email'])->send(new TestMail());
        }
        }
       

        return 0;
    }
}
