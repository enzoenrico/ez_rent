<style>
.button-size {
  width: 500px !important;
}
.d-flex{
  padding-top: 20px;
}
.body-size{
  padding-bottom: 80px;
}
</style>


<div class='body-size'>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <!-- COMEÇO NAVBAR -->
  <nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid">

      <h1 style="color: white;">EzRent</h1>

      <form style="padding-top: 13.5px;" class="d-flex" role="search">
        <input class="form-control button-size me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success" type="submit">Search</button>
      </form>

      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
       
        <div class="offcanvas-header">

          <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">EzRent</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>

        </div>
        
        <div class="offcanvas-body">
          
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">

            <li class="nav-item">

              <a class="nav-link active" aria-current="page" href="#">Home</a>

            </li>
            <li class="nav-item dropdown">
              
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Categorias
              </a>
              <ul class="dropdown-menu dropdown-menu-dark">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- FIM NAVBAR -->



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</div>