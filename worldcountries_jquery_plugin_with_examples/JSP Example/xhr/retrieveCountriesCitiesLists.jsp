<%@ page import="java.sql.*" %>
<%
/* This is the only part you need to edit in this file
 * Change the below defaults with your database name, user and password and you'll be ready to go.
 */
String db = "jqueryplugin";
String dbUser = "root";
String dbPassword = "password";
/* end of the part you need to edit */

/* database connection, no need to edit (or you can use your own database layer class and replace this */
Connection connection = null;
ResultSet result = null;
Statement query = null;
try {
		Class.forName("com.mysql.jdbc.Driver").newInstance();
	} catch (Exception e) {
		e.printStackTrace();
	}
	try {
		connection = DriverManager.getConnection("jdbc:mysql:///" + db, dbUser, dbPassword);
	} catch (SQLException e) {
		e.printStackTrace();
	}
/* end of connecting to database */

StringBuilder json = new StringBuilder("[");

/* if countries list is not generated and no country code sent with the request to fetch the cities of this country
retrieve all countris from the database */

    if(request.getParameter("countryCode") == null)
       {
        try {
		query = connection.createStatement();
	} catch (SQLException e) {
		e.printStackTrace();
	}
	try {
            String sqlCountries = "SELECT countryCode, countryName FROM countries ORDER BY countryName";
		result = query.executeQuery(sqlCountries);
	} catch (SQLException e) {
		e.printStackTrace();
	}

	try {
            	while(result.next())
		{
                  json.append("{\"countryCode\": \"" + result.getString("countryCode") + "\", ");
                  json.append("\"countryName\": \"" + result.getString("countryName") + "\"}");
                  
                  if(!result.isLast())
                    json.append(",");                      
		}
	} catch (SQLException e) {
		e.printStackTrace();
	}
    result.close();
}
else //if countries list is already generated and a request is sent to fetch the cities of the selected country
{
        String countryCode = request.getParameter("countryCode").toString();
        
        try {
		query = connection.createStatement();
	} catch (SQLException e) {
		e.printStackTrace();
	}
	try {
        String sqlCities = "SELECT cityId, cityName FROM cities WHERE cityCountryCode='" + countryCode +"'";
		result = query.executeQuery(sqlCities);
	} catch (SQLException e) {
		e.printStackTrace();
	}

    
	try {
            	while(result.next())
		{
                  json.append("{\"cityId\": \"" + result.getString("cityId") + "\", ");
                  json.append("\"cityName\": \"" + result.getString("cityName") + "\"}");
                  
                  if(!result.isLast())
                    json.append(",");                      
		}
	} catch (SQLException e) {
		e.printStackTrace();
	}
    result.close();
    
}      
json.append("]");
out.print(json.toString());
%>
