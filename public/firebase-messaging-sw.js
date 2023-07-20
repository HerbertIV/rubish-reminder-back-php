importScripts("https://www.gstatic.com/firebasejs/7.8.2/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/7.8.2/firebase-messaging.js");
let config = {
    apiKey: "AIzaSyAhixKv2Ah_QXF96gOUF2zxpoec2JFhsPg",
    authDomain: "rubishback.firebaseapp.com",
    projectId: "rubishback",
    storageBucket: "rubishback.appspot.com",
    messagingSenderId: "163284422021",
    appId: "1:163284422021:web:1b14da1eee2698000608ec",
    // measurementId: "G-SLEPT38EC0"
};

!firebase.apps.length ? firebase.initializeApp(config) : firebase.app();

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (payload) {
    console.log(' Received background message ', payload);
    let title = 'Recipe PWA',
        options = {
            body: "New Recipe Alert",
            icon: "https://raw.githubusercontent.com/idoqo/laravel-vue-recipe-pwa/master/public/recipe-book.png"
        };
    return self.registration.showNotification(
        title,
        options
    );
});
