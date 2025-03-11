<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>URL Shortener</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">🔗 URL Shortener</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form Start -->
    <div class="card shadow-sm">
        <div class="card-body">
            <form method="post" action="{{ route('shorten.store') }}">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Original URL</label>
                    <input type="url" class="form-control @error('original_url') is-invalid @enderror" name="original_url" required>
                    @error('original_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Custom Short Code (Optional)</label>
                    <input type="text" class="form-control @error('custom_alias') is-invalid @enderror" name="custom_alias" id="aliasInput">
                    <small id="aliasHelp" class="form-text text-muted">Max: 10 characters</small>
                    <span id="charCount" class="text-muted"></span>

                    @error('custom_alias')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Shorten URL</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Form End -->

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript to Show Character Count -->
<script>
    document.getElementById('aliasInput').addEventListener('input', function () {
        let count = this.value.length;
        document.getElementById('charCount').textContent = count + "/10";
    });
</script>

</body>
</html>
