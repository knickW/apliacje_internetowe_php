<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f8f9fa;
        }

        .auth-container {
            display: flex;
            justify-content: space-around;
            width: 600px;
            /* Adjust the width as needed */
        }

        .login-container,
        .register-container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 100%;
            /* Make both containers take up the full width */
        }

        .login-container h2,
        .register-container h2 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #0056b3;
        }

        .switch-button {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        .switch-button:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">

            <!-- Use a common container for both login and register forms -->
            <div class="col-md-6 auth-container">

                <!-- Login Form -->
                <div class="login-container">
                    <h2>Login</h2>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" name="email" id="login-email" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" name="password" id="login-password" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>

                    <p>Nie masz konta? <a href="javascript:void(0);" onclick="toggleRegister()">Zarejestruj się</a></p>
                </div>

                <!-- Register Form -->
                <div class="register-container" style="display: none;">
                    <h2>Register</h2>

                    <form method="POST" action="{{ route('register') }}" id="register-form">
                        @csrf

                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" name="name" id="register-name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" name="email" id="register-email" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" name="password" id="register-password" required>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password:</label>
                            <input type="password" class="form-control" name="password_confirmation"
                                id="register-password_confirmation" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Register</button>
                        </div>
                    </form>

                    <p>Masz już konto? <a href="javascript:void(0);" onclick="toggleRegister()">Zaloguj się tutaj</a>
                    </p>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        function toggleRegister() {
            var loginContainer = document.querySelector('.login-container');
            var registerContainer = document.querySelector('.register-container');

            if (loginContainer.style.display === 'block') {
                loginContainer.style.display = 'none';
                registerContainer.style.display = 'block';
            } else {
                loginContainer.style.display = 'block';
                registerContainer.style.display = 'none';
            }
        }
    </script>

</body>

</html>