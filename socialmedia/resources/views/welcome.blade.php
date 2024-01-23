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
            background: radial-gradient(ellipse at center, #fffeea 0%, #fffeea 35%, #b7e8eb 100%);
            overflow: hidden;
            position: relative;
            animation: gradientFade 10s infinite alternate linear;
        }

        .ocean {
            height: 5%;
            width: 100%;
            position: absolute;
            bottom: 0;
            left: 0;
            background: #015871;
        }

        .wave {
            background: url(https://cdn.kcak11.com/codepen_assets/wave_animation/wave.svg) repeat-x;
            position: absolute;
            top: -198px;
            width: 6400px;
            height: 198px;
            animation: wave 7s cubic-bezier(0.36, 0.45, 0.63, 0.53) infinite;
            transform: translate3d(0, 0, 0);
        }

        .circle-effect {
            position: fixed;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 1000;
            width: 100%;
            height: 100%;
        }

        .circle {
            position: absolute;
            width: 15px;
            height: 15px;
            border: 2px solid #ffffff;
            border-radius: 50%;
            opacity: 0;
            transition: transform 0.3s, opacity 0.3s;
            box-sizing: content-box;
        }

        .container {
            z-index: 1;
        }

        .auth-container {
            position: relative;
            z-index: 2;
        }

        @keyframes wave {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-1600px);
            }
        }

        @keyframes gradientFade {
            0% {
                background: radial-gradient(ellipse at center, #fffeea 0%, #fffeea 35%, #b7e8eb 100%);
            }

            100% {
                background: radial-gradient(ellipse at center, #fffeea 0%, #fffeea 35%, #b7e8eb 100%, #001F3F 100%);
            }
        }
    </style>
</head>

<body>

    <div class="ocean">
        <div class="wave"></div>
    </div>

    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-6 mt-5 auth-container">

                <!-- Login Form -->
                <div class="login-container bg-light p-3 rounded shadow">
                    <h2 class="text-primary text-center mb-4">Login</h2>

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
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                    </form>

                    <p class="text-center">Nie masz konta? <a href="#" onclick="toggleRegister()">Zarejestruj się</a>
                    </p>
                </div>

                <!-- Register Form -->
                <div class="register-container bg-light p-3 rounded shadow" style="display: none;">
                    <h2 class="text-success text-center mb-4">Register</h2>

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
                            <button type="submit" class="btn btn-success btn-block">Register</button>
                        </div>
                    </form>

                    <p class="text-center">Masz już konto? <a href="#" onclick="toggleRegister()">Zaloguj się tutaj</a>
                    </p>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- JavaScript for Circle Effect -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const circleEffectContainer = document.createElement("div");
            circleEffectContainer.className = "circle-effect";
            document.body.appendChild(circleEffectContainer);

            document.addEventListener("mousemove", function (event) {
                const mouseX = event.clientX;
                const mouseY = event.clientY;

                if (!document.querySelector('.auth-container:hover')) {
                    const circle = document.createElement("div");
                    circle.className = "circle";
                    circle.style.transform = `translate(${mouseX - 7.5}px, ${mouseY - 7.5}px)`;
                    circleEffectContainer.appendChild(circle);

                    // Triggering reflow to apply styles and start the transition
                    void circle.offsetWidth;

                    // Adjust opacity and transform after reflow
                    circle.style.opacity = "0.3";
                    circle.style.transform = `translate(${mouseX - 7.5}px, ${mouseY - 7.5}px) scale(2)`;

                    // Remove the circle after 0.3s (duration of transition)
                    setTimeout(() => {
                        circle.remove();
                    }, 300);
                }
            });
        });

        // javascript for changing forms
        function toggleRegister() {
            var loginContainer = document.querySelector('.login-container');
            var registerContainer = document.querySelector('.register-container');

            if (loginContainer.style.display === 'block') {
                loginContainer.style.display = 'none';
                registerContainer.style.display = 'block';
            } else {
                loginContainer.style.display = 'block';
                registerContainer.style.display = 'none';
        }  }
    </script>

</body>

</html>