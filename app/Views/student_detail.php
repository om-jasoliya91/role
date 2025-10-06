<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Page Not Found - 404</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        text-align: center;
        padding: 50px;
    }

    h1 {
        font-size: 50px;
    }

    p {
        font-size: 20px;
    }

    a {
        color: #007bff;
        text-decoration: none;
    }
    </style>
</head>

<body>
    <h1>404 - Page Not Found</h1>
    <p>Sorry, the page you are looking for does not exist.</p>
    <p><a href="<?= base_url('/') ?>">Go back home</a></p>
    <h2>Student Detail</h2>
<ul>
    <li>Name: <?= esc($student['full_name']) ?></li>
    <li>Email: <?= esc($student['email']) ?></li>
    <li>Phone: <?= esc($student['phone']) ?></li>
    <li>Age: <?= esc($student['age']) ?></li>
    <li>Gender: <?= esc($student['gender']) ?></li>
    <li>Address: <?= esc($student['address']) ?></li>
</ul>

</body>

</html>