<h1>WiFi Car App Gamepad</h1>

<?php
$ip = $_SERVER['SERVER_ADDR'];

echo "<div style='width:640; height:480; margin-left:auto; margin-right:auto;'>";
echo "<iframe src='http://".$ip.":8000' height=480 width=640></iframe>";
echo "</div>";
echo "<br>";
?>

<body>
Controller Commands:
<p> Connection Status: <span id="status">Not Connected</span></p>
<p>Button: <span id="button">0000</span></p>
<p>Left Stick x/y: <span id="leftx">0000</span> : <span id="lefty">0000</span></p>
<p>Right Stick x/y: <span id="rightx">0000</span> : <span id="righty">0000</span></p>
<p>Direction: <span id ="direction">0000</span></p>
<p>Speed: <span id ="speed">0000</span></p>
</body>

<script type="text/javascript">
let gamepadIndex;
window.addEventListener('gamepadconnected', (event) => {
    gamepadIndex = event.gamepad.index;
});

setInterval(() => {
    if(gamepadIndex !== undefined) {
        // a gamepad is connected and has an index
        const myGamepad = navigator.getGamepads()[gamepadIndex];
        document.getElementById("status").innerHTML = "CONNECTED"; // reset page

        document.getElementById("leftx").innerHTML = (`${myGamepad.axes[0]}`);
        document.getElementById("lefty").innerHTML = (`${myGamepad.axes[1]}`);

        var lefty = myGamepad.axes[1];
        var leftx = myGamepad.axes[0];

        document.getElementById("rightx").innerHTML = (`${myGamepad.axes[2]}`);
        document.getElementById("righty").innerHTML = (`${myGamepad.axes[3]}`);

        myGamepad.buttons.map(e => e.pressed).forEach((isPressed, buttonIndex) => {
            if(isPressed) {
                document.getElementById("button").innerHTML = `${buttonIndex}`;

                if(buttonIndex == 2){
                speed = "slow";
                var xmlhttp = new XMLHttpRequest();
                 xmlhttp.open("GET", "./speed.php?speed=" + speed);
                xmlhttp.send();
                document.getElementById("speed").innerHTML = speed;
                }

                if(buttonIndex == 3){
                speed = "medium";
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.open("GET", "./speed.php?speed=" + speed);
                xmlhttp.send();
                document.getElementById("speed").innerHTML = speed;
                }

                if(buttonIndex == 1){
                speed = "fast";
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.open("GET", "./speed.php?speed=" + speed);
                xmlhttp.send();
                document.getElementById("speed").innerHTML = speed;
                }

            }
        })

        if(lefty == -1 ){
        direction = "forward";
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "./controls.php?command=" + direction);
        xmlhttp.send();
        document.getElementById("direction").innerHTML = direction;
        }

        if(lefty == 0){
        direction = "stop";
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "./controls.php?command=" + direction);
        xmlhttp.send();
        document.getElementById("direction").innerHTML = direction;
        }

        if(lefty == 1){
        direction = "backward";
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "./controls.php?command=" + direction);
        xmlhttp.send();
        document.getElementById("direction").innerHTML = direction;
        }

        if(leftx == 1){
        direction = "left";
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "./controls.php?command=" + direction);
        xmlhttp.send();
        document.getElementById("direction").innerHTML = direction;
        }

        if(leftx > 0.2 && leftx < 1){
        direction = "forwardLeft";
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "./controls.php?command=" + direction);
        xmlhttp.send();
        document.getElementById("direction").innerHTML = direction;
        }

        if(leftx == -1){
        direction = "right";
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "./controls.php?command=" + direction);
        xmlhttp.send();
        document.getElementById("direction").innerHTML = direction;
        }

        if(leftx < -0.2 && leftx > -1){
        direction = "forwardRight";
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "./controls.php?command=" + direction);
        xmlhttp.send();
        document.getElementById("direction").innerHTML = direction;
    }
    }
},1)
</script>