<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - Focus Todo App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.4.0/p5.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #fefefe 0%, #f8fafc 100%);
            min-height: 100vh;
        }

        .glass-nav {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.8);
            border-bottom: 1px solid rgba(226, 232, 240, 0.3);
        }

        .settings-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(226, 232, 240, 0.3);
            transition: all 0.3s ease;
        }

        .settings-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .hero-section {
            background: url('resources/hero-bg.jpg') center/cover;
            position: relative;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.7);
        }

        .particle-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            pointer-events: none;
        }

        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 3rem;
            height: 1.5rem;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 1.5rem;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 1.125rem;
            width: 1.125rem;
            left: 0.1875rem;
            bottom: 0.1875rem;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: #3B82F6;
        }

        input:checked+.slider:before {
            transform: translateX(1.5rem);
        }

        .color-picker {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            border: 2px solid #E5E7EB;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .color-picker:hover {
            transform: scale(1.1);
            border-color: #3B82F6;
        }

        .category-item {
            transition: all 0.3s ease;
        }

        .category-item:hover {
            transform: translateX(4px);
            background-color: rgba(59, 130, 246, 0.05);
        }

        .shortcut-key {
            background: #F3F4F6;
            border: 1px solid #D1D5DB;
            border-radius: 0.25rem;
            padding: 0.125rem 0.5rem;
            font-family: monospace;
            font-size: 0.875rem;
            color: #374151;
        }
    </style>
</head>

