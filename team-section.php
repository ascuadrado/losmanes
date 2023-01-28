<?php
$string = file_get_contents("data/team.json");
$obj = json_decode($string);
$members = array_merge($obj->SEUL, $obj->TTU, $obj->Other);
?>

<section id="team" class="team">
  <div class="container" data-aos="fade-up">

    <div class="section-title">
      <h2>Team</h2>
      <p>Check our Team</p>
    </div>

    <div class="row">
      <?php
      foreach ($members as $key => $value) {
        $img = ($value->verified)?('<img src="assets/img/badge.png" width=15% style="position:absolute;top:0px;left:0px">'):("");
                  # Medals 🥇🥈🥉🏓🔥🚙
        $medals = str_repeat("🥇", $value->cat1);
        $medals .= str_repeat("🥈", $value->cat2);
        $medals .= str_repeat("🥉", $value->cat3);
        $medals .= str_repeat("🏓", $value->balls);
        $medals .= str_repeat("🔥", $value->fire);
        $medals .= str_repeat("🚙", $value->coche);
        echo '<div class="col-lg-3 col-md-6 col-sm-12 d-flex align-items-stretch">
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
</section>
