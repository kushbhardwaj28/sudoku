
<?php
//ini_set('memory_limit', '1024M');
//ini_set('max_execution_time', 3000);
    class CreateSudoku{
        public $sudokuArray;              # Array to store the manupulated value and store the result ie solved array
        public $chkArray;                   # Value to store actual unsloved values of grid and show unsolved array
        public $grid;
        
        function makeSudoku(){              # Method to create the sudoku grid and give 27 random value
            for ($i=0; $i < 9; $i++) {
        	for ($j=0; $j < 9; $j++) {
                    $this->sudokuArray[$i][$j] = 0;
                    $this->chkArray[$i][$j] = 0;
        	}
            }
            $emptyplace = 0;
            while($emptyplace < 27){
                $this->initilizeValue();
                $emptyplace = $this->countFilled();
            }
            $this->sudokuArray = $this->chkArray;           #assign sudokuArray as chkarray
            
            if (!$this->chkSudoku(0, 0))
                $this->makeSudoku();
         # End of makeSudoku method    
        }

        function countFilled(){             #Method to count total non zero value
            $count = 0;
            for($i =0;$i<9;$i++){
                for ($j=0;$j<9;$j++)
                    if ($this->chkArray[$i][$j] != 0)
                        $count++;
            }
            return $count;
        }
                
        function initilizeValue(){                          #Method to take a random value and check it for a certain position
        #Method to initilize pre-Defined Values in the grid
                $r = rand(00,88);
                if($r%10 == 9 || $r == 9){
                    $r=$r-1;
                    if($r < 9)
                        $val = "0".$r;
                    else
                        $val = $r;
                }   
                else if($r < 9) 
                    $val = "0".$r;
                else
                    $val = $r;
                $vals = str_split($val, 1);
                $val1 = rand(1,9);
//                $this->sudokuArray[$vals[0]][$vals[1]] = rand(1,9);
                if($this->isTrue($this->chkArray, $vals[0], $vals[1], $val1)){
                    $this->chkArray[$vals[0]][$vals[1]] = $val1;
                    //return TRUE;
                }  
        }
        
        function chkSudoku($row,$col){                      # Method to check the sudoku for repeat and solve the grid
            if( $row<9 && $col<9 )
            {
                if($this->sudokuArray[$row][$col] != 0 )       #pre filled
                {
                    if( ($col+1)<9 )
                        return $this->chkSudoku($row, $col+1);
                    else if( ($row+1)<9 )
                        return $this->chkSudoku($row+1, 0);
                    else
                        return true;
                }
                else
                {
                    for($i=0; $i<9; ++$i)
                    {
                        if($this->isAvailable($this->sudokuArray, $row, $col, $i+1) )
                        {
                            $this->sudokuArray[$row][$col] = $i+1;

                            if( ($col+1)<9 )
                            {
                                if($this->chkSudoku( $row, $col +1) )
                                {
                                    return true;}
                                else
                                    $this->sudokuArray[$row][$col] = 0;
                            }
                            else if( ($row+1)<9 )
                            {
                                if($this->chkSudoku($row+1, 0) )
                                {
                                    return true;}
                                else
                                    $this->sudokuArray[$row][$col] = 0;
                            }
                            else{
                                return true;
                            }
                        }
                    }
                }
                return false;
            }
            else
            {
                return true;
            }
            
        }
        
        function isAvailable($sudoku, $row, $col, $num)             # Method to see repeation in row,col or box while solution
        {
            //checking in the grid
            $rowStart = $row - ($row%3);
            $colStart = $col - ($col%3);

            for($i=0; $i<9; ++$i)
            {
                if ($sudoku[$row][$i] == $num)
                    return FALSE;
                if ($sudoku[$i][$col] == $num)
                    return FALSE;
                
            }

            for($i=0; $i<3; ++$i)
            {
                for($j=0; $j<3; ++$j)
                {
                    if( $sudoku[$i+$rowStart][$j+$colStart] == $num )
                        return false;
                }
            }
            return true;
        }
        
        function isTrue($sudoku, $row, $col, $num)              # Method to see repeation in row,col or box while initilize
        {
            //checking in the grid
            $rowStart = $row - ($row%3);
            $colStart = $col - ($col%3);

            for($i=0; $i<9; ++$i)
            {
                if($sudoku[$row][$i] == 0 )
                    continue;
                if ($sudoku[$row][$i] == $num)
                    return FALSE;
            }
            for($i=0; $i<9; ++$i)
            {
                if($sudoku[$i][$col] == 0)
                    continue;
                if ($sudoku[$i][$col] == $num)
                    return FALSE;
                
            }
            for($i=0; $i<3; ++$i)
            {
                for($j=0; $j<3; ++$j)
                {
                    if($sudoku[$i+$rowStart][$j+$colStart] == 0)
                        continue;
                    if( $sudoku[$i+$rowStart][$j+$colStart] == $num )
                        return false;
                }
            }
            return true;
        }


        function showSudoku(){                          # Method to show the grid on screen 
            
            echo "<div id='main1'><table id='sudoku1' hidden>";
            for ($i=0; $i < 9; $i++) { 
		echo "<tr>";
		for ($j=0; $j < 9; $j++) {
			echo "<td><input type=\"text\" id='h".$i.$j."' maxlength=\"1\" autocomplete='off'></td>";
			#the index will be given as h00,h01 and so on
		}
		echo "</tr>";
            }
            echo "</table></div>";
            
            for ($i=0; $i < 9; $i++) { 
                for ($j=0; $j < 9; $j++) {
                    if($this->sudokuArray[$i][$j] != 0){
                        echo "<script>
                          document.getElementById('h".$i.$j."').value=".$this->sudokuArray[$i][$j].";
                          document.getElementById('h".$i.$j."').disabled = true;
                          document.getElementById('h".$i.$j."').style.backgroundColor = \"grey\";
                          document.getElementById('h".$i.$j."').style.border = \"grey\";
                          document.getElementById('h".$i.$j."').style.color = \"black\";
                             </script>";
                    }
                }
            }

            echo "<div id='main2'><table id='sudoku2' style='margin:auto'>";
            for ($i=0; $i < 9; $i++) { 
                echo "<tr>";
                for ($j=0; $j < 9; $j++) {
                    echo "<td><input type=\"text\" id='s".$i.$j."' maxlength=\"1\" autocomplete='off'></td>";
                    #the index will be given as h00,h01 and so on
                }
                echo "</tr>";
            }
            echo "</table></div>";
            
            for ($i=0; $i < 9; $i++) { 
                for ($j=0; $j < 9; $j++) {
                    if($this->chkArray[$i][$j] != 0){
                        echo "<script>
                          document.getElementById('s".$i.$j."').value=".$this->chkArray[$i][$j].";
                          document.getElementById('s".$i.$j."').disabled = true;
                          document.getElementById('s".$i.$j."').style.backgroundColor = \"grey\";
                          document.getElementById('s".$i.$j."').style.border = \"grey\";
                          document.getElementById('s".$i.$j."').style.color = \"black\";
                             </script>";
                    }
                }
            }
            //print_r($arrayToStore);
        }
    
     
     #End of CreateSudoku class 
    }   
?>
