<!DOCTYPE html>
<html>
<head>
    <title>Application Error</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="alert alert-danger">
            <h4 class="alert-heading">Oops! Something went wrong.</h4>
            <p><?= esc($message ?? 'An unexpected error occurred.') ?></p>
            <hr>
            <a href="<?= base_url('/') ?>" class="btn btn-primary">Go back home</a>
        </div>
    </div>
</body>
</html>
