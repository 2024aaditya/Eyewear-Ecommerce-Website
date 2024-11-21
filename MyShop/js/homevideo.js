// Get the video element
var video = document.getElementById("myVideo");

// Get the play/pause button
var playButton = document.getElementById("playPause");

// Get the seek bar
var seekBar = document.getElementById("seekBar");

// Get the full-screen button
var fullScreenButton = document.getElementById("fullScreen");

// Play or pause the video when the button is clicked
playButton.addEventListener("click", function() {
    if (video.paused) {
        video.play();
        playButton.innerHTML = "Pause";
    } else {
        video.pause();
        playButton.innerHTML = "Play";
    }
});

// Update the seek bar as the video plays
video.addEventListener("timeupdate", function() {
    var time = video.currentTime / video.duration;
    seekBar.value = time * 100;
});

// Update the video time as the seek bar is dragged
seekBar.addEventListener("input", function() {
    var time = (seekBar.value / 100) * video.duration;
    video.currentTime = time;
});

// Toggle full screen
fullScreenButton.addEventListener("click", function() {
    if (video.requestFullscreen) {
        video.requestFullscreen();
    } else if (video.mozRequestFullScreen) {
        video.mozRequestFullScreen();
    } else if (video.webkitRequestFullscreen) {
        video.webkitRequestFullscreen();
    }
});
