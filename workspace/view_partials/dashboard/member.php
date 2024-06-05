<?php
$task = new Task($db);
$tasks = $task->getMemberTasks($_SESSION['user_id']);
?>

<h2>Member Dashboard</h2>
<h3>Hi, <?php echo isset($_SESSION['first_name']) ? $_SESSION['first_name'] . $_SESSION['last_name'] : 'Default'; ?></h3>

<body>
    <div class="row">
        <div class="col-md-12">
            <?php if ($tasks): ?>
                <div class="card-deck">
                    <?php foreach ($tasks as $i => $task): ?>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= $task['name'] ?></h5>
                                <p class="card-text"><?= $task['description'] ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-center">No tasks found. Hooray!</p>
                <img src="/public/img/no-tasks.png" alt="No more tasks" class="img-fluid w-50 d-flex justify-content-center align-items-center">
            <?php endif; ?>
        </div>
    </div>
</body>