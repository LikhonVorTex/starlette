<?php
set_time_limit(200);
error_reporting(E_ERROR | E_PARSE);
?>
  <html>

  <head>
    <meta charset="utf-8">
    <title>CCN FOR RENT</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.1.1/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=0.3">

    <style>
      body {
        min-height: 100vh;
        font-family: 'Montserrat', sans-serif;
      }

      td {
        text-align: center;
      }
    </style>
  </head>

  <body style="background-image: url(images/bg.jpg);background-size:cover;background-attachment:fixed;background-repeat:no-repeat;">
    <div class="container-fluid">
      <audio id="livesfx"><source src="sounds/lives.mp3" type="audio/mp3"></audio>
      <div class="text-center">
        <h1 style="margin-top: 40px;background: -webkit-linear-gradient(#d5eef5, white);-webkit-background-clip: text;-webkit-text-fill-color: transparent;"><img src="images/logo.png" style="animation: rotation <?php echo array_rand(array(30, 50, 60, 10, 15, 8));?>s infinite linear;" height="120" class=""><br>Dr. Ugs <br></h1><sub style="font-size: 13px;color:white"><i>"At your service"</i></sub>
      </div>
      <br>
      <div class="row">
        <div style="margin-bottom: 10px;margin-top: 10px;" class="col-lg-8">
          <div class="card rounded-lg border-primary mb-12">
            <div class="card-body bg-secondary text-center">
              <div class="row col-lg-12 text-center">
                <div class="col-md-12 text-center">
                  <p>Cards<br> <span class="badge-danger"  id="status">STATUS: WAITING</span> </p>
                  <textarea class="border-dark border form-control bg-secondary h-20" id="ccs" rows="10" cols="20" style="color: black; font-size: 15px; font-weight: bolder" placeholder="XXXXXXXXXXXXXXXX|XX|XXXX|XXX"></textarea><br>
                </div>
                <div class="col-lg-12 text-center">

                    <div class="container ">
                      <button   class="btn btn-primary" style="min-width: 200px"   name="btnStart" onclick="start()"; >START</button>
                       <button  class= "btn btn-danger" style="min-width: 200px"   name="btnStop"  onclick="if(confirm('You want to stop checking?')){stop()};";  >STOP</button>
                               <br>            
                      <p style="margin-top: 10px;color: black;font-size: 20px">Anti Captcha Key</p>
                   <textarea class="border-dark border form-control bg-secondary h-20 text-center" id="anti_captchakey" style="color: black; font-size: 10px; font-weight: bolder"></textarea>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <div style="margin-bottom: 10px;margin-top: 20px; height: 100px "  class="col-lg-4">
          <div class="card rounded-lg border-primary mb-12 h-50"style="margin-top: 20px height: 100px">
            <div class="card-body bg-secondary text-center">
              <p>Checked Cards</p>
              <div class="progress" style="height:40px;">
                <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" id="progresslive" style="width: 100%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
              </div>  
            </div>
