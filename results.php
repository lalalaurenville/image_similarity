<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Result </title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            body {
                background-color: black;
                color: white;
                font-family: Arial, Helvetica, sans-serif;
            }
            hr {
                width: 65%;
            }
            .center {
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 40%;
            }
            .download {
                display: flex; 
                justify-content: center;
                align-items: center;
            }
            .results {
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 60%;
            }
            .button {
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 30%;
                transition-duration: 0.4s;
                cursor: pointer;
                padding: 2% 7%;
            }
            .column {
                float: left;
                width: 50%;
                padding: 5px;
            }
            .row::after {
                content: "";
                clear: both;
                display: table;
            }
            @media screen and (max-width: 500px) {
                .column {
                    width: 100%;
                }
            }
            * {
                box-sizing: border-box;
            }
            .downloadbtn {
                background-color: DodgerBlue;
                border: none;
                color: white;
                padding: 12px 30px;
                cursor: pointer;
                font-size: 20px;
            }

            /* Darker background on mouse-over */
            .downloadbtn:hover {
                background-color: RoyalBlue;
            }
            a {
                text-decoration: none;
            }

            .centerlogo {
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 13%;
            }

        </style>
    </head>
    <!-- Add icon library -->
    
    <body>
        <center><img src="Images/logo.png" alt="logo" class="centerlogo"></center>
        
        <p class="center">Success!</p> 
        <div class="results">
            <div class="row">
                <div class="column">
                    <b><p style="text-align:center;"> Image 1</p></b>
                    <img src="Images/<?php echo $_REQUEST['file1']; ?>" alt="Before" style="width:100%">
                </div>
                <div class="column">
                    <b><p style="text-align:center;"> Image 2</p></b>
                    <img src="Images/<?php echo $_REQUEST['file2']; ?>" alt="After" style="width:100%">
                </div>
            </div>
        </div>
        <div class="results">
            <div class="row">
                <b><p style="text-align:center;"> Similarity Visualization</p></b>
                <img src="Images/sim_im.png" alt="Before" style="width:100%">
                
            </div>
        </div>
        
        <p> Overall Similarity Score: 
            <?php 
                $string = file_get_contents("data.json");
                $json_a = json_decode($string, true);
                echo $json_a['score'];
            ?>
        </p>
        <p> Simiarity Score details:</p>
        <a href="similarity_score.xlsx" download>
            <p class="download">
                <button class="downloadbtn"><i class="fa fa-download"></i> Download</button>
            </p>
        </a>
    </body>
</html>

