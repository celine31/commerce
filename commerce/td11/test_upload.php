<?php
require_once 'class/Upload.php';
require_once 'class/I18n.php';
if(filter_input(INPUT_POST,'submit')){
    $upload=new Upload('photo',[],['image/jpeg']);
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Test Upload</title>
		<script>
			const MAX_FILE_SIZE = <?= Upload::maxFileSize() ?>;
		</script>

	</head>
	<body>
		<form name="form1" action="" method="post" enctype="multipart/form-data">
			<input id="photo" type="file" name="photo"/>
			<input type="submit" value="Envoyer"/>
			<p id="vignette" style="width: 300px; height: 300px"></p>
			
		</form>
		<script>
			var vignette = document.querySelector('#vignette');
			document.querySelector('#photo').onchange = function () {
				vignette.innerHTML = '';
				var fichiers = this.files;
				if (fichiers.length !== 1) {
					return;
				}
				var fichier = fichiers[0];
				if (!fichier.size) {
					return alert("Le fichier est vide.");
				}
				if (fichier.size > MAX_FILE_SIZE) {
					return alert("Le fichier est trop lourd.");
				}
				if (fichier.type !== 'image/jpeg') {
					return alert("Le fichier n'est pas JPEG.");
				}
				var reader = new FileReader();
				reader.onload = function () {
					var image = new Image();
					image.style.maxWidth = '100%';
					image.style.maxHeight = '100%';
					vignette.appendChild(image);
					image.src = this.result;
				};
				reader.readAsDataURL(fichier);
			};
		</script>
	</body>
</html>
