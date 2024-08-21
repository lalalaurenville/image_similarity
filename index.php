<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> SIMVIZ </title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <style>
            body {
                background-color: black;
                color: white;
                font-family: Arial, Helvetica, sans-serif;
            }
            hr {
                width: 45%;
            }
            .center {
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 40%;
            }
            .button {
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 45%;
                transition-duration: 0.4s;
                cursor: pointer;
                padding: 2% 7%;
            }
            #viewsimviz {
                background-color: grey;
                border-color: white;
                color: #F8E0B9;
                border-radius: 8px;
            }
            #viewsimviz:hover {
                background-color: #EDB44E;
                border-color: #F5D296;
                color: black;
            }

            .logo {
                width: 100px;
                height: 100px;
            }

            .center {
                text-align:center; 
            }

            ul {
                text-align: center;
                list-style: inside;
            }

            .centerlogo {
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 13%;
            }
        </style>
    </head>
    
    <body>
        <div>
            <center><img src="Images/logo.png" alt="logo" class="centerlogo"></center>
            
            <p style="text-align:center;"> Compare the similarity of two given maps in seconds!</p> <hr>
            <p style="text-align:center;"> This tool will measure resemblance and generate
                <ul class="center">
                    <li>Similarity image visualization</li>
                    <li>Overall similarity score</li>
                    <li>Details available for download</li>
                </ul> 
            </p>

            <form action="action_page.php" method="post" enctype="multipart/form-data"> 
                <hr>
                <p class="center">Upload two maps aligned with the same regions and legend colors</p>
                
                <b><p style="text-align:center;"> Image 1</p></b>
                <center> <input type="file" id="myFile1" name="filename1" download="test1.jpg" multiple="multiple"  /></center>

                <b><p style="text-align:center;"> Image 2</p></b>
                <center> <input type="file" id="myFile2" name="filename2" download="test2.jpg" multiple="multiple"  /></center>
            
                <p class="center">

                <input type="submit" name="action" value="View Similarity" class="button" id="viewsimviz"/> 
                
                <br>
            </form>
        </div>
    </body>
</html>