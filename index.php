<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firebase PHP</title>
    <link rel="shortcut icon" href="./public/images/favicon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
    <script src='https://cdn.firebase.com/js/client/2.2.1/firebase.js'></script>
</head>

<body>
    // Your Content
</body>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-analytics.js"></script>
<script>
    const firebaseConfig = {
        apiKey: "AIzaSyDXcSp0YADUykDxfN9sUlA5p0dzroNtFgY",
        authDomain: "php-firebase-c5742.firebaseapp.com",
        projectId: "php-firebase-c5742",
        storageBucket: "php-firebase-c5742.appspot.com",
        messagingSenderId: "1013350745500",
        appId: "1:1013350745500:web:a880fe3ca7478d0d367459",
        measurementId: "G-E7YDHTJ7FG"
    };

    firebase.initializeApp(firebaseConfig)
    const analytics = firebase.analytics();
    const messaging = firebase.messaging();

    function initFirebaseMessagingRegistration() {
        messaging.requestPermission().then(function () {
            return messaging.getToken()
        }).then(function (token) {
            $.ajax({
                url: './backend/SaveFcmToken.php',
                type: 'POST',
                data: { fcm_token: token, project_master_id: 1 },
                success: function (data) {
                    // console.log(data);
                    localStorage.setItem('isFcmSaved', 1);
                },
                error: function (error) {
                    // console.log(error);
                    localStorage.setItem('isFcmSaved', 0);
                }
            });

        }).catch(function (err) {
            console.log(`Token Error :: ${err}`);
        });
    }

    if (localStorage.getItem('isFcmSaved') == undefined || localStorage.getItem('isFcmSaved') != 1) {
        initFirebaseMessagingRegistration();
    }

    messaging.onMessage(function ({ data: { body, title, icon, clickAction } }) {
        console.log('Notification: ', data)
        let notification = new Notification(title, {
            body,
            icon
        });

        notification.addEventListener('click', function () {
            window.open(clickAction);
        });
    });
</script>

</html>