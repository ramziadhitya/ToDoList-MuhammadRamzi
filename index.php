<?php
session_start();


$successMessage = ''; 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_task'])) {
    $task = $_POST['task'];
    $priority = $_POST['priority'];
    $keterangan = $_POST['keterangan']; 

    if (!isset($_SESSION['tasks'])) {
        $_SESSION['tasks'] = [];
    }

    $_SESSION['tasks'][] = [
        'task' => $task,
        'priority' => $priority,
        'keterangan' => $keterangan 
    ];

    
    $successMessage = 'Task berhasil ditambahkan!';
}


if (isset($_GET['delete'])) {
    $index = $_GET['delete'];
    unset($_SESSION['tasks'][$index]);
    
    
    $_SESSION['tasks'] = array_values($_SESSION['tasks']);
    
    
    $successMessage = 'Task berhasil dihapus!';
    
    
    header('Location: index.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }
        .alert-success {
            animation: fadeOut 3s forwards;
        }
        @keyframes fadeOut {
            0% { opacity: 1; }
            100% { opacity: 0; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">To Do List</h1>

        <!-- Pesan Sukses -->
        <?php if ($successMessage): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $successMessage; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Form untuk menambahkan task (Dibungkus dalam card) -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Add New Task</h5>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="task" class="form-label">Task</label>
                        <input type="text" name="task" id="task" class="form-control" placeholder="Enter new task" required>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Description</label>
                        <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Enter task description" required>
                    </div>
                    <div class="mb-3">
                        <label for="priority" class="form-label">Priority</label>
                        <select name="priority" id="priority" class="form-select">
                            <option value="Low">Low</option>
                            <option value="Medium">Medium</option>
                            <option value="High">High</option>
                        </select>
                    </div>
                    <button type="submit" name="add_task" class="btn btn-primary">Add Task</button>
                </form>
            </div>
        </div>

        <!-- Daftar task dalam bentuk tabel -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Task List</h5>
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Task</th>
                            <th>Description</th>
                            <th>Priority</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($_SESSION['tasks']) && count($_SESSION['tasks']) > 0): ?>
                            <?php foreach ($_SESSION['tasks'] as $index => $task): ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo $task['task']; ?></td>
                                    <td><?php echo isset($task['keterangan']) ? $task['keterangan'] : 'No description available'; ?></td>
                                    <td>
                                        <?php if ($task['priority'] == 'High'): ?>
                                            <span class="badge bg-danger"><?php echo $task['priority']; ?></span>
                                        <?php elseif ($task['priority'] == 'Medium'): ?>
                                            <span class="badge bg-warning text-dark"><?php echo $task['priority']; ?></span>
                                        <?php else: ?>
                                            <span class="badge bg-success"><?php echo $task['priority']; ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="edit.php?index=<?php echo $index; ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="?delete=<?php echo $index; ?>" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">No tasks available.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
