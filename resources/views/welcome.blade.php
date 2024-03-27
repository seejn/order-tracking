<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        body{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        }

        .login-left {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        }

        .login-right {
        flex: 1;
        padding: 40px;
        background-color: #f2f2f2;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .login-image {
        width: 500px;
        height: auto;
        margin-bottom: 20px;
        border-radius: 50%;
        }

        h2 {
        text-align: center;
        margin-bottom: 20px;
        }

        form input {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: none;
        border-radius: 3px;
        }

        form .forgot-password {
        display: block;
        text-align: right;
        margin-bottom: 10px;
        color: #999;
        text-decoration: none;
        transition: color 0.3s ease;
        }

        form .forgot-password:hover {
        color: #333;
        }

        form button {
        width: 100%;
        padding: 10px;
        background-color: #4CAF50;
        color: #fff;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        }

        form button:hover {
        background-color: #45a049;
        }

    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-left">
          <img src="https://img.freepik.com/free-vector/mobile-login-concept-illustration_114360-83.jpg?w=2000" alt="Image 1" class="login-image">
        </div>
        <div class="login-right">
          <h2>Login</h2>
          <form action="{{ route('dashboard') }}">
            <input type="text" placeholder="Email">
            <input type="password" placeholder="Password">
            <a href="#" class="forgot-password">Forgot password?</a>
            <button type="submit">Login</button>
          </form>
        </div>
      </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
