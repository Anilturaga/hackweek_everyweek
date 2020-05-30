<?php
session_start();
if(empty($_SESSION['username']))
{
header("Location:log.php");
}
$con = mysqli_connect('localhost','mec','Test1234','mec');
if (!$con) {
    die("Connection failed :_ |" );
}

?>
<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8">
  
  <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=0"/>
<link rel="stylesheet" href="./material.min.css">
<script src="./material.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<title>Hack it!</title>
<style type="text/css">
body,section.body,div.mdl-layout{
padding:0px;
margin:0px;
background-color:white;
width:100%;
height:100%;
overflow-y:auto;
overflow-x:hidden;
font-size:17px;
color: black !important;
}
header{
    height:13%;
width:100%;
background-color: #00bcd4 ;
display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: row;
    
}
span.mdl-layout-title{
margin:auto;
    text-decoration: underline;
    //color:white !important;
    font-size:150%;
    display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: row;
  }
main{
  width:100%;
  height:87%;
  overflow-y:auto;
overflow-x:hidden;
display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: row;
  padding:3%;
  
}
div.data{
  width:90%;
  height:100%;
}
div.sol{
  height:7%;
  width:100%;display: flex;
  flex-direction: row;
  
}
section.code{
  width:100%;
  height:100%;
  display: flex;
  flex-direction: row;

}
div.input{
  width:70%;
  height:100%;
  display: flex;
  flex-direction: column;
}

div.output{
  height:100%;
  width:30%;
  display: flex;
  flex-direction: column;
  border-radius: 2%;
  margin-left:1%;
  padding:0.5%;
}
textarea.stdin,pre.stdout{
  height:50%;
  width:100%;
  border-radius: 2%;
  margin-bottom:1%;
  padding:0.5%;
  background-color:#D3D3D3;
  overflow-y:auto;
  overflow-x:auto;
}

form.back{
  width:100%;
  height:100%;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: row;
  color:black;
}
div.button{
  //border-style: solid;
  //border-width: 0.09px;
}
button.mdl-navigation__link{
  font-size:100%;
  color:black !important;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
}
h4.heading{
  
  text-decoration: underline;
}
section.hiddenn{
	display:none;
}
</style>


</head>
<body bgcolor=#212f3d text="white"  >
<section class="body">
<!-- Simple header with fixed tabs. -->
<!-- Always shows a header, even in smaller screens. -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
  <header class="mdl-layout__header  mdl-shadow--2dp">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <span class="mdl-layout-title">Hackweek every week</span>
      <!-- Add spacer, to align navigation to the right -->
      <div class="mdl-layout-spacer"></div>
      <!-- Navigation. We hide it in small screens. -->
      <nav class="mdl-navigation mdl-layout--large-screen-only">
      <form class="back" action='/index1.php' method='post'>
        <button class="mdl-button mdl-js-button mdl-navigation__link" type="submit" name="submit" value="simple" formaction="/index1.php">Simple</button>
        <button class="mdl-button mdl-js-button mdl-navigation__link" type="submit" name="submit" value="medium" formaction="/index1.php">Medium</button>
        <button class="mdl-button mdl-js-button mdl-navigation__link" type="submit" name="submit" value="hard" formaction="/index1.php">Hard</button>
      </form>
      </nav>
    </div>
  </header>
  <div class="mdl-layout__drawer">
    <nav class="mdl-navigation">
    <a class="mdl-navigation__link" href="/payment_status.php"><?php echo $_SESSION['username']; ?></a>
      <a class="mdl-navigation__link" href="">Badge:<?php echo $_SESSION['badge']; ?></a>
      <a class="mdl-navigation__link" href="">Simple:<?php echo $_SESSION['simple']; ?></a>
      <a class="mdl-navigation__link" href="">Medium:<?php echo $_SESSION['medium']; ?></a>
      <a class="mdl-navigation__link" href="">Hard:<?php echo $_SESSION['hard']; ?></a>
      <a class="mdl-navigation__link" href="/index.php">Home</a>
      <a class="mdl-navigation__link" href="logout.php">Log out</a>
    </nav>
  </div>
  <main class="mdl-layout__content">
    <!-- Your content goes here -->
    <div class="data">
    <?php
    clearstatcache();
    $q = $_SESSION['page'];
    $id = $_POST['submit'];
    $sql="SELECT * FROM $q WHERE id = $id";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result);
    echo "<h4 class='heading'>Question ".$id.":</h4>
    <h4>Task:</h4>".$row['task']."<br>
    <h4>Input Format:</h4>".$row['inputformat']."<br><br>
    <h4>Constraints:</h4>".$row['constraints']."<br><br>
    <h4>Output Format:</h4>".$row['outputformat']."<br><br>
    <h4>Sample Input:</h4>".$row['sampleinput']."<br><br>
    <h4>Expected Output:</h4>".$row['sampleoutput']."<br><br>
    <h4>Explanation:</h4>".$row['explanation']."<br><br>";
  ?>
