// // Get registration token. Initially this makes a network call, once retrieved
// // subsequent calls to getToken will return from cache.
// messaging.getToken({ vapidKey: 'BKoLVbXMo4XwKPN7KC-yjKXILh277OSFUqdmrZ8Kg_lfI0fzEmVoch9OqP3gVgHM1LFYIHVivugtJtnlw9Xh3hs' }).then((currentToken) => {
//   if (currentToken) {
//     // Send the token to your server and update the UI if necessary
//     // ...
//   } else {
//     // Show permission request UI
//     console.log('No registration token available. Request permission to generate one.');
//     // ...
//   }
// }).catch((err) => {
//   console.log('An error occurred while retrieving token. ', err);
//   // ...
// });



/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/

importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js');

/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/
firebase.initializeApp({
    apiKey: "AIzaSyBbigY7kCCqmeAFRlSd61gKAbSK3ZLrfh8",
    authDomain: "testfcm-f527f.firebaseapp.com",
    projectId: "testfcm-f527f",
    storageBucket: "testfcm-f527f.appspot.com",
    messagingSenderId: "1037124914195",
    appId: "1:1037124914195:web:c7d39eaa651ab3dc91c3e6",
    measurementId: "G-ZRVJLDJB9Y"
});

/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
  console.log(
    "[firebase-messaging-sw.js] Received background message ",
    payload,
  );
  /* Customize notification here */
  const notificationTitle = "Background Message Title";
  const notificationOptions = {
    body: "Background Message body.",
    icon: "/itwonders-web-logo.png",
  };

  return self.registration.showNotification(
    notificationTitle,
    notificationOptions,
  );
});