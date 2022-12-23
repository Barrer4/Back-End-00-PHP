<?php
//Insert header
include_once('includes/header.php');

//Message vs
$msg = '';
$msgClass = '';

//Check for submit
if (filter_has_var(INPUT_POST, "submit")) {
   //Get form data
   $name = mysqli_escape_string($con, $_POST["form-name"]);
   $surname = mysqli_escape_string($con, $_POST["form-surname"]);
   $email = mysqli_escape_string($con, $_POST["form-email"]);
   $category = mysqli_escape_string($con, $_POST["form-category"]);
   $comments = mysqli_escape_string($con, $_POST["form-comments"]);

   //Check required fields
   if (!empty($name) && !empty($surname) && !empty($email)  && !empty($category) && !empty($comments)) {
      //Passed
      //Check email
      if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
         //Failed
         $msg = "Please enter a valid email";
         $msgClass = "alert-danger";
      }
   } else {
      //Failed
      $msg = "Please fill in all fields";
      $msgClass = "alert-danger";
   }
}
?>

<div class="container">
   <?php if ($msg != "") : ?>
      <div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
   <?php endif; ?>
</div>
<form class="container" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
   <div class="mb-3">
      <label for="form-name" class="form-label">Name</label>
      <input type="text" class="form-control" name="form-name" placeholder="Enter your name here" aria-describedby="nameHelp" value="<?php echo isset($_POST['form-name']) ? $name : ''; ?>">
   </div>

   <div class="mb-3">
      <label for="form-surname" class="form-label">Lastname</label>
      <input type="text" class="form-control" name="form-surname" placeholder="Enter your last name here" aria-describedby="lastnameHelp" value="<?php echo isset($_POST['form-surname']) ? $surname : ''; ?>">
   </div>

   <div class="mb-3">
      <label for="form-email" class="form-label">Email address</label>
      <input type="email" class="form-control" name="form-email" aria-describedby="emailHelp" value="<?php echo isset($_POST['form-email']) ? $email : ''; ?>">
   </div>
   <label for="form-category">Please select a category</label>
   <div class="form-floating mb-3">

      <select class="form-category mb-3" name="form-category" aria-label="Floating label select" value="<?php echo isset($_POST['form-category']) ? $category : ''; ?>">
         <option selected disabled>Category list</option>
         <option value="Complain">Complain</option>
         <option value="Request">Request</option>
         <option value="Recommendation">Recommendation</option>
         <option value="Other">Other</option>
      </select>
   </div>
   <div class="form-floating mb-3">
      <textarea class="form-control" placeholder="Leave your comments here" name="form-comments" value="<?php echo isset($_POST['form-comments']) ? $comments : ''; ?>"></textarea>
      <label for="form-comments"></label>
   </div>


   <button name="submit" type="button" class="btn btn-primary">Submit</button>
</form>
<div class="footer-container">
   <?php
   //Insert footer
   include(INC_PATH . DS . 'footer.php'); ?>
</div>