<!DOCTYPE html>
<html>
<head>
<title>WorldCountries jQuery Plugin Example</title>
<link  href="css/styles.css" type="text/css" rel="stylesheet" />
<!-- serve jQuery from Google's CDN -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script src="js/plugins/jquery.worldcountries.js" type="text/javascript"></script>

<script>
$(function(){
$('#testCountriesList').worldcountries({url: "xhr/retrieveCountriesCitiesLists.php", dependantCities: $("#testCitiesList")});
});
</script>

</head>

<body>
    <h3>Registration form</h3>
    <hr />
    <table>
        <tr>
            <th>
Name
            </th>
            <td>
                <input type="text" name="name" id="name" />

            </td>
        </tr>
        <tr>
            <th>
E-mail
            </th>
            <td>
                <input type="text" name="email" id="email" />

            </td>
        </tr>
        <tr>
            <th>
Countries                
            </th>
            <td>
<select id="testCountriesList" class="testCountriesList">
</select>
            </td>
        </tr>
        <tr>
            <th>
Cities                
            </th>
            <td>
                <select id="testCitiesList" class="testCitiesList"></select>                
            </td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submit" id="submit" />
            </td>
        </tr>
    </table>

<br />

</body>
</html>