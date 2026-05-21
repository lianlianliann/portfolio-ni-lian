// Select the button and the root html element
const themeToggleBtn = document.getElementById('theme-toggle');
const htmlElement = document.documentElement;

// 1. Check local storage to see if the user already picked a theme
const savedTheme = localStorage.getItem('theme');

// If there's a saved theme, apply it immediately
if (savedTheme) {
    htmlElement.setAttribute('data-theme', savedTheme);
    updateButtonText(savedTheme);
}

// 2. Listen for clicks on the toggle button
themeToggleBtn.addEventListener('click', () => {
    // Get the current theme (defaults to dark if not set)
    const currentTheme = htmlElement.getAttribute('data-theme') || 'dark';
    
    // Determine what the new theme should be
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

    // Apply the new theme to the HTML tag
    htmlElement.setAttribute('data-theme', newTheme);
    
    // Save it to localStorage so it persists across pages
    localStorage.setItem('theme', newTheme);
    
    // Update the button text
    updateButtonText(newTheme);
});

// Helper function to keep the button text accurate
function updateButtonText(theme) {
    if (theme === 'dark') {
        themeToggleBtn.textContent = 'Light Mode';
    } else {
        themeToggleBtn.textContent = 'Dark Mode';
    }
}