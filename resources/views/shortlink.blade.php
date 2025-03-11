<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>رابط مختصر</title>

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .card {
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-copy {
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="card bg-white">
            <h1 class="text-primary">هذا هو الرابط المختصر الخاص بك</h1>
            <p>
                <a href="{{ route('redirect', $shortenedUrl->short_code) }}" target="_blank" class="text-success">
                    {{ route('redirect', $shortenedUrl->short_code) }}
                </a>
            </p>
            <button class="btn btn-primary btn-copy" onclick="copyToClipboard()">نسخ الرابط</button>
        </div>
        
    </div>




    <script>
        function copyToClipboard() {
            const link = "{{ route('redirect', $shortenedUrl->short_code) }}";
            navigator.clipboard.writeText(link).then(() => {
                alert("تم نسخ الرابط إلى الحافظة!");
            });
        }
    </script>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>