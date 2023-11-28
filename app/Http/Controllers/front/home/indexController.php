<?php

namespace App\Http\Controllers\front\home;

use App\Http\Controllers\Controller;
use App\Models\UserPermission;
use App\Models\WorkerBasket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class indexController extends Controller
{
    public function index()
    {
        if (Auth::user()->permName == 'worker')
        {
            $gorevSayisi = WorkerBasket::where('userId',Auth::id())->count();
            return view ('front.workerPanel.index',['gorevSayisi' => $gorevSayisi]);
        }
        else {
            return view ('front.home.index');
        }
        
    }
}
