<?php
require_once '../db.php'; // PATH FIXED

// Handle the DELETE Operation securely
if (isset($_GET['delete']) && $_GET['delete'] !== '') {
    $id = $_GET['delete'];
    
    try {
        $stmt = $pdo->prepare("DELETE FROM certifications WHERE id = ?");
        $stmt->execute([$id]);
        header("Location: manage-certifications.php"); 
        exit;
    } catch(PDOException $e) {
        die("Delete failed because: " . $e->getMessage()); 
    }
}

// Fetch all certifications to display in the table
$stmt = $pdo->query("SELECT * FROM certifications ORDER BY id DESC");
$certs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>Manage Certifications</title>
    <link rel="stylesheet" href="../css/style.css"> <style>
        .admin-container { max-width: 900px; margin: 40px auto; padding: 30px; background: var(--bg-sidebar); border-radius: 16px; border: 1px solid var(--border); }
        .admin-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .admin-table th, .admin-table td { padding: 14px; text-align: left; border-bottom: 1px solid var(--border); color: var(--text-primary); }
        
        .action-btn { 
            display: inline-block; 
            padding: 6px 14px; 
            border-radius: 6px; 
            text-decoration: none; 
            font-size: 13px; 
            font-weight: 500;
            transition: opacity 0.2s; 
        }
        .action-btn:hover { opacity: 0.8; }
        .btn-edit { background: var(--accent); color: white; border: none; }
        .btn-delete { background: #dc3545; color: white; border: none; }
        
        .btn-add { background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 8px; display: inline-block; margin-bottom: 20px; font-weight: 600; transition: transform 0.2s; }
        .btn-add:hover { transform: translateY(-2px); }

        .actions-flex { 
            display: flex; 
            gap: 12px; 
            align-items: center; 
            white-space: nowrap; 
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <h1 class="page-title">Manage Certifications</h1>
        
        <a href="add-cert.php" class="btn-add">+ Add Certification</a>
        
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Issuer</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($certs as $cert): ?>
                <tr>
                    <td><?php echo htmlspecialchars($cert['title']); ?></td>
                    <td><?php echo htmlspecialchars($cert['issuer']); ?></td>
                    <td><?php echo htmlspecialchars($cert['category']); ?></td>
                    <td>
                        <div class="actions-flex">
                            <a href="edit-cert.php?id=<?php echo $cert['id']; ?>" class="action-btn btn-edit">Edit</a>
                            <a href="manage-certifications.php?delete=<?php echo $cert['id']; ?>" class="action-btn btn-delete" onclick="return confirm('Are you sure you want to delete this certification?');">Delete</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <br><br>
        <div style="display: flex; gap: 20px;">
            <a href="manage-projects.php" style="color: var(--accent); text-decoration: none;">Go to Manage Projects</a> <a href="../certifications.php" style="color: var(--text-secondary); text-decoration: none;">&larr; Back to Public Portfolio</a> </div>
    </div>
</body>
</html>