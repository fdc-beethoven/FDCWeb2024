<?php
class Project
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }


    private function projectNameExists($name)
    {
        $query = $this->db->prepare("SELECT id FROM projects WHERE name = ?");
        $query->bind_param("s", $name);
        $query->execute();
        $query->store_result();
        return $query->num_rows > 0;
    }

    public function createProject($name, $description, $createdBy)
    {
        if ($this->projectNameExists($name)) {
            return false;
        }

        $query = $this->db->prepare("INSERT INTO projects (name, description, created_by) VALUES (?, ?, ?)");
        $query->bind_param("ssi", $name, $description, $createdBy);

        if ($query->execute()) {
            return $query->insert_id;
        } else {
            return false;
        }
    }

    public function getProjects()
    {
        $query = $this->db->prepare("SELECT * FROM projects WHERE is_deleted = 0");
        $query->execute();
        $result = $query->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProjectDetails($projectId)
    {
        $query = $this->db->prepare("SELECT * FROM projects WHERE id = ?");
        $query->bind_param("i", $projectId);

        if ($query->execute()) {
            $result = $query->get_result();
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    public function updateProject($projectId, $name, $description, $pmId)
    {
        $query = $this->db->prepare("UPDATE projects SET name = ?, description = ?, pm_id = ? WHERE id = ?");
        $query->bind_param("ssii", $name, $description, $pmId, $projectId);

        return $query->execute();
    }

    public function deleteProject($projectId)
    {
        $query = $this->db->prepare("UPDATE projects SET is_deleted = 1 WHERE id = ?");
        $query->bind_param("i", $projectId);

        return $query->execute();
    }
}
?>