<h4>Solution:</h4>
  <div class="sol">
  <select id="languageselect" onchange="changelang(this)">
  <option value="c_cpp">C</option>
  <option value="java">Java</option>
  <option value="python">Python</option>
  <option value="javascript">Javascript</option>
</select>
<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored"  style="margin-left: 30px;" onclick="clickrun()">Run</button>
<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored"  style="margin-left: 30px;" onclick="clicksubmit()" name="submit" value=<?php echo $id; ?> >Submit</button>
    </div>
    <section class="code">
  <div class="input" id="editor">
    
</div>
    <div class="output" id="output">
   <strong>Stdin</strong>
   <textarea class="stdin" name="stdin"><?php echo $row['sampleinput']; ?></textarea> 
    </div></section><strong>Stdout</strong>
 <pre class="stdout" id="stdrout"></pre>
    </div>
  </main>
</div>

</section>

<script src="/src/ace.js" type="text/javascript" charset="utf-8"></script>
<script>
    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/vibrant_ink");
    editor.session.setMode("ace/mode/c_cpp");
    function changelang(lang) {
      var selectedValue = lang.value;
      editor.session.setMode("ace/mode/"+selectedValue);
    }
    var vs = 0;
    function clickrun(){
      vs =0;
      var stdin = $("textarea[name=stdin]").val();
      var expectedOutput = $("input[name=expectedOutput]").val();
      executer(stdin,expectedOutput);	
    }
    var sum=0;
    function clicksubmit(){
    vs =1;
      var st1 = "<?php echo $row['input1']; ?>";
      var ot1 = "<?php echo $row['output1']; ?>"; 
      var st2 = "<?php echo $row['input2']; ?>";
      var ot2 = "<?php echo $row['output2']; ?>";
      var st3 = "<?php echo $row['input3']; ?>";
      var ot3 = "<?php echo $row['output3']; ?>";
	  executer(st1,ot1);
	  executer(st2,ot2);
	  executer(st3,ot3);
	  setTimeout(final, 5000)
	  
    }
    function final(){
    	if(sum == 3){
    		document.getElementById("success").submit(); 
    	}	
    }

</script>
<section class="hiddenn">
<form id="success" action="/success.php">
<input name="page" value="<?php echo $_SESSION['page']; ?>">
<input name="id" value="<?php echo $q; ?>">
</form>
<strong>API URL</strong>&nbsp
  <br><br>
  <strong>AUTHENTICATION HEADER</strong>&nbsp
  <input type="text" name="authnHeader" size="31" placeholder="X-Auth-Token" value="X-Auth-Token"><br><br>
  <strong>AUTHENTICATION TOKEN</strong>&nbsp
  <input type="text" size="31" name="authnToken"><br><br>
  <strong>AUTHORIZATION HEADER</strong>&nbsp
  <input type="text" name="authzHeader" size="31" placeholder="X-Auth-User" value="X-Auth-User"><br><br>
  <strong>AUTHORIZATION TOKEN</strong>&nbsp
  <input type="text" size="31" name="authzToken"><br><br>
  <strong>Source Code</strong>
  <input type="checkbox" name="sourceCodeIsNull"><code>null</code><br>
  <textarea name="sourceCode" rows="10" cols="50">
#include <stdio.h>

