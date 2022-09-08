<?php

/**
 * protéger les formulaires contre les attaques CSRF.
 * 
 * @author ESTIAM
 *
 */
class CSRF_Protect
{
	/**
	 * L'espace de noms pour la variable de session et les entrées de formulaire
	 * @var string
	 */
	private $namespace;

	/**
	 * création d'un jeton à usage unique et ajoutez-le à la $_SESSIONvariablen
	 * 
	 * @param string $namespace
	 */
	public function __construct($namespace = '_csrf')
	{
		$this->namespace = $namespace;

		if (session_id() === '') {
			session_start();
		}

		$this->setToken();
	}

	/**
	 * Renvoyer le jeton du stockage persistant
	 * 
	 * @return string
	 */
	public function getToken()
	{
		return $this->readTokenFromStorage();
	}

	/**
	 * Vérification si le jeton fourni correspond au jeton stocké
	 * 
	 * @param string $userToken
	 * @return boolean
	 */
	public function isTokenValid($userToken)
	{
		return ($userToken === $this->readTokenFromStorage());
	}

	/**
	 * Echo au champ de saisie HTML avec le jeton et l'espace de noms comme nom du champ
	 */
	public function echoInputField()
	{
		$token = $this->getToken();
		echo "<input type=\"hidden\" name=\"{$this->namespace}\" value=\"{$token}\" />";
	}

	/**
	 * Vérifie si le jeton de publication a été défini, sinon affiche une erreur
	 */
	public function verifyRequest()
	{
		if (!$this->isTokenValid($_POST[$this->namespace])) {
			die("CSRF validation failed.");
		}
	}

	/**
	 * Génère une nouvelle valeur de jeton et la stocke dans le stockage persisent, ou bien ne fait rien s'il en existe déjà un dans le stockage persistant
	 */
	private function setToken()
	{
		$storedToken = $this->readTokenFromStorage();

		if ($storedToken === '') {
			$token = md5(uniqid(rand(), TRUE));
			$this->writeTokenToStorage($token);
		}
	}

	/**
	 * Lire le jeton du stockage persistant
	 * @return string
	 */
	private function readTokenFromStorage()
	{
		if (isset($_SESSION[$this->namespace])) {
			return $_SESSION[$this->namespace];
		} else {
			return '';
		}
	}

	/**
	 * Écrire le jeton dans le stockage persistant
	 */
	private function writeTokenToStorage($token)
	{
		$_SESSION[$this->namespace] = $token;
	}
}
