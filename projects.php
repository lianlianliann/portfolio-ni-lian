<?php
require_once 'db.php'; 

$stmt = $pdo->query("SELECT * FROM projects ORDER BY id DESC");
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects - Portfolio ni Lian</title>
    <!-- Google Font: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- External CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="layout-wrapper">

        <!-- SIDEBAR -->
        <aside class="sidebar">

            <img src="images/lian-luigi-paredes.jpg"
                alt="Profile Picture"
                class="profile-pic"/>

            <div class="sidebar-intro">
                <h2>Hello, I'm Lian!</h2>
                <div class="badge">Data Scientist Enthusiast | UI/UX Designer | Front-End Developer | Graphics Designer</div>
            </div>

            <hr class="sidebar-divider"/>

            <ul class="contact-list">
                <li>
                    <div class="contact-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                    </div>
                    <div class="contact-info">
                        <strong>Email</strong>
                        <p>lianlianliann13@gmail.com</p>
                    </div>
                </li>
                <li>
                    <div class="contact-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect><line x1="12" y1="18" x2="12.01" y2="18"></line></svg>
                    </div>
                    <div class="contact-info">
                        <strong>Phone</strong>
                        <p>+63 966 710 4695</p>
                    </div>
                </li>
                <li>
                    <div class="contact-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    </div>
                    <div class="contact-info">
                        <strong>Location</strong>
                        <p>Quezon City, Philippines</p>
                    </div>
                </li>
            </ul>

            <div class="social-links">
                <a href="https://www.facebook.com/ventura.lian/" target="_blank" aria-label="Facebook">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                </a>
                <a href="https://github.com/lianlianliann" target="_blank" aria-label="GitHub">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>
                </a>
                <a href="https://www.linkedin.com/in/lian-paredes-87608a298/" target="_blank" aria-label="LinkedIn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
                </a>
            </div>

        </aside>

        <!-- MAIN CONTENT -->
        <main class="main-content">

            <!-- NAVIGATION -->
            <nav class="navbar">
                <ul class="nav-links">
                    <li><a href="index.html">About</a></li>
                    <li><a href="resume.html">Resume</a></li>
                    <li><a href="projects.html" class="active">Projects</a></li>
                    <li><a href="certifications.html">Certifications</a></li>
                    <li><a href="hire-me.html">Hire Me</a></li>
                </ul>
                <button id="theme-toggle" class="theme-switch" aria-label="Toggle Theme">
                    <span class="switch-thumb"></span>
                </button>
            </nav>

            <script src="js/script.js"></script>

            <hr class="nav-divider"/>

            <!-- PROJECTS SECTION -->
            <section id="projects" class="section">
                <h1 class="page-title">Projects</h1>

                <div class="projects-grid">
                    <?php foreach ($projects as $project): ?>
                        <div class="project-card fade-in">
                            <a href="#" class="project-link">
                                <div class="project-image-wrapper">
                                    <div class="project-image-placeholder">
                                        <p>Project Screenshot</p>
                                    </div>
                                    <div class="project-overlay">
                                        <div class="eye-icon-wrapper">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="project-info">
                                    <span class="project-meta"><?php echo htmlspecialchars($project['category']); ?> &bull; <?php echo htmlspecialchars($project['project_date']); ?></span>
                                    <h2><?php echo htmlspecialchars($project['title']); ?></h2>
                                    <p><?php echo htmlspecialchars($project['description']); ?></p>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

        </main>

    </div>

</body>
</html>