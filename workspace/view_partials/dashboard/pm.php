<?php
$project = new Project($db);
$projects = $project->getProjects();
//$didCreate = $project->createProject("Test Project", "Test Project Description",$_SESSION['user_id']);
//var_dump($didCreate);
?>

<h2>PM Dashboard</h2>

<div class="row">
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
    <button type="button" class="btn btn-primary" id="createProjectButton" data-toggle="modal" data-target="#createProjectModal">
        Create Project
    </button>

    <div class="modal fade" id="createProjectModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createProjectModalLabel">Create Project</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="createProjectForm">
                        <div class="form-group">
                            <label for="project_name">Project Name</label>
                            <input type="text" class="form-control" id="project_name" name="project_name" required>
                        </div>
                        <div class="form-group">
                            <label for="project_description">Description</label>
                            <textarea class="form-control" id="project_description" name="project_description"
                                rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="create-project-form" class="btn btn-primary">Create Project</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../public/js/pm_dashboard.js"></script>
</div>