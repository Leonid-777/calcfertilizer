<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CalcFertilizer|Форма обратной связи</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
<?php

/**
 * Template Name: Modal
 *
 
 */

    
  //response generation function
  $response = "";
  
  //function to generate response
  function generate_response($type, $message){
      
    global $response;
  
    if($type == "success") $response = "<div class='success'>{$message}</div>";
    else $response = "<div class='error'>{$message}</div>";
      
  }
 //response messages
$not_human       = "Проверка АНТИРОБОТ не подтверждена!";
$missing_content = "Заполните все поля!";
$email_invalid   = "Email адрес некорректный!";
$message_unsent  = "Сообщение не отправлено. Попробуйте сново!";
$message_sent    = "Спасибо! Ваше сообщение отправлено!";
  
//user posted variables
$name = $_POST['message_name'];
$email = $_POST['message_email'];
$message = $_POST['message_text'];
$human = $_POST['message_human'];
  
//php mailer variables
$to = get_option('admin_email');
$subject = "Someone sent a message from ".get_bloginfo('name');
$headers = 'From: '. $email . "rn" .
  'Reply-To: ' . $email . "rn";
  
 if(!$human == 0){
  if($human != 2) generate_response("error", $not_human); //not human!
  else {
      
   //validate email
if(!filter_var($email, FILTER_VALIDATE_EMAIL))
  generate_response("error", $email_invalid);
else //email is valid
{
  //validate presence of name and message
if(empty($name) || empty($message)){
  generate_response("error", $missing_content);
}
else //ready to go!
{
  $sent = mail($to, $subject, $message, $headers);
if($sent) generate_response("success", $message_sent); //message sent!
else generate_response("error", $message_unsent);//message wasn't sent
}
}
  }
} 
else if ($_POST['submitted']) generate_response("error", $missing_content);
  
?>

  
  <div id="primary" class="site-content">
    <div id="content" role="main">
  
      <?php while ( have_posts() ) : the_post(); ?>
  
          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  
            <header class="entry-header">
              <h1 class="entry-title"><?php the_title(); ?></h1>
            </header>
  
            <div class="entry-content">
              <?php the_content(); ?>
  
              <p>
                  <style type="text/css">
  .error{
    margin: 0 auto;
    width: 300px;
    padding: 5px 9px;
    border: 1px solid red;
    color: red;
    border-radius: 3px;
  }
  
  .success{
    margin: 0 auto;
    width: 300px;
    padding: 5px 9px;
    border: 1px solid green;
    color: green;
    border-radius: 3px;
  }
  body {
      background-color: #fffab0;
      padding-bottom: 200px;
      text-align: center;
      padding-top: 200px;
  }
  #primary {
    width: 400px;
    color: #072909;
    font-family: Arial;
    margin: 0 auto;
    border: 3px solid #ffa500;
    background-color: #e0bc77;
    border-radius: 10px;
}
#primary h2 {
    margin: 0 auto;
    font-size: 30px;
}
#primary input[type="submit"] {
    display: block;
    outline: none;
    border: none;
    cursor: pointer;
    width: 150px;
    height: 40px;
    background-color: #159720;
    margin: 0 auto;
    margin-top: 10px;
    color: #ffffff;
    border-radius: 20px;
    font-size: 20px;
}
#primary input[type="text"] {
    width: 300px;
    height: 30px;
	border: 3px solid #ffa500;
    border-radius: 4px;
    margin-left: 50%;
    transform: translateX(-150px);
    margin-top: 12px;
    margin-bottom: 12px;
    font-size: 24px;
    outline: none;
}
#primary textarea {
    outline: none;
    overflow: scroll;
    resize: none;
    height: 200px;
    margin-left: 50%;
    transform: translateX(-150px);
    width: 300px;
    background-color: #fffab0;
	border: 1px solid #ffa500;
    border-radius: 7px;
    font-size: 20px;
    padding: 3px; 
}
  form span{
    color: red;
  }
  @media (max-device-width: 900px) {
      body {
          padding-top: 20px;
          padding-bottom: 20px;
          width: 100%;
      }
      #primary {
          max-width: 98%;
          margin: 0 auto;
          padding-left: 12px;
      }
      #primary input[type="text"], #primary textarea {
          max-width: 90%;
      }
  }
</style>
  
<div id="respond">
  <?php echo $response; ?>
  <form action="<?php the_permalink(); ?>" method="post">
    <p><label for="name">Name: <span>*</span> <br><input type="text" name="message_name" value="<?php echo $_POST['message_name']; ?>"></label></p>
    <p><label for="message_email">Email: <span>*</span> <br><input type="text" name="message_email" value="<?php echo $_POST['message_email']; ?>"></label></p>
    <p><label for="message_text">Message: <span>*</span> <br><textarea type="text" name="message_text"><?php echo $_POST['message_text']; ?></textarea></label></p>
    <p><label for="message_human">Human Verification: <span>*</span> <br><input type="text" style="width: 60px;" name="message_human"> + 3 = 5</label></p>
    <input type="hidden" name="submitted" value="1">
    <p><input type="submit" id="sub"></p>
  </form>
</div>
              </p>
  
            </div><!-- .entry-content -->
  
          </article><!-- #post -->
  
      <?php endwhile; // end of the loop. ?>
  
    </div><!-- #content -->
  </div><!-- #primary -->
  </body>
  </html>