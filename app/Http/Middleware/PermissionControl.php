<?php

namespace App\Http\Middleware;

use App\Models\UserPermission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Auth;

class PermissionControl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // $prefix = str_replace('/','',request()->route()->getPrefix());
        // $index = array_search($prefix,Config::get('app.permissions'));
        // if(!UserPermission::getMyControl($index)){return redirect('/');}
        // return $next($request);
        $userRole = Auth::user()->permName;
        $prefix = str_replace('/', '', $request->route()->getPrefix());
        $categories = Config::get('app.permissions');
        $userCategory = $this->getUserCategory();
        
        
        if (!isset($categories[$userCategory])) {
            return redirect('/');
        }

        
        $categoryPermissions = $categories[$userCategory];

        if (!$this->hasPermission($prefix, $categoryPermissions)) {
            return redirect('/');
        }

        return $next($request);
    }

    private function getUserCategory()
    {
        $userRole = Auth::user()->permName; // Kullanıcı rolüne göre ayarlayın
        switch ($userRole) {
            case 'superAdmin':
                return 'superAdmin';
            case 'chef':
                return 'chef';
            case 'officer':
                return 'officer';
            case 'worker':
                return 'worker';
            default:
                return ''; // Eğer rol tanımlı değilse, boş bir değer dönebilirsiniz.
        }
    }

    /**
     * Check if the given prefix is in the category permissions.
     *
     * @param string $prefix
     * @param array $categoryPermissions
     * @return bool
     */
    private function hasPermission($prefix, $categoryPermissions)
    {
        // Kategori genel izinlerini kontrol et
        return in_array($prefix, $categoryPermissions);
    }
}