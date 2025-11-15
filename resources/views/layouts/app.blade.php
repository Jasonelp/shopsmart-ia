<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ShopSmart IA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
      /* Un pequeño estilo para que el fondo sea oscuro como en tu figma */
      body {
        background-color: #f8f9fa; /* Un gris claro, puedes cambiarlo */
      }
      .navbar {
        /* El color de tu barra de navegación se veía oscura */
        background-color: #232f3e !important; 
      }
    </style>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container-fluid">

        <a class="navbar-brand fw-bold" href="/">ShopSmart IA</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <form class="d-flex w-50 mx-auto" role="search">
            <input class="form-control me-2" type="search" placeholder="Buscar productos..." aria-label="Search">
            <button class="btn btn-outline-light" type="submit">Buscar</button>
          </form>

          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link fs-5" href="#">
                <i class="bi bi-cart"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link fs-5" href="#">
                <i class="bi bi-person-circle"></i>
              </a>
            </li>
          </ul>

        </div>
      </div>
    </nav>

    <main class="py-4">
      @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
