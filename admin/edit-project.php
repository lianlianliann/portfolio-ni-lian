<?php
require_once '../db.php'; // PATH FIXED

$error = '';
$project = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ?");
    $stmt->execute([$id]);
    $project = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$project) {
        header("Location: manage-projects.php");
        exit;
    }
} else {
    header("Location: manage-projects.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $project_date = trim($_POST['project_date']);
    $description = trim($_POST['description']);

    if (empty($title) || empty($category) || empty($project_date) || empty($description)) {
        $error = 'All fields are required.';
    } else {
        $stmt = $pdo->prepare("UPDATE projects SET title = ?, category = ?, project_date = ?, description = ? WHERE id = ?");
        $stmt->execute([$title, $category, $project_date, $description, $id]);
        
        header("Location: manage-projects.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>Edit Project</title>
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
        <h1 class="page-title" style="margin-bottom: 24px;">Edit Project</h1>
        
        <?php if ($error): ?>
            <div class="error-msg"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="edit-project.php?id=<?php echo $project['id']; ?>" method="POST">
            <input type="hidden" name="id" value="<?php echo $project['id']; ?>">
            
            <div class="form-group">
                <label>Project Title</label>
                <input type="text" name="title" class="form-input" value="<?php echo htmlspecialchars($project['title']); ?>">
            </div>
            
            <div class="form-group">
                <label>Category</label>
                <input type="text" name="category" class="form-input" value="<?php echo htmlspecialchars($project['category']); ?>">
            </div>
            
            <div class="form-group">
                <label>Date / Timeframe</label>
                <input type="text" name="project_date" class="form-input" value="<?php echo htmlspecialchars($project['project_date']); ?>">
            </div>
            
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-textarea"><?php echo htmlspecialchars($project['description']); ?></textarea>
            </div>
            
            <button type="submit" class="btn-submit">Update Project</button>
        </form>
        
        <div style="text-align: center; margin-top: 20px;">
            <a href="manage-projects.php" style="color: var(--text-secondary); text-decoration: none; font-size: 14px;">&larr; Cancel and go back</a>
        </div>
    </div>
</body>
</html>