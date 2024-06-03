<?php
class User {
    private $db;
    private $id;
    private $username;
    private $password;
    private $role;
    private $isActive;
    private $firstName;
    private $lastName;
    private $profilePhoto;

    public function __construct($db) {
        $this->db = $db;
    }

    public function usernameExists($username) {
        $query = $this->db->prepare("SELECT id FROM users WHERE username = ?");
        $query->bind_param("s", $username);
        $query->execute();
        $query->store_result();
        return $query->num_rows > 0;
    }

    public function createUser($username, $password, $role, $firstName, $lastName, $profilePhoto) {
        if ($this->usernameExists($username)) {
            echo 'Username already exists';
            return false;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $createdIp = $_SERVER['REMOTE_ADDR']; 

        $query = $this->db->prepare("INSERT INTO users (username, password, role, first_name, last_name, profile_photo, is_active, created_ip) VALUES (?, ?, ?, ?, ?, ?, 1, ?)");
        $query->bind_param("sssssss", $username, $hashedPassword, $role, $firstName, $lastName, $profilePhoto, $createdIp);
        return $query->execute();
    }

    public function authenticate($username, $password) {
        $query = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $query->bind_param("s", $username);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $this->id = $user['id'];
                $this->username = $user['username'];
                $this->role = $user['role'];
                $this->isActive = $user['is_active'];
                $this->firstName = $user['first_name'];
                $this->lastName = $user['last_name'];
                $this->profilePhoto = $user['profile_photo'];
                return true;
            }
        }
        return false;
    }

    public function getUserDetails($userId) {
        $query = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $query->bind_param("i", $userId);
        $query->execute();
        $result = $query->get_result();
        return $result->fetch_assoc();
    }

    public function updateUserRole($userId, $role) {
        $query = $this->db->prepare("UPDATE users SET role = ? WHERE id = ?");
        $query->bind_param("si", $role, $userId);
        return $query->execute();
    }

    public function deactivateUser($userId) {
        $query = $this->db->prepare("UPDATE users SET is_active = 0 WHERE id = ?");
        $query->bind_param("i", $userId);
        return $query->execute();
    }

    public function editUserDetails($userId, $firstName, $lastName, $profilePhoto) {
        $query = $this->db->prepare("UPDATE users SET first_name = ?, last_name = ?, profile_photo = ? WHERE id = ?");
        $query->bind_param("sssi", $firstName, $lastName, $profilePhoto, $userId);
        return $query->execute();
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getRole() {
        return $this->role;
    }

    public function isActive() {
        return $this->isActive;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getProfilePhoto() {
        return $this->profilePhoto;
    }
}
?>