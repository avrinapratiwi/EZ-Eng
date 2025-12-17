<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow p-4 mx-auto" style="max-width: 500px; width: 100%;">

        <div class="text-center mb-2">
            <img src="img/logo_ez-eng.png" alt="Logo" style="width: 100px; height: auto;">
        </div>

        <h3 class="text-center mb-4">Sign Up</h3>
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
        
        <form action="/signup" method="POST" enctype="multipart/form-data">
            @csrf
        
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">First Name</label>
                    <input type="text" name="first_name" class="form-control" placeholder="Enter first name" required>
                </div>
        
                <div class="col-md-6 mb-3">
                    <label class="form-label">Last Name</label>
                    <input type="text" name="last_name" class="form-control" placeholder="Enter last name" required>
                </div>
            </div>
        
            <div class="mb-3">
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
        
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter email" required>
            </div>
        
            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone" class="form-control" placeholder="62XXX" maxlength="13" required>
            </div>
        
            <div class="mb-3">
                <label class="form-label">Gender</label>
                <select name="gender" class="form-select" required>
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
        
            <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control" placeholder="Enter address" required>
            </div>
        
            <div class="mb-3 text-start">
                <small style="color: red;"><i>*Please verify your data carefully</i></small>
            </div>
        
            <button type="submit" class="btn btn-primary w-100 mt-2">Sign Up</button>
        
            <div class="text-center mt-3">
                <small>Already have an account? <a href="/login" class="text-primary">Login here</a></small>
            </div>
        </form>        

    </div>
</div>


<script src="js/sb-admin.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
