<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - CinéHall</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-gray-900 text-white shadow-lg">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-2xl font-bold text-red-500">CinéHall</a>
            <div class="hidden md:flex space-x-6">
                <a href="{{ url('/') }}" class="hover:text-red-500 transition">Accueil</a>
                <a href="{{ url('/films') }}" class="hover:text-red-500 transition">Films</a>
                <a href="#" class="hover:text-red-500 transition">À propos</a>
                <a href="#" class="hover:text-red-500 transition">Contact</a>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ url('/login') }}" class="text-red-500 transition" id="loginBtn">Connexion</a>
                <a href="{{ url('/profile') }}" class="hidden hover:text-red-500 transition" id="profileBtn">Mon Profil</a>
            </div>
            <button class="md:hidden text-white focus:outline-none">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>

    <!-- Login Section -->
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-md mx-auto">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-red-100 rounded-full mb-4">
                        <i class="fas fa-user text-red-500 text-2xl"></i>
                    </div>
                    <h1 class="text-2xl font-bold">Connexion</h1>
                    <p class="text-gray-600 mt-2">Accédez à votre compte CinéHall</p>
                </div>
                
                <form id="loginForm">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="votre@email.com">
                    </div>
                    
                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-1">
                            <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                            <a href="#" class="text-sm text-red-600 hover:text-red-700">Mot de passe oublié?</a>
                        </div>
                        <input type="password" id="password" name="password" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="••••••••">
                    </div>
                    
                    <div class="mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="rounded border-gray-300 text-red-600 focus:ring-red-500 h-4 w-4">
                            <span class="ml-2 text-sm text-gray-600">Se souvenir de moi</span>
                        </label>
                    </div>
                    
                    <button type="submit" class="block w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-4 rounded-lg text-center transition">
                        Se connecter
                    </button>
                </form>
                
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Vous n'avez pas de compte? 
                        <a href="{{ url('/register') }}" class="text-red-600 hover:text-red-700 font-medium">S'inscrire</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8 mt-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">CinéHall</h3>
                    <p class="text-gray-400">Votre plateforme de réservation de places de cinéma en ligne.</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Liens utiles</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition">À propos</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Conditions d'utilisation</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Politique de confidentialité</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Suivez-nous</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-6 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} CinéHall. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript for API integration -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.getElementById('loginForm');
    
            loginForm.addEventListener('submit', function(event) {
                event.preventDefault();
    
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;
    
                if (!email || !password) {
                    alert('Veuillez remplir tous les champs');
                    return;
                }
    
                const loginData = {
                    email: email,
                    password: password
                };
    
                const submitButton = loginForm.querySelector('button[type="submit"]');
                const originalButtonText = submitButton.innerHTML;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Connexion...';
                submitButton.classList.add('opacity-75', 'cursor-not-allowed');
    
                fetch('/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(loginData)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Identifiants incorrects');
                    }
                    return response.json();
                })
                .then(data => {
                    // ✅ Store the token and user info in localStorage
                    localStorage.setItem('auth_token', data.token);
                    localStorage.setItem('user_data', JSON.stringify(data.user));
    
                    alert('Connexion réussie!');
                    window.location.href = '{{ url("/profile") }}';
                })
                .catch(error => {
                    alert(error.message || 'Une erreur est survenue lors de la connexion');
                })
                .finally(() => {
                    submitButton.innerHTML = originalButtonText;
                    submitButton.classList.remove('opacity-75', 'cursor-not-allowed');
                });
            });
        });
    </script>
    
</body>
</html>