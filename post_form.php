<?php
/************************************************************

    Document   : post_form.php

    Created on : Dec 7, 2008, 11:07:23 PM
    Author     : Sharada Thimmaiah

   This file not only caters to Homework 4 and beyond that.
   It includes the html code for the form which
   is Homework 2 and  connects to database created in Homework 3 
   and post each classified data into database by using form 
   created in New Post Form

   This helps to even upload the images. Please note
   there needs to be an uploads directory in the
   current directory. The uploads directory needs
   be be accessible. Use chmod to change the access rules.

***********************************************************/
require_once("initialize.php");
require_once("post.php");

if (!$session->is_logged_in()) {

  echo 'You have not logged in. Please Login     ';
  echo '<a href="index.php">Login</a>';

} else {

$errors = array(); //global array
$upload_errors = array(
  //http://php.net/manual/en/features.file-upload.errors.php
  UPLOAD_ERR_OK         => "No errors.",
  UPLOAD_ERR_INI_SIZE   => "Larger than upload_max_filesize.",
  UPLOAD_ERR_FORM_SIZE  => "Larger than form MAX_FILE_SIZE",
  UPLOAD_ERR_PARTIAL    => "Partial upload.",
  UPLOAD_ERR_NO_FILE    => "No file.",
  UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
  UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
  UPLOAD_ERR_EXTENSION  => "File upload stopped by extension."
);

/******************************************************************* 
The following code does Form parameter validations once the form is
   posted. 
********************************************************************/

// form variables declarations and initializations

  $subcategory = $location = $title = $price = "";
  $description = $email = $confirm_email = $agreement = "";
  $image1 = $image2 = $image3 = $image4 = NULL;

// Initialization of variables for error handling

  $subcategory_err = $location_err = $title_err = $price_err = "";
  $description_err = $email_err = $confirm_email_err = $agreement_err = "";
  $image1_err = $image2_err = $image3_err = $image4_err = NULL;

// The following function removes white space, cleans up the data from form,
// removes backslash , <, > chars.

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

// The following function checks the length of the passed string 
// with max length

  function has_max_length($value, $max) {
    return strlen($value) <= $max;
  }

// Actual form validation starts below

  //if ($_SERVER["REQUEST_METHOD"] == "POST") { 
  if (isset($_POST['submit'])) { 

    // SubCategory validation
  
    if (($_POST['SubCategory']) == 'Select' ) {
      $subcategory_err = "Please select Sub-Category";
      $errors['SubCategory'] = "SubCategory". " has to be selected";
    }  else {
      $subcategory = $_POST["SubCategory"];
    } 
    
    // Location validation

    if (($_POST['Location']) == 'Select' ) {
      $location_err = "Please select Location";
      $errors['Location'] = "Location". " has to be selected";
    } else {
      $location = $_POST["Location"];
    } 

    // Title is a Required field which can not be empty
    // and can only contain letters, numbers and white space
    // It's max length can be 64 chars

    if (empty($_POST['Title'])) {
      $title_err = "Title is required";
      $errors['Title'] = "Title". " is required";
    } else {
      $title = test_input($_POST["Title"]);
      $max = 64;
      if (!has_max_length($title, $max)) {
        $errors['Title'] = ucfirst('Title') . "is too long";
        $title_err = "Title is too long.";
      } else {
        if (!preg_match("/^[a-zA-Z0-9. ]*$/",$title)) {
          $title_err = "Only letters, numbers and white space allowed";
          $errors['Title'] = "Title". " only letters, numbers and white space";
        }
      } 
    } 

    // Price is required and only numbers(it can be just 0.0) and 
    // decimal points are allowed

    if (empty($_POST['Price'])) {
      $price_err = "Price is required";
      $errors['Price'] = "Price". " is required";
    } else {
      $price = $_POST["Price"];
      //if (!preg_match("/^[0-9]+(:\.?[0-9]{2})$/",$price)) {
        if (!preg_match("/^[+-]?((\d+(\.\d*)?)|(\.\d+))$/",$price)) {
        $price_err = "Only numbers,decimal points allowed";
        $errors['Price'] = "Price". "  only numbers and decimal points";
      } 
    }

    // Description can be empty. When not empty there is no restriction
    // with the content. The length can not exceed 256 chars

    global $database;
    $description = $database->escape_value($_POST["Description"]);
    $max = 256;
    if (!has_max_length($description, $max)) {
      $errors['Description'] = ucfirst('Description') . "is too long";
      $description_err = "Description is too long.";
    } 

    //Email field cannot be empty.It has to conform to the email format
    // It can not exceed 32 chars

    if (empty($_POST['Email'])) {
      $email_err = "Email is required";
      $errors['Email'] = "Email". " is required";
    } else {
      $email = test_input($_POST["Email"]);
      if (!has_max_length($email, 32)) {
        $errors['Email'] = ucfirst('Email') . "is too long";
        $email_err = "Email is Too long";
      } else { 
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $email_err = "Invalid email format";
          $errors['Email'] = ucfirst('Email') . "Invalid format";
        }
      }
    }

    //Confirm_Email field cannot be empty.It has to conform to
    //the email format and it should match email field

    if (empty($_POST['Confirm_Email'])) {
      $confirm_email_err = "Confirm Email is required";
      $errors['Confirm_Email'] = "Confirm_Email". " is required";
    } else {
      $confirm_email = test_input($_POST["Confirm_Email"]);
      
      if (!has_max_length($confirm_email, 32)) {
        $errors['Confirm_Email'] = ucfirst('Confirm_Email') . "is too long";
        $confirm_email_err = "Confirm_Email is Too long";
      } else {
        if (!filter_var($confirm_email, FILTER_VALIDATE_EMAIL)) {
          $confirm_email_err = "Invalid email format";
          $errors['Confirm_Email'] = ucfirst('Confirm_Email') . "invalid format";
        } else {
          if ($email != $confirm_email) {
            $confirm_email_err = "Emails do not match.";
            $errors['Confirm_Email'] = ucfirst('Confirm_Email') . "emails do not match";
          }
        }    
      } 
    }

    // Terms and conditions agreement has to be checked

    if (!isset($_POST['Agreement'])) {
      $agreement_err = "Please checkmark Agreement";
      $errors['Agreement'] = "Agreement". " has to be checked";
    } else {
      $agreement = (int)$_POST["Agreement"];
    }

    // Image1 upload
    if (isset ($_FILES['Image1'])) {
      // print_r($_FILES['Image1']);
      if ($_FILES['Image1']['size'] >0) {
        $image1_size = $_FILES['Image1']['size'];
        $image1_type = $_FILES['Image1']['type'];

        if ($image1_size > 5000000) {
          $image1_err = "File size is bigger than 5 Mb";
          $errors['Image1'] = "Image1". "File size is big"; 
        } else {
          if ( ($image1_type != "image/jpeg") &&
              ($image1_type != "image/jpg") &&
              ($image1_type != "image/gif") &&
              ($image1_type != "image/png")
            ) {
            $image1_err = "File type invalid, only jpeg,jpg,gif,png allowed";
            $errors['Image1'] = "Image1". "File type invalid only jpeg,jpg,gif,png allowed";
          } else {
             $tmp_file = $_FILES['Image1']['tmp_name'];
             $target_file = basename($_FILES['Image1']['name']);
             $upload_dir = "uploads";
  
	     if(move_uploaded_file($tmp_file, $upload_dir."/".$target_file)) {
               $message = "File uploaded successfully.";
               $image1 = $_FILES['Image1']['name'];
             } else {
	       $error = $_FILES['Image1']['error'];
               $message = $upload_errors[$error];
             }
             echo "<pre>";
             //print_r($_FILES['Image1']);
             echo "</pre>";
             echo "<hr />";
          } 
       }
      } else {
         echo "Please select an image.";
      } 
    } 
    
    // Image2 upload 
    if (isset ($_FILES['Image2'])) {
      //print_r($_FILES['Image2']);
      if ($_FILES['Image2']['size'] >0) {
        $image2_size = $_FILES['Image2']['size'];
        $image2_type = $_FILES['Image2']['type'];

        if ($image2_size > 5000000) {
          $image2_err = "File size is bigger than 5 Mb";
          $errors['Image2'] = "Image2". "File size is big";
        } else {
          if ( ($image2_type != "image/jpeg") &&
              ($image2_type != "image/jpg") &&
              ($image2_type != "image/gif") &&
              ($image2_type != "image/png")
            ) {
            $image2_err = "File type invalid, only jpeg,jpg,gif,png allowed";
            $errors['Image2'] = "Image2". "File type invalid only jpeg,jpg,gif,png allowed";
          } else {

             $image2 = $tmp_file = $_FILES['Image2']['tmp_name'];
             $target_file = basename($_FILES['Image2']['name']);
             $upload_dir = "uploads";

             if(move_uploaded_file($tmp_file, $upload_dir."/".$target_file)) {
               $message = "File uploaded successfully.";
               $image2 = $_FILES['Image2']['name'];
             } else {
               $error = $_FILES['Image2']['error'];
               $message = $upload_errors[$error];
             }
             echo "<pre>";
             //print_r($_FILES['Image2']);
             echo "</pre>";
             echo "<hr />";
          }
       }
      }
    }

    if (isset ($_FILES['Image3'])) {
      if ($_FILES['Image3']['size'] >0) {
        $image3_size = $_FILES['Image3']['size'];
        $image3_type = $_FILES['Image3']['type'];

        if ($image3_size > 5000000) {
          $image3_err = "File size is bigger than 5 Mb";
          $errors['Image3'] = "Image3". "File size is big";
        } else {
          if ( ($image3_type != "image/jpeg") &&
              ($image3_type != "image/jpg") &&
              ($image3_type != "image/gif") &&
              ($image3_type != "image/png")
            ) {
            $image3_err = "File type invalid, only jpeg,jpg,gif,png allowed";
            $errors['Image3'] = "Image3". "File type invalid only jpeg,jpg,gif,png allowed";
          } else {
          
             $image3 = $tmp_file = $_FILES['Image3']['tmp_name'];
             $target_file = basename($_FILES['Image3']['name']);
             $upload_dir = "uploads";

             if(move_uploaded_file($tmp_file, $upload_dir."/".$target_file)) {
               $message = "File uploaded successfully.";
               $image3 = $_FILES['Image3']['name'];
             } else {
               $error = $_FILES['Image3']['error'];
               $message = $upload_errors[$error];
             }
             echo "<pre>";
             //print_r($_FILES['Image3']);
             echo "</pre>";
             echo "<hr />";

          }
       }
      }
    }

    if (isset ($_FILES['Image4'])) {
      if ($_FILES['Image4']['size'] >0) {
        $image4_size = $_FILES['Image4']['size'];
        $image4_type = $_FILES['Image4']['type'];

        if ($image4_size > 5000000) {
          $image4_err = "File size is bigger than 5 Mb";
          $errors['Image4'] = "Image4". "File size is big";
        } else {
          if ( ($image4_type != "image/jpeg") &&
              ($image4_type != "image/jpg") &&
              ($image4_type != "image/gif") &&
              ($image4_type != "image/png")
            ) {
            $image4_err = "File type invalid, only jpeg,jpg,gif,png allowed";
            $errors['Image4'] = "Image4". "File type invalid only jpeg,jpg,gif,png allowed";
          } else {
          
             $image4 = $tmp_file = $_FILES['Image4']['tmp_name'];
             $target_file = basename($_FILES['Image4']['name']);
             $upload_dir = "uploads";

             if(move_uploaded_file($tmp_file, $upload_dir."/".$target_file)) {
               $message = "File uploaded successfully.";
               $image4 = $_FILES['Image4']['name'];
             } else {
               $error = $_FILES['Image4']['error'];
               $message = $upload_errors[$error];
             }
             echo "<pre>";
             //print_r($_FILES['Image4']);
             echo "</pre>";
             echo "<hr />";
          }
       }
      }
    }

 
    if (empty($errors)) {

      $new_post = Post::make($title,$price, $description, $email,$agreement, $image1, $image2,$image3,$image4, $subcategory, $location);

      if ($new_post  && $new_post->save()) {
         // comment saved
        echo "New Post record created successfully";
        echo nl2br('<a href="mini_craigslist.php">Want to browse Ads?</a>'); 
      } else {
         // failed
        $message = "There was an error prevented the post from being saved.";
      }
  
    } else {
        print_r($errors); 
    } 
 }
}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>AdsList</title>
    <link rel="stylesheet" type="text/css" href="styles.css"> 
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=US-ASCII">
</head>
<body>

