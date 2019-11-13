importScripts('https://www.gstatic.com/firebasejs/5.8.4/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/5.8.4/firebase-messaging.js');

// Initialize Firebase
var config = {
    messagingSenderId: "185741590134"
};
firebase.initializeApp(config);

const messaging = firebase.messaging();