<div class="card rounded-lg border-primary mb-12 h-50"style=" margin-top:20px; height:150px"> </div>
            <div class="container"> </div>
                <select class="borders-dark border form-control bg-primary ,h-50" id="gate">
                  <div class="card rounded-lg border-primary mb-12 h-20" style="margin-top:"20px>
                  <div class="container"  style="height: 150px">
                  <option value="stripe-01">CCN 1(STRIPE GOODS CHARGE)</option>
                  <option value="stripe-02">CCN 2(STRIPE GOODS CHARGE) </option>
                  <option value="stripe-03">CCN 3(STRIPE GOODS CHARGE) </option>
                  <option value="stripe-04">CCN 4(STRIPE GOODS CHARGE) </option>
                  <option value="capi2" disabled >CCN 5(BRAINTREE GOODS CHARGE) </option>
                  <option value="api6" disabled>CCN 6 (BRAINTREE GOODS CHARGE: 18$)) </option>
      
                </select>
                <div class="card rounded-lg border-primary mb-12 h-50"style=" margin-top:20px; height:150px"> </div>
            <div class="card-body bg-secondary text-center">
                  <p style="color: black; font-size: 25px; font-weight: bolder" class="margin-top">Select Checker Gate</p>
                  <div style="color: black; font-size: 25px; class="container">
                    <label class="radio-inline">
                      <input type="radio" name="optradio" disabled>
                      CVV </label >
                    <label class="radio-inline">
                      <input type="radio" name="optradio" checked>
                      CCN</label>
                  </div>
                  <br>
                   <p style="color: black; font-size: 20px; "class="margin-top">Amount of Charges</p>
                <label style="color: black; font-size:35px; height:20px; font-weight: bolder">$</label > <textarea lass=""  class="border-dark border bg-secondary h-5  text-center" value="1.00" id="amount" style="color: black; margin:auto;height:30px; width:85px;font-size: 15px; font-weight: bolder">1</textarea> <br>
                </div>
          </div>

        </div>
      </div>
      <div class="row" style="margin-top: 20px;margin-bottom: 40px;">
        <div class="col-lg-6">
          <div class="card rounded-lg border-primary mb-12">
            <div class="card-header bg-secondary  success">
              <div class="row">
                <div class="text-left col-sm-6">Alive</div>
                <div class="text-right col-sm-6"><button id="mostra" style="background-color:transparent;border:none;"><span class="badge badge-success">CVV/CCN : <span id="countlives">0</span></span></button></div>
              </div>
            </div>
            <div class="card-body bg-secondary ">
              <div id="b-li" class="row">
                <div class="table-wrapper-scroll-y table-responsive col-lg-12 h-100">
                  <table class="table">
                    <tr align="center">
                      <th>STATUS</th>
                      <th>~~</th>
                      <th>CARD</th>
                      <th>INFO</th>
                    </tr>
                    <tbody id="lives">
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card rounded-lg border-primary mb-12">
            <div class="card-header bg-secondary ">
              <div class="row">
                <div class="text-left col-sm-6">Dead</div>
                 <div class="text-right col-sm-6"><button id="mostra2" style="background-color:transparent;border:none;">
                <div class="text-right col-sm-6"><span class="badge badge-danger">Dead : <span id="countdeads">0</span></span>
                </div>
              </div>
            </div>
            <div class="card-body bg-secondary ">
              <div id="b-de" class="row">
                <div class="table-wrapper-scroll-y table-responsive col-lg-12 h-100">
                  <table class="table">
                    <tr align="center">
                      <th>CARD</th>
                      <th>~~</th>
                      <th>MESSAGE</th>
                      <th>INFO</th>
                    </tr>
                    <tbody id="deads">
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
    <title>DOC Checker</title>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300&display=swap" rel="stylesheet">

  <script>
    function start() {
      document.getElementById("status").innerHTML = "STATUS: CHECKING";
      document.getElementById("status").setAttribute("class","btn-primary");
      document.getElementById("ccs").setAttribute('readonly',true);
      var linha = $("#ccs").val();
      var gates = $("#gate").val();
      var key = $("#anti_captchakey").val();
      var amnt = $("#amount").val();
      var linhaenviar = linha.split("\n");  
      window.numberofcc = linhaenviar.length;
      window.checked = 0;
    
     linhaenviar.forEach( function(value, index) {
        setTimeout(
          function() {
            window.numberofcc = numberofcc;
            $.ajax({
              url: gates +'.php?lista=' + value + '&key=' + key + '&amount=' + amnt,
              type: 'GET',
              async: true,
              success:  function(resultado) {
                window.checked = parseInt(checked) + 1;
                window.percentage = checked / numberofcc;
                window.percentage = percentage * 100;
                document.getElementById("progresslive").innerHTML = checked + ' / ' + numberofcc;

                if (resultado.match("badge-success")) {
                  removelinha();
                  aprovadas(resultado, value);
                } else {
                  removelinha();
                  reprovadas(resultado, value);
                }
                document.getElementById("progresslive").setAttribute("style", "width:" + percentage + '%');

           if (window.numberofcc == window.checked){
                document.getElementById("status").innerHTML = "STATUS: ALL DONE";
                document.getElementById("status").setAttribute("class","badge-success");
                document.getElementById("ccs").removeAttribute('readonly'); 
             }
              
              }
            });

             }, 10000 * index);

      });
    
 }

  function stop(){
      document.getElementById("countlives").innerHTML = 0;
      document.getElementById("countdeads").innerHTML = 0;
      document.getElementById("status").innerHTML = "STATUS: STOPPED";
      document.getElementById("status").setAttribute("class","badge-danger");
      document.getElementById("ccs").removeAttribute('readonly'); 
      document.getElementById("progresslive").setAttribute("style","width: 1000"); 
      session_distroy();
  } 

    function playLIVE() {
      // var sound = new Howl({
      //   src: ['/sounds/lives.mp3'],
      //   volume: 100
      // });
      // sound.play()
    }

    function aprovadas(str, card) {
      playLIVE();
      var last = document.getElementById("countlives").textContent;
      var count = parseInt(last) + 1;
      document.getElementById("countlives").innerHTML = count;
      $("#lives").append(str);
      $("#lives-2").append(card + "\n");
    }

    function reprovadas(str, card) {
      var last = document.getElementById("countdeads").textContent;
      var count = parseInt(last) + 1;
      document.getElementById("countdeads").innerHTML = count;
      $("#deads").append(str);
      $("#deads-2").append(card + "\n");
    }

    function removelinha() {
      var lines = $("#ccs").val().split('\n');
      lines.splice(0, 1);
      $("#ccs").val(lines.join("\n"));
    }   

  </script>
<script type="text/javascript">

$(document).ready(function(){


    $("#b-li").hide();
  $("#esconde").show();
  
  $('#mostra').click(function(){
  $("#b-li").slideToggle();
  });

});

</script>

<script type="text/javascript">

$(document).ready(function(){


    $("#b-de").hide();
  $("#esconde2").show();
  
  $('#mostra2').click(function(){
  $("#b-de").slideToggle();
  });

});

</script>
  </html>

