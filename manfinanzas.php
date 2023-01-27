<!DOCTYPE html>
<html lang="en">

<?php include ('head.php'); ?>

<?php
$string = file_get_contents("data/team.json");
$obj = json_decode($string);
$members = array_merge($obj->SEUL, $obj->TTU, $obj->Other);
?>

<body>

  <!-- ======= Header ======= -->
  <?php include ('inner-header.php'); ?><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>ManFinanzas</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>ManFinanzas</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
      <div class="container">
        <h1>Resumen de la sección</h1>
        <p>Pa que no me llameis morosooooo</p>

        <br></br>
        <div class="row">
          <div class="col-xl-2 col-xl-6">
            <h2>Gastos</h2>
            <div class="row">
              <?php
              $array = array();

              if (($handle_gastos = fopen("data/gastos.csv", "r")) != FALSE) {
                while (($gastos= fgetcsv($handle_gastos, 100, ",")) !== FALSE){
                  $ng = count($gastos);
                  if($ng == 2){
                    array_push($array, [$gastos[0], $gastos[1]]);
                  }
                }
                fclose($handle_gastos);
              }

              echo "<div class=\"col-xl-2 col-xl-7\">";
              echo "<u>Concepto</u>";
              echo "<br></br>";
              for ($i=0; $i < count($array); $i++) {
                echo "<p>".$array[$i][0]."</p>";
              }
              echo "</div>";

              echo "<div class=\"col-xl-2 col-xl-3\">";
              echo "<u>Cantidad</u>";
              echo "<br></br>";
              for ($i=0; $i < count($array); $i++) {
                echo "<p>".$array[$i][1]."</p>";
              }
              echo "</div>";

              ?>
            </div>
          </div>

          <div class="col-xl-2 col-xl-6">
            <h2>Rondas de financiación</h2>
            <u>Participantes ronda pre-seed</u>
            <br></br>
            <?php
            $string = file_get_contents("data/team.json");
            $obj = json_decode($string);
            $members = array_merge($obj->SEUL, $obj->TTU, $obj->Other);

            $counter = 0;

            foreach ($members as $key => $value) {
              if($value->verified){
                echo "<p>".$value->nombre."</p>";
                $counter++;
              }
            }
            echo "<p><i>Total recaudado: ". 5 * $counter ." EUR </i></p>";
            ?>
          </div>

        </div>

      </div>
    </section>

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
