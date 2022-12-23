<?php
//Insert header
include_once('includes/header.php');

if (isset($_GET['search'])) {
   $search = rawurlencode($_GET['search']);
   $url = 'http://localhost/peliculas/api/services/getMovies.php?search=' . $search;
} else {
   $url = 'http://localhost/peliculas/api/services/getMovies.php';
}

$result = file_get_contents($url);
$data = json_decode($result, true);
$movies_per_page = 6;

//Check or set the page number
if (isset($_GET['page'])) {
   $page = $_GET['page'];
} else {
   $page = 1;
}


// Calculate total number of records, and total number of pages
$total_records = count($data);
$total_pages   = ceil($total_records / $movies_per_page);

// Calculate the position of the first record of the page to display
$start_from = ($page - 1) * $movies_per_page;

$movies = array_slice($data, $start_from, $movies_per_page);

if ($movies[0] == "Error") {; ?> <div class='container container-fluid mt-5 justify-content-center'>
      <h5>No movies were found with your search. Please try again</h5>
   <?php
} else { ?>
      <div class='container justify-content-center'>
         <div class='container container-fluid mt-5 justify-content-center'>

            <table class="table align-middle table-hover">
               <thead>
                  <tr>
                     <th scope="col" class="col-3 text-center">Poster</th>
                     <th scope="col" class="col-3 text-center">Title</th>
                     <th scope="col" class="col-1 text-center">Year</th>
                     <th scope="col" class="col-2 text-center">Director</th>
                     <th scope="col" class="col-3 text-center">Country</th>

                  </tr>
               </thead>
               <tbody>

                  <?php

                  foreach ($movies as $movie) : ?>

                     <tr class="position-relative">

                        <td class="col-3">
                           <a href="<?php echo ROOT_URL; ?>movie.php?movie_id=<?php echo $movie['id']; ?>">
                              <img src=<?php echo $movie['poster_path']; ?> alt=<?php echo $movie['title']; ?> class="img-thumbnail" /></a>
                        </td>

                        <td class="col-3 text-center">
                        <a href="<?php echo ROOT_URL; ?>movie.php?movie_id=<?php echo $movie['id']; ?>"><h6><?php echo $movie['title']; ?></h6></a>
                        </td>
                        <td class="col-1 text-center">
                           <h6><?php echo $movie['year']; ?></h6>
                        </td>
                        <td class="col-2 text-center">
                           <h6><?php echo $movie['director_name']; ?></h6>
                        </td>
                        <td class="col-3 text-center">
                           <h6><?php echo $movie['country_name']; ?></h6>
                        </td>
                        
                     </tr>
                  <?php endforeach;  ?>
               </tbody>
            </table>

         </div>

      </div>
   <?php }
   ?>


   <div class='container container-fluid mt-5'>
      <nav aria-label="Page navigation example">
         <ul class="pagination pagination-sm justify-content-center">

            <?php $page == 1
               ? print '<li class="page-item disabled" >'
               :  print '<li class="page-item" >'; ?>
            <a class="page-link" href="<?php echo ROOT_URL; ?>index.php?page=<?php echo ($page - 1); ?>" aria-label="Previous">
               <span aria-hidden="true">&laquo;</span>
            </a>
            </li>

            <?php


            for ($i = 1; $i <= $total_pages; $i++) {
               echo '<li class="page-item"><a class="page-link" href="' . ROOT_URL . 'index.php?page=' . $i . '">' . $i . '</a></li>';
            }

            ?>

            <?php $page == $total_pages
               ? print '<li class="page-item disabled" >'
               :  print '<li class="page-item" >'; ?>
            <a class="page-link" href="<?php echo ROOT_URL; ?>index.php?page=<?php echo ($page + 1); ?>" aria-label="Next">
               <span aria-hidden="true">&raquo;</span>
            </a>
            </li>
         </ul>
      </nav>
   </div>
   </div>


   <?php
   //Insert footer
   include(INC_PATH . DS . 'footer.php'); ?>