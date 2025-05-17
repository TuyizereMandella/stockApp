<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GENUINE Stock Management</title>
    <style>
        body { font-family: Arial; margin: 0; padding: 20px; background: #f4f4f4; }
        .container { max-width: 800px; margin: auto; }
        .nav { background: #333; padding: 10px; margin-bottom: 20px; }
        .nav a { color: white; margin-right: 10px; text-decoration: none; }
        .btn { padding: 5px 10px; background: #007bff; color: white; border-radius: 3px; text-decoration: none; }
        .btn-danger { background: #dc3545; }
        .table { width: 100%; border-collapse: collapse; background: white; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; }
        .alert { padding: 10px; background: #28a745; color: white; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; }
        .form-group input, .form-group textarea, .form-group select { width: 100%; padding: 5px; }
        .error { color: red; }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    const quantity = form.querySelector('[name="quantity"]');
                    if (quantity && quantity.value < 0) {
                        e.preventDefault();
                        alert('Quantity cannot be negative!');
                    }
                });
            });
        });
    </script>
</head>
<body>
    <div class="nav">
        <a href="/">Home</a>
        @if (Auth::guard('admin')->check())
            <a href="/items">Items</a>
            <a href="/stockinpurchases">Stock-ins</a>
            <a href="/stockouts">Stock-outs</a>
            <form action="/logout" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn">Logout</button>
            </form>
        @else
            <a href="/login">Login</a>
            <a href="/signup">Signup</a>
        @endif
    </div>
    <div class="container">
        @if (session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <p class="error">{{ $error }}</p>
            @endforeach
        @endif
        @yield('content')
    </div>
</body>
</html>