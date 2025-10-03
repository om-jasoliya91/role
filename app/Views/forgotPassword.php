
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-5">
        <div class="card shadow p-4">
            <h3 class="card-title text-center mb-4">Forgot Password</h3>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <form method="post" action="<?= base_url('forgotPassword') ?>">

                <?= csrf_field() ?>
                <div class="mb-3">
                    <label class="form-label">Enter your Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Send Reset Link</button>
                </div>
                <div class="text-center mt-3">
                    <a href="<?= base_url('login') ?>">Back to Login</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>

</html>
