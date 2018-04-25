<?php
// On démarre la session
session_start();

if(isset($_POST['pseudo']) && isset($_POST['message']))
{
	if (!isset($_SESSION['pseudo'])) {//si la variable $_SESSION['pseudo'] n'existe pas, création
		$_SESSION['pseudo'] = $_POST['pseudo'];
	}

	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=blogPHP', 'root', 'root');
	}
	catch (Exception $e)
	{
	        die('Erreur : ' . $e->getMessage());
	}

	$req = $bdd->prepare('INSERT INTO minichat(pseudo, message, day)
						  VALUES(:pseudo, :message, NOW())');
	$req->execute(array(
	'pseudo' => htmlspecialchars($_POST['pseudo']),
	'message' => htmlspecialchars($_POST['message'])
	));


}

header('Location: index.php');
