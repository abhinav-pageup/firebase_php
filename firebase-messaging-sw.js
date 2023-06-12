importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

firebase.initializeApp({
    apiKey: "AIzaSyDXcSp0YADUykDxfN9sUlA5p0dzroNtFgY",
    authDomain: "php-firebase-c5742.firebaseapp.com",
    projectId: "php-firebase-c5742",
    storageBucket: "php-firebase-c5742.appspot.com",
    messagingSenderId: "1013350745500",
    appId: "1:1013350745500:web:a880fe3ca7478d0d367459",
    measurementId: "G-E7YDHTJ7FG"
});

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (data) {
    return self.registration.showNotification(data.data.title, { body: data.data.body, icon: data.data.icon, click_action: data.data.click_action });
});