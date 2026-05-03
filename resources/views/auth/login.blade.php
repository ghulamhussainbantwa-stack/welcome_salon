<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Welcome Salon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin-dark.css') }}">
    <style>
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle at top right, #1a1a2e, #0a0a0a);
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            padding: 40px;
        }
    </style>
</head>
<body>

    <div class="glass-card login-card text-center fade-in">
        <h2 class="text-neon-cyan fw-bold mb-4">WELCOME SALON</h2>
        <p class="text-secondary mb-5">Sign in to your account</p>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-4 text-start">
                <label class="form-label small text-secondary">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-glass text-secondary">
                        <i class="fa-solid fa-envelope"></i>
                    </span>
                    <input type="email" name="email" class="form-control" placeholder="admin@salon.com" required>
                </div>
                @error('email')
                    <small class="text-danger mt-1">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-5 text-start">
                <label class="form-label small text-secondary">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-glass text-secondary">
                        <i class="fa-solid fa-lock"></i>
                    </span>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="btn btn-neon w-100 py-3">Login to Dashboard</button>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script>
        gsap.from('.login-card', { 
            scale: 0.8, 
            opacity: 0, 
            duration: 1, 
            ease: 'power4.out' 
        });
    </script>
</body>
</html>
