<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?? 'PERUMDA AIR MINUM MUARA TIRTA' ?></title>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css" integrity="sha512-t7Few9xlddEmgd3oKZQahkNI4dS6l80+eGEzFQiqtyVYdvcSG2D3Iub77R20BdotfRPA9caaRkg1tyaJiPmO0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Backend CSS -->
    <link rel="stylesheet" href="<?= base_url('backend/assets/css/bootstrap.css') ?>">
    <link rel="stylesheet" href="<?= base_url('backend/assets/css/app.css') ?>">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom Modern CSS -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #ffffff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        #auth {
            width: 100%;
            max-width: 450px;
        }

        .auth-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .auth-logo {
            text-align: center;
            margin-bottom: 2rem;
        }

        .auth-logo img {
            height: 50px;
            margin-bottom: 0.75rem;
        }

        .auth-logo h4 {
            color: #435ebe;
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 0.25rem;
        }

        .auth-logo h5 {
            color: #6c757d;
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 0.25rem;
        }

        .auth-logo p {
            color: #adb5bd;
            font-size: 0.875rem;
        }

        .auth-title {
            color: #2d3748;
            font-weight: 700;
            font-size: 1.75rem;
            margin-bottom: 0.5rem;
            text-align: center;
        }

        .auth-subtitle {
            color: #718096;
            font-size: 0.875rem;
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
            position: relative;
        }

        .form-control {
            width: 100%;
            height: 50px;
            padding: 0.75rem 1rem 0.75rem 3rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 0.9375rem;
            transition: all 0.3s ease;
            background-color: #f7fafc;
        }

        .form-control:focus {
            border-color: #435ebe;
            background-color: #fff;
            box-shadow: 0 0 0 3px rgba(67, 94, 190, 0.1);
            outline: none;
        }

        .form-control::placeholder {
            color: #a0aec0;
        }

        .form-control-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #718096;
            font-size: 1.125rem;
            pointer-events: none;
            transition: color 0.3s ease;
            z-index: 5;
        }

        .form-group:focus-within .form-control-icon {
            color: #435ebe;
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #718096;
            font-size: 1.125rem;
            transition: color 0.3s ease;
            z-index: 10;
        }

        .password-toggle:hover {
            color: #435ebe;
        }

        .form-check {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .form-check-input {
            width: 18px;
            height: 18px;
            margin-right: 0.5rem;
            border: 2px solid #cbd5e0;
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: #435ebe;
            border-color: #435ebe;
        }

        .form-check-label {
            color: #4a5568;
            font-size: 0.875rem;
            cursor: pointer;
            user-select: none;
        }

        .btn-primary {
            width: 100%;
            height: 50px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            color: #fff;
            font-weight: 600;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
            background: linear-gradient(135deg, #5a67d8 0%, #6b3fa0 100%);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .forgot-password {
            text-align: center;
            margin-top: 1.25rem;
        }

        .forgot-password a {
            color: #667eea;
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .forgot-password a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .auth-footer {
            text-align: center;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e2e8f0;
        }

        .auth-footer p {
            color: #718096;
            font-size: 0.8125rem;
            margin: 0;
        }

        .alert {
            padding: 0.875rem 1rem;
            border-radius: 12px;
            margin-bottom: 1.25rem;
            border: none;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background-color: #d2ffe8;
            color: #00391c;
        }

        .alert-danger {
            background-color: #ffdede;
            color: #450000;
        }

        .alert i {
            font-size: 1.125rem;
        }

        .alert ul {
            margin: 0;
            padding-left: 1.25rem;
        }

        .alert .btn-close {
            padding: 0;
            background: transparent;
            border: none;
            opacity: 0.5;
            cursor: pointer;
            font-size: 1.25rem;
            margin-left: auto;
        }

        .alert .btn-close:hover {
            opacity: 1;
        }

        @media (max-width: 576px) {
            .auth-card {
                padding: 2rem 1.5rem;
            }

            .auth-title {
                font-size: 1.5rem;
            }

            .form-control {
                height: 46px;
                font-size: 0.875rem;
            }

            .btn-primary {
                height: 46px;
            }
        }
    </style>

    <?= $this->renderSection('styles') ?>
</head>

<body>
    <div id="auth">
        <?= $this->renderSection('content') ?>
    </div>

    <!-- Core JS -->
    <script src="<?= base_url('backend/assets/js/bootstrap.bundle.min.js') ?>"></script>

    <?= $this->renderSection('scripts') ?>
</body>

</html>