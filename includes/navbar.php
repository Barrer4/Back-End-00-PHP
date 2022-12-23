<?php

$categories_url = 'http://localhost/peliculas/api/services/getCategories.php?';
$directors_url = 'http://localhost/peliculas/api/services/getDirectors.php';
$years_url = 'http://localhost/peliculas/api/services/getYears.php';
$titles_url = 'http://localhost/peliculas/api/services/getTitles.php?';
$actors_url = 'http://localhost/peliculas/api/services/getActors.php';
$countries_url = 'http://localhost/peliculas/api/services/getCountries.php';

$categories_result = file_get_contents($categories_url);
$directors_result = file_get_contents($directors_url);
$years_result = file_get_contents($years_url);
$titles_result = file_get_contents($titles_url);
$actors_result = file_get_contents($actors_url);
$countries_result = file_get_contents($countries_url);

$categories_data = json_decode($categories_result, true);
$directors_data = json_decode($directors_result, true);
$years_data = json_decode($years_result, true);
$titles_data = json_decode($titles_result, true);
$actors_data = json_decode($actors_result, true);
$countries_data = json_decode($countries_result, true);

$categories = array_slice($categories_data, 0);
$directors = array_slice($directors_data, 0);
$years = array_slice($years_data, 0);
$titles = array_slice($titles_data, 0);
$actors = array_slice($actors_data, 0);
$countries = array_slice($countries_data, 0);

?>

<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo ROOT_URL; ?>">Net+ Prime</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categories
          </a>
          <ul class="dropdown-menu">

            <?php
            foreach ($categories as $category) : ?>
              <li><a class="dropdown-item" href="<?php echo ROOT_URL; ?>?search=<?php print (rawurlencode($category['genre_name'])); ?>"><?php echo $category['genre_name']; ?></a></li>
            <?php endforeach;  ?>
          </ul>

        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Titles
          </a>
          <ul class="dropdown-menu">
            <?php
            foreach ($titles as $title) : ?>
              <li><a class="dropdown-item" href="<?php echo ROOT_URL; ?>?search=<?php echo $title['movie_name']; ?>"><?php echo $title['movie_name']; ?></a></li>
            <?php endforeach;  ?>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Directors
          </a>
          <ul class="dropdown-menu">
            <?php
            foreach ($directors as $director) : ?>
              <li><a class="dropdown-item" href="<?php echo ROOT_URL; ?>?search=<?php echo $director['crew_name']; ?>"><?php echo $director['crew_name']; ?></a></li>
            <?php endforeach;  ?>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Years
          </a>
          <ul class="dropdown-menu">
            <?php
            foreach ($years as $year) : ?>
              <li><a class="dropdown-item" href="<?php echo ROOT_URL; ?>?search=<?php echo $year['movie_year']; ?>"><?php echo $year['movie_year']; ?></a></li>
            <?php endforeach;  ?>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Actors
          </a>
          <ul class="dropdown-menu">
            <?php
            foreach ($actors as $actor) : ?>
              <li><a class="dropdown-item" href="<?php echo ROOT_URL; ?>?search=<?php echo $actor['cast_name']; ?>"><?php echo $actor['cast_name']; ?></a></li>
            <?php endforeach;  ?>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Countries
          </a>
          <ul class="dropdown-menu">
            <?php
            foreach ($countries as $country) : ?>
              <li><a class="dropdown-item" href="<?php echo ROOT_URL; ?>?search=<?php echo $country['country_name']; ?>"><?php echo $country['country_name']; ?></a></li>
            <?php endforeach;  ?>
          </ul>
        </li>
      </ul>

      <form class="d-flex" role="search" method="get">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">

        <button class="btn btn-outline-success" type="submit" <?php

                                                              if (isset($_GET['search'])) {
                                                                $search = $_GET['search'];

                                                                $search == ''
                                                                  ? ''
                                                                  : 'href="<?php echo ROOT_URL; ?>index.php?search=<?php echo $_GET["search"]; ?>" ?>';
                                                              }; ?>>Search</button>'
        }


      </form>
    </div>
  </div>
</nav>
<div class="container" style="margin-bottom: 8vw"></div>