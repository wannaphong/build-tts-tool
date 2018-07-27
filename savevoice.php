<?php
require('block_not_login.php');
$idpost=$_GET["id"];
require_once('cryptor.php');
$iduser= Cryptor::doDecrypt($_COOKIE['user']);
require('db.php');
$data = $database->select("textcorpus",'*',array('id[=]' =>$idpost));
$post=$data[0];
if($post['txt_read']!=""){
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>อัดเสียง : <?php echo $post['txt_read'] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
	  <!--<h1>อัดเสียง</h1> -->
	  <!--<h2>ข้อความ : <?php /*echo $post['txt'] */?></h2>-->
	  <h1><?php echo $post["txt_read"] ?></h1>
    <p>ชนิดไฟล์เสียง:<br>
    <select id="encodingTypeSelect">
	  <option value="wav">Waveform Audio (.wav)</option>
	</select>
	</p>
	<div id="controls">
		<button id="recordButton">Record</button>
		<button id="stopButton" disabled>Stop</button>
	</div>
	<div id="formats"></div>
	<h3>Log</h3>
	<pre id="log"></pre>

	<h3>Recordings</h3>
	<p>เลือกเสียงที่ดีที่สุดแล้วกด upload</p><br>
	<ol id="recordingsList"></ol>
	<h3>เสียงที่อยู่ในระบบ</h3>
	<?php
$datas = $database->select("voice","*",array('AND' => array('id_user[=]' =>$iduser, 'id_txt[=]'=> $idpost)));
?>
<table border="1">
<tr>
    <th>เสียง</th>
    <th>วันเดือนปีที่อัด</th>
	<th>สถานะ</th>
	<th>เปลี่ยนสถานะ</th>
  </tr>
<?php
foreach($datas as $data) {
?>
<tr>
 <td>
 <audio controls> <!--id="player">-->
 	<source src="voice/<?php echo $data["path"]; ?>"type="audio/wav">
 </audio>
</td>
 <td><?php echo $data["date_save"]; ?></td>
 <td><?php 
 if($data["is_use"]){
	 echo "ใช้";
 }
 else{
	 echo "ไม่ใช้";
 }
 ?></td>
 <td><?php 
 if($data["is_use"]){
	 //echo "ใช้";
 }
 else{
	 echo "<a href='updateuse.php?id=".$idpost."&idpost=".$data["id"]."'>เปลี่ยน</a>";
 }
 ?></td>
</tr>
<?php
}
?>
</table>
<script src="https://cdn.plyr.io/3.3.21/plyr.js"></script>
<script>const player = new Plyr('#player');</script>
  	<!-- inserting these scripts at the end to be able to use all the elements in the DOM -->
	<script src="js/WebAudioRecorder.min.js"></script>
	<script>
		//webkitURL is deprecated but nevertheless
URL = window.URL || window.webkitURL;

var gumStream; 						//stream from getUserMedia()
var recorder; 						//WebAudioRecorder object
var input; 							//MediaStreamAudioSourceNode  we'll be recording
var encodingType; 					//holds selected encoding for resulting audio (file)
var encodeAfterRecord = true;       // when to encode

// shim for AudioContext when it's not avb. 
var AudioContext = window.AudioContext || window.webkitAudioContext;
var audioContext; //new audio context to help us record

var encodingTypeSelect = document.getElementById("encodingTypeSelect");
var recordButton = document.getElementById("recordButton");
var stopButton = document.getElementById("stopButton");

//add events to those 2 buttons
recordButton.addEventListener("click", startRecording);
stopButton.addEventListener("click", stopRecording);

function startRecording() {
	console.log("startRecording() called");

	/*
		Simple constraints object, for more advanced features see
		https://addpipe.com/blog/audio-constraints-getusermedia/
	*/
    
    var constraints = { audio: true, video:false }

    /*
    	We're using the standard promise based getUserMedia() 
    	https://developer.mozilla.org/en-US/docs/Web/API/MediaDevices/getUserMedia
	*/

	navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
		__log("getUserMedia() success, stream created, initializing WebAudioRecorder...");

		/*
			create an audio context after getUserMedia is called
			sampleRate might change after getUserMedia is called, like it does on macOS when recording through AirPods
			the sampleRate defaults to the one set in your OS for your playback device

		*/
		audioContext = new AudioContext();

		//update the format 
		document.getElementById("formats").innerHTML="Format: 2 channel "+encodingTypeSelect.options[encodingTypeSelect.selectedIndex].value+" @ "+audioContext.sampleRate/1000+"kHz"

		//assign to gumStream for later use
		gumStream = stream;
		
		/* use the stream */
		input = audioContext.createMediaStreamSource(stream);
		
		//stop the input from playing back through the speakers
		//input.connect(audioContext.destination)

		//get the encoding 
		encodingType = encodingTypeSelect.options[encodingTypeSelect.selectedIndex].value;
		
		//disable the encoding selector
		encodingTypeSelect.disabled = true;

		recorder = new WebAudioRecorder(input, {
		  workerDir: "js/", // must end with slash
		  encoding: encodingType,
		  numChannels:2, //2 is the default, mp3 encoding supports only 2
		  onEncoderLoading: function(recorder, encoding) {
		    // show "loading encoder..." display
		    __log("Loading "+encoding+" encoder...");
		  },
		  onEncoderLoaded: function(recorder, encoding) {
		    // hide "loading encoder..." display
		    __log(encoding+" encoder loaded");
		  }
		});

		recorder.onComplete = function(recorder, blob) { 
			__log("Encoding complete");
			createDownloadLink(blob,recorder.encoding);
			encodingTypeSelect.disabled = false;
		}

		recorder.setOptions({
		  timeLimit:120,
		  encodeAfterRecord:encodeAfterRecord,
	      ogg: {quality: 0.5},
	      mp3: {bitRate: 160}
	    });

		//start the recording process
		recorder.startRecording();

		 __log("Recording started");

	}).catch(function(err) {
	  	//enable the record button if getUSerMedia() fails
    	recordButton.disabled = false;
    	stopButton.disabled = true;

	});

	//disable the record button
    recordButton.disabled = true;
    stopButton.disabled = false;
}

