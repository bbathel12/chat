    var updateChat = function(data){
    // gets json from get_chats.php sends the last chat id updated on the page.
      if (data != -1) {
          messages = JSON.parse(data);
          var message=""
          for(var number in messages) {
            console.log(number)
            message += '<div class="message_holder"><span class="message ' + messages[number]['username']+ '">' + messages[number]['username']+'('+messages[number]['time'].substring(12,16)+'):'+ messages[number]['message']+'</span></div>'
            window.lastMessageNumber +=1
          }
          $(message).insertBefore($('#ChatBox div#end'))
      }
      
    }
    
    /*
     *!!!!!!!!message format
     *<div class="message_holder">
     *  <span class="message amber">
     *    amber: Yeah, I guess you just pick one that you like or one that has special meaning
     *  </span>
     * </div>
     *
     *!!!!!!!!Data format
     *"603":{"username":"brice","message":"Amber are you a fucking cop","chatId":603,"time":"2015-08-05 14:57:26"}
     * 
    */
    //$("#chatbox div").load("/chat/get_chats.php #Chats");
    //$('#chatbox').scrollTop($('#chatbox div').height())
  
  
  var sendchat = function(user_id){
    if ($('#ChatForm input[type=text]').val().length > 0) {
      new_chat = {"user_id":user_id,"message" : $('#ChatForm input[type=text]').val() }
      $('#ChatForm input[type=text]').val("");
      $.get('/chat/add_chat.php',new_chat);
      $.get("/chat/get_chats.php?lastMessage="+lastMessageNumber,function(data){message = data;updateChat(data)})
    }
  }
  
  