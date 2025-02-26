<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <style>
        @font-face {
            font-family: 'Cairo';
            src: url('{{ storage_path('fonts/Cairo-Regular.ttf') }}') format('truetype');
        }

        body {
            font-family: 'Cairo', sans-serif;
            direction: rtl;
            text-align: right;
        }

        .bold {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <p>  يف كب اًبحرم Laravel</p>
    <p>هذا نص باللغة العربية باستخدام خط Cairo.</p>
    <p >هذا نص غامق.</p>
</body>
</html>