<body>
    <!-- Particle Background -->
    <div id="particle-bg" class="particle-bg"></div>

    <!-- Navigation -->
    <nav class="glass-nav fixed top-0 left-0 right-0 z-50 px-6 py-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('resources/focus-icon.png') }}" alt="Focus" class="h-8 w-8">
                <h1 class="text-xl font-semibold text-gray-800">Focus</h1>
            </div>
            <div class="flex items-center space-x-6">
                <a href="{{ url('/') }}" class="text-gray-600 hover:text-gray-800 transition-colors">Tasks</a>
                <a href="{{ url('/analytics') }}" class="text-gray-600 hover:text-gray-800 transition-colors">Analytics</a>
                <a href="{{ url('/settings') }}" class="text-blue-600 font-medium border-b-2 border-blue-600 pb-1">Settings</a>
                <a href="{{ url('/help') }}" class="text-gray-600 hover:text-gray-800 transition-colors">Help</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section pt-24 pb-12">
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Settings & Preferences</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Customize your Focus experience to match your
                    workflow and preferences.</p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-6 pb-12">
        <div class="space-y-8">
            <!-- Appearance Settings -->
            <div class="settings-card rounded-xl p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                    <span class="text-2xl mr-3">🎨</span>
                    Appearance
                </h3>

                <div class="space-y-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="font-medium text-gray-800">Dark Mode</h4>
                            <p class="text-sm text-gray-600">Switch to a darker theme for better focus</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" id="darkModeToggle">
                            <span class="slider"></span>
                        </label>
                    </div>

                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="font-medium text-gray-800">Animations</h4>
                            <p class="text-sm text-gray-600">Enable smooth transitions and micro-interactions</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" id="animationsToggle" checked>
                            <span class="slider"></span>
                        </label>
                    </div>

                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="font-medium text-gray-800">Compact View</h4>
                            <p class="text-sm text-gray-600">Reduce spacing for more tasks on screen</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" id="compactToggle">
                            <span class="slider"></span>
                        </label>
                    </div>

                    <div>
                        <h4 class="font-medium text-gray-800 mb-3">Font Size</h4>
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-600">Small</span>
                            <input type="range" id="fontSizeSlider" min="12" max="18" value="14" class="flex-1">
                            <span class="text-sm text-gray-600">Large</span>
                        </div>
                        <p class="text-sm text-gray-600 mt-2">Current: <span id="fontSizeValue">14px</span></p>
                    </div>
                </div>
            </div>

            <!-- Notification Settings -->
            <div class="settings-card rounded-xl p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                    <span class="text-2xl mr-3">🔔</span>
                    Notifications
                </h3>

                <div class="space-y-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="font-medium text-gray-800">Due Date Reminders</h4>
                            <p class="text-sm text-gray-600">Get notified when tasks are due</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" id="dueDateToggle" checked>
                            <span class="slider"></span>
                        </label>
                    </div>

                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="font-medium text-gray-800">Completion Celebrations</h4>
                            <p class="text-sm text-gray-600">Celebrate when you complete tasks</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" id="celebrationToggle" checked>
                            <span class="slider"></span>
                        </label>
                    </div>

                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="font-medium text-gray-800">Daily Summary</h4>
                            <p class="text-sm text-gray-600">Receive daily productivity summaries</p>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" id="summaryToggle">
                            <span class="slider"></span>
                        </label>
                    </div>

                    <div>
                        <h4 class="font-medium text-gray-800 mb-3">Reminder Time</h4>
                        <select
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="15">15 minutes before</option>
                            <option value="30" selected>30 minutes before</option>
                            <option value="60">1 hour before</option>
                            <option value="240">4 hours before</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Category Management -->
            <div class="settings-card rounded-xl p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                    <span class="text-2xl mr-3">🏷️</span>
                    Categories
                </h3>

                <div class="space-y-4">
                    <div class="flex items-center space-x-4">
                        <input type="text" id="newCategoryInput" placeholder="Add new category..."
                            class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <div class="flex items-center space-x-2">
                            <input type="color" id="categoryColorPicker" value="#68D391" class="color-picker">
                            <button id="addCategoryBtn"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                Add
                            </button>
                        </div>
                    </div>

                    <div id="categoryList" class="space-y-2">
                        <!-- Categories will be rendered here -->
                    </div>
                </div>
            </div>

            <!-- Data Management -->
            <div class="settings-card rounded-xl p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                    <span class="text-2xl mr-3">💾</span>
                    Data Management
                </h3>

                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <button id="exportAllBtn"
                            class="p-4 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition-colors text-left">
                            <h4 class="font-medium text-blue-800 mb-1">Export Data</h4>
                            <p class="text-sm text-blue-600">Download all your tasks and settings</p>
                        </button>

                        <label
                            class="p-4 bg-green-50 border border-green-200 rounded-lg hover:bg-green-100 transition-colors text-left cursor-pointer">
                            <h4 class="font-medium text-green-800 mb-1">Import Data</h4>
                            <p class="text-sm text-green-600">Restore from backup file</p>
                            <input type="file" id="importFileInput" accept=".json" class="hidden">
                        </label>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <button id="clearCompletedBtn"
                            class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg hover:bg-yellow-100 transition-colors text-left">
                            <h4 class="font-medium text-yellow-800 mb-1">Clear Completed</h4>
                            <p class="text-sm text-yellow-600">Remove all completed tasks</p>
                        </button>

                        <button id="resetAllBtn"
                            class="p-4 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100 transition-colors text-left">
                            <h4 class="font-medium text-red-800 mb-1">Reset All</h4>
                            <p class="text-sm text-red-600">Delete all data (cannot be undone)</p>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Keyboard Shortcuts -->
            <div class="settings-card rounded-xl p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                    <span class="text-2xl mr-3">⌨️</span>
                    Keyboard Shortcuts
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-3">
                        <h4 class="font-medium text-gray-800">General</h4>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">New Task</span>
                                <span class="shortcut-key">Ctrl+N</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Search</span>
                                <span class="shortcut-key">Ctrl+F</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Toggle Filter</span>
                                <span class="shortcut-key">Ctrl+1-3</span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <h4 class="font-medium text-gray-800">Task Management</h4>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Complete Task</span>
                                <span class="shortcut-key">Space</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Edit Task</span>
                                <span class="shortcut-key">Enter</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Delete Task</span>
                                <span class="shortcut-key">Del</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- About -->
            <div class="settings-card rounded-xl p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                    <span class="text-2xl mr-3">ℹ️</span>
                    About
                </h3>

                <div class="space-y-4">
                    <div class="flex items-center space-x-4">
                        <img src="{{ asset('resources/focus-icon.png') }}" alt="Focus" class="h-16 w-16">
                        <div>
                            <h4 class="text-lg font-semibold text-gray-800">Focus Todo App</h4>
                            <p class="text-sm text-gray-600">Version 1.0.0</p>
                            <p class="text-sm text-gray-600">Built with modern web technologies</p>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-4">
                        <h5 class="font-medium text-gray-800 mb-2">Technologies Used</h5>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">HTML5</span>
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">CSS3</span>
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">JavaScript ES6+</span>
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">Tailwind CSS</span>
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">Anime.js</span>
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">ECharts.js</span>
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">p5.js</span>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-4">
                        <p class="text-sm text-gray-600">
                            Focus is designed to help you stay productive with a clean, minimalist interface that
                            eliminates distractions and helps you concentrate on what matters most.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 py-8">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="text-gray-600 text-sm">© 2025 Focus Todo App. Designed for productivity and peace of mind.</p>
        </div>
    </footer>

    <!-- Load main JavaScript -->
    <!-- Removing main.js reference as requested -->

    <!-- Settings specific JavaScript -->
    <script>
        // Settings state and functions
        function loadSettings() {
            const settings = JSON.parse(localStorage.getItem('todoSettings') || '{}');
            if (settings.darkMode) document.getElementById('darkModeToggle').checked = true;
            if (settings.animations !== undefined) document.getElementById('animationsToggle').checked = settings.animations;
            if (settings.compactView) document.getElementById('compactToggle').checked = true;
            if (settings.fontSize) {
                document.getElementById('fontSizeSlider').value = settings.fontSize;
                document.getElementById('fontSizeValue').textContent = settings.fontSize + 'px';
            }
            if (settings.dueDateReminders !== undefined) document.getElementById('dueDateToggle').checked = settings.dueDateReminders;
            if (settings.celebrations !== undefined) document.getElementById('celebrationToggle').checked = settings.celebrations;
            if (settings.dailySummary) document.getElementById('summaryToggle').checked = true;
            applySettings(settings);
        }

        function saveSettings() {
            const settings = {
                darkMode: document.getElementById('darkModeToggle').checked,
                animations: document.getElementById('animationsToggle').checked,
                compactView: document.getElementById('compactToggle').checked,
                fontSize: parseInt(document.getElementById('fontSizeSlider').value),
                dueDateReminders: document.getElementById('dueDateToggle').checked,
                celebrations: document.getElementById('celebrationToggle').checked,
                dailySummary: document.getElementById('summaryToggle').checked
            };
            localStorage.setItem('todoSettings', JSON.stringify(settings));
            applySettings(settings);
        }

        function applySettings(settings) {
            document.documentElement.style.fontSize = settings.fontSize + 'px';
            if (settings.darkMode) document.body.classList.add('dark');
            else document.body.classList.remove('dark');
        }

        function renderCategories() {
            const container = document.getElementById('categoryList');
            if (!container) return;
            fetch('api/categories')
                .then(response => response.json())
                .then(categories => {
                    container.innerHTML = '';
                    categories.forEach(category => {
                        const div = document.createElement('div');
                        div.className = 'category-item flex items-center justify-between p-3 rounded-lg border border-gray-200';
                        div.innerHTML = `
                            <div class="flex items-center space-x-3">
                                <div class="w-4 h-4 rounded-full" style="background-color: ${category.color}"></div>
                                <span class="font-medium text-gray-800">${category.name}</span>
                            </div>
                            <button data-id="${category.id}" data-action="delete-category" class="text-red-500 hover:text-red-700 transition-colors">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>`;
                        container.appendChild(div);
                    });
                })
                .catch(error => console.error('Error loading categories:', error));
        }

        function addCategory() {
            const input = document.getElementById('newCategoryInput');
            const colorPicker = document.getElementById('categoryColorPicker');
            if (input && input.value.trim()) {
                fetch('api/categories', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ name: input.value.trim(), color: colorPicker.value })
                })
                .then(res => {
                    if (res.ok) {
                        input.value = '';
                        renderCategories();
                    }
                })
                .catch(error => console.error('Error adding category:', error));
            }
        }

        function deleteCategory(categoryId) {
            if (!confirm('Are you sure?')) return;
            fetch(`api/categories/${categoryId}`, { method: 'DELETE' })
                .then(res => { if (res.ok) renderCategories(); })
                .catch(error => console.error('Error deleting category:', error));
        }

        function exportAllData() {
            fetch('api/tasks?limit=1000')
                .then(res => res.json())
                .then(data => {
                    const blob = new Blob([JSON.stringify({ tasks: data.tasks, exportDate: new Date().toISOString() }, null, 2)], { type: 'application/json' });
                    const url = URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = `focus-backup-${new Date().toISOString().split('T')[0]}.json`;
                    a.click();
                    URL.revokeObjectURL(url);
                })
                .catch(error => console.error('Error exporting data:', error));
        }

        function importData(file) {
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    try {
                        const data = JSON.parse(e.target.result);
                        if (data.tasks) localStorage.setItem('todoTasks', JSON.stringify(data.tasks));
                        if (data.categories) localStorage.setItem('todoCategories', JSON.stringify(data.categories));
                        if (data.settings) localStorage.setItem('todoSettings', JSON.stringify(data.settings));
                        alert('Data imported successfully! Please refresh.');
                    } catch (error) { alert('Error importing data.'); }
                };
                reader.readAsText(file);
            }
        }

        function clearCompletedTasks() {
            if (!confirm('Clear completed tasks?')) return;
            fetch('api/tasks/completed', { method: 'DELETE' })
                .then(res => { if (res.ok) alert('Cleared!'); })
                .catch(error => console.error('Error clearing:', error));
        }

        function resetAllData() {
            if (!confirm('Delete ALL data?')) return;
            fetch('api/tasks/all', { method: 'DELETE' })
                .then(() => alert('All data reset.'))
                .catch(error => console.error('Error resetting:', error));
        }

        function setupParticleBackground() {
            if (typeof p5 !== 'undefined') {
                new p5((p) => {
                    let particles = [];
                    p.setup = () => {
                        const canvas = p.createCanvas(p.windowWidth, p.windowHeight);
                        canvas.parent('particle-bg');
                        canvas.style('position', 'fixed');
                        canvas.style('top', '0');
                        canvas.style('z-index', '-1');
                        canvas.style('pointer-events', 'none');
                        for (let i = 0; i < 35; i++) {
                            particles.push({
                                x: p.random(p.width), y: p.random(p.height),
                                vx: p.random(-0.4, 0.4), vy: p.random(-0.4, 0.4),
                                size: p.random(2, 5), alpha: p.random(0.1, 0.25)
                            });
                        }
                    };
                    p.draw = () => {
                        p.clear();
                        particles.forEach(pt => {
                            p.fill(113, 128, 150, pt.alpha * 255); p.noStroke();
                            p.ellipse(pt.x, pt.y, pt.size);
                            pt.x += pt.vx; pt.y += pt.vy;
                            if (pt.x < 0 || pt.x > p.width) pt.vx *= -1;
                            if (pt.y < 0 || pt.y > p.height) pt.vy *= -1;
                        });
                    };
                    p.windowResized = () => { p.resizeCanvas(p.windowWidth, p.windowHeight); };
                });
            }
        }

        // Initialize & Observers
        document.addEventListener('DOMContentLoaded', () => {
            loadSettings();
            renderCategories();
            setupParticleBackground();

            // Settings Observers
            document.querySelectorAll('input[type="checkbox"], input[type="range"]').forEach(input => {
                input.addEventListener('change', saveSettings);
            });
            document.getElementById('fontSizeSlider').addEventListener('input', (e) => {
                document.getElementById('fontSizeValue').textContent = e.target.value + 'px';
            });

            // Global Click Observer
            document.addEventListener('click', (e) => {
                const target = e.target.closest('button') || e.target;
                if (target.id === 'addCategoryBtn') addCategory();
                if (target.dataset.action === 'delete-category') deleteCategory(target.dataset.id);
                if (target.id === 'exportAllBtn') exportAllData();
                if (target.id === 'clearCompletedBtn') clearCompletedTasks();
                if (target.id === 'resetAllBtn') resetAllData();
            });

            // Import Observer
            document.getElementById('importFileInput').addEventListener('change', (e) => {
                importData(e.target.files[0]);
            });

            // Animate cards
            if (typeof anime !== 'undefined') {
                anime({
                    targets: '.settings-card',
                    opacity: [0, 1], translateY: [30, 0],
                    delay: anime.stagger(100), duration: 800, easing: 'easeOutQuart'
                });
            }
        });
    </script>
</body>

</html>