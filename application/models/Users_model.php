<?php
class Users_model extends CI_Model {

  public function __construct() {
    parent::__construct();
    $this->load->database();
  }
  
  //Check if username/pass combo exists, if so return true else return false
  public function checkLogin($username,$pass) {
	  $sql = "SELECT username FROM Users WHERE username = ? AND password = ?";
	  $query = $this->db->query($sql,array($username,$pass));
	  return count($query->result()) > 0;
  }

  //If $follower is following $followed return true, else return false
  public function isFollowing($follower,$followed) {
	  $sql = "SELECT follower_username FROM User_Follows WHERE follower_username = ? AND followed_username = ?";
	  $query = $this->db->query($sql,array($follower,$followed));
	  return count($query->result()) > 0;
  }
  
  //Insert into the User_Follows table the currently logged in user and $followed
  public function follow($followed) {
	  $sql = "INSERT INTO User_Follows (follower_username, followed_username) VALUES (?, ?)";
	  $this->db->query($sql,array($this->session->userdata("username"), $followed));
  }
  
}