<?php
require_once '../db.php'; // PATH FIXED

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $project_date = trim($_POST['project_date']);
    $description = trim($_POST['description']);

    if (empty($title) || empty($category) || empty($project_date) || empty($description)) {
        $error = 'All fields are required. Please fill out the entire form.';
    } else {
        $stmt = $pdo->prepare("INSERT INTO projects (title, category, project_date, description) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $category, $project_date, $description]);
        
        header("Location: manage-projects.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>Add New Project</title>
    <link rel="stylesheet" href="../css/style.css"> <style>
        .admin-container { max-width: 600px; margin: 60px auto; padding: 40px; background: var(--bg-sidebar); border-radius: 16px; border: 1px solid var(--border); }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 500; font-size: 14px; color: var(--text-secondary); }
        .form-input, .form-textarea { width: 100%; background: var(--bg-card); border: 1px solid var(--border); color: var(--text-primary); padding: 12px; border-radius: 8px; font-family: 'Inter', sans-serif; }
        .form-textarea { min-height: 120px; resize: vertical; }
        .btn-submit { background: var(--accent); color: white; border: none; padding: 12px 24px; border-radius: 8px; font-weight: 600; cursor: pointer; width: 100%; transition: opacity 0.2s; }
        .btn-submit:hover { opacity: 0.85; }
        .error-msg { background: #dc3545; color: white; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; text-align: center; }
    </style>
</head>
<body>
    <div class="admin-container">
        <h1 class="page-title" style="margin-bottom: 24px;">Add New Project</h1>
        
        <?php if ($error): ?>
            <div class="error-msg"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="add-project.php" method="POST">
            <div class="form-group">
                <label>Project Title</label>
                <input type="text" name="title" class="form-input" placeholder="e.g., IskoAlert">
            </div>
            
            <div class="form-group">
                <label>Category</label>
                <input type="text" name="category" class="form-input" placeholder="e.g., Web Development">
            </div>
            
            <div class="form-group">
                <label>Date / Timeframe</label>
                <input type="text" name="project_date" class="form-input" placeholder="e.g., January 2026">
            </div>
            
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-textarea" placeholder="Describe the project features and your role..."></textarea>
            </div>
            
            <button type="submit" class="btn-submit">Save Project</button>
        </form>
        
        <div style="text-align: center; margin-top: 20px;">
            <a href="manage-projects.php" style="color: var(--text-secondary); text-decoration: none; font-size: 14px;">&larr; Cancel and go back</a>
        </div>
    </div>
</body>
</html>