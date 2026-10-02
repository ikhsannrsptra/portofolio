<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login - Portfolio CMS</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <style>
    body {
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      background-color: #070913;
    }
    .login-card {
      width: 100%;
      max-width: 420px;
      padding: 40px;
      background: rgba(15, 23, 42, 0.8);
      backdrop-filter: blur(20px);
      border: 1px solid var(--border-glow);
      border-radius: var(--radius-lg);
      box-shadow: 0 25px 50px -12px rgba(99, 102, 241, 0.3);
    }
  </style>
</head>
<body>

  <div class="login-card">
    <div style="text-align: center; margin-bottom: 30px;">
      <span class="logo-dot" style="margin: 0 auto 12px auto; display: block; width: 14px; height: 14px;"></span>
      <h2 style="font-size: 1.8rem;">Admin Portal</h2>
      <p style="color: var(--text-muted); font-size: 0.9rem; margin-top: 6px;">Masuk untuk mengelola portofolio Anda</p>
    </div>

    @if($errors->any())
      <div style="background: rgba(239, 68, 68, 0.15); border: 1px solid #ef4444; color: #ef4444; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 0.88rem;">
        {{ $errors->first() }}
      </div>
    @endif

    <form action="{{ route('admin.login.submit') }}" method="POST">
      @csrf
      <div class="form-group" style="margin-bottom: 20px;">
        <label for="email">Alamat Email Admin</label>
        <input type="email" name="email" id="email" class="form-control" value="admin@portfolio.com" required placeholder="admin@portfolio.com">
      </div>

      <div class="form-group" style="margin-bottom: 24px;">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" required placeholder="••••••••">
      </div>

      <button type="submit" class="btn btn-primary" style="width: 100%;">
        <span>Login ke Panel Admin</span>
        <i class="fas fa-arrow-right"></i>
      </button>
    </form>

    <div style="text-align: center; margin-top: 24px;">
      <a href="{{ route('portfolio.index') }}" style="color: var(--text-muted); text-decoration: none; font-size: 0.85rem;">
        <i class="fas fa-long-arrow-alt-left"></i> Kembali ke Website
      </a>
    </div>
  </div>

</body>
</html>
