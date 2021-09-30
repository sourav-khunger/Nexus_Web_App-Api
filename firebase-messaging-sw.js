importScripts('https://www.gstatic.com/firebasejs/8.9.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.9.1/firebase-messaging.js');

const firebaseConfig = {
  apiKey: "AIzaSyCnK1DLIa5tvjFJWimpvLexSkMB3ZNEmRI",
  authDomain: "nexus-b8e2b.firebaseapp.com",
  databaseURL: "https://nexus-b8e2b-default-rtdb.firebaseio.com",
  projectId: "nexus-b8e2b",
  storageBucket: "nexus-b8e2b.appspot.com",
  messagingSenderId: "455683395406",
  appId: "1:455683395406:web:a6ba356fa8c7dbf745181f",
  measurementId: "G-V75VSBHJ68"
};

firebase.initializeApp(firebaseConfig);
const messaging=firebase.messaging();

messaging.setBackgroundMessageHandler(function (payload) {
  console.log(payload);
    const notification=JSON.parse(payload);
    const notificationOption={
        body:notification.body,
        icon:notification.icon
    };
    return self.registration.showNotification(payload.notification.title,notificationOption);
});
