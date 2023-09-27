<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


<h1>SSH Bağlantısı</h1>
ssh hywefuza@s108.cyon.net
<h1>Kurulum Adımları</h1>

<ol>
<li>composer install</li>
<li>npm install</li>
<li>composer require laravel/ui --dev</li>
<li>php artisan ui vue --auth</li>
<li>cp .env.example .env</li>
<li>php artisan key:generate</li>
<li>php artisan migrate</li>
<li>php artisan db:seed</li>
</ol>

<h1>Gerekli Bilgiler</h1>
<h3>Login Sorunu</h3>
<p>Login Sorunu için https://www.mertbuldur.com/laravel-login-icin-md5-nasil-kullanilir ya da Hash::make() kullan</p>

<h3>Calendar Renk</h3>
<p>Calendar Renk setColorId() metodu eksik bunun için;<br>
vendor>spatie>laravel-google-calendar>src>Event.php ye git <br>
setSourceProperty metodunun altına aşşağıdaki metodu ekle <br><br>
public function setColorId(int $id) <br>
    {<br>
        $this->googleEvent->setColorId($id); <br>
    }<br>
</p>
<p>Calendar Renk Paleti https://lukeboyle.com/blog/posts/google-calendar-api-color-id</p>

<h3>SSH Bağlantısı (CYON için)</h3>
<p>ssh ile bağlandığında Composer Komutu kullanabilmek için https://www.cyon.ch/support/a/composer-installieren</p>

<h3>Lagerung Mailer</h3>
<p>ssh ile bağlan screen -S Scheduler(oturuma özel isim vermek için) yaz oturum başlat. php artisan schedule:work yaz terminali kapat </p>
<p>Durdurmak İçin: screen -ls yazıp oturumlara bak kapatmak istediğin oturuma girmek için screen -r [oturum ismi] daha sonra ctrl c ile komutu durdur ve en son exit yazarak oturumu sonlandır</p>
