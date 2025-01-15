<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escolha sua Opção</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-custom {
            width: 200px;
            height: 200px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            text-decoration: none;
            color: white;
            font-size: 18px;
            font-weight: bold;
            transition: transform 0.2s, background-color 0.2s;
        }
        .btn-custom:hover {
            transform: scale(1.1);
        }
        .btn-admin {
            background-color: #007bff;
        }
        .btn-admin:hover {
            background-color: #0056b3;
        }
        .btn-web {
            background-color: #28a745;
        }
        .btn-web:hover {
            background-color: #1e7e34;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
<div class="d-flex gap-5">
    <a href="/admin" class="btn-custom btn-admin text-center">
        <i class="bi bi-gear-fill d-block mb-2" style="font-size: 50px;"></i>
        Admin
    </a>
    <a href="/web" class="btn-custom btn-web text-center">
        <i class="bi bi-house-door-fill d-block mb-2" style="font-size: 50px;"></i>
        Web
    </a>
</div>

<!-- Bootstrap JS and Icons -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</body>
</html>
