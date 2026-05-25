document.addEventListener('DOMContentLoaded', () => {
    const themeBtn = document.getElementById('theme-toggle');
    const root = document.documentElement;
    
    // Initialize theme from storage, default to dark
    const savedTheme = localStorage.getItem('theme') || 'dark';
    root.setAttribute('data-theme', savedTheme);
    updateButton(savedTheme);

    // Handle click event
    themeBtn.addEventListener('click', () => {
        const currentTheme = root.getAttribute('data-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        
        root.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        
        updateButton(newTheme);
    });

    // Update UI with emojis
    function updateButton(theme) {
        themeBtn.textContent = theme === 'dark' ? '☀️' : '🌙';
    }
});