<!-- The following is the New Post form -->
<p>
  <?php if(!empty($message)) {echo "<p>{$message}</p>";} ?>
  <p><span class="error">* required fields.</span></p>
   <div style="width:500px;height:800px;background-color:#6B8E23; color:white">

  <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
    <?php
         if($session->is_logged_in()) {
           echo nl2br('<a href="logout.php">Logout</a>');
           echo nl2br("\n");
         }
     ?>

    <label>Sub-Category: </label>
    <?php //drop down list for SubCategory
      global $database;

      $res = $database->query("Select SubCategory_ID, SubCategoryName from SubCategory");
      echo "<select name=SubCategory value = 'SubCategory'><option>Select</option>";
      while($row_sc = $res->fetch_assoc()) {
        echo "<option value=$row_sc[SubCategory_ID]>$row_sc[SubCategoryName]</option>";
      }
      echo "</select>";
    ?>
    <span class="error">* <?php echo $subcategory_err;?></span>
    <br>
    <br>
    <label>Location: </label>
      <?php  //drop down list for Location
        $res = $database->query("Select Location_ID, LocationName from Location");
        echo "<select name=Location value = 'Location'><option>Select</option>";
        while($row_lcn = $res->fetch_assoc()) {
          echo "<option value=$row_lcn[Location_ID]>$row_lcn[LocationName]</option>";
        }
        echo "</select>";
      ?>
     <span class="error">* <?php echo $location_err;?></span>

     <p style="color:white">Title: <input id="title" type="text" name="Title"></p>
     <span class="error">* <?php echo $title_err;?></span>
     <p style="color:white">Price: <input id="price" type="text" name="Price"></p>
     <span class="error">* <?php echo $price_err;?></span>
     <p style="color:white"> Description: <textarea id="desc" type="textarea" name="Description"> </textarea></p>
     <span class="error">* <?php echo $description_err;?></span>
     <p style="color:white">Email: <input id="email" type="text" name="Email" />
     <span class="error">* <?php echo $email_err;?></span>
     <p style="color:white">Confirm Email: <input id="confemail" type="text" name="Confirm_Email" />
     <span class="error">* <?php echo $confirm_email_err;?></span>
     <br>
     <br>
     <label style="color:white;">I agree with terms and conditions </label>
     <input name="Agreement" type="checkbox" value="1" />
     <span class="error">* <?php echo $agreement_err;?></span>
     <br>
     <br>
     <label style="color:white;">Optional fields: </label>
     <br>
     <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
     <label style="color:white;">Image 1 (max 5 MB): <input id="Image1" name="Image1" type="file" />
     <br>
     <label style="color:white;">Image 2 (max 5 MB): <input id="Image2" name="Image2" type="file" />
     <br>
     <label style="color:white;">Image 3 (max 5 MB): <input id="Image3" name="Image3" type="file" />
     <br>
     <label style="color:white;">Image 4 (max 5 MB): <input id="Image4" name="Image4" type="file" />

     <p><input id="sub" value="Submit" type="submit" name="submit" onclick="return confirm('Please confirm the values before you submit');"/>
     <input id="res" type="Reset" value="Reset"></p>

   </form>
 </div>
</p>

</body>
</html>
