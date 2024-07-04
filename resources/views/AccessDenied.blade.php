<!-- resources/views/admin/access_denied.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8d7da;
            color: #721c24;
            font-family: Arial, sans-serif;
        }
        .message {
            text-align: center;
        }
    </style>
    <script>
        setTimeout(function() {
            window.history.back();
        }, 5000);
    </script>
</head>
<body>
    <div class="message">
        <h1>Access Denied</h1>
        <p>You do not have permission to access this page.</p>
        <p>Redirecting in 5 seconds...</p>
    </div>
</body>
</html>
