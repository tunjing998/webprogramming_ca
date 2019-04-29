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
    <!-- <h1>Rainbow & Unicorn</h1> -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="navbar-brand" href="<?= BASE_DIR ?>">Rainbow & Unicorn</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= BASE_DIR ?>/product">Product</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= BASE_DIR ?>/contact">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="link_login" data-toggle="modal" data-target="#exampleModal">Login</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0" action='product'>
        <input class="form-control mr-sm-2" name='search' type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
      </form>

      <!-- Modal -->
      <div class="modal bd-example-modal-lg fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">ACCOUNT LOGIN</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="col" id="username">
                <label for="username">Username : </label>
                <input id="input" class="form-control" name="username" type="text" placeholder="Enter Username" required>
              </div>
              <div class="col" id="psw">
                <label for="password">Password : </label>
                <div class="input-group" id="psw">
                  <input id="password" class="form-control" name="password" type="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                  <span class="input-group-append">
                    <button class="btn btn-outline-info" type="button"><i class="far fa-eye" id='showpassword'></i></button>
                  </span>
                </div>
              </div>
              <div class="modal-footer d-block">
                <div class="">
                  <p class="mb-1">Forgot <a href="reset.php">Username / Password?</a></p>
                  <p class="mb-1">Create an account?<a href="<?= BASE_DIR ?>/register"> Sign up</a></p>
                </div>
                <div class="float-right">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <input class="btn btn-primary" id="btn" type="button" value=" Log In" name='submitButton' /><br />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
      </div>
      <script src="<?= BASE_DIR ?>/assets/js/login.js"></script>
    </nav>
  </header>
  <?= \Rapid\Renderer::VIEW_PLACEHOLDER ?>
</body>

</html>