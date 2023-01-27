<!DOCTYPE html>
<html lang="en">

<?php include ('head.php'); ?>
<?php
  $string = file_get_contents("data/team.json");
  $obj = json_decode($string);
  $members = array_merge($obj->SEUL, $obj->TTU);

  function getPoints($data, $team=1)
  {
    $points=0;

    if($team){
      $newData = $data->TTU;
    }else{
      $newData = $data->SEUL;
    }

    foreach ($newData as $key => $value) {
      $points += 3*$value->cat1;
      $points += 2*$value->cat2;
      $points += 1*$value->cat3;
      $points += 1*$value->balls;
      $points += 1*$value->fire;
      $points += 1*$value->coche;
    }
    return $points;
  }

  $TTU = getPoints($obj, 1);
  $SEUL = getPoints($obj, 0);
  $winSEUL = $SEUL > $TTU;
  $winTTU = $TTU > $SEUL;
?>

<script src="forms/marcador-form.js"></script>

<body>

  <!-- ======= Header ======= -->
  <?php include ('inner-header.php'); ?><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>TTU v SEUL</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>TTU v SEUL</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Marcador ======= -->
    <section>
      <div class="container">
        <div class="section-title">
          <h2>Marcador</h2>
          <p>PUNTUACIÓN EN TIEMPO REAL</p><br>
          <div class="row">
            <div class="col" style='text-align: center;'>
              <h3>Team SEUL <?php echo ($winSEUL)?"🏆":""; ?></h3><br>
              <div class="card" style='padding: 20px;border:2px solid #ffc451;'>
                <h4><b><?php echo $SEUL;?></b> puntos</h4>
              </div>
            </div>
            <div class="col" style='text-align: center;'>
              <h3>Team TTU <?php echo ($winTTU)?"🏆":""; ?></h3><br>
              <div class="card" style='padding: 20px;border:2px solid #ffc451;'>
                <h4><b><?php echo $TTU; ?> </b>puntos</h4>
              </div>
            </div>
          </div>
        </div>
        <h5>Formulario para reportar nuevos puntos</h5>

        <form id="marcadorForm" action="forms/marcador-form.php" method="post">
          <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12">
              <div class="form-group">
                <label for="memberSelect">Seleccionar Miembro</label>
                <select class="form-control" id="memberSelect">
                  <?php foreach ($members as $key => $value) {
                    echo "<option>".$value->nombre."</option>"; } ?>
                </select>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
              <div class="form-group">
                <label for="actionSelect">Seleccionar Hazaña</label>
                <select class="form-control" id="actionSelect">
                  <option>CAT I 🥇</option>
                  <option>CAT II 🥈</option>
                  <option>CAT III 🥉</option>
                  <option>BALLS BACK 🏓</option>
                  <option>ON FIRE 🔥</option>
                  <option>COCHES CHOCONES 🚙</option>
                </select>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
              <div class="form-group">
                <label for="passwordCheck">Contraseña</label>
                <input type="password" class="form-control" id="passwordCheck" placeholder="Password">
              </div>
            </div>
            <div class="col-lg-1 col-md-6 col-sm-12">
              <br>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </section><!-- End Marcador -->

    <!-- ======= Teams Section ======= -->
    <section id="team" class="team">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Team</h2>
          <p>DESCUBRE A LOS CONTRINCANTES</p>
        </div>

        <div class="row">
          <div class="col">
            <h3>Team SEUL</h3>
            <div class="row">
              <?php
                foreach ($obj->SEUL as $key => $value) {
                  $img = ($value->verified)?('<img src="assets/img/badge.png" width=15% style="position:absolute;top:0px;left:0px">'):("");
                  # Medals 🥇🥈🥉🏓🔥🚙
                  $medals = str_repeat("🥇", $value->cat1);
                  $medals .= str_repeat("🥈", $value->cat2);
                  $medals .= str_repeat("🥉", $value->cat3);
                  $medals .= str_repeat("🏓", $value->balls);
                  $medals .= str_repeat("🔥", $value->fire);
                  $medals .= str_repeat("🚙", $value->coche);
                  echo '<div class="col-lg- col-md-6 col-sm-12 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="100">
                      <div class="member-img">
                        <img src="assets/img/team/'.$value->foto.'" class="img-fluid" alt="">
                      </div>
                      <div class="member-info">
                        <h4>'.$value->nombre.'</h4>
                        <span>'.$value->puesto.'</span>
                        '. $img .'
                        <span>'. $medals .'</span>
                      </div>
                    </div>
                  </div>';
                }
              ?>
            </div>
          </div>

          <div class="col">
            <h3>Team TTU</h3>
            <div class="row">
              <?php
                foreach ($obj->TTU as $key => $value) {
                  $img = ($value->verified)?('<img src="assets/img/badge.png" width=15% style="position:absolute;top:0px;left:0px">'):("");
                  # Medals 🥇🥈🥉🏓🔥🚙
                  $medals = str_repeat("🥇", $value->cat1);
                  $medals .= str_repeat("🥈", $value->cat2);
                  $medals .= str_repeat("🥉", $value->cat3);
                  $medals .= str_repeat("🏓", $value->balls);
                  $medals .= str_repeat("🔥", $value->fire);
                  $medals .= str_repeat("🚙", $value->coche);
                  echo '<div class="col-lg-6 col-md-6 col-sm-12 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up" data-aos-delay="100">
                      <div class="member-img">
                        <img src="assets/img/team/'.$value->foto.'" class="img-fluid" alt="">
                      </div>
                      <div class="member-info">
                        <h4>'.$value->nombre.'</h4>
                        <span>'.$value->puesto.'</span>
                        '. $img .'
                        <span>'. $medals .'</span>
                      </div>
                    </div>
                  </div>';
                }
              ?>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Team Section -->

    <!-- ======= About Section ======= -->
    <section id="about" class="team">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>About</h2>
          <p>REGLAMENTO</p>
        </div>
        <div>
          <p> En el siguiente documento queda grabado para la posterioridad el reglamento oficial de la competición “TTU vs SEÚL”.
            Recuerden que esto es un deporte de equipo. Mucha suerte a todos los concursantes y que gane el mejor.</p>
          <div class="row">
            <div class="col">
              <h4>CAT I 🥇</h4>
              <i>3 puntos</i>
              <p>Booombazo de los que le gustan a luchi!</p>

            </div>
            <div class="col">
              <h4>CAT II 🥈</h4>
              <i>2 puntos</i>
              <p>Para los amigos, un faray... (pero no hace falta que sea en Guadalajara)</p>

            </div>
            <div class="col">
              <h4>CAT III 🥉</h4>
              <i>1 punto</i>
              <p>No vale el criterio de Ros: "Me ha mirado, esa queria..." Esto es un deporte de contacto!</p>

            </div>
          </div>

          <p>Además, los equipos se pueden beneficiar de las siguientes bonificaciones si se cumplen los requisitos.</p>

          <div class="row">
            <div class="col">
              <h4>BALLS BACK 🏓</h4>
	      <i>4 o 5 puntos</i>
              <p>Si todos los miembros de un equipo puntúan una misma noche, se anulan los puntos de esa noche del equipo contrario</p>

            </div>
            <div class="col">
              <h4>ON FIRE 🔥</h4>
              <i>1 puntos</i>
              <p>Si un miembro llega a racha de 2, tiene que gritar ON FIRE y si vuelve a puntuar se suma la bonificación</p>

            </div>
            <div class="col">
              <h4>COCHES CHOCONES 🚙</h4>
              <i>1 punto</i>
              <p>Hacer doblete con distintos objetivos en la misma jornada tiene premio!</p>

            </div>
          </div>
        </div>

    </section>
    <!-- End About Section -->


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include('footer.php'); ?><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>
</html>
