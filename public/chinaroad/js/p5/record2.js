var mic, recorder, soundFile, video;

var state=0;

function setup(){
    mic = new p5.AudioIn();

    mic.start();

    recorder = new p5.SoundRecorder();

    recorder.setInput(mic);

    soundFile = new p5.SoundFile();
}


function rec() {
    if(state === 0 && mic.enabled) {
        console.log('hello');
        $('#message').text('녹음중입니다.');
        $('#rec_button').get(0).src='/chinaroad/icon/pause.png';
        recorder.record(soundFile);
        state++;
    }
    else if(state === 1) {
        recorder.stop();
        state++;
        console.log('stop');
    }
     //soundFile.play()
     else if(state === 2) {
        console.log('play');
         soundFile.play();
     }
}
