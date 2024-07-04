<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
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
        <h1>An Error Occurred</h1>
        <p>Sorry, something went wrong. Please try again later.</p>
        <p>Redirecting in 5 seconds...</p>
    </div>
</body>
</html>
