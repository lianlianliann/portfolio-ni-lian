document.addEventListener('DOMContentLoaded', () => {
    const themeBtn = document.getElementById('theme-toggle');
    const root = document.documentElement;

    // 1. Initialize theme from storage, default to dark
    const savedTheme = localStorage.getItem('theme') || 'dark';
    root.setAttribute('data-theme', savedTheme);
    updateButton(savedTheme);

    // 2. Handle click event
    themeBtn.addEventListener('click', () => {
        const currentTheme = root.getAttribute('data-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        
        root.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme); // Sticky note to remember preference
        
        updateButton(newTheme);
    });

    // 3. Update UI
    function updateButton(theme) {
        themeBtn.textContent = theme === 'dark' ? 'Light Mode' : 'Dark Mode';
    }
});