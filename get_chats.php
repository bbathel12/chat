<div id="Chats">
    
     
        <?php
          ini_set('display_errors',1);
          include('connection.php');
          $count_query = "SELECT COUNT(message) FROM chats";
          $chat_count = mysqli_query($con,$count_query );
          $chat_count = mysqli_fetch_row($chat_count);
          //echo "count".$chat_count[0]."<br>";
          $start = $chat_count[0]-100 > 0 ? $chat_count[0]-100 : 0;
          //echo "Start $start<br>";
          $end = $chat_count[0];
          //echo "End $end<br>";
          
          //Gets 1000 latest chats
          $get_chats = "select  users.user_name, chats.message, chats.Id,chats.CreatedOn from chats inner join users on chats.ownerId=users.Id order by chats.Id limit ".$start.",".$end;
          
          //Gets chats from up to two seconds ago
          /*
          $start = strtotime('-1 seconds');
          $start =  date('Y-m-d G:i:s', $start);
          $end = date('Y-m-d G:i:s');
          $get_chats = "select users.user_name, chats.message, chats.Id, chats.CreatedOn from chats inner join users on chats.ownerId=users.Id where chats.CreatedOn between '$start' and '$end' order by chats.Id";
          */
          
          $result = mysqli_query($con,$get_chats);
          
           while( $rows = mysqli_fetch_array($result)){
            echo "<div class='message_holder'><span class='message $rows[0]'>".$rows[0].": ".$rows[1]."</span></div>";
           }
          
        
        ?>
    
</div>