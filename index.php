<!DOCTYPE html>

<?php
    include 'sudokuBeta.php';
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
	
	
</style>
</head>
<?php
	$game = new CreateSudoku();
        
        $game -> makeSudoku();

        $game->showSudoku();
?>

<input type="button" id="hsbutton" onclick="hideshow()" value="Show Solution" style="width:100px">
<script>
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
</script>
