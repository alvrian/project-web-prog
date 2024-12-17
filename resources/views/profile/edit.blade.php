<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Update</title>
    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #f7fafc; 
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .card {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .title {
            font-size: 1.5em;
            font-weight: bold;
            color: #1a202c;
        }

        .subtitle {
            font-size: 1em;
            color: #718096;
        }

 
        .input-group {
            margin-bottom: 20px;
        }

        .input-label {
            display: block;
            font-size: 0.9em;
            margin-bottom: 8px;
            color: #2d3748; 
        }

        .input {
            width: 100%;
            padding: 12px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1em;
            color: #2d3748;
        }

        .input:focus {
            border-color: #3182ce;
            outline: none;
        }


        .button {
            padding: 12px 24px;
            font-size: 1em;
            border-radius: 8px;
            cursor: pointer;
            border: none;
        }

        .blue {
            background-color: #3182ce;
            color: white;
        }

        .blue:hover {
            background-color: #2b6cb0;
        }

        .red {
            background-color: #e53e3e;
            color: white;
        }

        .red:hover {
            background-color: #c53030;
        }

        .secondary {
            background-color: #edf2f7;
            color: #2d3748;
        }

        .secondary:hover {
            background-color: #e2e8f0;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            max-width: 400px;
            width: 100%;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }
    </style>
</head>

<body class="bg-gray-100">

    <div>
        <nav 
            class="navbar navbar-expand-lg" 
            style="height: 7vh; background-color: #6c757d;">
            <div class="container-fluid" style="display: flex; justify-content: space-between; align-items: center;">

                <div style="display: flex; align-items: center;">
                    <span style="font-size: 14px; color: #6c757d; margin-right: 10px;">
                        Welcome, Guest!
                    </span>
                </div>

                <div style="display: flex; align-items: center; margin-left: auto;">
                    <a href="/account">
                        <img 
                            src="images/accountLogo.png" 
                            alt="Account Logo" 
                            style="max-width: 20px; vertical-align: middle;" 
                        />
                    </a>
                </div>
            </div>
        </nav>  
    </div>





    <div class="container py-12">

        <!-- Password Update Section -->
        <div class="card">
            <section>
                <header>
                    <h2 class="title">Update Password</h2>
                    <p class="subtitle">Ensure your account is using a long, random password to stay secure.</p>
                </header>

                <form method="POST" action="/profile/update">
                    <!-- Use a hidden input to simulate the PATCH method -->
                    <input type="hidden" name="_method" value="PATCH">
                    
                    <!-- Other form fields here -->
                    
                    <div class="input-group">
                        <label for="name" class="input-label">Name</label>
                        <input type="text" id="name" name="name" class="input" required autofocus autocomplete="name">
                    </div>

                    <div class="input-group">
                        <label for="email" class="input-label">Email</label>
                        <input type="email" id="email" name="email" class="input" required autocomplete="username">
                    </div>

                    <div class="flex">
                        <button type="submit" class="button blue">Save</button>
                    </div>
                </form>
            </section>
        </div>

        <!-- Profile Update Section -->
        <div class="card">
            <section>
                <header>
                    <h2 class="title">Profile Information</h2>
                    <p class="subtitle">Update your account's profile information and email address.</p>
                </header>

                <form method="post" action="#" class="form">
                    <div class="input-group">
                        <label for="name" class="input-label">Name</label>
                        <input type="text" id="name" name="name" class="input" required autofocus autocomplete="name">
                    </div>

                    <div class="input-group">
                        <label for="email" class="input-label">Email</label>
                        <input type="email" id="email" name="email" class="input" required autocomplete="username">
                    </div>

                    <div class="flex">
                        <button type="submit" class="button blue">Save</button>
                        <p class="status">Saved.</p>
                    </div>
                </form>
            </section>
        </div>

        <!-- Delete Account Section -->
        <div class="card">
            <section>
                <header>
                    <h2 class="title">Delete Account</h2>
                    <p class="subtitle">Once your account is deleted, all of its resources and data will be permanently deleted. Please download any data you wish to retain.</p>
                </header>

                <button class="button red" onclick="openModal()">Delete Account</button>

                <!-- Modal -->
                <div id="deleteModal" class="modal">
                    <form method="post" action="#" class="form modal-content">
                        <h2 class="title">Are you sure you want to delete your account?</h2>
                        <p class="subtitle">Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm.</p>

                        <div class="input-group">
                            <label for="password" class="input-label">Password</label>
                            <input type="password" id="password" name="password" class="input" placeholder="Password">
                        </div>

                        <div class="modal-actions">
                            <button type="button" class="button secondary" onclick="closeModal()">Cancel</button>
                            <button type="submit" class="button red">Delete Account</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>

    </div>


    <script>
        function openModal() {
            document.getElementById('deleteModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('deleteModal').style.display = 'none';
        }
    </script>
</body>

</html>
