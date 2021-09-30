<?php $page="home"; ?>
<?php 
include_once('template-parts/header.php'); 
      include_once('web-api/details/get-all-real-time-talk-user.php');
      include_once('web-api/details/get-all-talk-later-users.php');
    
      ?>
<section id="home-page">
<div class="container-fluid realtime">
<div class="row realtime-heading">
<div class="col-md-4">
</div>
<div class="col-md-4">
    <h3 class="title">Realtime Talk</h3>
</div>
<div class="col-md-4 d-flex">
       <label class="annony">Show yourself in Realtime Talk</label>
<div class="custom-control custom-switch">
 
  <input type="checkbox" class="custom-control-input home" id="real-talk-toggle">
  <label class="custom-control-label" for="real-talk-toggle"></label>
</div>
</div>
</div>
<div id="content-real">
<?
$total_realtime_users=sizeof($realtime_users);
$count=0;
 for($i=0; $i<$total_realtime_users; $i++)
 {
     if($i%3==0)
     {
         echo ' <div class="row card-row">';
     }
     $count++; 
?>

    <div class="col-md-4 blogBox moreBox filter  <?php 
    
    for($j=0; $j<sizeof($realtime_users[$i]->User_purposes);$j++){   echo " ".$realtime_users[$i]->User_purposes[$j][purpose][purpose_id];  } ?> ">
    <div class="user-card simple">
    <div class="header-section">
    <img class="cover" src="/assets/images/home/cover.png">
    <img class="avtar-profile" <?php if(!empty($realtime_users[$i]->user_profile_data[user_profile_photo])){ echo 'src='.$realtime_users[$i]->user_profile_data[user_profile_photo]; } else echo 'src="/assets/images/home/user.png"'; ?>>
    <span class="user-online"><img class="online" src="/assets/images/home/online.png" />Online</span>
    </div>
    <div class="sub-header-section">
      <h4 class="name"><?php echo $realtime_users[$i]->user_profile_data[user_name]?$realtime_users[$i]->user_profile_data[user_name]:""; ?></h4> 
      <div class="social-icons">
          <a href="<?php echo $realtime_users[$i]->user_profile_data[facebook]?$realtime_users[$i]->user_profile_data[facebook]:""; ?>" class="social-link"><img clas="social-icon" src="/assets/images/home/fb.png" /></a>
          <a href="<?php echo $realtime_users[$i]->user_profile_data[twitter]?$realtime_users[$i]->user_profile_data[twitter]:""; ?>" class="social-link"><img clas="social-icon" src="/assets/images/home/twitter.png" /></a>
          <a href="<?php echo $realtime_users[$i]->user_profile_data[instagram]?$realtime_users[$i]->user_profile_data[instagram]:""; ?>" class="social-link"><img clas="social-icon" src="/assets/images/home/insta.png" /></a>
    </div>
    <div id="activity"><h6 class="activity-area"><?php echo $realtime_users[$i]->user_profile_data[user_activity_area]?$realtime_users[$i]->user_profile_data[user_activity_area]:""; ?></h6></div>
    <h6 class="work-status"><span id="occupation"><?php echo $realtime_users[$i]->user_profile_data[occupation]?$realtime_users[$i]->user_profile_data[occupation]:""; ?></span> / <span id="company_name"><?php echo $realtime_users[$i]->user_profile_data[company_name]?$realtime_users[$i]->user_profile_data[company_name]:""; ?></span></h6>
    </div>
    <div class="card-skills">
    <h6 class="parent-skills">Skills：Engineering</h6>
    <div class="children-skills"><span>IOS/ Android developer</span></div>
    <div class="sub-children-skills"><span>Children</span></div>
    </div>
    <div class="user-card-footer">
        <button onclick="getUserPopupdetails(this.id)" id="<?php echo $realtime_users[$i]->user_profile_data[user_id]; ?>" class="btn on user-card-button" data-toggle="" data-target=""  >Talk Now</button>
    </div>
    </div>
    </div>
    <?php if($count%3==0)
     {
         echo ' </div>';
     } ?>
  <?php } ?>  
  </div>
  <div class="see-more filter"><a class="underline_link">see more</a></div>
</div>

<!------------- talk later ---------------------->

<div class="container-fluid talklater">
<div class="row taklklater-heading">

<div class="col text-center">
    <h3 class="title">Talk later</h3>
</div>

</div>

