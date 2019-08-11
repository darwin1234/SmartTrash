<html>
<head>
<title> </title>

</head>
<style>
.tank {
    width: 150px;
    height: 300px;
    border: 2px solid black;
    background: white;
    position: relative;
    
    display: inline-block;
    margin: 10px;
}

.tank .water {
    position: absolute;
    background: blue;
    width: 100%;
    bottom: 0;
}
</style>
<body>

<div class="tank">
    <div class="water" id="water1" ></div>
</div>

<div class="tank">
    <div class="water" id="water2"></div>
</div>

<div class="tank">
    <div class="water" id="water3"></div>
</div>


<table>
    <tr>
	<th>ID
	<th>Bio
	<th>Non-Bio
	<th>Recy
	<th>Extra
    </tr>

    <tbody id="data"></tbody>
</table>

<script>
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "tank.php", true);
    ajax.send();

    ajax.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            console.log(data);

            var html = "";
            for(var a = 0; a < data.length; a++) {
                var ID = data[a].ID;
                var Bio = data[a].Bio;
                var Non_Bio = data[a].Non_Bio;
		var Recy = data[a].Recy;
		var Extra = data[a].Extra;

                html += "<tr>";
                    html += "<td>" + ID + "</td>";
                    html += "<td>" + Bio + "</td>";
                    html += "<td>" + Non_Bio + "</td>";
		    html += "<td>" + Recy + "</td>";
		    html += "<td>" + Extra + "</td>";
                html += "</tr>";
            }
            document.getElementById("data").innerHTML += html; 

            var obtained = Bio;  
            var obtained2 = Non_Bio;
            var obtained3 = Recy;
            var div = 5000;

            var obt = obtained*100/div;
            var obt2 = obtained2*100/div;
            var obt3 = obtained3*100/div;

            console.log(obt);
            console.log(obt2);
            console.log(obt3);

            document.getElementById("water1").style.height = obt + "%";
            document.getElementById("water2").style.height = obt2 + "%";
            document.getElementById("water3").style.height = obt3 + "%";
           
        }

       
    };
</script>
</body>
</html>
