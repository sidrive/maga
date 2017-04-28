<?php
  // memanggil file koneksi.php untuk melakukan koneksi database
 require_once("koneksi.php");
 ?>
<html>
<head>
<script>
function showDatabarang(str) {
    if (str == "") {
        document.getElementById("txtData").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtData").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","coba.php?kode="+str,true);
        xmlhttp.send();
    }bacaSuplier(str);
}
</script>

<script>
	function bacaSuplier(str) {
    if (str == "") {
        document.getElementById("txtSup").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtSup").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","bacaSup.php?kode="+str,true);
        xmlhttp.send();
    }
	}
	</script>
	
	<script>
	function keranJang(str) {
    if (str == "") {
        document.getElementById("txtKeranjang").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtKeranjang").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","keranjang.php?kode="+str,true);
        xmlhttp.send();
    }
	}
	</script>
</head>
<body>

<form>
<select name="users" onchange="showDatabarang(this.value)">
  <option value="">Select a person:</option>
  <?php $sql = mysqli_query($connect_db,"SELECT * FROM SUP ORDER BY NAMA_SUP ASC");
    while ($row = mysqli_fetch_array($sql)) { echo
		"<option value='"; echo $row['KODE_SUP']."'>";
		echo $row['NAMA_SUP']."</option>";
		
	} ?>
  
  </select>
</form>
<br>
<div id="txtSup"><b>Person info will be listed here...</b></div>
<div id="txtData"><b>Person info will be listed here...</b></div>
<div id="txtKeranjang"><b>Person info will be listed here...</b></div>

</body>
</html>