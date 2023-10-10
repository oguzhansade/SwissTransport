<?php

namespace App\Console\Commands;

use App\Models\offerte;
use App\Models\OfferteEntsorgung;
use App\Models\OfferteReinigung;
use App\Models\OfferteTransport;
use App\Models\OfferteUmzug;
use Carbon\Carbon;
use Illuminate\Console\Command;

class OfferteDateUpdater extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:offertedateupdater';

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
        $data = offerte::where('offerteStatus', 'Beklemede')
            ->get(['id', 'offerteUmzugId', 'offerteTransportId', 'offerteReinigungId','offerteEntsorgungId'])
            ->toArray();

        $today = Carbon::now()->format('Y-m-d');
        $umzugOfferteler = [];

        foreach ($data as $offerte) {
            $models = OfferteUmzug::find($offerte['offerteUmzugId'])
                ?? OfferteTransport::find($offerte['offerteTransportId'])
                ?? OfferteReinigung::find($offerte['offerteReinigungId'])
                ?? OfferteEntsorgung::find($offerte['offerteEntsorgungId']);

            if ($models) {
                $tarih = null;
                $belirtec = null;
                $servisId = null;

                if ($models instanceof OfferteUmzug) {
                    $belirtec = 'Umzug';
                    $tarih = $models->moveDate;
                    $servisId = $models->id;
                } elseif ($models instanceof OfferteTransport) {
                    $belirtec = 'Transport';
                    $tarih = $models->transportDate;
                    $servisId = $models->id;
                } elseif ($models instanceof OfferteReinigung) {
                    $belirtec = 'Reinigung';
                    $tarih = $models->startDate;
                    $servisId = $models->id;
                }
                elseif ($models instanceof OfferteEntsorgung) {
                    $belirtec = 'Entsorgung';
                    $tarih = $models->entsorgungDate;
                    $servisId = $models->id;
                }

                $durum = ($tarih >= $today) ? 'Online' : 'Expired';

                $umzugOfferteler[] = [
                    'offerteId' => $offerte['id'],
                    'servisAdi' => $belirtec,
                    'servisId' => $servisId,
                    'servisTarihi' => $tarih,
                    'suankiTarih' => $today,
                    'tarihDurumu' => $durum,
                ];
                

            }

            $expiredOfferteIds = [];

            foreach ($umzugOfferteler as $offerte) {
                if ($offerte['tarihDurumu'] === 'Expired') {
                    $expiredOfferteIds[] = $offerte['offerteId'];
                }
            }
            offerte::whereIn('id', $expiredOfferteIds)->update(['offerteStatus' => 'Onaylanmadı']);
        }
        return 0;
    }
}
