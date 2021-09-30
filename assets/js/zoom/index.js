var testTool = window.testTool;
var API_KEY = "xKdY9pm_Q6-WlXzejHB05w";
var API_SECRET = "tAKSPlBfVTz5P8AJzS6TjcWzHFsGbnATjDZ5";
// click join meeting button
function createMeeting(){
    var meetingConfig = testTool.getMeetingConfig();
    meetingConfig.name='vaibhav';
    meetingConfig.mn='89018193159';
    meetingConfig.pwd='12345';
      if (!meetingConfig.mn || !meetingConfig.name) {
        alert("Meeting number or username is empty");
        return false;
      }

      
     // testTool.setCookie("meeting_number", '89018193159');
      //testTool.setCookie("meeting_pwd", '12345');

      var signature = ZoomMtg.generateSignature({
        meetingNumber: meetingConfig.mn,
        apiKey: API_KEY,
        apiSecret: API_SECRET,
        role: 0,
        success: function (res) {
          console.log(res.result);
          meetingConfig.signature = res.result;
          meetingConfig.apiKey = API_KEY;
          var joinUrl = "/zoom_status/CDN/meeting.html?" + testTool.serialize(meetingConfig);
          console.log(joinUrl);
},
});
}


    


