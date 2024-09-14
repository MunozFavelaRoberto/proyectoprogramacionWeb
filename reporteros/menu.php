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
            <a class="nav-link" href="about.php">Acerca De</a>
          </li>
        </ul>
        
      </div>
        <a href="perfil.php?accion=editPerfil" >
          <?php if($_SESSION['Foto']>'')
                  echo '<img src="data:image/jpeg;base64,'.base64_encode($_SESSION['Foto']).'
                    alt="foto" class="miniFoto" />';
                else
                  echo '<img src="../images/userX.png" class="miniFoto" />';
          ?>
          &nbsp;<?=$_SESSION['Nombre'];?></a>
          &nbsp;&nbsp; <a class="text-white" href="../index.php">Cerrar Sesión</a>
  </nav>
