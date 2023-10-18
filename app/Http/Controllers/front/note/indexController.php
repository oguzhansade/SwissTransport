<?php

namespace App\Http\Controllers\front\note;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\OfferteNotes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;


class indexController extends Controller
{

    public function getCustomer(Request $request)
    {
        $id = request()->route('customerId');
        $data = Customer::where('id',$id)->first();
        if ($data) {
            // Başarılı yanıt oluştur
            return response()->json(['message' => 'Müşteri Bulundu', 'data' => $data], 200);
        } else {
            // Hata yanıtı oluştur
            return response()->json(['message' => 'Müşteri Bulunamadı'], 500);
        }
    }

    public function data(Request $request)
    {
        $offerId = $request->offerId;
        $table = DB::table('offerte_notes')->where('offerId', '=', $offerId)->get()->toArray();
        $data = DataTables::of($table)

            ->editColumn('id', function ($data) {
                return '' . $data->id;
            })
            ->editColumn('created_at', function ($data) {
                $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y');
                return $formatedDate;
            })

            ->editColumn('updated_at', function ($data) {
                $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->updated_at)->format('d-m-Y');
                return $formatedDate;
            })

            ->addColumn('option', function ($table) {
                return '
                
                    <a title="Detail" class="btn btn-sm btn-primary detailNotizButton" href="#" data-toggle="modal" data-target="#detailNotizModal" data-id="'.$table->id.'" onclick="notizDetail('.$table->id.')" ><i class="feather feather-eye" ></i></a>
                    <a title="Bearbeiten" class="btn btn-sm btn-info editNotizButton" href="#" data-toggle="modal" data-target="#editNotizModal" data-id="'.$table->id.'" onclick="notizEdit('.$table->id.')" ><i class="feather feather-edit" ></i></a> 
                    <a title="Delete" class="btn btn-sm btn-danger deleteNotizButton" href="#" data-toggle="modal" data-target="#deleteNotizModal" data-id="'.$table->id.'" onclick="notizDelete('.$table->id.')" ><i class="feather feather-trash-2" ></i></a>
                ';
            })
            ->rawColumns(['option'])
            ->make(true);

        return $data;
    }
    public function store(Request $request)
    {
        $offerId = request()->route('offerId');
        $note = [
            'offerId' => $offerId,
            'note' => $request->note
        ];

        $create = OfferteNotes::create($note);
        if ($create) {
            // Başarılı yanıt oluştur
            return response()->json(['message' => 'Not başarıyla kaydedildi'], 200);
        } else {
            // Hata yanıtı oluştur
            return response()->json(['message' => 'Not kaydedilemedi'], 500);
        }
    }

    public function edit(Request $request)
    {
        $id = request()->route('id');
        $data = OfferteNotes::where('id',$id)->first();

        if ($data) {
            // Başarılı yanıt oluştur
            return $data;
        } else {
            // Hata yanıtı oluştur
            return response()->json(['message' => 'Not Yüklenemedi'], 500);
        }
    }

    public function update(Request $request)
    {
        $id = request()->route('id');
        $data = OfferteNotes::where('id',$id)->first();
        if($data)
        {
            $note = [
                'note' => $request->note
            ];

            $update = OfferteNotes::where('id',$id)->update($note);
            if ($update) {
                // Başarılı yanıt oluştur
                return response()->json(['message' => 'Not başarıyla Güncellendi'], 200);
            } else {
                // Hata yanıtı oluştur
                return response()->json(['message' => 'Not Güncellenemedi'], 500);
            }
        }
        else {
            // Hata yanıtı oluştur
            return response()->json(['message' => 'Not Güncellenemedi, Çünkü Not Bulunamadı'], 500);
        }
        
    }

    public function delete(Request $request)
    {
        $id = request()->route('id');
        $data = OfferteNotes::where('id',$id)->count();

        if($data > 0)
        {
            $delete = OfferteNotes::where('id',$id)->delete();

            if($delete) {
                // Başarılı yanıt oluştur
                return response()->json(['message' => 'Not başarıyla Silindi'], 200);
            } else {
                // Hata yanıtı oluştur
                return response()->json(['message' => 'Not Silinemedi'], 500);
            }
        }
    }
}
