var mic, recorder, soundFile, video;

var state=0;

function setup(){
    mic = new p5.AudioIn();

    mic.start();

    recorder = new p5.SoundRecorder();

    recorder.setInput(mic);

    soundFile = new p5.SoundFile();

    video = $('video').get(0);
}

function rec(){
    if(state === 0 && mic.enabled) {
        recorder.record(soundFile);
        $('#message').text('문장을 직접 말해보세요.');
        video.play();
        setTimeout(stop, video.duration*1000)
        state++;
    }

    else if(state === 2 && video.paused && !soundFile.isPlaying()) {
        soundFile.play();
        video.play();
    }
}

function stop(){
    recorder.stop();
    $('#message').text('녹음한 문장을 다시 들어보세요.');
    $('#microphone').get(0).src='icon/playvoice.png';
    $('#microphone').get(0).width=150;
    $('.mic').css('border','0px solid');
    state++;
}