<?  
$total_realtime_users=sizeof($talk_later_users);
$datas=json_encode($talk_later_users);
echo '<script>console.log('.$datas.')</script>';
$cnt=0;
 for($i=0; $i<$total_realtime_users; $i++)
 {
     if($i%3==0)
     {
         echo ' <div class="row card-row">';
     }
     $cnt++;

?>

    <div class="col-md-4 filter <?php 
    
    for($j=0; $j<sizeof($talk_later_users[$i]->User_purposes);$j++){   echo " ".$talk_later_users[$i]->User_purposes[$j][purpose][purpose_id];  } ?>">
    <div class="user-card simple">
    <div class="header-section">
    <img class="cover" <?php if(!empty($talk_later_users[$i]->user_profile_data[user_background_photo])){ echo 'src='.$talk_later_users[$i]->user_profile_data[user_background_photo]; } else echo 'src="/assets/images/home/cover.png"'; ?>>
     <img class="avtar-profile" <?php if(!empty($talk_later_users[$i]->user_profile_data[user_profile_photo])){ echo 'src='.$talk_later_users[$i]->user_profile_data[user_profile_photo]; } else echo 'src="/assets/images/home/user.png"'; ?>>
    </div>
    <div class="sub-header-section">
      <h4 class="name"><?php echo $talk_later_users[$i]->user_profile_data[user_name]?$talk_later_users[$i]->user_profile_data[user_name]:"Not Available"; ?></h4> 
      <div class="social-icons">
          <a href="<?php echo $talk_later_users[$i]->user_profile_data[facebook]?$talk_later_users[$i]->user_profile_data[facebook]:"#"; ?>" class="social-link"><img clas="social-icon" src="/assets/images/home/fb.png" /></a>
          <a href="<?php echo $talk_later_users[$i]->user_profile_data[instagram]?$talk_later_users[$i]->user_profile_data[instagram]:"#"; ?>" class="social-link"><img clas="social-icon" src="/assets/images/home/twitter.png" /></a>
          <a href="<?php echo $talk_later_users[$i]->user_profile_data[twitter]?$talk_later_users[$i]->user_profile_data[twitter]:"#"; ?>" class="social-link"><img clas="social-icon" src="/assets/images/home/insta.png" /></a>
    </div>
    <div id="activity"><h6 class="activity-area"><?php echo $talk_later_users[$i]->user_profile_data[user_activity_area]?$talk_later_users[$i]->user_profile_data[user_activity_area]:"Not Available"; ?></h6></div>
    <h6 class="work-status"><span id="occupation"><?php echo $talk_later_users[$i]->user_profile_data[occupation]?$talk_later_users[$i]->user_profile_data[occupation]:"Not Available"; ?></span> / <span id="company_name"><?php echo $talk_later_users[$i]->user_profile_data[company_name]?$talk_later_users[$i]->user_profile_data[company_name]:"Not Available"; ?></span></h6>
    </div>
    <div class="card-skills">
    <h6 class="parent-skills">Skills：Engineering</h6>
    <div class="children-skills"><span>IOS/ Android developer</span></div>
    <div class="sub-children-skills"><span>Children</span></div>
    </div>
    <div class="user-card-footer">
        <button class="btn on user-card-button" id="<?php echo$talk_later_users[$i]->user_profile_data[user_id]; ?>" onclick="talkLaterRequest(this.id)">Talk Later</button>
    </div>
    </div>
    </div>
    <?php if($cnt%3==0)
     {
         echo ' </div>';
     } ?>
  <?php } ?>  
  <!--<div class="see-more" id="loadMore"><a class="underline_link">see more</a></div>-->
</div>
</section>

<!---- Calling modal--->

<div class="modal fade" id="callingModal">
  
</div>



<!-- The Profile-View_model -->
<div class="modal fade" id="ProfileModal">
  
</div>

<!----- Hide User ------------>




<div class="modal fade modal-box-my" id="Calling" tabindex="-1" role="dialog" aria-labelledby="Calling" aria-hidden="true">
    

  
  
</div>
<?php include_once('template-parts/footer.php'); ?>
<script src="assets/js/toast/jquery.toast.js"></script>
<script>
function cancleCall(id){
    var meeting_id=localStorage.getItem('meeting_id');
    
    var status='cencel';
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
                $("#Calling").modal('hide');
                $("#Calling").removeClass('show');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
             }
        }
    }); 
 
}

