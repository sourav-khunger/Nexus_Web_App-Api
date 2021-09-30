window.addEventListener('DOMContentLoaded', function(event) {
  console.log('DOM fully loaded and parsed');
  websdkready();
});

function websdkready() {
  var testTool = window.testTool;
  if (testTool.isMobileDevice()) {
    vConsole = new VConsole();
  }
  console.log("checkSystemRequirements");
  console.log(JSON.stringify(ZoomMtg.checkSystemRequirements()));

  // it's option if you want to change the WebSDK dependency link resources. setZoomJSLib must be run at first
  // if (!china) ZoomMtg.setZoomJSLib('https://source.zoom.us/1.9.7/lib', '/av'); // CDN version default
  // else ZoomMtg.setZoomJSLib('https://jssdk.zoomus.cn/1.9.7/lib', '/av'); // china cdn option
  // ZoomMtg.setZoomJSLib('http://localhost:9999/node_modules/@zoomus/websdk/dist/lib', '/av'); // Local version default, Angular Project change to use cdn version
  ZoomMtg.preLoadWasm(); // pre download wasm file to save time.

  var API_KEY = "xKdY9pm_Q6-WlXzejHB05w";

  /**
   * NEVER PUT YOUR ACTUAL API SECRET IN CLIENT SIDE CODE, THIS IS JUST FOR QUICK PROTOTYPING
   * The below generateSignature should be done server side as not to expose your api secret in public
   * You can find an eaxmple in here: https://marketplace.zoom.us/docs/sdk/native-sdks/web/essential/signature
   */
  var API_SECRET = "tAKSPlBfVTz5P8AJzS6TjcWzHFsGbnATjDZ5";
  var meeting_id=localStorage.getItem('meeting_id');
  var name=localStorage.getItem('user_name');
  // click join meeting button

 function generateMeetingUrl()
 {
      var meetingConfig = testTool.getMeetingConfig();
      meetingConfig.name=testTool.b64EncodeUnicode(name);
      meetingConfig.mn=meeting_id;
      var signature = ZoomMtg.generateSignature({
        meetingNumber: meetingConfig.mn,
        apiKey: API_KEY,
        apiSecret: API_SECRET,
        role: meetingConfig.role,
        success: function (res) {
          meetingConfig.signature = res.result;
          meetingConfig.apiKey = API_KEY;
          var joinUrl = "web-api/zoom/meeting/meeting.html?" + testTool.serialize(meetingConfig);
          localStorage.setItem('joinUrl',joinUrl);
          
        },
      });
    }
    
 }
