<?php

namespace App\Console\Commands;

use App\Mail\LagerungMail;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceLagerung;
use App\Models\LagerungMailer;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;


class LagerungMailReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:lagerungmailer';

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
        $lagerunMailer = LagerungMailer::where('startDate',Carbon::now()->format('Y-m-d'))
        ->get();

        if ($lagerunMailer->count() > 0) {
        foreach ($lagerunMailer as $lagerunMailer) {
                $invoicePdf = Invoice::where('id',$lagerunMailer['invoiceId'])->first();
                if($invoicePdf)
                {
                    $CustomerMail = Customer::where('id',$lagerunMailer['customerId'])->first();
                    $customerData =  Customer::where('id',$lagerunMailer['customerId'])->first();
                    $lagerungPdf = InvoiceLagerung::where('id',$lagerunMailer['lagerungId'])->first();
    
                    $pdfData = [
                        'invoiceNumber' => $lagerunMailer['invoiceId'],
                        'invoice' => $invoicePdf,
                        'customer' => $customerData,
                        'lagerung' => $lagerungPdf,
                    ];
    
                    $pdf = Pdf::loadView('lagerungPdf', $pdfData);
                    $pdf->setPaper('A4');
    
                    $emailData = [
                        'invoiceNumber' => $lagerunMailer['invoiceId'],
                        'name' => $CustomerMail['name'],
                        'surname' => $CustomerMail['surname'],
                        'gender' => $customerData['gender'],
                        'companyName'=>Company::InfoCompany('name'),
                        'sub' => 'Lagerung Bill Reminder',
                        'from' => Company::InfoCompany('email'),
                        'pdf' => $pdf,
                    ];
                Mail::to($CustomerMail['email'])->send(new LagerungMail($emailData));
                }
                
        }
        }

        return 0;
    }
}
