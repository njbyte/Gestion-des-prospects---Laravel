<!-- resources/views/errors/419.blade.php -->

<!-- Assuming your layout is named 'app.blade.php' -->
<style>
/* error-page.css */

.container {
    text-align: center;
    max-width: 600px;
    margin: auto;
    padding: 20px;
}

h1 {
    font-size: 2.5rem;
    color: #dc3545;
    margin-bottom: 20px;
}

p {
    font-size: 1.2rem;
    color: #6c757d;
    margin-bottom: 20px;
}

.btn-primary {
    padding: 10px 20px;
    font-size: 1rem;
    text-decoration: none;
    background-color: #007bff;
    border-color: #007bff;
    color: #fff;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #004085;
}

</style>

    <div class="container mt-5">
        <h1>419 - Page Expired</h1>
        <p>Your session has expired. Please refresh the page to continue.</p>
        <a href="{{ url('/') }}" class="btn btn-primary">Go to Home</a>
    </div>
