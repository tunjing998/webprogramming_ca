<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>
        <?= $locals['page_title'] ?? 'Rainbow & Unicorn' ?>
    </title>

    <link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.0.js" integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="<?= BASE_DIR ?>/assets/styles/main.css">
    <link href="https://fonts.googleapis.com/css?family=Alegreya|Chivo" rel="stylesheet">

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="navbar-brand" href="<?= BASE_DIR ?>">Rainbow & Unicorn</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_DIR ?>/product">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_DIR ?>/order">Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_DIR ?>/account">Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="link_login" data-toggle="modal" data-target="#cart"><i class="fas fa-shopping-cart"></i></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_DIR ?>/logout">Logout</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" action='product'>
                    <input class="form-control mr-sm-2" name='search' type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>
        <?php include_once('templates/layouts/cart.php'); ?>
    </header>

    <?= \Rapid\Renderer::VIEW_PLACEHOLDER ?>
</body>
<footer class="footer mt-3 py-3 border border-primary bg-secondary">
    <div class="container" class='wrapper'>
        <address>
            <strong>Some Company, Inc.</strong><br>
            007 street<br>
            Some City, State XXXXX<br>
            <abbr title="Phone">P:</abbr> (123) 456-7890
        </address>
        <address>
            <strong>XINGNUOCEN</strong><br>
            <a href="#">xingnuocen@123.com</a>
        </address>
    </div>
    <div class="container">
        <p>Follow us on
            <i class="fab fa-facebook-square"></i>
            <i class="fab fa-twitter-square"></i>
            <i class="fab fa-instagram"></i>
        </p>
    </div>
</footer>

</html>