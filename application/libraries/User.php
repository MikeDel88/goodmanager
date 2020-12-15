<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * User
 * Cette classe représente le model de construction pour un utilisateur
 */
class User extends Utilities {

	private int $id;
	private int $entreprise_id = 0;
	private string $email;
	private string $password;
	private string $nom ='';
	private string $prenom = '';
	private int $active;
	private int $admin;
	private string $token;
	private string $token_validation;
	private string $created_at;
	private string $updated_at;


	/**
	 * Get the value of id
	 */ 
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set the value of id
	 *
	 * @return  self
	 */ 
	public function setId($id)
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * Get the value of entreprise_id
	 */ 
	public function getEntreprise_id()
	{
		return $this->entreprise_id;
	}

	/**
	 * Set the value of entreprise_id
	 *
	 * @return  self
	 */ 
	public function setEntreprise_id($entreprise_id)
	{
		$this->entreprise_id = $entreprise_id;

		return $this;
	}

	/**
	 * Get the value of email
	 */ 
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * Set the value of email
	 *
	 * @return  self
	 */ 
	public function setEmail($email)
	{
		$this->email = $email;

		return $this;
	}

	/**
	 * Get the value of password
	 */ 
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * Set the value of password
	 *
	 * @return  self
	 */ 
	public function setPassword($password)
	{
		$this->password = $password;

		return $this;
	}

	/**
	 * Get the value of nom
	 */ 
	public function getNom()
	{
		return $this->nom;
	}

	/**
	 * Set the value of nom
	 *
	 * @return  self
	 */ 
	public function setNom($nom)
	{
		$this->nom = $nom;

		return $this;
	}

	/**
	 * Get the value of prenom
	 */ 
	public function getPrenom()
	{
		return $this->prenom;
	}

	/**
	 * Set the value of prenom
	 *
	 * @return  self
	 */ 
	public function setPrenom($prenom)
	{
		$this->prenom = $prenom;

		return $this;
	}

	/**
	 * Get the value of active
	 */ 
	public function getActive()
	{
		return $this->active;
	}

	/**
	 * Set the value of active
	 *
	 * @return  self
	 */ 
	public function setActive($active)
	{
		$this->active = $active;

		return $this;
	}

	/**
	 * Get the value of created_at
	 */ 
	public function getCreated_at()
	{
		return $this->created_at;
	}

	/**
	 * Set the value of created_at
	 *
	 * @return  self
	 */ 
	public function setCreated_at($created_at)
	{
		$this->created_at = $created_at;

		return $this;
	}

	/**
	 * Get the value of updated_at
	 */ 
	public function getUpdated_at()
	{
		return $this->updated_at;
	}

	/**
	 * Set the value of updated_at
	 *
	 * @return  self
	 */ 
	public function setUpdated_at($updated_at)
	{
		$this->updated_at = $updated_at;

		return $this;
	}

	/**
	 * Get the value of token
	 */ 
	public function getToken()
	{
		return $this->token;
	}

	/**
	 * Set the value of token
	 *
	 * @return  self
	 */ 
	public function setToken($token)
	{
		$this->token = $token;

		return $this;
	}

	/**
	 * Get the value of token_validation
	 */ 
	public function getToken_validation()
	{
		return $this->token_validation;
	}

	/**
	 * Set the value of token_validation
	 *
	 * @return  self
	 */ 
	public function setToken_validation($token_validation)
	{
		$this->token_validation = $token_validation;

		return $this;
	}

	/**
	 * Get the value of admin
	 */ 
	public function getAdmin()
	{
		return $this->admin;
	}

	/**
	 * Set the value of admin
	 *
	 * @return  self
	 */ 
	public function setAdmin($admin)
	{
		$this->admin = $admin;

		return $this;
	}
}
