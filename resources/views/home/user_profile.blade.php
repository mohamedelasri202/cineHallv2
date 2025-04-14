<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - CinéHall</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-gray-900 text-white shadow-lg">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="index.html" class="text-2xl font-bold text-red-500">CinéHall</a>
            <div class="hidden md:flex space-x-6">
                <a href="index.html" class="hover:text-red-500 transition">Accueil</a>
                <a href="films.html" class="hover:text-red-500 transition">Films</a>
                <a href="#" class="hover:text-red-500 transition">À propos</a>
                <a href="#" class="hover:text-red-500 transition">Contact</a>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-red-500">Jean Dupont</span>
                <a href="index.html" class="hover:text-red-500 transition">Déconnexion</a>
            </div>
            <button class="md:hidden text-white focus:outline-none">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>

    <!-- Profile Section -->
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Sidebar -->
            <div>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex flex-col items-center mb-6">
                        <div class="w-24 h-24 bg-red-100 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-user text-red-500 text-4xl"></i>
                        </div>
                        <h2 class="text-xl font-bold">Jean Dupont</h2>
                        <p class="text-gray-600">jean.dupont@example.com</p>
                    </div>
                    
                    <nav class="space-y-1">
                        <a href="profile.html" class="flex items-center px-4 py-2 bg-red-50 text-red-700 rounded-md font-medium">
                            <i class="fas fa-user mr-3"></i> Mon profil
                        </a>
                        <a href="my-tickets.html" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-50 rounded-md">
                            <i class="fas fa-ticket-alt mr-3"></i> Mes billets
                        </a>
                        <a href="#" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-50 rounded-md">
                            <i class="fas fa-cog mr-3"></i> Paramètres
                        </a>
                        <a href="index.html" class="flex items-center px-4 py-2 text-red-600 hover:bg-red-50 rounded-md">
                            <i class="fas fa-sign-out-alt mr-3"></i> Déconnexion
                        </a>
                    </nav>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="md:col-span-3">
                <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                    <h2 class="text-2xl font-bold mb-6">Mon profil</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Informations personnelles</h3>
                            <form class="space-y-4">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="firstName" class="block text-sm font-medium text-gray-700 mb-1">Prénom</label>
                                        <input type="text" id="firstName" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" value="Jean">
                                    </div>
                                    <div>
                                        <label for="lastName" class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                                        <input type="text" id="lastName" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" value="Dupont">
                                    </div>
                                </div>
                                
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" id="email" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" value="jean.dupont@example.com">
                                </div>
                                
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                                    <input type="tel" id="phone" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" value="+33 6 12 34 56 78">
                                </div>
                                
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition">
                                    Mettre à jour
                                </button>
                            </form>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Changer de mot de passe</h3>
                            <form class="space-y-4">
                                <div>
                                    <label for="currentPassword" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe actuel</label>
                                    <input type="password" id="currentPassword" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="••••••••">
                                </div>
                                
                                <div>
                                    <label for="newPassword" class="block text-sm font-medium text-gray-700 mb-1">Nouveau mot de passe</label>
                                    <input type="password" id="newPassword" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="••••••••">
                                </div>
                                
                                <div>
                                    <label for="confirmPassword" class="block text-sm font-medium text-gray-700 mb-1">Confirmer le mot de passe</label>
                                    <input type="password" id="confirmPassword" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="••••••••">
                                </div>
                                
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition">
                                    Changer le mot de passe
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Tickets -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">Billets récents</h3>
                        <a href="my-tickets.html" class="text-red-600 hover:text-red-700 font-medium">Voir tous</a>
                    </div>
                    
                    <div class="space-y-4">
                        <!-- Ticket 1 -->
                        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-semibold">Inception</h4>
                                    <div class="flex items-center text-sm text-gray-600 mt-1">
                                        <i class="fas fa-clock mr-1"></i>
                                        <span>Lundi 15 Avril, 20:15</span>
                                    </div>
                                    <div class="flex items-center mt-2">
                                        <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Payé</span>
                                        <span class="ml-2 text-sm text-gray-600">2 sièges</span>
                                    </div>
                                </div>
                                <a href="ticket.html" class="text-red-600 hover:text-red-700">Voir le billet</a>
                            </div>
                        </div>
                        
                        <!-- Ticket 2 -->
                        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-semibold">The Dark Knight</h4>
                                    <div class="flex items-center text-sm text-gray-600 mt-1">
                                        <i class="fas fa-clock mr-1"></i>
                                        <span>Vendredi 19 Avril, 18:00</span>
                                    </div>
                                    <div class="flex items-center mt-2">
                                        <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Payé</span>
                                        <span class="ml-2 text-sm text-gray-600">3 sièges</span>
                                    </div>
                                </div>
                                <a href="ticket.html" class="text-red-600 hover:text-red-700">Voir le billet</a>
                            </div>
                        </div>
                    </div>
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
                <p>&copy; 2023 CinéHall. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript for API integration would go here -->
    <script>
        // This is where you would add your JavaScript code to interact with your API
        // Example:
        // document.addEventListener('DOMContentLoaded', function() {
        //     // Fetch user profile from API
        //     // Handle form submissions
        //     // Update user data
        // });
    </script>
</body>
</html>
