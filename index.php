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
	$game = new CreateSudoku();				#create a new object to createSudoku class
        
        $game -> makeSudoku();					//call to class methods	of making the sudoku and initilize 27 random value
        if($game->chkSudoku(0, 0))				//check if solution exist to the sudoku made 
            $game ->showSudoku(); 				//if yes show the sudoku
       else
           echo "No solution";					//else show the error
?>