function stopRecording() {
	console.log("stopRecording() called");
	
	//stop microphone access
	gumStream.getAudioTracks()[0].stop();

	//disable the stop button
	stopButton.disabled = true;
	recordButton.disabled = false;
	
	//tell the recorder to finish the recording (stop recording + encode the recorded audio)
	recorder.finishRecording();

	__log('Recording stopped');
}

function createDownloadLink(blob,encoding) {
	
	var url = URL.createObjectURL(blob);
	var au = document.createElement('audio');
	var li = document.createElement('li');
	var link = document.createElement('a');

	//add controls to the <audio> element
	au.controls = true;
	au.src = url;
	au.id ='t';

	//link the a element to the blob
	link.href = url;
	link.download = new Date().toISOString() + '.'+encoding;
	link.innerHTML = link.download;

	//add the new audio and a elements to the li element
	li.appendChild(au);
	li.appendChild(link);

	//add the li element to the ordered list
	recordingsList.appendChild(li);

	var filename = new Date().toISOString(); //filename to send to server without extension
//upload link
var upload = document.createElement('a');
upload.href="#";
upload.innerHTML = "Upload";
upload.addEventListener("click", function(event){
      var xhr=new XMLHttpRequest();
      xhr.onload=function(e) {
          if(this.readyState === 4) {
              console.log("Server returned: ",e.target.responseText);
			  window.location.reload(false); //reload the page
          }
      };
      var fd=new FormData();
      fd.append("audio_data",blob,"<?php echo $idpost.'.wav' ?>");
      xhr.open("POST","uploadaudio.php",true);
      xhr.send(fd);
})
li.appendChild(document.createTextNode (" "))//add a space in between
li.appendChild(upload)//add the u
}

//helper function
function __log(e, data) {
	log.innerHTML += "\n" + e + " " + (data || '');
}
	</script>

  </body>
  </html>
<?php
}
else echo"error"; 
?>