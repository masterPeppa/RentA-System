$(document).ready(function(){
    // when back button inside the chat area is clicked
    $(".btn-back-inside").click(function(){
        window.location.href = "messages.php";
    });
    let emailRequestExecuted = false;
    $("#btn_sendMessage").click(function(){
       $.ajax({
        url:"Functions/sendMessageFunction.php",
        method:"POST",
        data:{
            sender: $("#userSender").val(),
            receiver: $("#userReceiver").val(),
            message: $("#userMessages").val(),
            identification: $("#identification").val()
        },
        dataType:"text",
        success:function(data){
            $("#userMessages").val("");
            setTimeout(function() {
                scrollToBottom();
            }, 700);
            if (!emailRequestExecuted) {
                $.ajax({
                    url:"Functions/sendingmessageEmail.php",
                    method:"POST",
                    data:{
                        receiver: $("#userReceiver").val()
                    },
                    dataType:"text"
                });
                emailRequestExecuted = true;
            }
        }
       });
    });

    $('#userMessages').on('keyup', function (event) {
        if(event.keyCode === 13){
            $('#btn_sendMessage').click();
        }
      });
  });