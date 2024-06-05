<?php
$project = new Project($db);
$projects = $project->getProjects();

if (isset($_POST['action_type'])) {
    switch ($_POST['action_type']) {
        case 'create':
            $project->createProject($_POST['project_name'], $_POST['project_description'], $_SESSION['user_id']);
            echo "<script> window.location.href = '?page=dashboard&create_project_success=1'; 
            </script>";
            break;
    }
}

if (isset($_GET["create__project_success"])) {
    ?>
    <div class="alert alert-success">
        Project created successfully!
    </div>
    <?php
}

var_dump($_POST);
?>

<h2>PM Dashboard</h2>
<h3>Hi, <?php echo isset($_SESSION['first_name']) ? $_SESSION['first_name'] . $_SESSION['last_name'] : 'Default'; ?>
</h3>

<body>

    <div class="row">
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#createProjectModal">Create
            Project</button>
        <div class="col-md-12">
            <?php if ($projects): ?>
                <div class="card-deck">
                    <?php foreach ($projects as $i => $project): ?>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= $project['name'] ?></h5>
                                <p class="card-text"><?= $project['description'] ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>No projects found.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="modal fade" id="createProjectModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createProjectModalLabel">Create Project</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="createProjectForm" action="?page=dashboard" method="POST">
                        <div class="form-group">
                            <label for="project_name">Project Name</label>
                            <input type="text" class="form-control" id="project_name" name="project_name" required>
                        </div>
                        <div class="form-group">
                            <label for="project_description">Description</label>
                            <textarea class="form-control" id="project_description" name="project_description"
                                rows="3"></textarea>
                        </div>
                        <input type="hidden" name="action_type" value="create" />
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="edit_user" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>