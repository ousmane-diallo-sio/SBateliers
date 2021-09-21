<!DOCTYPE html>
<html lang="fr">

	<head>
		<title>Test ER</title>
		
		<link rel="stylesheet" href="../src/css/styles.css"/>
		
	</head>



	<body>
		
		<form action="../controleurs/ctrl-testER.php" method="POST" style="display:flex; flex-direction:column;" >
			<label>Expression</label>
			<input name="expression" style="min-width:30em;" />

            <label>Chaine de char</label>
            <input name="char" style="min-width:20em;"/>

			<button type="submit">Valider</button>
		</form>
		
	</body>


</html>
