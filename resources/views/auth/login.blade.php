<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter</title>
   
</head>
<body>
    <div class="container">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
        <h1>Connectez-vous</h1>
        <form method="POST" action="{{ route('login') }}" class="login-form">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" required >
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input id="password" type="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Se connecter</button>
            </div>
            @if ($errors->any())
            <div class="error-messages">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        </form>
    </div>
</body>
</html>

<style>
  body, html {
    height: 100%;
    margin: 0;
    font-family: 'Roboto', sans-serif;
    background-color: #f8f9fa;
    display: flex;
    justify-content: center;
    align-items: center;
}

.container {
    background-color: #ffffff;
    padding: 70px;
    padding-left: 80px;
    padding-right: 100px;
    border-radius: 8px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    text-align: center;
    max-width: 600px; /* Increased max-width for larger form */
    width: 100%;
}

.logo {
    width: 300px; /* Increased logo width */
    height: auto; /* Maintain aspect ratio */
    margin-bottom: 30px; /* Increased margin bottom */
}

h1 {
    color: #6c757d;
    font-size: 28px; /* Increased font size */
    margin-bottom: 30px; /* Increased margin bottom */
}

.login-form {
    display: flex;
    flex-direction: column;
    align-items: center; /* Center align form elements */
}

.form-group {
    margin-bottom: 20px; /* Increased margin bottom */
    width: 100%; /* Full width for form elements */
    max-width: 600px;
     /* Max width for form elements */
}

label {
    display: block;
    margin-bottom: 10px; /* Adjusted margin bottom */
    color: #495057;
    font-size: 16px; /* Increased font size */
}

input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 15px; /* Increased padding */
    font-size: 18px; /* Increased font size */
    border: 1px solid #ced4da;
    border-radius: 4px;
    
}

.btn {
    cursor: pointer;
    padding: 12px 24px; /* Increased padding */
    border: none;
    border-radius: 4px;
    font-size: 18px; /* Increased font size */
    font-weight: bold;
    text-align: center;
    text-decoration: none;
    transition: background-color 0.3s;
    background-color: #007bff;
    color: white;
    margin-top:25px
}

.btn:hover {
    background-color: #0056b3;
}

.error-messages {
    color: #721c24;
    background-color: #f8d7da;
    padding: 12px;
    border-radius: 4px;
    margin-top: 20px; /* Increased margin top */
    text-align: left;
    width: 100%; /* Full width for error messages */
    max-width: 400px;
    text-align: center /* Max width for error messages */
}

</style>