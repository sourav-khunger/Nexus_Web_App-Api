var intervalId = window.setInterval(function(){
  /// call your function here
$(function () {
        if ($('#InputFullName').val() != '' && $('#InputActivity').val() != ''&& $('#InputSkills').val() != '' && $('#InputBriefJobHistory').val() != '' && $('#InputOccupation').val() != '' && $('#InputFullName').val() != '') {
            $('#step-2-register').attr('disabled', false);
            $('#step-2-register').css("background-color","black");
        } else {
            $('#step-2-register').attr('disabled', true);
             $('#step-2-register').css("background-color","#999999");
        }
 });
}, 500);