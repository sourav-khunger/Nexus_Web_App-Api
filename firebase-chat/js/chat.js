var chat_data = {}, user_uuid, chatHTML = '', chat_uuid = "", userList = [];
	
	
// To send Message //

		$(".send-btn").on('click', function(){
		    
			var message = $(".message-input").val();
			if(message != ""){
				db.collection("messages").doc("5363")
                 .collection('messages').add({
                    message: message,
                    date: new Date(),
                    image:"irl",
                    sentDate: new Date(),
                    senderId: '53',
                    receiverId:'63',
                    status: '0',
                    timeStamp: 1630394749775,
                    read: true,
				})
				.then(function(docRef) {
					$(".message-input").val("");
				    console.log("Document written with ID: ", docRef.id);
				})
				.catch(function(error) {
				    console.error("Error adding document: ", error);
				});
			}


		});
		
// To get Message //

	
		var newMessage = '';
		function realTime(){
			db.collection('messages').doc('5363').collection('messages').orderBy('sentDate')
			.onSnapshot(function(snapshot) {
			    alert('heelloo');
				newMessage = '';
		        snapshot.docChanges().forEach(function(change) {
		            console.log('changedata',change);
		            if (change.type === "added") {
		                
		                console.log(change.doc.data());
		                
		                if (change.doc.data().senderId == '63') {

								newMessage += '<div class="message-block">'+
												'<div class="user-icon"></div>'+
												'<div class="message">'+ change.doc.data().message +'</div>'+
											'</div>';

							}else{
								newMessage += '<div class="message-block received-message">'+
												'<div class="user-icon"></div>'+
												'<div class="message">'+ change.doc.data().message +'</div>'+
											'</div>';
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
		        
		      

		    });
		
}


