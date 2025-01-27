
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-dark .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1rem;
            font-weight: bold;
            transition: color 0.3s;
        }

        .navbar-dark .navbar-nav .nav-link:hover {
            color: #fff;
            text-decoration: underline;
        }

        .btn-sm.text-light {
            padding: 0.4rem 0.75rem;
            font-size: 0.875rem;
        }
    </style>
    <title>Event Management</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="events.php">Event Management</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="events.php">Events</a>
                </li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="create.php">Create Event</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="purchase_history.php">Purchase History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger btn-sm text-light" href="logout.php">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary btn-sm text-light" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-success btn-sm text-light" href="register.php">Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
</body>
</html>