int main(void) {
  char name[10];
  scanf("%s", name);
  printf("hello, %s\n", name);
  return 0;
}</textarea><br><br>
  <strong>Language ID</strong>&nbsp
  <input type="checkbox" name="languageIdIsNull"><code>null</code><br><br>
  <strong>Number Of Runs</strong>&nbsp
  <input type="text" name="numberOfRuns" value="1">
  <input type="checkbox" name="numberOfRunsIsNull"><code>null</code><br><br>

  <strong>CPU Time Limit</strong>&nbsp
  <input type="text" name="cpuTimeLimit" value="2">
  <input type="checkbox" name="cpuTimeLimitIsNull"><code>null</code><br><br>

  <strong>CPU Extra Time</strong>&nbsp
  <input type="text" name="cpuExtraTime" value="0.5">
  <input type="checkbox" name="cpuExtraTimeIsNull"><code>null</code><br><br>

  <strong>Wall Time Limit</strong>&nbsp
  <input type="text" name="wallTimeLimit" value="5">
  <input type="checkbox" name="wallTimeLimitIsNull"><code>null</code><br><br>

  <strong>Memory Limit</strong>&nbsp
  <input type="text" name="memoryLimit" value="128000">
  <input type="checkbox" name="memoryLimitIsNull"><code>null</code><br><br>

  <strong>Stack Limit</strong>&nbsp
  <input type="text" name="stackLimit" value="64000">
  <input type="checkbox" name="stackLimitIsNull"><code>null</code><br><br>

  <strong>Max Processes And Or Threads</strong>&nbsp
  <input type="text" name="maxProcessesAndOrThreads" value="30">
  <input type="checkbox" name="maxProcessesAndOrThreadsIsNull"><code>null</code><br><br>

  <strong>Enable Per Process And Thread Time Limit</strong>
  <input type="radio" name="enablePerProcessAndThreadTimeLimit" value="true"> <code>true</code>
  <input type="radio" name="enablePerProcessAndThreadTimeLimit" value="false" checked> <code>false</code>
  <input type="radio" name="enablePerProcessAndThreadTimeLimit" value="null"> <code>null</code><br><br>

  <strong>Enable Per Process And Thread Memory Limit</strong>
  <input type="radio" name="enablePerProcessAndThreadMemoryLimit" value="true" checked> <code>true</code>
  <input type="radio" name="enablePerProcessAndThreadMemoryLimit" value="false"> <code>false</code>
  <input type="radio" name="enablePerProcessAndThreadMemoryLimit" value="null"> <code>null</code><br><br>

  <strong>Max File Size</strong>&nbsp
  <input type="text" name="maxFileSize" value="1024">
  <input type="checkbox" name="maxFileSizeIsNull"><code>null</code><br><br>

  <strong>Stdin</strong>
  <input type="checkbox" name="stdinIsNull"><code>null</code><br>
  
  <strong>Expected Output</strong>
  <input type="checkbox" name="expectedOutputIsNull"><code>null</code><br>
  <input name="expectedOutput" value= "<?php echo $row['sampleoutput']; ?>"><br><br>

  <strong>Fields</strong>&nbsp
  <input type="text" size="50" name="fields"><br><br>

  <input type="checkbox" name="waitResponse" checked>
  <strong>Wait for submission</strong><br><br>

  <input type="checkbox" name="base64EncodedRequest">
  <strong>Send request with Base64 encoded data</strong><br><br>

  <input type="checkbox" name="base64EncodedResponse">
  <strong>Accept response with Base64 encoded data</strong><br><br>

  <div id="panel" style="position: fixed; bottom: 0px; padding: 20px; background-color: #00F20D; bottom: 20px; right: 20px; border: 1px solid #777">
    <button type="button" id="run">run</button>
    <button type="button" id="stop" disabled>Stop</button>
    <button type="button" id="clearLog">Clear Log</button>
    <button type="button" id="backToTop">Back To Top</button>
  </div>

  <hr>

  <h2>Request/Response Log</h2><br>
  <pre id="log"></pre>
