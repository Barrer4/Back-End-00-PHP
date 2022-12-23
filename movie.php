<?php
//Insert header
include_once('includes/header.php');

//Get movie id

if (isset($_GET['movie_id'])) {
   $id = $_GET['movie_id'];
   $url = 'http://localhost/peliculas/api/services/getMovie.php?movie_id=' . $id;
}

$result = file_get_contents($url);
$data = json_decode($result, true);
$movie = array_slice($data, 0);
$genre_name = explode(', ', $movie['genre_name']);
$cast_name = explode(', ', $movie['cast_name']);
$cast_order = explode(', ', $movie['cast_order']);


if ($movie['id'] == null) {
?><div class="container">
      <h5>Error: Movie not found</h5>
   </div><?php
      } else {;
         ?>

   <div class="card mt-5">
      <img src=<?php echo $movie['backdrop_path']; ?> class="card img-fluid opacity-25" alt=<?php echo $movie['title']; ?> style="max-height: 75vh" />

      <div class="card-img-overlay container p-md-0">
         <div class="row h-100">
            <div class="col-md-4 d-flex justify-content-end align-items-center h-100">
               <img src=<?php echo $movie['poster_path']; ?> class="rounded float-end align-text-middle h-75 " alt=<?php echo $movie['title']; ?> />
            </div>

            <div class="col-md-5 ps-md-4 d-flex align-self-center">
               <div class="block">

                  <h3 class="d-inline" style="font-weight: 700"><?php echo $movie['title']; ?></h3>
                  <h3 id="movie_year" class="d-inline p-2" style="font-weight: 700">(<?php echo $movie['year']; ?>)</h3>
                  <br>
                  <?php

                  foreach ($genre_name as $genre) : ?>

                     <a class="card-text li-2 p-2 fst-italic" href="<?php echo ROOT_URL; ?>?search=<?php print(rawurlencode($genre)); ?>"><?php echo $genre; ?></a>
                  <?php endforeach;  ?>
                  <p class="card-text li-2 py-lg-3 row ps-md-4" style="font-size:medium"><?php echo $movie['overview']; ?></p>
                  <div class="row">


                     <div class="row row-cols-3 d-flex">
                        <div class="col col-md-4">
                           <a class="card-text li-2 mb-0 fw-bolder" href="<?php echo ROOT_URL; ?>?search=<?php echo $movie['director_name']; ?>"><?php echo $movie['director_name']; ?></a>
                           <p class="card-text" style="font-size: small">Director</p>
                        </div>

                        <div class="col col-md-4">
                           <a class="card-text li-2 mb-0 fw-bolder" href="<?php echo ROOT_URL; ?>?search=<?php echo $cast_name[0]; ?>"><?php echo $cast_name[0]; ?></a>

                           <p style="font-size: small"><?php $cast_order[0] == 0 ? print 'Leading role' : print 'Supporting role'; ?>


                        </div>
                        <div class="col col-md-4">
                           <a class="card-text li-2 mb-0 fw-bolder" href="<?php echo ROOT_URL; ?>?search=<?php echo $cast_name[1]; ?>"><?php echo $cast_name[1]; ?></a>

                           <p style="font-size: small"><?php $cast_order[1] == 0 ? print 'Leading role' : print 'Supporting role'; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   </div><?php
      }
         ?>


<?php
//Insert footer
include(INC_PATH . DS . 'footer.php'); ?>