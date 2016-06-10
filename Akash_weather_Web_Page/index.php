<?php
/*
	Title : Adorable Weather
	Description : This webpage gives weather forecast of the user location by detecting user,s geolocation from WebBrowser or by entering the location.
	Author : Akash Anilkumar Patel
	Create Date : 6th June 2016
*/
$apikey = "05843fdfbb835f7a";
$locationcity = "";
$dupq = "";
if(isset($_REQUEST['locationcity']))
{
	$locationcity = trim($_REQUEST['locationcity']);
	$locationcity1= str_replace(" ","_",$locationcity);
	
	$url = "http://api.wunderground.com/api/". $apikey ."/geolookup/conditions/q/". $locationcity1 .".json";
	$content = file_get_contents($url);
	$data1 = $data = json_decode($content);
	
	if(isset($data->response->results) && count($data->response->results) > 0)
	{
		$dupq = @$_REQUEST['dupq'];
		if($dupq != "0" && $dupq != "")
		{
			$url = "http://api.wunderground.com/api/". $apikey ."/geolookup/conditions". $dupq .".json";
			$content = file_get_contents($url);
			$data = json_decode($content);
			$newdata = $data;
		}
	}
	else
	{
		$newdata = $data;
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>weather</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/custom.css">
<!-- Optional theme -->
<link rel="stylesheet" href="css/bootstrap-theme.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</head>
<body class="bodybg">

<div class="container bgwhite">
	<div class="row text-right">
    	<div class="col-lg-12 topbg">
	    	<p class="white"></p>	
        </div>
    </div>
    <div class="row">
		<center><h1>Welcome to weather Forecast Page.</h1></center>
    	<div class="col-lg-6">
			<br />
        </div>
        <div class="col-lg-6 text-right">
        </div>
    </div>
    <div class="row">
    	<div class="col-lg-2 menutext" style="background-color: #9e021a"></div>
        <div class="col-lg-2 menutext" style="background-color: #c34200"></div>
		<div class="col-lg-2 menutext" style="background-color: #fe8100"></div>
        <div class="col-lg-2 menutext" style="background-color: #feac00"></div>
        <div class="col-lg-2 menutext" style="background-color: #a37704"></div>
        <div class="col-lg-2 menutext" style="background-color: #474303"></div>

    </div>
    
    <div class="row">
    	<div class="col-lg-12" id="dacontainer">
        	<form method="post" id="mainform" name="mainform">
                <div class="row">
                    <div class="col-lg-12">
                        <br/>
                        <center>Please enter a city below or allow the Web Browser to access your Geolocation.</center>
                        <br />
                        <div class="row">
                            <div class="col-lg-2">
                            </div>
                            <div class="col-lg-8">
                                <center><input type="text" name="locationcity" id="locationcity" value="<?php echo $locationcity; ?>" style="width: 80%; padding: 5px;" /></center>
                                <br />
                                <center>
                                <?php
								if(isset($data1->response->results) && count($data1->response->results) > 0)
								{
									?>
                                    <select id="dupq" name="dupq" onchange="this.form.submit();" style="width: 80%; padding: 5px;" />>
                                    	<option value="0">-- SELECT --</option>
                                    <?php
									foreach($data1->response->results as $q)
									{
									?>
                                    	<option <?php if($dupq == $q->l) { echo " selected "; } ?> value="<?php echo $q->l; ?>"><?php echo $q->city; ?>, <?php echo $q->state; ?> <?php echo $q->country_name; ?></option>
                                    <?php
									}
									?>
                                    </select>
                                    <?php								
								}
								?>
                                </center>
                            </div>
                            <div class="col-lg-2">
                            </div>
                        </div>
                        <br />
                    </div>
                </div>         
                
                <?php
				if(isset($_REQUEST['locationcity']) && isset($data) && isset($newdata))
				{
					
					if(isset($newdata))
					{
						$data = $newdata;
					}
					if(isset($data->current_observation->weather)){

				?>
                <div class="row">
                    <div class="col-lg-2" >
                    </div>
                    <div class="col-lg-8">
                        <br />
                        <table style="border-collapse: collapse;" border="1" bordercolor="#CCCCCC" align="center">
                            <tr>
                                <td style="padding: 5px;">Weather : </td>
                                <td style="padding: 5px;"><?php echo $data->current_observation->weather; ?> &nbsp; <img src="<?php echo $data->current_observation->icon_url; ?>" /></td>
                            </tr>
                            <tr>
                                <td style="padding: 5px;">Temperature : </td>
                                <td style="padding: 5px;"><?php echo $data->current_observation->temperature_string; ?></td>
                            <tr>
                                <td style="padding: 5px;">Feels Like : </td>
                                <td style="padding: 5px;"><?php echo $data->current_observation->feelslike_string; ?></td>
                            </tr>
                            <tr>
                                <td style="padding: 5px;">Humidity : </td>
                                <td style="padding: 5px;"><?php echo $data->current_observation->relative_humidity; ?></td>
                            </tr>
                            <tr>
                                <td style="padding: 5px;">Wind : </td>
                                <td style="padding: 5px;"><?php echo $data->current_observation->wind_string; ?></td>
                            </tr>
                            <tr>
                                <td style="padding: 5px;">Dew Point : </td>
                                <td style="padding: 5px;"><?php echo $data->current_observation->dewpoint_string; ?></td>
                            </tr>
                        </table>
                        <br />
               			 <br />
                    </div>
                    <div class="col-lg-2">
                    </div>
                </div>
                <?php
					}else{
							?>
                <div class="row">
			    	<div class="col-lg-12 topbg">
						<p class="white">
						<center><h3>There is an error of the city name</h3></center>
						</p>	
					</div>
				</div>
							<?php
					}
				}
				?>
                </form>
        </div>
    </div>
     
    <div class="row">
    	<div class="col-lg-2 menutext" style="background-color: #9e021a"></div>
        <div class="col-lg-2 menutext" style="background-color: #c34200"></div>
		<div class="col-lg-2 menutext" style="background-color: #fe8100"></div>
        <div class="col-lg-2 menutext" style="background-color: #feac00"></div>
        <div class="col-lg-2 menutext" style="background-color: #a37704"></div>
        <div class="col-lg-2 menutext" style="background-color: #474303"></div>
    </div>      
</div>

<script language="javascript" type="text/javascript">
	
	if(document.getElementById('locationcity').value == '')
	{
		getLocation();
	}
	/* getLocation() function detects user's geolocation from webbrowser.*/
	function getLocation()
	{
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(showPosition);
		} else {
			$.get( "api1.php", function( data ) {
				  if(data != "")
				  {
					 $( "#dacontainer" ).html( data ); 			
				  }
				  
			  });
		}
	}
	
	/* showPosition(position) function shows the position of the user.*/
	function showPosition(position)
	{
		$( "#dacontainer" ).html( '<br /><center><img style="margin-top: 2px;" src="loading.gif" /></center><br />');
		$.get( "api1.php?geo=" + position.coords.latitude + "," + position.coords.longitude, function( data ) {
		  if(data != "")
		  {
			 $( "#dacontainer" ).html( data ); 			
		  }
		  
	  });
		
	}
</script>
</body>
</html>