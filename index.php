<?php
$bilddateien=array();
$d=opendir('bilder');
while($f=readdir($d)) {
    if($f== '.' || $f== '..' || $f== 'index.php') {
        continue;
    }
    $bilddateien[]=$f;
}
closedir($d);
asort($bilddateien);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Bildergalerie</title>
  <style>
    img {
        max-height:150px;
    }
    </style>
    <script>
    var bilder=<?= json_encode($bilder) ?>;
    function datei_ausgewaehlt() {
        let input=document.getElementById('bild');
        let pfad=input.value;
        let index=pfad.lastIndexOf("\\");
        if(index<0) {
            pfad.lastIndexOf("/");
        }
        if(index>=0) {
            pfad=pfad.substring(index+1);
        }
        index=bilder.indexOf(pfad);
        if(index<0) {
            //alles Ok, neue Datei wird hochgeladen
            return;
        }
        if(confirm('Datei '+pfad+' ist schon vorhanden. Ersetzen?')) {
            return;
        }
        input.value='';
    }
    </script>
</head>
<body>
<h1>Bildergalerie</h1>
<form action="bild_upload.php" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
    <input type="file" name="bild" id="bild" onchange="datei_ausgewaehlt()" /> <input type="submit" value="Hochladen"  />
</form>
<?php
foreach($bilddateien as $f) {
?>
<img src="bilder/<?= htmlentities($f,ENT_COMPAT) ?>" />
<?php
}
?>
</body>
</html>