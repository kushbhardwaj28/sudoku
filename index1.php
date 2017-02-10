<!DOCTYPE html>

<?php
    include 'sudokuBeta.php';
    session_start();
    echo $_SESSION['playerName'];
?>
<head>
<style>

	table,td,tr{
		border :1px solid black;
		border-collapse: collapse;
		height: 30px;
	}
	table{
		border: 2px solid black;
	}
	td:nth-child(3n){
		 border-right:2px solid ;
	}
	tr:nth-child(3n) td {
		border-bottom:2px solid ;
	}
	input{
		width: 30px;
		height: 30px;
		font-size: 20px;
		text-align: center;
	}
        #timer{
            width:100%;
            height: 120px;
            background-color: #f2f2f2;
            text-align: center;
        }
	
</style>
</head>
<div id='timer'><time style="font-size:100px;color:#00ccff">00:00:00</time></div>
<?php
	$game = new CreateSudoku();
        
        $game -> makeSudoku();

        $game->showSudoku();
?>
<div style="width:356px;margin:auto">
<input type="button" id="hsbutton" onclick="hideshow()" value="Show Solution" style="width:176px;margin:auto">
<input type="button" id="chkbutton" onclick="checkans()" value="Check/Finish" style="width:176px;margin:auto"><br />
</div>
<script>
        var errorPlace = 0;
        for(var i =0 ;i<9;i++){
            for(var j =0 ;j<9;j++){
                var index1 = 's'+i+j;
                var index2 = 'h'+i+j;
                var x = document.getElementById(index1);
                var y = document.getElementById(index2);
                if(x.value != y.value){
                    errorPlace++;
                }
            }
        }
    
    function hideshow(){
        var hsbutton = document.getElementById('hsbutton');
        var solvedTable = document.getElementById('sudoku1');
        if(hsbutton.value == 'Show Solution'){
            solvedTable.hidden = false;
            hsbutton.value = 'Hide Solution';
        }
        else if(hsbutton.value == 'Hide Solution'){
            solvedTable.hidden = true;
            hsbutton.value = 'Show Solution';
        }
    }
    function checkans(){
        errorPlace = 0;
        for(var i =0 ;i<9;i++){
            for(var j =0 ;j<9;j++){
                var index1 = 's'+i+j;
                var index2 = 'h'+i+j;
                var x = document.getElementById(index1);
                var y = document.getElementById(index2);
                if(x.value != y.value){
                    x.style.backgroundColor = 'red';
                    errorPlace++;
                }
                else{
                    if(x.style.backgroundColor != 'grey')
                        x.style.backgroundColor = 'white';
                }
            }
        }
        if(errorPlace === 0){
            console.log('done');
            clearTimeout(t);
            storeTime(seconds,minutes,hours);
        }
    }
    
    setInterval(function(){
        for(var i =0 ;i<9;i++){
            for(var j =0 ;j<9;j++){
                var index1 = 's'+i+j;
                var x = document.getElementById(index1);
                if(x.style.backgroundColor != 'grey')
                    x.style.backgroundColor = 'white';
                
            }
        }
    },3000);
</script>
<script>
    var seconds = 0, minutes = 0, hours = 0,t;
    var start = document.getElementById('sudoku2');
    function add() {
    seconds++;
    if (seconds >= 60) {
        seconds = 0;
        minutes++;
        if (minutes >= 60) {
            minutes = 0;
            hours++;
        }
    }
    console.log(errorPlace+','+seconds+':'+minutes+':'+hours);
    document.getElementById('timer').textContent = (hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds);
    document.getElementById('timer').style.fontSize = '100px';
    document.getElementById('timer').style.color = '#00ccff';
    
    timer();
    }
    function timer() {
        t = setTimeout(add, 1000);
    }
    timer();


    /* Start button */
    start.onload = timer;
 
    console.log('<?php echo $_SESSION["playerName"];?>');
    function storeTime(sec,min,hr) {
        var xhttp = new XMLHttpRequest();
        console.log('hii');
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("tble").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "storeTime.php?time="+hr+':'+min+':'+sec+"&name='<?php echo $_SESSION['playerName'];?>", true);
        xhttp.send();
    }
</script>
<div id="tble"></div>
