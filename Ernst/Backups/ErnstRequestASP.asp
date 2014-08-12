<html>
<head>
<title>Calling Ernst Web service from classic ASP</title>
</head>
<body>
<%
If Request.ServerVariables("REQUEST_METHOD") = "POST" Then
Dim xmlhttp
Dim DataToSend
DataToSend="xmlRequest="&Request.Form("text1")
Dim postUrl
postUrl =
"http://www.ernstpublishing.com/xml_webservice/processxml.asmx/Request"
Set xmlhttp = server.Createobject("MSXML2.XMLHTTP")
xmlhttp.Open "POST",postUrl,false
xmlhttp.setRequestHeader "Content-Type","application/x-www-form-urlencoded"
xmlhttp.send DataToSend
Response.Write DataToSend & "<br>"
Response.Write(xmlhttp.responseText)
Else
Response.Write "Loading for first Time"
End If
%>
<FORM method=POST name="form1" ID="Form1">
Enter the Request<BR>
<INPUT type="text" name="text1" ID="Text1" value="<Request></Request>">
<BR><BR>
<INPUT type="submit" value="GO" name="submit1" ID="Submit1">
</form>
</body>
</html>