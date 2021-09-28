<!DOCTYPE html>
<html lang="fr">

	<head>
		<title>Créer un compte</title>
		
		<link rel="stylesheet" href="../src/css/styles.css"/>

	</head>



	<body>
		
		<form action="../controleurs/ctrl-enregistrer-client.php" method="POST" style="display:flex; flex:1; flex-direction:column; align-items:center; margin:auto" >
			<div style="width:50%">
				<div style="display:flex; justify-content:space-evenly;  flex-direction:column;">

				<?php

					$styleErreur = 'color:red; background-color:#fee; border-radius:5%; text-align:center';

					switch($_SERVER['REQUEST_URI']){
						case "/sbateliers/vues/vue-enregistrement-client.php?echec=code_postal":
							echo "<p style='$styleErreur'>Mauvais format [ Code postal ].</p>";
							break;
						case "/sbateliers/vues/vue-enregistrement-client.php?echec=numero_tel":
							echo "<p style='$styleErreur'>Mauvais format [ Numéro de téléphone ].</p>";
							break;
					}

				?>

					<label>Civilite</label>
					<div>
						<label for="civilite-homme">Homme</label>
						<input id="civilite-homme" name="civilite" type="radio" value="Homme" required />
						<label for="civilite-femme">Femme</label>
						<input id="civilite-femme" name="civilite" type="radio" value="Femme" required />
					</div>
				</div>

				<div style="display:flex; flex-direction:column; align-self:flex-start;">
					<div style="display:flex; justify-content:space-evenly; width:100%; margin:1em 0 1em 0; flex-wrap:wrap; justify-content:flex-start">
						<div>
							<label>Nom</label>
							<input name="nom" required />
						</div>
						<div>
							<label>Prenom</label>
							<input name="prenom" required />
						</div>
						<div>
							<label>Date de naissance</label>
							<input name="date_de_naissance" type="date" required />
						</div>
					</div>
					
					<div style="display:flex; justify-content:space-evenly; width:100%; margin:1em 0 1em 0; flex-wrap:wrap; justify-content:flex-start">
						<div>
							<label>Code postal</label>
							<input name="code_postal" type="number" style="width:10ch" required />
						</div>
						<div>
							<label>Ville</label>
							<input name="ville" required />
						</div>
						<div>
							<label>Numéro de téléphone</label>
							<input name="numero_tel" type="int" style="width:10ch" required />
						</div>
				
					</div>
					
					
					<label>adresse email</label>
					<input name="email" type="email" style="width:35%" required />
					<label>Adresse postale</label>
					<input name="adresse" style="width:50%" required />

					
					<label>Mot de passe</label>
					<input id="mdp" name="mdp" type="password" minlength=8 oninput="showRules(), checkValider()" required /> </br>
					<label>Confirmer mot de passe</label>
					<input id="confirmation_mdp" name="confirmation_mdp" type="password" minlength=8 oninput="showRules(), checkValider()" required /> </br>

					<button class="btnValider" id="btnValider" type="submit" style="width:50%; align-self:center">Créer un compte</button>
					<ul style="text-align:left;">
						<p id="rule1" style="text-align:center; color:red; display:none ">Le mot de passe doit avoir au moins 8 charactères.</p>
						<p id="rule2" style="text-align:center; color:red; display:none ">Les mots de passe ne correspondent pas.</p>	
					<ul>
				</div>
			</div>
			
		</form>



		<script>
			
			let inputMdp = document.getElementById("mdp");
			let inputValiderMdp = document.getElementById("confirmation_mdp");
			let btnValider = document.getElementById("btnValider");
			let formProblems = document.getElementById("formProblems");

			let rule1 = document.getElementById("rule1");
			let rule2 = document.getElementById("rule2");


			let checkValider = () => {
				if(inputMdp.value != inputValiderMdp.value || inputMdp.value.length < 8){
					btnValider.disabled = true;
					btnValider.style.background = "#aaa";
				} 
				else {
					btnValider.disabled = false;
					btnValider.style.background = "#33f";
					rule1.style.display = "none";
					rule2.style.display = "none";
				}
			}

			let showRules = () => {
				if(inputMdp.value != inputValiderMdp.value){
						rule2.style.display = "block"; 
				} 
				else {
					rule2.style.display = "none";
				}


				if(inputMdp.value.length < 8){
					rule1.style.display = "block";
				} 
				else{
					rule1.style.display = "none";
				}


			}

			document.addEventListener("DOMContentLoaded", function(){
				checkValider();
			});

		</script>
		
	</body>


</html>
