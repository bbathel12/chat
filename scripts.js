    var updateChat = function(){
    //$.get("/chat/get_chats.php",function(data){$("#chatbox div").append(data)})
    $("#chatbox div").load("/chat/get_chats.php #Chats");
    //$('#chatbox').scrollTop($('#chatbox div').height())
  }
  
  var sendchat = function(user_id){
    if ($('#ChatForm input[type=text]').val().length > 0) {
      new_chat = {"user_id":user_id,"message" : $('#ChatForm input[type=text]').val() }
      $('#ChatForm input[type=text]').val("");
      $.get('/chat/add_chat.php',new_chat);
      updateChat();
      
    }
  }