<?php

namespace App\Http\Controllers\front\customerForms;

use App\Http\Controllers\Controller;
use App\Models\CustomerForm;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Customer;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;



class indexController extends Controller
{
    public function handleSchnellanForm(Request $request)
    {
        $formData = $request->all();
        $schnellanForm = [
            'customerName'  => $formData['Name_/_Vorname'],
            'mail' => $formData['Ihre_E-Mail-Adresse'],
            'phone'=> $formData['Telefon'],
            'vonStreet' => $formData['Von:Strasse/Nr_'],
            'vonPlz' => $formData['Von:PLZ/Ort'],
            'zimmer'=> $formData['Anzahl_Zimmer'],
            'nachStreet' => $formData['Nach:Strasse/Nr_'],
            'nachPlz' => $formData['Nach:PLZ/Ort'],
            'umzugDate' =>  $formData['Umzugsdatum'] ? Carbon::createFromFormat('d/m/Y', $formData['Umzugsdatum'])->format('Y-m-d') : NULL,
            'type' => 'Schnellanform',
            'status' => 0
        ];

        $create = CustomerForm::create($schnellanForm);

        // $fileContents = json_encode($formData);
        // $filePath = storage_path('app/public/schnellanForm.txt'); // Dosyanın tam yolu

        // if (!file_exists($filePath)) {
        //     touch($filePath); // Dosyayı oluştur
        //     chmod($filePath, 0666); // Yazma izinlerini ayarla
        // }

        // file_put_contents($filePath, $fileContents);

        // // İşlem sonucunu döndür
        return response()->json(['message' => 'FormCraft verileri başarıyla alındı ve dosyaya yazıldı.']);
    }

    public function handleFirmenForm(Request $request)
    {
        $formData = $request->all();
        $firmenForm = [
            'customerName' => $formData['Name_/_Vorname'],
            'mail' => $formData['Ihre_E-Mail-Adresse'],
            'phone' => $formData['Telefon'],
            'firma' => $formData['Firma'],
            'vonStreet' => $formData['Von:Strasse/Nr_'],
            'vonPlz' => $formData['Von:PLZ/Ort'],
            'zimmer' => $formData['Anzahl_Räume'],
            'nachStreet' => $formData['Nach:Strasse/Nr_'],
            'nachPlz' => $formData['Nach:PLZ/Ort'],
            'umzugDate' => $formData['Umzugsdatum'] ? Carbon::createFromFormat('d/m/Y', $formData['Umzugsdatum'])->format('Y-m-d') : NULL,
            'vonEtage' => $formData['Von:Etage'],
            'nachEtage' => $formData['Nach:Etage'],
            'vonLift' => $formData['Von:Lift_vorhanden?'],
            'nachLift' => $formData['Nach:Lift_vorhanden?'],
            'bemerkung' => $formData['Bemerkungen'],
            'type' => 'Firmenform',
            'status' => 0
        ];

        $create = CustomerForm::create($firmenForm);

        // $fileContents = json_encode($formData);
        // $filePath = storage_path('app/public/firmenForm.txt'); // Dosyanın tam yolu

        // if (!file_exists($filePath)) {
        //     touch($filePath); // Dosyayı oluştur
        //     chmod($filePath, 0666); // Yazma izinlerini ayarla
        // }

        // file_put_contents($filePath, $fileContents);

        // // İşlem sonucunu döndür
        return response()->json(['message' => 'FormCraft verileri başarıyla alındı ve dosyaya yazıldı.']);
    }

