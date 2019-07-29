<?php
/**
 * Created by PhpStorm.
 * User: ryanllewellyn
 * Date: 2019-07-13
 * Time: 17:20
 */

    require_once 'controller/lcs.php';

    $calculate = new lcs;
    $lcsReturn = null;
    $sameLCS = false;

    //get strings from submitted form
    if(isset($_GET['string1']) && isset($_GET['string2'])) {

        //assign input values to variables (REQUEST used for compatibility with, GET or POST)
        $str1 = $_REQUEST['string1'];
        $str2 = $_REQUEST['string2'];

        //start timer
        $time_start = microtime(true);

        //call recursive LCS function
        $lcsReturn = $calculate->findLCS($str1,$str2);

        //end timer
        $time_end = microtime(true);

        //calculate time elapsed for execution
        $calc_time = $time_end - $time_start;

        //round time to 2 decimal places, RV = Recursive, ME=Memoisation
        $exec_timeRV = round($calc_time, 8);

        //start timer
        $time_start = microtime(true);

        //call recursive LCS function, with Memoisation
        $lcsReturnMEM = $calculate->findLCSMEM($str1,$str2);

        //end timer
        $time_end = microtime(true);

        //calculate time elapsed for execution
        $calc_time = $time_end - $time_start;

        //round time to 2 decimal places, RV = Recursive, ME=Memoisation
        $exec_timeME = round($calc_time, 8);

        //check that LCS returned by both algorithms is identical
        if ($lcsReturn == $lcsReturnMEM) {
            $sameLCS = true;
        }


    }

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Meta Tags SEO -->
    <meta name="keywords" content="LCS, Longest Common Subsequence, Dynamic Programming">
    <meta name="description" content="Longest Common Subsequence problem, solved in the context of DNA sequencing">
    <meta name="subject" content="Dynamic Programming">
    <meta name="language" content="EN">
    <meta name="author" content="Mr Ryan Llewellyn BSc">
    <meta name="publisher" content="Mr Ryan Llewellyn BSc">
    <meta name="revised" content="Monday, July 29th, 2019, 17:14">
    <meta name="classification" content="education">
    <meta name="coverage" content="worldwide">
    <meta name="distribution" content="global">
    <meta name="rating" content="general">
    <meta name="HandheldFriendly" content="true">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">


    <!-- Site Title -->
    <title>DNA Sequencer</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS and JQuery -->
    <script> src="bootstrap/js/bootstrap.min.js" </script>


    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">

</head>

<!-- Site Body -->
<body class="text-center">

    <!-- Container Box -->
    <div class="container">

        <!-- Main text area, including UoL logo -->
        <div class="login-main-text">
            <img class="mb-4" src="img/dna.png" alt="dna logo">
            <h3>DNA Sequencer</h3>
            <p>Find the Longest common substring between 2 strings</p>
        </div>

        <?php

        //condition when array of values is returned
        if ($lcsReturn != null && $sameLCS = true) { ?>

            <div class="alert alert-success" role="alert">
                Longest Common Subsequence found!</div>

            <?php echo '<p> String 1 : '.$str1.' <br> String 2 : '.$str2.' <br> Longest Common Subsequence : '.$lcsReturn.' <br> Length : '.strlen($lcsReturn).'</p>';

            echo '<p> Time taken : '.$exec_timeRV.' Milliseconds (Recursive)</p>';

            echo '<p> Time taken : '.$exec_timeME.' Milliseconds (Memoisation)</p>';

        } else if ($lcsReturn === '') {
           echo '<div class="alert alert-danger" role="alert">
               No Longest Common Subsequence found!</div>';

           echo '<p> String 1 : '.$str1.' <br> String 2 : '.$str2.'</p>';

            echo '<p> Time taken : '.$exec_timeRV.' Milliseconds (Recursive)</p>';

            echo '<p> Time taken : '.$exec_timeME.' Milliseconds (Memoisation)</p>';

        }
        ?>

        <!-- Form Inputs -->
        <div class="login-form">
            <form method="get" class="form-signin" action="index.php">

                <div class="form-group">
                    <label>String 1</label><br>
                    <input type="text" name="string1" class="form-control" placeholder="String" required autofocus>
                </div>
                <div class="form-group">
                    <label>String 2</label><br>
                    <input type="text" name="string2" class="form-control" placeholder="String" required>
                </div>

                <!-- Form submit button -->
                <button type="submit" class="btn btn-primary" value="Submit">Calculate</button>

                <!-- Authors Mark -->
                <p class="mt-5 mb-3 text-muted">&copy; Ryan Llewellyn 2019</p>
            </form>
        </div>
    </div>

</body>
</html>