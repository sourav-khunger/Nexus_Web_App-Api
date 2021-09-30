<!-- The Modal -->
<div class="modal fade" id="Incoming_Call">
  
</div>
<!-- Footer -->
<footer class="bg-light text-center text-lg-start">
    <!-- Copyright -->
    <div class="text-center p-3" style="">
        <div class="row">
            <div class="col-md-6">
                <div class="terms">
                <a class="term" href="">Terms of use</a>
                <a class="privacy" href=""> Privacy policy</a></div>
            </div>
            <div class="col-md-6">
                <div class="contact">
                <a class="SCT" href=""> Commercial </a>
                <a class="contacts" href="">Contact us</a></div>
            </div>
        </div>
        <!--  <div class="TermsandPrivacy">-->
        <!--<a class="termsandcondition" id="termsandcondition" href="">Terms of use</a>-->
        <!-- <a class="Privacypolicy" id="Privacypolicy"  href="">Privacy policy</a></div>-->
        <!--<div class="sct"> <a class="SCT" id-"SCT" href="">Specified Commercial Transaction Act</a>-->
        <!--  <a class="Contact" id="Contact" href="">Contact us</a></div>-->
    </div>
    
<!---- Calling modal--->

<div class="modal fade" id="IncomingCallModal">
  
</div>

<!-------- Review Modal Box ------------>
<div class="modal fade" id="ReviewModal">
    
</div>

<!--------- Review Modal Ends here ----->
    <!-- Copyright -->
</footer>
<!-- Footer -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://www.gstatic.com/firebasejs/5.7.0/firebase-app.js"></script>
	<script src="https://www.gstatic.com/firebasejs/5.7.0/firebase-auth.js"></script>
	<script src="https://www.gstatic.com/firebasejs/5.7.0/firebase-firestore.js"></script>

<script src="assets/js/chat/firestore-config.js"></script>
<script src="assets/js/chat/chat.js"></script>

<script>

var user_id=localStorage.getItem('user_id');

$("textarea").each(function () {
  this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
}).on("input", function () {
  this.style.height = "auto";
  this.style.height = (this.scrollHeight) + "px";
});

</script>
<script>
var social_id ="<?php echo $_SESSION['social_id']; ?>";
var user_id="<?php echo $_SESSION['user_id']; ?>";
localStorage.setItem('user_id',user_id);

getHomedata();
function getHomedata(){
  $.ajax({
            url:'web-api/details/get-user-data.php',
            method:'POST',
            data:{
                user_social_id:social_id
                },
                success:function(response){
                var demo=JSON.parse(response);
                 $("#mini_user_image").attr("src", demo.User_profile_data.user_profile_photo);
                 localStorage.setItem('user_name',demo.User_profile_data.user_name);
                 if(demo.User_profile_data.realtime_talk=='true')
                 {
                  $("#real-talk-toggle").prop('checked', true);  
                 }
                 else{
                  $("#real-talk-toggle").prop('checked', false);  
                 }
                }
});

}





    $(".filter-button").click(function(){
        var value = $(this).attr('data-filter');
        $(this).addClass('active');
        $('.filter-button').removeClass('active');
          $(this).addClass('active');
        if(value == "all")
        {
            $('.filter').show('1000');
            
        }
        else
        {
            $(".filter").not('.'+value).hide('3000');
            $('.filter').filter('.'+value).show('3000');
            
        }
    
    if ($(".filter-button").removeClass("active")) {
$(this).removeClass("active");
}
$(this).addClass("active");

});
</script>
<script>
var intervalId = window.setInterval(function(){
  updateActivityTime();
}, 5000);
var user_id=localStorage.getItem('user_id');
function updateActivityTime(){

  $.ajax({
            url:'web-api/user/update-last-activity-time.php',
            method:'POST',
            data:{
                user_id:user_id
                },
                success:function(data){
               // response check here
                }
                });
  } 


var intervalMeetingStatus = window.setInterval(function(){
  getMeetingStatus();
}, 2000);

var meeting_id=localStorage.getItem('meeting_id');

