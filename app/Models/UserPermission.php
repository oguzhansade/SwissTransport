<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserPermission extends Model
{
    protected $guarded = [];
    use HasFactory;
    
    static function getControl($userId,$permissionId)
    {
        $c = UserPermission::where('userId',$userId)->where('permissionId', $permissionId)->count();
        return ($c!=0) ? true : false;
    }

    static function getMyControl($permissionId)
    {
        $c = UserPermission::where('userId',Auth::id())->where('permissionId', $permissionId)->count();
        return ($c!=0) ? true : false;
    }

    static function getMyPermission($userId,$permissionId)
    {
        $data = UserPermission::where('userId',$userId)->where('permissionId',$permissionId)->count();
        if($data['permissionId'] == 3)
        {

        }
        // $c = UserPermission::where('userId',Auth::id())->where('permissionId', $permissionId)->count();
        // return ($c!=0) ? true : false;
    }
}