    public function handlePrivatForm(Request $request)
    {
        $formData = $request->all();
        $privatForm = [
            'customerName' => $formData['Name_/_Vorname'],
            'mail' => $formData['Ihre_E-Mail-Adresse'],
            'phone' => $formData['Telefon'],
            'extraService' => $formData['Weitere_Dienstleistungen'],
            'vonStreet' => $formData['Von:Strasse/Nr_'],
            'vonPlz' => $formData['Von:PLZ/Ort'],
            'zimmer' => $formData['Anzahl_Zimmer'],
            'nachStreet' => $formData['Nach:Strasse/Nr_'],
            'nachPlz' => $formData['Nach:PLZ/Ort'],
            'umzugDate' => $formData['Umzugsdatum'] ? Carbon::createFromFormat('d/m/Y', $formData['Umzugsdatum'])->format('Y-m-d') : NULL,
            'vonEtage' => $formData['Von:Etage'],
            'nachEtage' => $formData['Nach:Etage'],
            'vonLift' => $formData['Von:Lift_vorhanden?'],
            'nachLift' => $formData['Nach:Lift_vorhanden?'],
            'bemerkung' => $formData['Bemerkungen'],
            'type' => 'Privatform',
            'status' => 0
        ];

        $create = CustomerForm::create($privatForm);

        // $fileContents = json_encode($formData);
        // $filePath = storage_path('app/public/privatForm.txt'); // Dosyanın tam yolu

        // if (!file_exists($filePath)) {
        //     touch($filePath); // Dosyayı oluştur
        //     chmod($filePath, 0666); // Yazma izinlerini ayarla
        // }

        // file_put_contents($filePath, $fileContents);

        // // İşlem sonucunu döndür
        return response()->json(['message' => 'FormCraft verileri başarıyla alındı ve dosyaya yazıldı.']);
    }
    public function data(Request $request)
    {

            $table=CustomerForm::query();
            if($request->min_date) {
                $table->whereDate('created_at', '>=', $request->min_date);
            }

            // Maximum date filter
            if($request->max_date) {
                $table->whereDate('created_at', '<=', $request->max_date);
            }
            $data=DataTables::of($table)

            ->editColumn('created_at', function ($data) {
                $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y');
                return $formatedDate;
            })
            ->editColumn('status', function ($data) {
                if($data->status == 0)
                {
                    return '<button type="button" class="btn btn-sm btn-warning">Nicht registriert</button>';
                }
                else {
                    return '<button type="button" class="btn btn-sm btn-success">Registriert</button>';
                }

            })
            ->editColumn('type', function ($data) {
                if($data->type == 'Privatform')
                {
                    return 'Privat kunde';
                }
                else if($data->type == 'Firmenform') {
                    return 'Firmen kunde';
                }
                else if($data->type == 'Schnellanform') {
                    return 'Schnellan kunde';
                }
                else if($data->type == 'Reinigungform') {
                    return 'Reinigung kunde';
                }
            })

            ->addColumn('option',function($table)
            {


                if(Auth::user()->permName == 'superAdmin')
                {
                    return '<a class="btn btn-sm  btn-detail" href="'.route('customerForms.detail',['id'=>$table->id]).'">Detail</a>
                    <a class="btn btn-sm  btn-danger" href="'.route('customerForms.delete',['id'=>$table->id]).'">Delete</a>';
                }
                else  {
                    return '<a class="btn btn-sm  btn-detail" href="'.route('customerForms.detail',['id'=>$table->id]).'">Detail</a> ';
                }
            })
            ->rawColumns(['option','status'])
            ->make(true);

            return $data;

    }

    public function detail(Request $request)
    {
        $id = $request->route('id');
        $data = CustomerForm::where('id',$id)->first();
        return view('front.customerForms.detail', ['data' => $data]);
    }

    public function assign(Request $request)
    {
        $id = $request->route('id');
        $data = CustomerForm::where('id',$id)->first();
        $customers = Customer::all();

        return view('front.customerForms.assign', ['data' => $data, 'customers' => $customers]);
    }

    public function assignCustomer(Request $request)
    {
        $id = $request->route('id');
        $customerId = $request->get('customer');

        $formUpdate = CustomerForm::where('id',$id)->update([
            'status' => 1,
            'customerId' => $customerId
        ]);

        if($formUpdate){
            return redirect()
                ->route('customerForms.detail', ['id' => $id])
                ->with('status', 'Der Kunde wurde erfolgreich zugewiesen');
        }
        else {
            return redirect()
                ->route('customerForms.detail', ['id' => $customerId])
                ->with('status2', 'Fehler: Der Kunde konnte nicht zugewiesen werden.');
        }
    }

    public function unAssignCustomer(Request $request)
    {
        $id = $request->route('id');
        $customerId = $request->get('customer');

        $formUpdate = CustomerForm::where('id',$id)->update([
            'status' => 0,
            'customerId' => NULL
        ]);

        if($formUpdate){
            return redirect()
                ->route('customerForms.detail', ['id' => $id])
                ->with('status', 'Mitarbeiterzuweisung erfolgreich entfernt');
        }
        else {
            return redirect()
                ->route('customerForms.detail', ['id' => $customerId])
                ->with('status2', 'Fehler: Mitarbeiterzuweisung konnte nicht entfernt werden.');
        }
    }

    public function delete ($id)
    {
        $c = CustomerForm::where('id',$id)->count();
        if($c !=0)
        {
            $data = CustomerForm::where('id',$id)->first();


            CustomerForm::where('id',$id)->delete();

            return redirect()->back()->with('status','Das Formular wurde erfolgreich gelöscht.');
        }
        else {
            return redirect('/');
        }
    }
}
