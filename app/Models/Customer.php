<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'customerType',
        'gender',
        'name',
        'surname',
        'companyName',
        'contactPerson',
        'street',
        'postCode',
        'Ort',
        'country',
        'source1',
        'source2',
        'email',
        'phone',
        'mobile',
        'note'
    ];

    static function getPublicName($id)
    {
        $data = Customer::where('id', $id)->first();
        if($data['customerType'] == 0){
            return $data['name']." ".$data['surname'];            
        }
        else
        {
            return $data['companyName'];
        }
    }

    static function getCustomer($id,$param)
    {
       
        $data = Customer::where('id',$id)->first();
        return $data[$param];
    }

    static function getData($id)
    {
        $data = Customer::where('id',$id)->get();
        return $data;
    }

    public function routeNotificationForWhatsApp()
    {
        return $this->phone;
    }
}
