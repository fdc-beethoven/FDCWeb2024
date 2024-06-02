<?php
class Task {
    // Properties
    private $db;

    // Constructor
    public function __construct($db) {
        $this->db = $db; // Database connection
    }

    // Method to create a new task
    public function createTask($projectId, $name, $description, $status, $priority, $assignedTo, $createdBy) {
        // Insert new task into the database
        $query = $this->db->prepare("INSERT INTO tasks (project_id, name, description, status, priority, assigned_to, created_by) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $query->bind_param("issssii", $projectId, $name, $description, $status, $priority, $assignedTo, $createdBy);

        if ($query->execute()) {
            // Return the ID of the newly inserted task
            return $query->insert_id;
        } else {
            // Return false if task creation fails
            return false;
        }
    }

    // Method to retrieve task details
    public function getTaskDetails($taskId) {
        // Retrieve task details from the database
        $query = $this->db->prepare("SELECT * FROM tasks WHERE id = ?");
        $query->bind_param("i", $taskId);

        if ($query->execute()) {
            $result = $query->get_result();
            return $result->fetch_assoc(); // Return task details as an associative array
        } else {
            // Return false if retrieval fails
            return false;
        }
    }

    // Method to update task information
    public function updateTask($taskId, $name, $description, $status, $priority, $assignedTo) {
        // Update task information in the database
        $query = $this->db->prepare("UPDATE tasks SET name = ?, description = ?, status = ?, priority = ?, assigned_to = ? WHERE id = ?");
        $query->bind_param("ssssis", $name, $description, $status, $priority, $assignedTo, $taskId);

        return $query->execute(); // Return true if update succeeds, false otherwise
    }

    // Method to delete a task
    public function deleteTask($taskId) {
        // Delete task from the database
        $query = $this->db->prepare("DELETE FROM tasks WHERE id = ?");
        $query->bind_param("i", $taskId);

        return $query->execute(); // Return true if deletion succeeds, false otherwise
    }

    // Method to add a note to a task
    public function addTaskNote($taskId, $note, $photo = null) {
        // Insert new note into the task_notes table
        $query = $this->db->prepare("INSERT INTO task_notes (task_id, note, photo) VALUES (?, ?, ?)");
        $query->bind_param("iss", $taskId, $note, $photo);

        return $query->execute(); // Return true if note addition succeeds, false otherwise
    }

    // Method to retrieve task notes
    public function getTaskNotes($taskId) {
        // Retrieve task notes from the database
        $query = $this->db->prepare("SELECT * FROM task_notes WHERE task_id = ?");
        $query->bind_param("i", $taskId);

        if ($query->execute()) {
            $result = $query->get_result();
            return $result->fetch_all(MYSQLI_ASSOC); // Return task notes as an array of associative arrays
        } else {
            // Return false if retrieval fails
            return false;
        }
    }

    // Method to update a task note
    public function updateTaskNote($noteId, $note, $photo = null) {
        // Update note in the task_notes table
        $query = $this->db->prepare("UPDATE task_notes SET note = ?, photo = ? WHERE id = ?");
        $query->bind_param("ssi", $note, $photo, $noteId);

        return $query->execute(); // Return true if update succeeds, false otherwise
    }

    // Method to delete a task note
    public function deleteTaskNote($noteId) {
        $query = $this->db->prepare("DELETE FROM task_notes WHERE id = ?");
        $query->bind_param("i", $noteId);

        return $query->execute();
    }
}
?>