function getMeetingStatus(){

  $.ajax({
            url:'/web-api/zoom/get-meeting-status.php',
            method:'POST',
            data:{
                meeting_id:meeting_id
                },
                success:function(data){
                 var meeting=JSON.parse(data);
                 if(meeting.meeting_status=='on_call')
                    {
                    var status='done';
                    var jsonData = JSON.stringify({"status":status, "meeting_id":meeting_id});
                    $.ajax({
                    type: "POST",
                    url: "web-api/zoom/update-meeting-status.php",
                    data: jsonData,
                    dataType: "json",
                    contentType: "application/json",
                    success: function (response) {
                    }
             }); 
            var urls=localStorage.getItem('join_url');
            window.location = urls;
            }
        }
        });
        
        
                

    var join_url= localStorage.getItem('joinUrl');
  } 

  
  
function hideCallPopup(data){
 $("#IncomingCallModal").modal('hide');
 $("#IncomingCallModal").removeClass('show');
 $('body').removeClass('modal-open');
 $('.modal-backdrop').remove();
}
  
  
function CallPopup(data){
 var user_id=data;
 $("#IncomingCallModal").load('ajax/incoming-call-modal-ajax.php?user_id='+user_id);
 $("#IncomingCallModal").modal('show');
 $("#IncomingCallModal").addClass('show');
 $('body').addClass('modal-open');
 $('.modal-backdrop').add();
var minute = 4;
var sec = 59;
var destroy=true;

var call_time=setInterval(function () {
    if(destroy){
               document.getElementById("zoom_timer").innerHTML =
                  minute + " : " + sec;
               sec--;
            
               if (sec == 00) {
                  minute--;
                  sec = 60;
                  if (minute == 0) {
                     sec = 60;
                     destroy=false;
         }
    }
}
else{
 $("#IncomingCallModal").modal('hide');
 $("#IncomingCallModal").removeClass('show');
 $('body').removeClass('modal-open');
 $('.modal-backdrop').remove();
}
}, 1000);
     
}

function rejectCall(id){
   
    var meeting_id=localStorage.getItem('meeting_id');
    var status='rejected';
    var reciever_id=id;
    var sender_id=localStorage.getItem('user_id');
    var jsonData = JSON.stringify({"sender_id":sender_id,"reciever_id": reciever_id,"status":status, "meeting_id":meeting_id});
    $.ajax({
            type: "POST",
            url: "web-api/zoom/update-meeting-status.php",
            data: jsonData,
            dataType: "json",
            contentType: "application/json",
            success: function (response) {
                console.log(response);
             if(response.success==1)
             {
                $("#IncomingCallModal").modal('hide');
                $("#IncomingCallModal").removeClass('show');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
               // clearInterval(call_time);
             }
        }
    }); 
 
}

function acceptCall(id){
   
    var meeting_id=localStorage.getItem('meeting_id');
    var status='on_call';
    var reciever_id=id;
    var sender_id=localStorage.getItem('user_id');
    var jsonData = JSON.stringify({"sender_id":sender_id,"reciever_id": reciever_id,"status":status, "meeting_id":meeting_id});
    $.ajax({
            type: "POST",
            url: "web-api/zoom/update-meeting-status.php",
            data: jsonData,
            dataType: "json",
            contentType: "application/json",
            success: function (response) {
            
             if(response.success==1)
             {
                $("#IncomingCallModal").modal('hide');
                $("#IncomingCallModal").removeClass('show');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
              
              var url=localStorage.getItem('join_url');
      
     //window.location = url;
             }
        }
    });
       
    
  
    
 
}

$(".chat-open").click(function (e) { 
    e.preventDefault();
    $("#chatbox").toggleClass("chatbox-hide");
    $("#chatbox").load('ajax/get-chat-list.php');
});

function openChat(chatid,id){
var receiver_id=id;
$("#chatbox").load('ajax/get-user-chat.php?receiver_id='+receiver_id);
localStorage.setItem('chat_id',chatid);
localStorage.setItem('receiver_id',receiver_id);
realTime(chatid,id);
}




</script>

<script>
function giveReview(){
    
 $("#ReviewModal").modal('show');
 $("#ReviewModal").addClass('show');
 $('body').addClass('modal-open');
 $('.modal-backdrop').add(); 
    
}

function saveReview(){
    
 $("#ReviewModal").modal('hide');
 $("#ReviewModal").addClass('hide');
 $('body').removeClass('modal-open');
 $('.modal-backdrop').remove(); 
 
}

</script>


</body>
<?php include_once ('firebase-notification/set.html'); ?>
</html>