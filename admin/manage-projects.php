<?php
require_once '../db.php'; // PATH FIXED

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM projects WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: manage-projects.php"); 
    exit;
}

$stmt = $pdo->query("SELECT * FROM projects ORDER BY id DESC");
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>Manage Projects</title>
    <link rel="stylesheet" href="../css/style.css"> <style>
        .admin-container { max-width: 900px; margin: 40px auto; padding: 30px; background: var(--bg-sidebar); border-radius: 16px; border: 1px solid var(--border); }
        .admin-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .admin-table th, .admin-table td { padding: 14px; text-align: left; border-bottom: 1px solid var(--border); color: var(--text-primary); }
        .action-btn { padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 13px; margin-right: 8px; transition: opacity 0.2s; }
        .action-btn:hover { opacity: 0.8; }
        .btn-edit { background: var(--accent); color: white; border: none; }
        .btn-delete { background: #dc3545; color: white; border: none; }
        .btn-add { background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 8px; display: inline-block; margin-bottom: 20px; font-weight: 600; transition: transform 0.2s; }
        .btn-add:hover { transform: translateY(-2px); }
    </style>
</head>
<body>
    <div class="admin-container">
        <h1 class="page-title">Manage Projects</h1>
        
        <a href="add-project.php" class="btn-add">+ Add New Project</a>
        
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projects as $project): ?>
                <tr>
                    <td><?php echo htmlspecialchars($project['title']); ?></td>
                    <td><?php echo htmlspecialchars($project['category']); ?></td>
                    <td><?php echo htmlspecialchars($project['project_date']); ?></td>
                    <td>
                        <a href="edit-project.php?id=<?php echo $project['id']; ?>" class="action-btn btn-edit">Edit</a>
                        
                        <a href="manage-projects.php?delete=<?php echo $project['id']; ?>" class="action-btn btn-delete" onclick="return confirm('Are you sure you want to delete this project?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <br><br>
        <a href="../projects.php" style="color: var(--text-secondary); text-decoration: none;">&larr; Back to Public Portfolio</a> </div>
</body>
</html>