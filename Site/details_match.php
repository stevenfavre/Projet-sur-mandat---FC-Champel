<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Détail du match</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
</head>

<body style="/*background: url(&quot;design.jpg&quot;);*/background-position: 0 -60px;">
    <?php include_once('default_pages/navbar.php'); ?>
    <header class="bg-primary-gradient">
        <div class="container pt-4 pt-xl-5">
            <div class="row pt-5">
                <div class="col-md-8 col-xl-6 text-center text-md-start mx-auto">
                    <div class="text-center">
                        <h1 class="fw-bold">Détail du match de : </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section class="py-5">
        <div class="container">
            <table class="table">
                <thead>
                    <td class="text-center">
                        <h2>Equipe A</h2>
                    </td>
                    <td>

                    </td>
                    <td class="text-center">
                        <h2>Equipe B</h2>
                    </td>

                </thead>
                <tr>
                    <td class="text-center">
                        <button type="submit" class="btn btn-primary btn-xs" value="L-UP">
                            <ion-icon name="chevron-up-outline"></ion-icon>
                        </button>
                    </td>
                    <td>

                    </td>
                    <td class="text-center">
                        <button type="submit" class="btn btn-primary btn-xs" value="V-UP">
                            <ion-icon name="chevron-up-outline"></ion-icon>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h3 class="text-center">0</h3>
                    </td>
                    <td></td>
                    <td>
                        <h3 class="text-center">0</h3>
                    </td>
                </tr>
                <tr>
                    <td class="text-center">
                        <button type="submit" class="btn btn-primary btn-xs" value="L-DOWN">
                            <ion-icon name="chevron-down-outline"></ion-icon>
                        </button>
                    </td>
                    <td>

                    </td>
                    <td class="text-center">
                        <button type="submit" class="btn btn-primary btn-xs" value="V-DOWN">
                            <ion-icon name="chevron-down-outline"></ion-icon>
                        </button>
                    </td>
                </tr>
            </table>
        </div>
    </section>
    <?php include_once('default_pages/footer.php'); ?>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/script.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>