<script>
    var stopFetch = false;

    if (window.location.protocol !== "file:") {
      $("input[name=apiUrl]").attr('value', window.location.origin);
    }

    function createQueryParameters(type = "Request") {
      var parameters = [];
      if ($(`input[name=base64Encoded${type}]`).is(":checked")) {
        parameters.push("base64_encoded=true");
      }

      var fields = $("input[name=fields]").val();
      if (fields.length != 0) {
        parameters.push(`fields=${fields}`);
      }

      var authnHeader = $("input[name=authnHeader]").val();
      var authnToken = $("input[name=authnToken]").val();
      if (authnToken.length != 0) {
        parameters.push(`${authnHeader}=${authnToken}`);
      }

      var authzHeader = $("input[name=authzHeader]").val();
      var authzToken = $("input[name=authzToken]").val();
      if (authzToken.length != 0) {
        parameters.push(`${authzHeader}=${authzToken}`);
      }

      if ($("input[name=waitResponse]").is(":checked")) {
        parameters.push("wait=true");
      }

      if (parameters.length == 0) {
        return "";
      }

      var queryParameters = "?";
      for (var i = 0; i < parameters.length - 1; i++) {
        queryParameters += parameters[i] + "&";
      }

      return queryParameters + parameters[parameters.length - 1];
    }

    function resetButtons() {
      stopFetch = false;
      $("#run").removeAttr("disabled");
      $("#stop").prop("disabled", true);
      $("#panel").css('background-color', '#00F20D');
    }

    function appendToLog(text) {
      var some = JSON.parse(text);
      if(vs == 1){
      	if(some['status']['description'] == "Accepted"){
      	sum = sum+1;
       }else{
          $("#stdrout").text($("#stdrout").text() +"All cases are not satisfying\n\n");
       }
      }else{
      $("#stdrout").text($("#stdrout").text() +">>Status:"+some['status']['description']+"\nCompile output:"+some['compile_output'] +"\nStdout:" +some['stdout']+ "\n\n\n");
		var elem = document.getElementById('stdrout');
      elem.scrollTop = elem.scrollHeight;
    }
    }

    function handleError(jqXHR, textStatus, errorThrown) {
      appendToLog(`[Response ${new Date().toLocaleString()}] ${jqXHR.status} ${jqXHR.statusText}\n${JSON.stringify(jqXHR, null, 4)}\n`);
      appendToLog(`[DONE ${new Date().toLocaleString()}]\n\n\n`);
      resetButtons();
    }

    function fetchSubmission(apiUrl, token) {
      var queryParameters = createQueryParameters("Response");
      //appendToLog(`[Request ${new Date().toLocaleString()}] GET ${apiUrl}/submissions/${token}${queryParameters}`);
      $.ajax({
        url: apiUrl + "/submissions/" + token + queryParameters,
        type: "GET",
        async: true,
        success: function(data, textStatus, jqXHR) {
          appendToLog(`${JSON.stringify(data, null, 4)}\n`);
          if ((data.status === undefined || data.status.id <= 2) && (data.status_id === undefined || data.status_id <= 2) && !stopFetch) {
            setTimeout(fetchSubmission.bind(null, apiUrl, token), 1500);
          } else if (!stopFetch) {
            appendToLog(`[DONE ${new Date().toLocaleString()}]\n\n\n`);
            resetButtons();
          } else {
            appendToLog(`[STOPPED ${new Date().toLocaleString()}]\n\n\n`);
            resetButtons();
          }
        },
        error: handleError
      });
    }

    function executer(stdin,expectedOutput) {
      $(this).prop("disabled", true);
      $("#stop").removeAttr("disabled");
      $("#panel").css('background-color', '#F2000D');

      var apiUrl = "http://localhost:3000";
      var sourceCode = editor.getValue();
      var selector = document.getElementById("languageselect").value;
      if(selector == "c_cpp"){
	   var languageId = 4;
      } 
      if(selector == "java"){
	   var languageId = 27;
      } 
      if(selector == "python"){
	   var languageId = 34;
      } 
      if(selector == "javascript"){
	   var languageId = 29;
      }
      var numberOfRuns = $("input[name=numberOfRuns]").val();
      var cpuTimeLimit = $("input[name=cpuTimeLimit]").val();
      var cpuExtraTime = $("input[name=cpuExtraTime]").val();
      var wallTimeLimit = $("input[name=wallTimeLimit]").val();
      var memoryLimit = $("input[name=memoryLimit]").val();
      var stackLimit = $("input[name=stackLimit]").val();
      var maxProcessesAndOrThreads = $("input[name=maxProcessesAndOrThreads]").val();
      var enablePerProcessAndThreadTimeLimit = $("input[name=enablePerProcessAndThreadTimeLimit]:checked").val() === "true";
      var enablePerProcessAndThreadMemoryLimit = $("input[name=enablePerProcessAndThreadMemoryLimit]:checked").val() === "true";
      var maxFileSize = $("input[name=maxFileSize]").val();
      var wait = $("input[name=waitResponse]").is(":checked");

      var queryParameters = createQueryParameters();
      if ($("input[name=base64EncodedRequest]").is(":checked")) {
        sourceCode = btoa(sourceCode);
        stdin = btoa(stdin);
        expectedOutput = btoa(expectedOutput);
      }
      if ($("input[name=sourceCodeIsNull]").is(":checked")) {
        sourceCode = null;
      }
      if ($("input[name=languageIdIsNull]").is(":checked")) {
        languageId = null;
      }
      if ($("input[name=numberOfRunsIsNull]").is(":checked")) {
        numberOfRuns = null;
      }
      if ($("input[name=stdinIsNull]").is(":checked")) {
        stdin = null;
      }
      if ($("input[name=expectedOutputIsNull]").is(":checked")) {
        expectedOutput = null;
      }
      if ($("input[name=cpuTimeLimitIsNull]").is(":checked")) {
        cpuTimeLimit = null;
      }
      if ($("input[name=cpuExtraTimeIsNull]").is(":checked")) {
        cpuExtraTime = null;
      }
      if ($("input[name=wallTimeLimitIsNull]").is(":checked")) {
        wallTimeLimit = null;
      }
      if ($("input[name=memoryLimitIsNull]").is(":checked")) {
        memoryLimit = null;
      }
      if ($("input[name=stackLimitIsNull]").is(":checked")) {
        stackLimit = null;
      }
      if ($("input[name=maxProcessesAndOrThreadsIsNull]").is(":checked")) {
        maxProcessesAndOrThreads = null;
      }
      if ($("input[name=enablePerProcessAndThreadTimeLimit]:checked").val() === "null") {
        enablePerProcessAndThreadTimeLimit = null;
      }
      if ($("input[name=enablePerProcessAndThreadMemoryLimit]:checked").val() === "null") {
        enablePerProcessAndThreadMemoryLimit = null;
      }
      if ($("input[name=maxFileSizeIsNull]").is(":checked")) {
        maxFileSize = null;
      }

      var data = {
        source_code: sourceCode,
        language_id: languageId,
        number_of_runs: numberOfRuns,
        stdin: stdin,
        expected_output: expectedOutput,
        cpu_time_limit: cpuTimeLimit,
        cpu_extra_time: cpuExtraTime,
        wall_time_limit: wallTimeLimit,
        memory_limit: memoryLimit,
        stack_limit: stackLimit,
        max_processes_and_or_threads: maxProcessesAndOrThreads,
        enable_per_process_and_thread_time_limit: enablePerProcessAndThreadTimeLimit,
        enable_per_process_and_thread_memory_limit: enablePerProcessAndThreadMemoryLimit,
        max_file_size: maxFileSize
      };

 //appendToLog(`[Request ${new Date().toLocaleString()}] POST ${apiUrl}/submissions${queryParameters}\n${JSON.stringify(data, null, 4)}`);

      $.ajax({
        url: apiUrl + "/submissions" + queryParameters,
        type: "POST",
        async: true,
        contentType: "application/json",
        data: JSON.stringify(data),
        success: function(data, textStatus, jqXHR) {
          appendToLog(`${JSON.stringify(data, null, 4)}\n`);
          if (!wait) {
            setTimeout(fetchSubmission.bind(null, apiUrl, data.token), 1500);
          } else {
            appendToLog(`[DONE ${new Date().toLocaleString()}]\n\n\n`);
            resetButtons();
          }
        },
        error: handleError
      });
    }

    $("#stop").click(function() {
      stopFetch = true;
    });

    $("#clearLog").click(function() {
      $("#log").html("");
    });

    $("#backToTop").click(function() {
      $('html, body').animate({
		      scrollTop: 0
	    }, 50);
    });
  </script>

</section>
</body>
<?php
mysqli_close($con);
?>
</html>
