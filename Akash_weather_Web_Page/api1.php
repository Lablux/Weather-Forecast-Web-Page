<?php
/*
	Title : Adorable Weather
	Description : This webpage gives weather forecast of the user location by detecting user,s geolocation from WebBrowser or by entering the location.
	Author : Akash Anilkumar Patel
	Create Date : 6th June 2016
*/

$apikey = "05843fdfbb835f7a";
// http://api.wunderground.com/api/05843fdfbb835f7a/geolookup/q/22.267422600000003,73.18527259999999.json
if(isset($_REQUEST['geo']))
{
	$geo = trim($_REQUEST['geo']);
	$url = "http://api.wunderground.com/api/". $apikey ."/geolookup/q/". $geo .".json";
	$content = file_get_contents($url);
	$data = json_decode($content);
	
	
	$url = "http://api.wunderground.com/api/". $apikey ."/geolookup/conditions/q/". $data->location->city .".json";
	$content = file_get_contents($url);
	$data = json_decode($content);
	
	

?>
<form method="post" id="mainform" name="mainform">
<div class="row">
    <div class="col-lg-12" id="dacontainer">
        <br />
        <center>Please enter a city below or allow the Web Browser to access your Geolocation.</center>
        <br />
        <div class="row">
        	<div class="col-lg-2" >
            </div>
            <div class="col-lg-8">
            	<Center><input type="text" name="locationcity" id="locationcity" value="<?php echo $data->location->city; ?>" style="width: 80%; padding: 5px;" /></Center>
            </div>
            <div class="col-lg-2">
            </div>
        </div>
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
        <br />
    </div>
</div>
</form>
<?php
}
else
{
	?>
    <form method="post" id="mainform" name="mainform">
    <div class="row">
        <div class="col-lg-12" id="dacontainer">
            <br />
            Geolocation information is not available. Please enter a city below.
            <br />
            <div class="row">
                <div class="col-lg-2" id="dacontainer">
                </div>
                <div class="col-lg-8" id="dacontainer">
                    <input type="text" name="locationcity" id="locationcity" value="" style="width: 80%; padding: 5px;" />
                </div>
                <div class="col-lg-2" id="dacontainer">
                </div>
            </div>
            <br />
        </div>
    </div>
    </form>
    <?php
}
?>