<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        /* Reset some defaults */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #4a90e2, #6a11cb);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 100%;
            max-width: 380px;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 6px 18px rgba(0, 0, 0, 0.2);
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .alert {
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 6px;
            font-size: 14px;
        }

        .alert-danger {
            background: #ffe0e0;
            color: #b30000;
        }

        .alert-success {
            background: #e0ffe5;
            color: #006600;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
            transition: border 0.3s;
        }

        input:focus {
            border-color: #4a90e2;
            outline: none;
        }

        .forgot-link,
        .register-link {
            display: inline-block;
            margin-top: 10px;
            font-size: 14px;
            color: #4a90e2;
            text-decoration: none;
        }

        .forgot-link:hover,
        .register-link:hover {
            text-decoration: underline;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background: #4a90e2;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn:hover {
            background: #357ab8;
        }

        .text-center {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3>Login</h3>

        <!-- Flash Messages -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>
        <?php endif; ?>

        <?php if (isset($errors) && is_array($errors)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Login Form -->
        <form method="post" action="<?= base_url('login') ?>">
            <?= csrf_field() ?>

            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" value="<?= old('email') ?>" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <a href="<?= base_url('forgotPassword') ?>" class="forgot-link">Forgot Password?</a>

            <button type="submit" class="btn">Login</button>

            <div class="text-center">
                <a href="<?= base_url('register') ?>" class="register-link">Don't have an account? Register</a>
            </div>
        </form>
    </div>
</body>

</html>
