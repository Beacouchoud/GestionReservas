var timer = null;
var lastMove = new Date();
var maxTimeOfInactivity = 10000 * 60 * 15;
var checkUser = 5000;

function saveLocalStorage(data, key) {
    if (!key) {
        key = 'user';
        startTimer();
    }
    localStorage.setItem(key, JSON.stringify(data));
}

function getLocalStorage(key) {
    if (!key) {
        key = 'user';
    }
    var data  = localStorage.getItem(key);
    return data ? JSON.parse(data) : null;
}

function removeLocalStorage(key) {
    if (!key) {
        key = 'user';
    }
    localStorage.removeItem(key);
}

/*
function startTimer() {
    var interval = window.setInterval(function() {
        console.log('check status login and activity')
        if (window.getLocalStorage() == null  || (lastMove - new Date() > maxTimeOfInactivity) ) {
            window.removeLocalStorage();
            window.location = 'http://localhost/';
            window.clearInterval(interval);
            interval = null;
        } else {
            lastMove = new Date();
        }
    }, 5000);
}

if (location.href !== 'http://localhost/' 
    && location.href !== 'http://localhost/index.php?ctl=formlogin'
    && location.href !== 'http://localhost/index.php?ctl=formregistro') {
    startTimer();
    console.log('timer start');
}


$('html').on('mousemove', function() {
    lastMove = new Date();
});
*/
