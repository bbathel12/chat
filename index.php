<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="/chat/scripts.js"></script>
  <link rel="stylesheet" href="/chat/chat.css">
  <?php
    ini_set('display_errors',1);
    session_start();
    $logged_in = isset($_SESSION['logged_in']) ? true : false ;
    
    //connection
    include('connection.php');
    
    
    //include('login.php');
      if(isset($_POST['username']) && isset($_POST['pwd'])){
      $user_query = "select * from users where first_name='".$_POST['username']."' and password='".$_POST['pwd']."'";
      $user = mysqli_query($con,$user_query);
      $user = mysqli_fetch_row($user);
      if($user != 0){
        $_SESSION['logged_in'] = $logged_in = true;
        $_SESSION['user_name'] = ucfirst($user[2]);
        $_SESSION['user_id'] = $user[0];
      }
    }
    
    
      
    
  ?>
</head>
<body>

<?php if ($logged_in == false){ ?>
  <fieldset><legend>Login</legend>
    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
      <label>User Name: <input type="text" name=username></label>
      <label>Password: <input type="password" name=pwd></label>
      <input type="submit" value="Login">
    </form>
  </fieldset>
<?php }else { include('nav.php'); ?>
  <fieldset><legend>Welcome to Chat <?php  echo $_SESSION['user_name'];?> </legend>
  
  <div id="chatbox"><div>
    
  </div><div id="end"></div>
</div>
  
  <form id=ChatForm method=get action="add_chat.php">
    <input type=text name="message">
    <input type=hidden name="user_id" value=1>
    <input type=submit value="Send >>>">
  </form></fieldset>
  
  <script>
  $(document).ready(function(){
    var chatbox = $("#chatbox");
    $("#ChatForm").submit(function(event){event.preventDefault();sendchat(<?php echo $_SESSION['user_id'];?>)})
    setInterval(updateChat,5000);
  })
  </script>
  <style>
    span.<?php echo strtolower($_SESSION['user_name']);?>{
      background-color:rgba(0,255,255,1);
      float:right;
    }
  </style>
  </style>
<?php }?>


</body>

</html>

