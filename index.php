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
        if($game->chkSudoku(0, 0))
            $game ->showSudoku(); 
       else
           echo "No solution";
?>

