<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\CustomerReminder;
use App\Models\Company;
use App\Models\Customer;
use App\Models\offerte;
use App\Models\OfferteEntsorgung;
use App\Models\OfferteReinigung;
use App\Models\OfferteTransport;
use App\Models\OfferteUmzug;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class beforeOneWeekOfferMailer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:beforeoneweekoffermailer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Offer mail before one week';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $offertes = Offerte::where('offerteStatus', 'Onaylandı')
            ->get();
        $umzugDate = null;
        foreach ($offertes as $offerte) {
            if ($offerte) {
                $customer = Customer::find($offerte->customerId);
                $from = Company::InfoCompany('email');
                $companyName = Company::InfoCompany('name');
    
                if ($offerte->offerteUmzugId) {
                    $umzugService = OfferteUmzug::find($offerte->offerteUmzugId);
    
                    // Check if both offerteUmzugId and moveDate are present
                    if ($umzugService && $umzugService->moveDate) {
                        $umzugDate = Carbon::parse($umzugService->moveDate);
                        $mailParseTime = $umzugService->moveTime;
                    } else {
                        // If moveDate is null, proceed to check for offerteTransportId
                        $umzugDate = null;
                        $mailParseTime = null;
                    }
                }
    
                if (!$umzugDate && $offerte->offerteTransportId) {
                    $transportService = OfferteTransport::find($offerte->offerteTransportId);
                    
                    // Check if both offerteUmzugId and moveDate are present
                    if ($transportService && $transportService->moveDate) {
                        $umzugDate = Carbon::parse($transportService->transportDate);
                        $mailParseTime = $transportService->transportTime;
                    } else {
                        // If moveDate is null, proceed to check for offerteTransportId
                        $umzugDate = null;
                        $mailParseTime = null;
                    }
                }

                if (!$umzugDate && $offerte->offerteReinigungId) {
                    $reinigungService = OfferteReinigung::find($offerte->offerteReinigungId);
                    
                    // Check if both offerteUmzugId and moveDate are present
                    if ($reinigungService && $reinigungService->startDate) {
                        $umzugDate = Carbon::parse($reinigungService->startDate);
                        $mailParseTime = $reinigungService->startTime;
                    } else {
                        // If moveDate is null, proceed to check for offerteTransportId
                        $umzugDate = null;
                        $mailParseTime = null;
                    }
                }

                if (!$umzugDate && $offerte->offerteEntsorgungId) {
                    $entsorgungService = OfferteEntsorgung::find($offerte->offerteEntsorgungId);
                    
                    // Check if both offerteUmzugId and moveDate are present
                    if ($entsorgungService && $entsorgungService->entsorgungDate) {
                        $umzugDate = Carbon::parse($entsorgungService->entsorgungDate);
                        $mailParseTime = $entsorgungService->entsorgungTime;
                    } else {
                        // If moveDate is null, proceed to check for offerteTransportId
                        $umzugDate = null;
                        $mailParseTime = null;
                    }
                }
    
                // If both offerteUmzugId and moveDate are null, skip this iteration
                if (!$umzugDate) {
                    continue;
                }
    
                // 1 hafta öncesi kontrol et
                $oneWeekBefore = $umzugDate->subDays(7);
                
                // Carbon::now() == $twoWeeksAfter eğer böyle yazsaydık saatinde uyuşması gerekirdi o yüzden isSameDay kullandık
                if (Carbon::now()->isSameDay($oneWeekBefore)) {
                    $emailData = [
                        'mailType' => 'beforeOneWeek',
                        'customer' => $customer,
                        'from' => $from,
                        'sub' => 'Vorbereitung und Details für Ihren Umzug mit der Swiss Transporte GmbH',
                        'companyName' => $companyName,
                        'offerte' => $offerte,
                        'umzugDate' => $umzugDate->addDays(7)->format('d-m-Y'),
                        'umzugTime' => $mailParseTime
                    ];
    
                    Mail::to($customer->email)->send(new CustomerReminder($emailData));
                }
            }
        }
    }
}
