var chat_data = {}, user_uuid, chatHTML = '', chat_uuid = "", userList = [];
	
	
// To send Message //

	 function sendMessageToFirebase(){
			var message = $("#messageToBeSend").val();
			$("#messageToBeSend").val("");
		    var chat_id=localStorage.getItem('chat_id');
			var sender_id=localStorage.getItem('user_id');
			var receiver_id=localStorage.getItem('receiver_id');
			
			 
			if(message != ""){
				db.collection("messages").doc(chat_id)
                 .collection('messages').add({
                    message: message,
                    date: new Date(),
                    image:"irl",
                    sentDate: new Date(),
                    senderId: sender_id,
                    receiverId: receiver_id,
                    status: '0',
                    timeStamp: Date.now(),
                    read: true,
				})
				.then(function(docRef) {
				    console.log("Document written with ID: ", docRef.id);
				})
				.catch(function(error) {
				    console.error("Error adding document: ", error);
				});
			}
}
		
// To get Message //
		var newMessage = '';
		function realTime(chatid,id){
		    var chatid=chatid.toString();
		    var receiver_id=id;
			db.collection('messages').doc(chatid).collection('messages').orderBy('sentDate')
			.onSnapshot(function(snapshot) {
				newMessage = '';
		        snapshot.docChanges().forEach(function(change) {
		            if (change.type === "added") {
		                var unix_timestamp =change.doc.data().timeStamp;
		               var date = new Date(unix_timestamp * 1000);
                        // Hours part from the timestamp
                        var hours = date.getHours();
                        // Minutes part from the timestamp
                        var minutes = "0" + date.getMinutes();
                        // Seconds part from the timestamp
                        var seconds = "0" + date.getSeconds();

                    // Will display time in 10:30:23 format
                        var formattedTime = hours + ':' + minutes.substr(-2);
		                if (change.doc.data().senderId ==receiver_id) {

								newMessage += '<div class="incoming-message"><p>'+ change.doc.data().message +'</p> <span class="time">'+formattedTime+'</span></div>';

							}else{
								newMessage += '<div class="outgoing-message"> <span class="time">'+formattedTime+'</span><p>'+ change.doc.data().message +'</p></div>';
							}
		            }
		            if (change.type === "modified") {
		               
		            }
		            if (change.type === "removed") {
		                
		            }
		        });

		        if (chatHTML != newMessage) {
		        	$('.messages').append(newMessage);
		        }
		        $(".chat-body").scrollTop($(".chat-body")[0].scrollHeight);
		      

		    });
		
}


