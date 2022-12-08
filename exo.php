<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <style>
            body{

                margin: 10px;
                width: 45%;
                height: 45%;
            }

            .container {
                width: 45%;
                height: 45%;
                border: 2px solid #000;
                padding: 10px;
            }
            .containerinfo{

                width:100%;
                display:inline-block;
    
            }
            .container-photo{
                border: 1px solid #000;
                width:30%;
                margin: 0px 4px 0px 2px;
                float: left;
            }
            .container-info{
                display:inline-block;
                border: 1px solid #000;
                width:64%;
                padding: 0px 0px 0px 4px;
                margin: 0px 0px 0px 0px;}
            .containerButton{
                padding: 5px;}

            .title {
                font-weight: bold;
            }
            input{
                padding: 5px;
                background-color:  #000;
                color:white;
                font-weight: bold;
                border-radius:5px;
            }

           img{
                weight: 59px;
                width: 59px;
            }
        </style>
    </head>
    <body>
        <div class="container">

                <!--Nom-->
                <div class="containerinfo"> 
                        <!--Photo-->
                        <div class="container-photo" id="photo">   <img src="http://localhost/AppGeo/connection/imagearuser/jo.jpeg"/> </div>
                        <!--infor-->
                        <div class="container-info">
                            <p> <label class="title" for="name">Nom:</label>
                                <label class="respo" for="name">Gauss</label><br />
                                <label class="title" for="name">Phone:</label>
                                <label class="trspo" for="name">0974205191</label>
                            </p>
     
                        </div>
                </div>
                <!--Adresse-->
                <div  class="containerAdresse"> 
                    <fieldset>
                        <legend>Adresse</legend>
                        <p><label class="title" for="name">Commune:</label>
                            <label class="respo" for="name">Gauss</label><br />
                            <label class="title" for="name">Quartier:</label>
                            <label class="respo" for="name">Himbi</label><br />
                            <label class="title" for="name">Avenue:</label>
                            <label class="respo" for="name">Baraka</label><br />
                            <label class="title" for="name">Numero:</label>
                            <label class="respo" for="name">34</label>
                        </p>
                    </fieldset>
                </div>
                <!--Button-->
                <div class="containerButton">
                    <input type="button" name="send" value="Accuser reception" /> 
                </div>

        </div>



    </body>
</html>
