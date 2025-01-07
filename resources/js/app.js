


import './bootstrap';
import {initializeApp} from "firebase/app";
import {getMessaging, getToken, onMessage} from "firebase/messaging";


const firebaseConfig = {
    apiKey: "AIzaSyD7y2iTKIgm9kSLM5gebmWzPX3u_Xu3LDU",
    authDomain: "healthcare-6e3f4.firebaseapp.com",
    projectId: "healthcare-6e3f4",
    storageBucket: "healthcare-6e3f4.firebasestorage.app",
    messagingSenderId: "1037480178846",
    appId: "1:1037480178846:web:131178374602106f74f78f",
    measurementId: "G-TGQRWC0DHZ"
};



const app = initializeApp(firebaseConfig);

const messaging = getMessaging(app);

function startFCM() {
    Notification.requestPermission()
        .then(function () {
            return getToken(messaging);
        })
        .then(function (response) {
            axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            axios.post('/store-token', {fcm_token: response}).then(function (response) {

                if (response.data.status){
                    console.log("response.data.fcm_token",response.data.fcm_token)
                }
                window.localStorage.setItem('fcm_token', response.data.fcm_token);
            })

        }).catch(function (error) {
        console.log("ss",error)
    });
}
// Assuming toastr is already included for showing notification alerts
onMessage(messaging, (payload) => {
    console.log("payload.data", payload);

    // Show a toast notification
    toastr.success(payload.data.title);

    // Append the new notification to the notification list
    appendNotification(payload.data);

    // Update the notification count
    updateNotificationCount();
});

function appendNotification(notificationData) {
    // Get the notifications list container
    let notificationsList = document.querySelector('.kt_topbar_notifications_1_scroll');

    // Create a new notification item
    let notificationItem = document.createElement('div');
    notificationItem.classList.add('d-flex', 'flex-stack', 'py-4');

    // Build the notification item content (similar to what you already have in the Blade template)
    notificationItem.innerHTML = `
        <div class="d-flex align-items-center">
            <div class="symbol symbol-35px me-4">
                <span class="symbol-label bg-light-primary">
                    <span
                                                                                class="svg-icon svg-icon-2 svg-icon-primary">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<svg xmlns="http://www.w3.org/2000/svg"
                                                                                     width="24" height="24"
                                                                                     viewBox="0 0 24 24" fill="none">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<path opacity="0.3"
                                                                                          d="M11 6.5C11 9 9 11 6.5 11C4 11 2 9 2 6.5C2 4 4 2 6.5 2C9 2 11 4 11 6.5ZM17.5 2C15 2 13 4 13 6.5C13 9 15 11 17.5 11C20 11 22 9 22 6.5C22 4 20 2 17.5 2ZM6.5 13C4 13 2 15 2 17.5C2 20 4 22 6.5 22C9 22 11 20 11 17.5C11 15 9 13 6.5 13ZM17.5 13C15 13 13 15 13 17.5C13 20 15 22 17.5 22C20 22 22 20 22 17.5C22 15 20 13 17.5 13Z"
                                                                                          fill="black"/>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<path
                                                                                        d="M17.5 16C17.5 16 17.4 16 17.5 16L16.7 15.3C16.1 14.7 15.7 13.9 15.6 13.1C15.5 12.4 15.5 11.6 15.6 10.8C15.7 9.99999 16.1 9.19998 16.7 8.59998L17.4 7.90002H17.5C18.3 7.90002 19 7.20002 19 6.40002C19 5.60002 18.3 4.90002 17.5 4.90002C16.7 4.90002 16 5.60002 16 6.40002V6.5L15.3 7.20001C14.7 7.80001 13.9 8.19999 13.1 8.29999C12.4 8.39999 11.6 8.39999 10.8 8.29999C9.99999 8.19999 9.20001 7.80001 8.60001 7.20001L7.89999 6.5V6.40002C7.89999 5.60002 7.19999 4.90002 6.39999 4.90002C5.59999 4.90002 4.89999 5.60002 4.89999 6.40002C4.89999 7.20002 5.59999 7.90002 6.39999 7.90002H6.5L7.20001 8.59998C7.80001 9.19998 8.19999 9.99999 8.29999 10.8C8.39999 11.5 8.39999 12.3 8.29999 13.1C8.19999 13.9 7.80001 14.7 7.20001 15.3L6.5 16H6.39999C5.59999 16 4.89999 16.7 4.89999 17.5C4.89999 18.3 5.59999 19 6.39999 19C7.19999 19 7.89999 18.3 7.89999 17.5V17.4L8.60001 16.7C9.20001 16.1 9.99999 15.7 10.8 15.6C11.5 15.5 12.3 15.5 13.1 15.6C13.9 15.7 14.7 16.1 15.3 16.7L16 17.4V17.5C16 18.3 16.7 19 17.5 19C18.3 19 19 18.3 19 17.5C19 16.7 18.3 16 17.5 16Z"
                                                                                        fill="black"/>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</svg>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</span>
                </span>
            </div>
            <div class="mb-0 me-2">
                <a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bolder">${notificationData.title}</a>
            </div>
        </div>
        <span class="badge badge-light fs-8">${notificationData.created_at}</span>
    `;

    // Append the new notification item to the notifications list
    notificationsList.insertBefore(notificationItem, notificationsList.firstChild);
}

function updateNotificationCount() {
    // Get the current notification count
    let notificationCountElement = document.getElementById('count_notifications');
    let currentCount = parseInt(notificationCountElement.innerText) || 0;

    // Increment the notification count
    notificationCountElement.innerText = currentCount + 1;

    // Add class to highlight if there's a new notification
    notificationCountElement.classList.add('count_notifications');
}

if (!window.localStorage.getItem('fcm_token') || window.localStorage.getItem('fcm_token') == 'undefined' ) {
    startFCM();
}



function requestPermission() {
    Notification.requestPermission()
        .then((permission) => {
            if (permission === "granted") {
                console.log("Notification permission granted.");
                // Get the FCM token
                getToken(messaging, { vapidKey: "YOUR_VAPID_KEY" })
                    .then((currentToken) => {
                        if (currentToken) {
                            console.log("FCM Token:", currentToken);
                        } else {
                            console.log("No registration token available.");
                        }
                    })
                    .catch((err) => {
                        console.error("Error getting FCM token:", err);
                    });
            } else {
                console.log("Notification permission denied.");
            }
        })
        .catch((err) => {
            console.error("Error requesting notification permission:", err);
        });
}

// Call the requestPermission function when needed (e.g., on page load or user interaction)

//شسيشسي


