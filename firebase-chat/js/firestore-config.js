// Initialize Firebase
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const config = {
  apiKey: "AIzaSyCnK1DLIa5tvjFJWimpvLexSkMB3ZNEmRI",
  authDomain: "nexus-b8e2b.firebaseapp.com",
  databaseURL: "https://nexus-b8e2b-default-rtdb.firebaseio.com",
  projectId: "nexus-b8e2b",
  storageBucket: "nexus-b8e2b.appspot.com",
  messagingSenderId: "455683395406",
  appId: "1:455683395406:web:a6ba356fa8c7dbf745181f",
  measurementId: "G-V75VSBHJ68"
};

firebase.initializeApp(config);

// Initialize Cloud Firestore through Firebase
var db = firebase.firestore();

// Disable deprecated features
db.settings({
	timestampsInSnapshots: true
});