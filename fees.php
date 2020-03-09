<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Library Fees</title>
</head>
<body>

<?php

    // Set default values
    $showFees = false;
    $feesBooks = "";
    $feesDays = "";

    if ( $_SERVER['REQUEST_METHOD'] == "GET"){  // GET method used
        if ( isset( $_GET['btnFees'] ) ){       //validation
            if ( ctype_digit( $_GET['books']) 
                && ctype_digit( $_GET['days']
                && $_GET['days'] > 0)        
            ){
                $showFees = true;
                ($_GET['books'] < 1 || !(ctype_digit($_GET['books']))) ? $feesBooks = 1 : $feesBooks = $_GET['books']; //set book default to 1            
                $feesDays = $_GET['days'];
            }            
        }
    }
    /**
     * Calclulates fees on overdue books
     * 
     * @param [number] $books
     * @param [number] $days
     * @return [number] amount due
     */
    function lateFees ($books, $days){
        $cost = 0;

        for ($i = 0; $i <= $days; $i++){
            if ($i == 1){
                $cost += 3.5255;
            }
            else if ($i > 1 && $i <=3 ){
                $cost += 4.0524;
            }
            else if ($i > 3 && $i <=8 ){
                $cost += 5.2967;
            }
            else if ($i > 8){
                $cost += 7.2967;
            }            
        }
        return $cost;
    }
    ?>
    <h1 id="fees">Library Fees</h1>
	<form action="fees.php" method="GET">
		<label for="txtBooks">Number of Books: </label>
		<input type="text" name="books" id="txtBooks" value="<?=$feesBooks ;?>"><br/>

		<label for="txtDays">Number of Days Overdue: </label>
		<input type="text" name="days" id="Days" value="<?=$feesDays ;?>"><br/>

		<button type="submit" name="btnFees">Calculate</button>
		<?php if ($showFees){ ?>
			<p>You owe $<?=round((lateFees($feesBooks, $feesDays)),2);?> in late fees</p>
            
		<?php } else echo "<BR>" . "AN ERROR HAS OCCURED!" ?>
	</form>

</body>
</html>