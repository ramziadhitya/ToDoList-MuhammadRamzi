<?php
session_start();

$successMessage = ''; 


if (isset($_GET['index'])) {
    $index = $_GET['index'];
    $task = $_SESSION['tasks'][$index]['task'];
    $priority = $_SESSION['tasks'][$index]['priority'];
    $keterangan = $_SESSION['tasks'][$index]['keterangan'];
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_task'])) {
    $_SESSION['tasks'][$index] = [
        'task' => $_POST['task'],
        'priority' => $_POST['priority'],
        'keterangan' => $_POST['keterangan'] 
    ];

    
    $successMessage = 'Task berhasil diubah!';
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
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
        <h1 class="text-center mb-4">Edit Task</h1>

        <!-- Pesan Sukses -->
        <?php if ($successMessage): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $successMessage; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Form Edit Task di dalam Card -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Edit Task Details</h5>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="task" class="form-label">Task</label>
                        <input type="text" name="task" id="task" class="form-control" value="<?php echo $task; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Description</label>
                        <input type="text" name="keterangan" id="keterangan" class="form-control" value="<?php echo $keterangan; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="priority" class="form-label">Priority</label>
                        <select name="priority" id="priority" class="form-select">
                            <option value="Low" <?php if ($priority == 'Low') echo 'selected'; ?>>Low</option>
                            <option value="Medium" <?php if ($priority == 'Medium') echo 'selected'; ?>>Medium</option>
                            <option value="High" <?php if ($priority == 'High') echo 'selected'; ?>>High</option>
                        </select>
                    </div>
                    <button type="submit" name="edit_task" class="btn btn-success">Update Task</button>
                    <a href="index.php" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
