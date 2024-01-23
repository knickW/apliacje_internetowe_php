<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SocialMedia</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            height: 100vh;
            margin: 0;
            flex-direction: column;
            font-family: Arial, sans-serif;
            display: flex;
        }

        header {
            background: linear-gradient(90deg, #3498db, #2c3e50);
            /* Kolor headera: gradient niebieski */
            color: white;
            text-align: center;
            padding: 1rem 0;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            animation: headerFade 10s ease-in-out infinite;
        }

        main {
            flex: 1;
            /* Wypełnia dostępną przestrzeń, aby uniknąć zasłaniania przez footer */
            padding-bottom: 60px;
            /* Dodaje odstęp na dole, aby uniknąć zasłaniania przez footer */
        }

        footer {
            background: linear-gradient(90deg, #3498db, #2c3e50);
            /* Kolor footera: gradient niebieski */
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            animation: footerFade 10s ease-in-out infinite;
        }

        #contrast-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 5px 10px;
            cursor: pointer;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
        }

        #contrast-modal {
            background: #f8f9fa;
            /* Kolor modalu: jasny szary */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: none;
            z-index: 1500;
        }

        #contrast-modal h3 {
            margin-bottom: 10px;
        }

        #contrast-options {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }

        .contrast-option {
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .contrast-option:hover {
            background-color: #d3d3d3;
            /* Kolor opcji kontrastu przy najechaniu myszką */
        }

        .anim {
            background: radial-gradient(ellipse at center, #fffeea 0%, #fffeea 35%, #b7e8eb 100%);
            overflow-y: auto;
            animation: gradientFade 10s infinite alternate linear;
            padding: 20px;
            margin-top: 60px;
            /* Ustawienie marginesu od góry dla zawartości */
        }

        @keyframes gradientFade {
            0% {
                background: radial-gradient(ellipse at center, #fffeea 0%, #fffeea 35%, #b7e8eb 100%);
            }

            100% {
                background: radial-gradient(ellipse at center, #fffeea 0%, #b7e8eb 35%, #fffeea 100%);
            }
        }

        .anim::-webkit-scrollbar {
            width: 12px;
        }

        .anim::-webkit-scrollbar-thumb {
            background-color: #888;
        }

        .anim::-webkit-scrollbar-track {
            background-color: #f1f1f1;
        }

        #chat-btn {
            position: fixed;
            bottom: 80px;
            right: 20px;
            z-index: 1000;
        }

        #new-post-btn {
            position: fixed;
            bottom: 80px;
            right: 100px;
            z-index: 1000;
        }

        .modal {
            overflow-y: auto;
        }

        .chat-container {
            max-height: 300px;
            overflow-y: auto;
        }

        #home-link {
            color: white;
            text-decoration: none;
            font-size: 18px;
            margin-right: 20px;
        }

        @keyframes headerFade {
            0% {
                background: linear-gradient(90deg, #3498db, #2c3e50);
            }

            50% {
                background: linear-gradient(90deg, #3498db, #2c3e50);
            }

            100% {
                background: linear-gradient(90deg, #2c3e50, #3498db);
            }
        }

        @keyframes footerFade {
            0% {
                background: linear-gradient(90deg, #3498db, #2c3e50);
            }

            50% {
                background: linear-gradient(90deg, #3498db, #2c3e50);
            }

            100% {
                background: linear-gradient(90deg, #2c3e50, #3498db);
            }
        }
    </style>
</head>

<body class="anim">
    <header>
        <a href="{{ route('home') }}" id="home-link">
            <h1>SocialMedia</h1>
        </a>
        <div class="d-flex justify-content-end">
            @auth
            <form id="logout-form" method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="button" class="btn btn-danger mr-3" onclick="confirmLogout()">Wyloguj</button>
            </form>
            @else
            <button type="button" class="btn btn-primary mr-3" onclick="showLoginModal()">
                Zaloguj
            </button>
            <button type="button" class="btn btn-success" onclick="showRegisterModal()">
                Zarejestruj
            </button>
            @endauth
        </div>
        <button id="contrast-btn" onclick="toggleContrastModal()">Kontrast</button>
    </header>

    <main class="container mt-4">
        @yield("content")
    </main>
    @auth
    <div class="d-flex justify-content-end">
        <a id="chat-btn" class="btn btn-info mr-2" href="{{ route('chat') }}">Czat</a>
        <button id="new-post-btn" class="btn btn-primary" onclick="redirectToNewPost()">Nowy Post</button>
    </div>
    @endauth

    <footer>
        &copy; 2024 SocialMedia. All rights reserved.
    </footer>

    <!-- Contrast Modal -->
    <div id="contrast-modal">
        <button type="button" class="close" onclick="closeContrastModal()" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h3>Zmień kontrast</h3>
        <div id="contrast-options" class="mb-2">
            <div class="contrast-option" onclick="setContrast('normal')">Normalny</div>
            <div class="contrast-option" onclick="setContrast('high')">Wysoki</div>
        </div>
        <p>Kontrast pomaga w dostosowaniu strony do Twoich preferencji. Wybierz preferowany poziom kontrastu.</p>
    </div>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Zaloguj się</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Adres Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Hasło</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Zaloguj</button>
                    </form>
                    <p class="mt-2">Nie masz konta? <a href="#" onclick="showRegisterModal()">Zarejestruj się tutaj</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Register Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">Zarejestruj się</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('register') }}" id="register-form">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nazwa</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Adres Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Hasło</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Powtórz Hasło</label>
                            <input type="password" class="form-control" name="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-success" id="register-btn">Zarejestruj</button>
                    </form>
                    <p class="mt-2">Masz już konto? <a href="#" onclick="showLoginModal()">Zaloguj się tutaj</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        function confirmLogout() {
            if (confirm("Czy na pewno chcesz się wylogować?")) {
                document.getElementById('logout-form').submit();
            }
        }
        function showContrastModal() {
            $('#contrast-modal').show();
            $('#loginModal').modal('hide');
            $('#registerModal').modal('hide');
        }

        function toggleContrastModal() {
            showContrastModal();
        }

        function setContrast(level) {
            // Tu dodaj logikę zmiany kontrastu na stronie
            alert("Zmiana kontrastu na poziom: " + level);
            // Ukryj modal po dokonaniu zmiany
            $('#contrast-modal').hide();
        }

        function showLoginModal() {
            $('#loginModal').modal('show');
            $('#registerModal').modal('hide');
            $('#chatModal').modal('hide');
        }

        function showRegisterModal() {
            $('#registerModal').modal('show');
            $('#loginModal').modal('hide');
            $('#chatModal').modal('hide');
        }

        function redirectToNewPost() {
            window.location.href = "{{ route('user.posts.create') }}";
        }

        function toggleContrastModal() {
            $('#contrast-modal').toggle();
        }
        function closeContrastModal() {
            $('#contrast-modal').hide();
        }
        function setContrast(level) {
            // Tu dodaj logikę zmiany kontrastu na stronie
            alert("Zmiana rastuiom: " + level);
        }
    </script>

    @yield('scripts')
</body>

</html>