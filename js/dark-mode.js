const desktopDarkModeToggle = document.getElementById('dark-mode-switch-desktop');
const mobileDarkModeToggle = document.getElementById('dark-mode-switch-mobile');
const link = document.createElement("link");
  link.rel = "stylesheet";
  link.href = `${BASE_URL}/css/dark-mode.css`;
  link.id = "dark-theme";
let darkModeEnabled = localStorage.getItem('darkMode') === 'enabled';
if (darkModeEnabled) {
    document.head.appendChild(link);
}

desktopDarkModeToggle.addEventListener('click', (e) => {
    e.preventDefault();
    toggleDarkMode();
});

mobileDarkModeToggle.addEventListener('click', (e) => {
    e.preventDefault();
    toggleDarkMode();
});

function toggleDarkMode() {
    darkModeEnabled = !darkModeEnabled;
    if (darkModeEnabled) {
        document.head.appendChild(link);
        localStorage.setItem('darkMode', 'enabled');
    } else {
        const existingLink = document.getElementById("dark-theme");
        if (existingLink) {
            document.head.removeChild(existingLink);
        }
        localStorage.setItem('darkMode', 'disabled');
    }
}