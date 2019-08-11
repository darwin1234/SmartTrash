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
    <div class="water" style="height: 70%;"></div>
</div>

<div class="tank">
    <div class="water" style="height: 10%;"></div>
</div>

<script>
            
            var obtained = 1612;
            var obt = obtained*100/500;
            console.log(obt);
            var water1 = document.getElementById("water1");
            water1.style.height = obt + "%";
           
</script>
</body>
</html>






 