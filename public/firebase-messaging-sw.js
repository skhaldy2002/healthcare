// Scripts for firebase and firebase messaging
importScripts("https://www.gstatic.com/firebasejs/8.2.0/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/8.2.0/firebase-messaging.js");

// Initialize the Firebase app in the service worker by passing the generated config
const firebaseConfig = {
    apiKey: "AIzaSyD7y2iTKIgm9kSLM5gebmWzPX3u_Xu3LDU",
    authDomain: "healthcare-6e3f4.firebaseapp.com",
    projectId: "healthcare-6e3f4",
    storageBucket: "healthcare-6e3f4.firebasestorage.app",
    messagingSenderId: "1037480178846",
    appId: "1:1037480178846:web:131178374602106f74f78f",
    measurementId: "G-TGQRWC0DHZ"

};

firebase.initializeApp(firebaseConfig);

// Retrieve firebase messaging
const messaging = firebase.messaging();

messaging.onBackgroundMessage(function(payload) {
    console.log("Received background message ", payload);

    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body,
    };

    self.registration.showNotification(notificationTitle, notificationOptions);
});
