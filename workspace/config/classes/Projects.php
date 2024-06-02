<?php
class Projects {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function createProject($name, $description, $pmId) {
        $query = $this->db->prepare("INSERT INTO projects (name, description, pm_id) VALUES (?, ?, ?)");
        $query->bind_param("ssi", $name, $description, $pmId);

        if ($query->execute()) {
            return $query->insert_id;
        } else {
            return false;
        }
    }

    public function getProjectDetails($projectId) {
        $query = $this->db->prepare("SELECT * FROM projects WHERE id = ?");
        $query->bind_param("i", $projectId);

        if ($quey->execute()) {
            $result = $query->get_result();
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    public function updateProject($projectId, $name, $description, $pmId) {
        $query = $this->db->prepare("UPDATE projects SET name = ?, description = ?, pm_id = ? WHERE id = ?");
        $query->bind_param("ssii", $name, $description, $pmId, $projectId);

        return $query->execute();
    }

    public function deleteProject($projectId) {
        $query = $this->db->prepare("UPDATE projects SET is_deleted = 1 WHERE id = ?");
        $query->bind_param("i", $projectId);

        return $query->execute();
    }
}
?>
