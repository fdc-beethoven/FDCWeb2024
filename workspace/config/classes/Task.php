<?php
class Task {
    private $db;
    public function __construct($db) {
        $this->db = $db;
    }

    public function createTask($projectId, $name, $description, $status, $priority, $assignedTo, $createdBy) {
        $query = $this->db->prepare("INSERT INTO tasks (project_id, name, description, status, priority, assigned_to, created_by) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $query->bind_param("issssii", $projectId, $name, $description, $status, $priority, $assignedTo, $createdBy);

        if ($query->execute()) {
            return $query->insert_id;
        } else {
            return false;
        }
    }

    public function getTaskDetails($taskId) {
        $query = $this->db->prepare("SELECT * FROM tasks WHERE id = ?");
        $query->bind_param("i", $taskId);

        if ($query->execute()) {
            $result = $query->get_result();
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    public function updateTask($taskId, $name, $description, $status, $priority, $assignedTo) {
        $query = $this->db->prepare("UPDATE tasks SET name = ?, description = ?, status = ?, priority = ?, assigned_to = ? WHERE id = ?");
        $query->bind_param("ssssis", $name, $description, $status, $priority, $assignedTo, $taskId);

        return $query->execute();
    }

    public function deleteTask($taskId) {
        $query = $this->db->prepare("DELETE FROM tasks WHERE id = ?");
        $query->bind_param("i", $taskId);

        return $query->execute();
    }

    public function addTaskNote($taskId, $note, $photo = null) {
        $query = $this->db->prepare("INSERT INTO task_notes (task_id, note, photo) VALUES (?, ?, ?)");
        $query->bind_param("iss", $taskId, $note, $photo);

        return $query->execute();
    }

    public function getTaskNotes($taskId) {
        $query = $this->db->prepare("SELECT * FROM task_notes WHERE task_id = ?");
        $query->bind_param("i", $taskId);

        if ($query->execute()) {
            $result = $query->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return false;
        }
    }

    public function updateTaskNote($noteId, $note, $photo = null) {
        $query = $this->db->prepare("UPDATE task_notes SET note = ?, photo = ? WHERE id = ?");
        $query->bind_param("ssi", $note, $photo, $noteId);

        return $query->execute();
    }

    public function deleteTaskNote($noteId) {
        $query = $this->db->prepare("DELETE FROM task_notes WHERE id = ?");
        $query->bind_param("i", $noteId);

        return $query->execute();
    }

    public function getMemberTasks($memberId) {
        $query = $this->db->prepare("SELECT * FROM tasks WHERE assigned_to = ?");
        $query->bind_param("i", $memberId);
        $query->execute();
        $result = $query->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>