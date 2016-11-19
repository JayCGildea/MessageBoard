<?php
class Messages_model extends CI_Model {

  public function __construct() {
    parent::__construct();
    $this->load->database();
  }
  
  //Return all messages posted by $name
  public function getMessagesByPoster($name = "") {
    $sql = "SELECT user_username,text,posted_at FROM Messages WHERE user_username = ? ORDER BY posted_at DESC";
    $query = $this->db->query($sql,$name);
    return $query->result();
  }
  
  //Return all messages containing $string
  public function searchMessages($string = "") {
	$string = "%".$string."%";
    $sql = "SELECT user_username,text,posted_at FROM Messages WHERE text LIKE ? ORDER BY posted_at DESC";
    $query = $this->db->query($sql,$string);
    
    return $query->result();
  }
  
  // Insert into Messages $posted and $string with the current datetime
  public function insertMessage($poster,$string) {
	  $sql = "INSERT INTO Messages (user_username,text,posted_at) VALUES (?, ?, ?)";
	  $this->db->query($sql,array($poster,$string,date("Y-m-d H:i:s")));
  }
  
  // Get all messages from users that $name follows
  public function getFollowedMessages($name) {
	$sql = "SELECT Messages.user_username,Messages.text,Messages.posted_at FROM Messages INNER JOIN User_Follows ON Messages.user_username=User_Follows.followed_username WHERE User_Follows.follower_username = ? ORDER BY Messages.posted_at DESC";
    $query = $this->db->query($sql,$name);
	return $query->result();
  }

}