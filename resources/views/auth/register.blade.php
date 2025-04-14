<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
<div class="min-h-screen flex items-center justify-center bg-gray-50">
    <div class="max-w-md w-full space-y-8 p-8 bg-white rounded shadow-lg">
        <h2 class="text-center text-3xl font-extrabold text-gray-900">
            Register
        </h2>
        
        <form class="mt-8 space-y-6" id="registerForm">
            <div class="rounded-md shadow-sm space-y-4">
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                    <input id="first_name" name="firstName" type="text" required 
                        class="appearance-none rounded relative block w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                    <input id="last_name" name="lastName" type="text" required 
                        class="appearance-none rounded relative block w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" name="email" type="email" required 
                        class="appearance-none rounded relative block w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" name="password" type="password" required 
                        class="appearance-none rounded relative block w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input id="password_confirmation" name="confirmPassword" type="password" required 
                        class="appearance-none rounded relative block w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Register
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const registerForm = document.getElementById('registerForm');

        registerForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const firstName = document.getElementById('first_name').value.trim();
            const lastName = document.getElementById('last_name').value.trim();
            const name = `${firstName} ${lastName}`;
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;

            if (!firstName || !lastName || !email || !password || !confirmPassword) {
                alert('Veuillez remplir tous les champs');
                return;
            }

            if (password !== confirmPassword) {
                alert('Les mots de passe ne correspondent pas');
                return;
            }

            const registerData = {
                name: name,
                email: email,
                password: password
            };

            const submitButton = registerForm.querySelector('button[type="submit"]');
            const originalButtonText = submitButton.innerHTML;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Inscription...';
            submitButton.classList.add('opacity-75', 'cursor-not-allowed');

            fetch('/api/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(registerData)
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(data => {
                        throw new Error(data.message || 'Échec de l\'inscription');
                    });
                }
                return response.json();
            })
            .then(data => {
                localStorage.setItem('auth_token', data.token);
                localStorage.setItem('user_data', JSON.stringify(data.user));

                alert('Inscription réussie!');
                if (data.user.role_id == 1) {
                    window.location.href = '/dashbord'; // change to your redirect URL
                } else if (data.user.role_id == 2) {
                    window.location.href = '/userprofile'; // change to your redirect URL
                }else
                window.location.href = '/profile'; // change to your redirect URL
            })
            .catch(error => {
                alert(error.message || 'Une erreur est survenue lors de l\'inscription');
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