function callUser(id){
  
 var sender_id=localStorage.getItem('user_id');
 var receiver_id=id;
 var meeting_status='calling';
 var jsonData = JSON.stringify({"sender_id":sender_id,"receiver_id": receiver_id,"meeting_status":meeting_status});
    $.ajax({
            type: "POST",
            url: "web-api/zoom/create-meeting.php",
            data: jsonData,
            dataType: "json",
            contentType: "application/json",
            success: function (response) {
             if(response.success==1)
             {
                 
                localStorage.setItem('meeting_id',response.meeting_data.meeting_id);
                $("#ProfileModal").modal('hide');
                $("#ProfileModal").removeClass('show');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();  
                $("#Calling").load('ajax/calling-modal-ajax.php?user_id='+id);   
                $("#Calling").modal('show');
                $("#Calling").addClass('show');
                $('body').addClass('modal-open');
                $('.modal-backdrop').add();
                
                var meeting_id=localStorage.getItem('meeting_id');
                alert(meeting_id);
                var senddata = JSON.stringify({"meeting_id":meeting_id});
                $.ajax({
                type: "POST",
                url: "web-api/zoom/meeting/index.php",
                data: senddata,
                dataType: "json",
                success: function (response) {
                  
                    }
            });

                
             
             }
        }
}); 
  
var join_url= localStorage.getItem('joinUrl');
}



function hideUser(id){
$("#ProfileModal").modal('hide');
 $("#ProfileModal").removeClass('show');
 $('body').removeClass('modal-open');
 $('.modal-backdrop').remove();
}
    
</script>
<script>
$(document).ready(function(){
var user_id=localStorage.getItem('user_id');
getRealTimeUsers();
function getRealTimeUsers(){
  $.ajax({
            url:'web-api/details/get-all-real-time-talk-user.php',
            method:'POST',
            data:{
                user_id:user_id
                },
                success:function(data){
                }
                });
}
$("#real-talk-toggle").click(function (e) { 
    
 if($(this).prop("checked") == true){
    status='true';  
    msg='Realtime mode turned ON.';
    }
    else if($(this).prop("checked") == false){
    status='false';
    msg='Realtime mode turned OFF.';
    }
  $.ajax({
            url:'web-api/user/update-realtime-talk-status.php',
            method:'POST',
            data:{
                user_id:user_id,
                status:status
                },
                success:function(data){
                   $.toast({
            heading: 'Dear User',
            text: msg,
            position: 'top-right',
            loaderBg: 'black',
            bgColor:'#FF3A99',
            icon: 'success',
            textColor: '#FFFF',
            hideAfter: 3000,
            stack: 6
        });
                }
                });
});




 
});

function talkLaterRequest(id)
{
    var receiver_id=id;
    
    var user_id=localStorage.getItem('user_id');
     
    $.ajax({
            url:'web-api/matches/talk-later-match.php',
            method:'POST',
            data:{
                user_id:user_id,
                receiver_id:receiver_id
                },
            success: function (response) {
              // response check here
              var result=JSON.parse(response);
                $.toast({
            heading: 'Dear User',
            text: result.message,
            position: 'top-right',
            loaderBg: 'black',
            bgColor:'#FF3A99',
            icon: 'success',
            textColor: '#FFFF',
            hideAfter: 3000,
            stack: 6
        });
                }
            });
      
}

$( document ).ready(function () {
		$(".moreBox").slice(0, 3).show();
		if ($(".blogBox:hidden").length != 0) {
			$("#loadMore").show();
		}		
		$("#loadMore").on('click', function (e) {
			e.preventDefault();
			$(".moreBox:hidden").slice(0, 6).slideDown();
			if ($(".moreBox:hidden").length == 0) {
				$("#loadMore").fadeOut('slow');
			}
		});
	});
  
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
var pushToken = localStorage.getItem("pushtoken");
$.ajax({
        url:'web-api/user/savePushToken.php',
        method:'POST',
        data:{
             pushToken: pushToken
              },
            success: function (response) {
              // response check here
            console.log(response);
                }
            });
</script>
<script>
function getUserPopupdetails(data){
 var user_id=data;
 $("#ProfileModal").load('ajax/user-modal-ajax.php?user_id='+user_id);
 $("#ProfileModal").modal('show');
 $("#ProfileModal").addClass('show');
 $('body').addClass('modal-open');
 $('.modal-backdrop').add();
}
</script>