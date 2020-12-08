<?php
    // get the data from the form
    $investment = filter_input(INPUT_POST, 'investment', FILTER_VALIDATE_FLOAT);

    $interest_rate = filter_input(INPUT_POST, 'interest_rate', FILTER_VALIDATE_FLOAT);
    $years = filter_input(INPUT_POST, 'years', FILTER_VALIDATE_INT); //This should be replaced with a proper filter_input method call
    //Here is where you should create the add the interest_rate variable and get it via the filter_input method

    // validate investment
    if (empty($investment))
    {
        $error_message = 'Investment must be a valid number.';
    }
    else if ( $investment <= 0 )
    {
        $error_message = 'Investment must be greater than zero.';
    }
    // Here is where you should validate interest rate
    else if ( empty($interest_rate) )
    {
        $error_message = 'Interest rate must be a valid number.';
    }
    else if ( $interest_rate <= 0 )
    {
        $error_message = 'Interest rate must be greater than zero.';
    }
    else if ($interest_rate >= 70)
    {
        $error_message = 'Exceeded Maximum interest rate allowed by law';
    }
    // Here is where you should validate years (make it larger than 0 and less than 50 years)
    else if ( empty($years))
    {
        $error_message = "Value of Year must be Integer";
    }
    else if ( $years <= 0)
    {
        $error_message = "Value of year must be grater than 0";
    }
    else if ( $years > 50)
    {
        $error_message = 'Value of year Exceeded the limit.';
    }
    // set error message to empty string if no invalid entries
     else
     {
         $error_message = "";
     }

    // if an error message exists, go to the index page
    if ($error_message != '')
    {
        //This redirects us to the index.php page again and displays the error_message
        include('index1.php');
        exit();
    }

    // calculate the future value
    $future_value = $investment;
    for ($i = 1; $i <= $years; $i++) {
        $future_value += $future_value * $interest_rate * .01;
    }

    // Here is where you should set the correct currency and percent formatting
    $investment_f = "$ ".number_format($investment, 2); //replace this empty string with the correct number_format call
    $yearly_rate_f = number_format($interest_rate, 2)." %"; //replace this empty string with the correct number_format call
    $future_value_f = "$ ".number_format($future_value, 2); //replace this empty string with the correct number_format call
?>
<!DOCTYPE html>
<html>
<head>
    <title>Future Value Calculator</title>
    <link rel="stylesheet" type="text/css" href="main1.css">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Inknut+Antiqua:wght@600&display=swap" rel="stylesheet">
</head>
<body>
    <main>
        <h1>Future Value Calculator</h1>
        <div class="container">
            <div class="item">
                <label>Investment Amount:</label>
                <span><?php echo $investment_f; ?></span><br>
            </div>
            <div class="item">
                <label>Yearly Interest Rate:</label>
                <span><?php echo $yearly_rate_f; ?></span><br>
            </div>
            <div class="item">
                <label>Number of Years:</label>
                <span><?php echo $years; ?></span><br>
            </div>
            <div class="item">
                <label>Future Value:</label>
                <span><?php echo $future_value_f; ?></span><br>
            </div>
        </div>
    </main>
</body>
</html>
