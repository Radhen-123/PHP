<?php
    //set default value of variables for initial page load
    if (!isset($investment)) { $investment = ''; }
    if (!isset($interest_rate)) { $interest_rate = ''; }
    if (!isset($years)) { $years = ''; }
// this is where you should check to see if the interest_rate and $years are set
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
        <div class="errorspace"></div>
    <?php
    //This code checks to see if we got an error message from the display_result.php page
     if (!empty($error_message)) { ?>
        <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
    <?php } ?>
    <form action="display_results1.php" method="post">

        <div id="data">
            <div class="input">
                <label for="investment">Investment Amount:</label>
                <input type="text" name="investment" id="investment" value="<?php echo htmlspecialchars($investment); ?>">
                <br>
            </div>

            <div class="input">
                <label for = "interest_rate">Interest rate:</label>
                <input type="text" name="interest_rate" id="interest_rate" value="<?php echo htmlspecialchars($interest_rate); ?>">
                <br>
            </div>
            <div class="input">
                <label for="years">Years:</label>
                <input type="text" name="years" id="years" value="<?php echo htmlspecialchars($years); ?>">
                <br>
            </div>
        </div>
        <div id="buttons">
            <label>&nbsp;</label>
            <input type="submit" value="Calculate"><br>
        </div>

    </form>
    </main>
</body>
</html>