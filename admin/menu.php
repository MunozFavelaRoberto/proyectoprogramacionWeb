<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Tecnológico</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pais.php">Pais</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="categoria.php">Categoria</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="opinion.php">Opiniones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="noticia.php">Noticias</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="tipousuario.php">Tipos Usuarios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="referencia.php">Referencias</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="imagen.php">Imagenes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">Acerca De</a>
          </li>
        </ul>
        
      </div>
      <span class="text-white"><?=$_SESSION['Nombre'];?> 
        <a href="../index.php">Cerrar Sesión</a></span>
    </div>
  </nav>
