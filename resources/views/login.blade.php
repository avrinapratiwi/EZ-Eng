<!doctype html> 
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow p-4 mx-auto" style="max-width: 450px; width: 100%; min-height: 430px;">
        <div class="text-center mb-0">
            <img src="img/logo_ez-eng.png" alt="Logo" style="width: 100px; height: auto;">
        </div>
        
        <h3 class="text-center mb-4">Login</h3>
        @if (session('success'))
        <div class="alert alert-success" style="background:#d4edda;color:#155724;padding:10px;border-radius:6px;margin-bottom:20px;">
            {{ session('success') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger" style="background:#f8d7da;color:#721c24;padding:10px;border-radius:6px;margin-bottom:20px;">
            <ul style="margin:0;padding-left:20px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
        @endif        

        <form action="/login" method="POST">
            @csrf

            <div class="mb-4">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Enter username" required>
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" required>
                    <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
            </div>            

            <button type="submit" class="btn btn-primary w-100 mt-4">Log</button>

            <div class="text-center mt-3">
                <small>Don’t have an account? <a href="{{ url('/signup') }}" class="text-primary">Sign up now</a>
                </small>
            </div>

        </form>
    </div>
</div>

<script src="js/sb-admin.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundlegit log --oneline -n 5.min.js"></script>
</body>
</html>
