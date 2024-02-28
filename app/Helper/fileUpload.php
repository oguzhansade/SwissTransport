<?php
namespace App\Helper;
use File;
use Image;
class fileUpload
{
    static function logoExpand($file)
    {
        try {
            $dosyaAdi = 'logo-expand.'.$file->getClientOriginalExtension();
            $file->move(public_path('assets/demo'), $dosyaAdi);
    
            return 'Başarılı'; // Yükleme başarılı olduğunda true döndür
    
        } catch (\Exception $e) {
            // Hata durumunda istisna yakalanır ve false döndürülür
            return 'Hatalı';
        }
    }

    static function logoCollapse($file)
    {
        try {
            $dosyaAdi = 'logo-collapse.'.$file->getClientOriginalExtension();
            $file->move(public_path('assets/demo'), $dosyaAdi);
    
            return 'Başarılı'; // Yükleme başarılı olduğunda true döndür
    
        } catch (\Exception $e) {
            // Hata durumunda istisna yakalanır ve false döndürülür
            return 'Hatalı';
        }
    }
    
}
