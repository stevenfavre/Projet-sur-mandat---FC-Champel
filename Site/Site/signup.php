<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Sign up - Brand</title>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
  <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
</head>

<body>
  <?php include_once('default_pages/navbar.php'); ?>
  <section class="py-5">
    <div class="container py-5">
      <div class="row mb-4 mb-lg-5">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
          <p class="fw-bold text-success mb-2">Sign up</p>
          <h2 class="fw-bold">Welcome</h2>
        </div>
      </div>
      <div class="row d-flex justify-content-center">
        <div class="col-md-6 col-xl-4">
          <div class="card">
            <div class="card-body text-center d-flex flex-column align-items-center">
              <div class="bs-icon-xl bs-icon-circle bs-icon-primary shadow bs-icon my-4"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-person">
                  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"></path>
                </svg></div>
              <form method="post">
                <div class="mb-3"><input class="form-control" type="email" name="email" placeholder="Email"></div>
                <div class="mb-3"><input class="form-control" type="password" name="password" placeholder="Password"></div>
                <div class="mb-3"><input class="form-control" type="password" name="confirmPassword" placeholder="Re-type password"></div>
                <div class="mb-3"><button class="btn btn-primary shadow d-block w-100" type="submit">Sign up</button></div>
                <p class="text-muted">Avez-vous déjà un compte ?&nbsp;<a href="login.html">Log in</a></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php include_once('default_pages/footer.php'); ?>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/script.min.js"></script>
</body>

</html>