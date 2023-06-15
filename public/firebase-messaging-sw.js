import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
const firebaseConfig = {
    apiKey: "AIzaSyAhixKv2Ah_QXF96gOUF2zxpoec2JFhsPg",
    authDomain: "rubishback.firebaseapp.com",
    projectId: "rubishback",
    storageBucket: "rubishback.appspot.com",
    messagingSenderId: "163284422021",
    appId: "1:163284422021:web:1b14da1eee2698000608ec",
    measurementId: "G-SLEPT38EC0"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);
