<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Postcode Finder</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="styles.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container shellContainer">
      <div class="row">


        <h1>Postcode Finder</h1>
        <p class="white center">Enter any address to find the postcode</p>

        <form class=""  method="">
          <div class="form-group">
            <input class="form-control" type="text" id="userAddress" name="userAddress" value=""
                  placeholder="i.e, 42 Wallaby Way, Sydney">

            <button class="btn btn-success btn-lg submitButton"
                  name="button">SUBMIT</button>
          </div>
        </form>

        <div  id="success" class="alert alert-success">SUCCESS</div>
        <div  id="error" class="alert alert-danger">Could not find a postcode for that address. Please try again.</div>
        <div  id="error2" class="alert alert-danger center">Error</div>
        <!-- <div class="input-group container-fluid">
          <input type="text" class="form-control userInput" placeholder="Enter an address...">

          <input class="btn-success submitButtom" type="submit" name="" value="submit">
        </div> -->
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

    <script type="text/javascript">
      $(".submitButton").click(function(event) {
        var result = 0;
        /* Act on the event */
        event.preventDefault();
        $.ajax({
          type:"GET",
          url:"https://maps.googleapis.com/maps/api/geocode/xml?address="+encodeURIComponent($("#userAddress").val())+"&key=AIzaSyBku3hBLJBxxZobKjiTq0Xx1kOacZwAjzA",
          dataType:"xml",
          success: processXML,
          error: error
        });

        function error(){
          $("#error2").fadeIn().delay(5000).fadeOut();;
        }

        function processXML(xml){
          //alert(xml);
          $(xml).find("address_component").each(function() {
            if ($(this).find("type").text() == "postal_code"){

              $("#success").html("The Postal Code for " + $("#userAddress").val()+ " is: "+ $(this).find("long_name").text()).fadeIn().delay(5000).fadeOut();

              result = 1;
            };
          });
        };
      });
    </script>
  </body>
</html>
