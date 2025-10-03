<!-- views/login.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-5">
            <div class="card shadow p-4">
                <h3 class="card-title text-center mb-4">Login</h3>

                <!-- Flash Messages -->
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>
                <?php endif; ?>

                <?php if (isset($errors) && is_array($errors)): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach ($errors as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- Login Form -->
                <form method="post" action="<?= base_url('login') ?>">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="text" name="email" value="<?= old('email') ?>" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <a href="<?= base_url('forgot-password') ?>" class="text-decoration-none">Forgot Password?</a>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>

                    <div class="text-center mt-3">
                        <a href="<?= base_url('register') ?>">Don't have an account? Register</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>
</html>
