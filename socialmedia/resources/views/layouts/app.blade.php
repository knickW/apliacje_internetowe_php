<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SocialMedia</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
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
    </style>
</head>

<body>
    <header class="bg-dark text-white text-center py-4">
        <a href="{{ route('home') }}" id="home-link">
            <h1>SocialMedia</h1>
        </a>
        <div class="d-flex justify-content-end">
            @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger mr-3">Logout</button>
            </form>
            @else
            <button type="button" class="btn btn-primary mr-3" onclick="showLoginModal()">
                Login
            </button>
            <button type="button" class="btn btn-success" onclick="showRegisterModal()">
                Register
            </button>
            @endauth
        </div>
    </header>

    <main class="container mt-4">
        @yield("content")
    </main>

    @auth
    <div class="d-flex justify-content-end">
        <button id="chat-btn" class="btn btn-info mr-2" onclick="showChatModal()">Chat</button>
        <button id="new-post-btn" class="btn btn-primary" onclick="redirectToNewPost()">New Post</button>
    </div>
    @endauth

    <footer class="bg-dark text-white text-center py-2 fixed-bottom">
        &copy; 2024 SocialMedia. All rights reserved.
    </footer>

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
                            <label for="email">E-Mail Address</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
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
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">E-Mail Address</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-success" id="register-btn">Register</button>
                    </form>
                    <p class="mt-2">Masz już konto? <a href="#" onclick="showLoginModal()">Zaloguj się tutaj</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#register-form').submit(function (e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function (response) {
                        // Rejestracja zakończona sukcesem, możesz dodać odpowiednie działania, np. zamknięcie modala
                        $('#registerModal').modal('hide');
                        // Dodaj dodatkowe działania po zakończeniu rejestracji
                    },
                    error: function (error) {
                        // Obsługa błędów, możesz dodać odpowiednie działania, np. wyświetlenie komunikatu
                        console.log(error);
                        // Dodaj dodatkowe działania w przypadku błędów
                    }
                });
            });
        });

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

        function showChatModal() {
            $('#chatModal').modal('show');
            $('#loginModal').modal('hide');
            $('#registerModal').modal('hide');
        }

        function redirectToNewPost() {
            window.location.href = "{{ route('user.posts.create') }}";
        }
    </script>

    @yield('scripts')
</body>

</html>