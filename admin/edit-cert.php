<?php
require_once '../db.php'; // PATH FIXED

$error = '';
$cert = null;

// 1. Fetch existing certification data
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM certifications WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $cert = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$cert) {
        header("Location: manage-certifications.php");
        exit;
    }
} else {
    header("Location: manage-certifications.php");
    exit;
}

// 2. Handle the form submission to update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = trim($_POST['title']);
    $issuer = trim($_POST['issuer']);
    $cert_date = trim($_POST['cert_date']);
    $category = trim($_POST['category']);

    if (empty($title) || empty($issuer) || empty($cert_date) || empty($category)) {
        $error = 'All fields are required.';
    } else {
        $stmt = $pdo->prepare("UPDATE certifications SET title = ?, issuer = ?, cert_date = ?, category = ? WHERE id = ?");
        $stmt->execute([$title, $issuer, $cert_date, $category, $id]);
        
        header("Location: manage-certifications.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>Edit Certification</title>
    <link rel="stylesheet" href="../css/style.css"> <style>
        .admin-container { max-width: 600px; margin: 60px auto; padding: 40px; background: var(--bg-sidebar); border-radius: 16px; border: 1px solid var(--border); }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 500; font-size: 14px; color: var(--text-secondary); }
        .form-input { width: 100%; background: var(--bg-card); border: 1px solid var(--border); color: var(--text-primary); padding: 12px; border-radius: 8px; font-family: 'Inter', sans-serif; }
        .btn-submit { background: var(--accent); color: white; border: none; padding: 12px 24px; border-radius: 8px; font-weight: 600; cursor: pointer; width: 100%; transition: opacity 0.2s; }
        .btn-submit:hover { opacity: 0.85; }
        .error-msg { background: #dc3545; color: white; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; text-align: center; }
    </style>
</head>
<body>
    <div class="admin-container">
        <h1 class="page-title" style="margin-bottom: 24px;">Edit Certification</h1>
        
        <?php if ($error): ?>
            <div class="error-msg"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="edit-cert.php?id=<?php echo $cert['id']; ?>" method="POST">
            <input type="hidden" name="id" value="<?php echo $cert['id']; ?>">
            
            <div class="form-group">
                <label>Certification Title</label>
                <input type="text" name="title" class="form-input" value="<?php echo htmlspecialchars($cert['title']); ?>">
            </div>
            
            <div class="form-group">
                <label>Issuer / Organization</label>
                <input type="text" name="issuer" class="form-input" value="<?php echo htmlspecialchars($cert['issuer']); ?>">
            </div>
            
            <div class="form-group">
                <label>Date Issued</label>
                <input type="text" name="cert_date" class="form-input" value="<?php echo htmlspecialchars($cert['cert_date']); ?>">
            </div>
            
            <div class="form-group">
                <label>Category</label>
                <input type="text" name="category" class="form-input" value="<?php echo htmlspecialchars($cert['category']); ?>">
            </div>
            
            <button type="submit" class="btn-submit">Update Certification</button>
        </form>
        
        <div style="text-align: center; margin-top: 20px;">
            <a href="manage-certifications.php" style="color: var(--text-secondary); text-decoration: none; font-size: 14px;">&larr; Cancel and go back</a>
        </div>
    </div>
</body>
</html>