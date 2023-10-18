<!DOCTYPE html>
<html>
<head>
    <title>SWISSTRANSPORT-CRM: Hata Bildirimi</title>
</head>
<body>
    <h1>SWISSTRANSPORT-CRM: Hata Bildirimi</h1>
    <strong>Tarih ve Saat: </strong> <strong style="color:red;">{{ now()->toDateTimeString() }}</strong>
    <p>Aşağıdaki hata oluştu:</p>
    
    <pre>{{ $error }}</pre>
</body>
</html> 