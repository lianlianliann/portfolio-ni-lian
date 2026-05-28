<?php
require_once 'db.php';

// Handle DELETE
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM certifications WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    header("Location: manage-certifications.php");
    exit;
}

// Fetch all
$stmt = $pdo->query("SELECT * FROM certifications ORDER BY id DESC");
$certs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>Manage Certifications</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .admin-container { max-width: 900px; margin: 40px auto; padding: 30px; background: var(--bg-sidebar); border-radius: 16px; border: 1px solid var(--border); }
        .admin-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .admin-table th, .admin-table td { padding: 14px; text-align: left; border-bottom: 1px solid var(--border); color: var(--text-primary); }
        .action-btn { padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 13px; margin-right: 8px; }
        .btn-edit { background: var(--accent); color: white; }
        .btn-delete { background: #dc3545; color: white; }
        .btn-add { background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 8px; display: inline-block; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="admin-container">
        <h1>Manage Certifications</h1>
        <a href="add-cert.php" class="btn-add">+ Add Certification</a>
        <table class="admin-table">
            <thead>
                <tr><th>Title</th><th>Issuer</th><th>Actions</th></tr>
            </thead>
            <tbody>
                <?php foreach ($certs as $cert): ?>
                <tr>
                    <td><?php echo htmlspecialchars($cert['title']); ?></td>
                    <td><?php echo htmlspecialchars($cert['issuer']); ?></td>
                    <td>
                        <a href="edit-cert.php?id=<?php echo $cert['id']; ?>" class="action-btn btn-edit">Edit</a>
                        <a href="manage-certifications.php?delete=<?php echo $cert['id']; ?>" class="action-btn btn-delete" onclick="return confirm('Delete this?');">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="certifications.php" style="color: var(--text-secondary);">Back to Public View</a>
    </div>
</body>
</html>