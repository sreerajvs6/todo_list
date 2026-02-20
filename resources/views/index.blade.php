<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Focus - Clean Todo List</title>
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

        .task-item {
            transition: all 0.3s ease;
        }

        .task-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .priority-high {
            border-left: 4px solid #FC8181;
        }

        .priority-medium {
            border-left: 4px solid #F6E05E;
        }

        .priority-low {
            border-left: 4px solid #68D391;
        }

        .stats-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(226, 232, 240, 0.3);
        }

        .filter-btn {
            transition: all 0.2s ease;
        }

        .filter-btn:hover {
            transform: scale(1.02);
        }

        .add-task-form {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(226, 232, 240, 0.3);
        }

        .task-list-container {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(226, 232, 240, 0.3);
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

        .category-tag {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            color: white;
            font-weight: 500;
        }

        .priority-badge {
            font-size: 0.75rem;
            padding: 0.125rem 0.5rem;
            border-radius: 9999px;
            font-weight: 500;
        }

        .empty-state {
            opacity: 0.6;
        }

        .task-checkbox:checked {
            background-color: #68D391;
            border-color: #68D391;
        }

        .task-checkbox:checked+.task-description {
            text-decoration: line-through;
            opacity: 0.6;
        }

        @media (max-width: 768px) {
            .main-container {
                flex-direction: column;
            }

            .left-panel,
            .right-panel {
                width: 100%;
                margin-bottom: 1rem;
            }
        }

        /* Calendar Styles */
        .calendar-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(226, 232, 240, 0.3);
        }

        .calendar-day {
            width: 100%;
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            position: relative;
        }

        .calendar-day:hover {
            background: rgba(59, 130, 246, 0.1);
            color: #2563eb;
        }

        .calendar-day.selected {
            background: #2563eb;
            color: white;
            font-weight: 600;
        }

        .calendar-day.today {
            border: 1px solid #2563eb;
            color: #2563eb;
        }

        .calendar-day.empty {
            cursor: default;
        }

        .calendar-day.has-tasks::after {
            content: '';
            position: absolute;
            bottom: 4px;
            width: 4px;
            height: 4px;
            background: #10b981;
            border-radius: 50%;
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
                <a href="{{ url('/') }}" class="text-blue-600 font-medium border-b-2 border-blue-600 pb-1">Tasks</a>
                <a href="{{ url('/analytics') }}" class="text-gray-600 hover:text-gray-800 transition-colors">Analytics</a>
                <a href="{{ url('/settings') }}" class="text-gray-600 hover:text-gray-800 transition-colors">Settings</a>
                <a href="{{ url('/help') }}" class="text-gray-600 hover:text-gray-800 transition-colors">Help</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section pt-24 pb-12">
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Stay Focused, Stay Productive</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">A clean, minimalist todo list that helps you focus on
                    what matters most. No distractions, just pure productivity.</p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-6 pb-12">
        <div class="flex flex-col lg:flex-row gap-8 main-container">
            <!-- Left Panel - Add Task Form -->
            <div class="lg:w-1/4 left-panel">
                <div class="add-task-form rounded-xl p-6 sticky top-28">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Add New Task</h3>
                    <form id="addTaskForm" class="space-y-4">
                        <div>
                            <input type="text" id="taskInput" placeholder="What needs to be done?"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                required>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Priority</label>
                                <select id="taskPriority"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">None</option>
                                    <option value="high">High</option>
                                    <option value="medium">Medium</option>
                                    <option value="low">Low</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                                <select id="categoryList"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">None</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Due Date</label>
                            <input type="date" id="dueDate"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 transition-all font-medium">
                            Add Task
                        </button>
                    </form>


                </div>

                <!-- Calendar Section -->
                <div class="calendar-container rounded-xl p-6 mt-8">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Calendar</h3>
                        <div class="flex space-x-1">
                            <button id="prevMonth" class="p-1 hover:bg-gray-100 rounded">
                                <svg class="h-5 w-5 text-gray-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button>
                            <button id="nextMonth" class="p-1 hover:bg-gray-100 rounded">
                                <svg class="h-5 w-5 text-gray-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div id="calendarMonth" class="text-sm font-medium text-gray-600 mb-4 text-center"></div>
                    <div class="grid grid-cols-7 gap-1 mb-2">
                        <div class="text-center text-xs font-bold text-gray-400">Su</div>
                        <div class="text-center text-xs font-bold text-gray-400">Mo</div>
                        <div class="text-center text-xs font-bold text-gray-400">Tu</div>
                        <div class="text-center text-xs font-bold text-gray-400">We</div>
                        <div class="text-center text-xs font-bold text-gray-400">Th</div>
                        <div class="text-center text-xs font-bold text-gray-400">Fr</div>
                        <div class="text-center text-xs font-bold text-gray-400">Sa</div>
                    </div>
                    <div id="calendarDays" class="grid grid-cols-7 gap-1">
                        <!-- Days will be rendered here -->
                    </div>
                    <button id="clearDateFilter"
                        class="w-full mt-4 text-xs text-blue-600 hover:text-blue-800 font-medium hidden">
                        Clear Date Filter
                    </button>
                </div>
            </div>

            <!-- Center Panel - Task List -->
            <div class="lg:w-1/2 center-panel" style="width: 70% !important;">
                <div class="task-list-container rounded-xl p-6">
                    <!-- Search and Filters -->
                    <div class="mb-6 space-y-4">
                        <div class="relative">
                            <input type="text" id="searchInput" placeholder="Search tasks..."
                                class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <svg class="absolute left-3 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>

                        <div class="flex flex-wrap gap-2">
                            <button class="filter-btn px-4 py-2 rounded-lg bg-blue-500 text-white font-medium"
                                data-filter="all">
                                All Tasks
                            </button>
                            <button class="filter-btn px-4 py-2 rounded-lg bg-gray-200 text-gray-700 font-medium"
                                data-filter="active">
                                Active
                            </button>
                            <button class="filter-btn px-4 py-2 rounded-lg bg-gray-200 text-gray-700 font-medium"
                                data-filter="completed">
                                Completed
                            </button>
                            <button id="clearCompletedBtn"
                                class="px-4 py-2 rounded-lg bg-red-100 text-red-700 font-medium hover:bg-red-200 transition-colors">
                                Clear Completed
                            </button>
                            <button id="completeAllTasksBtn"
                                class="px-4 py-2 rounded-lg bg-green-100 text-green-700 font-medium hover:bg-green-200 transition-colors">
                                Mark All Done
                            </button>
                        </div>
                    </div>

                    <!-- Task List -->
                    <div id="taskList" class="space-y-3">
                        <!-- Tasks will be rendered here by JavaScript -->
                    </div>

                    <!-- Pagination -->
                    <div id="pagination" class="mt-8 flex items-center justify-between border-t border-gray-100 pt-6">
                        <div class="text-sm text-gray-500">
                            Showing <span id="startIndex">0</span> to <span id="endIndex">0</span> of <span
                                id="totalCount">0</span> tasks
                        </div>
                        <div class="flex items-center space-x-2">
                            <button id="prevPage"
                                class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                                Previous
                            </button>
                            <button id="nextPage"
                                class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                                Next
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Panel - Quick Stats & Productivity Insights -->
            <div class="lg:w-1/4 right-panel">
                <!-- Quick Stats -->
                <div class="mt-8 space-y-4 card">
                    <!-- <h4 class="text-sm font-semibold text-gray-700 uppercase tracking-wide">Quick Stats</h4> -->
                    <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wide">Quick Stats</h3>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="stats-card rounded-lg p-3 text-center">
                            <div class="text-2xl font-bold text-blue-600" id="totalTasks">0</div>
                            <div class="text-xs text-gray-600">Total</div>
                        </div>
                        <div class="stats-card rounded-lg p-3 text-center">
                            <div class="text-2xl font-bold text-green-600" id="completedTasks">0</div>
                            <div class="text-xs text-gray-600">Done</div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="stats-card rounded-lg p-3 text-center">
                            <div class="text-2xl font-bold text-yellow-600" id="activeTasks">0</div>
                            <div class="text-xs text-gray-600">Active</div>
                        </div>
                        <div class="stats-card rounded-lg p-3 text-center">
                            <div class="text-2xl font-bold text-purple-600" id="streak">0 days</div>
                            <div class="text-xs text-gray-600">Streak</div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="stats-card rounded-xl p-6 sticky top-28">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Productivity Insights</h3>

                    <!-- Completion Rate -->
                    <div class="mb-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700">Completion Rate</span>
                            <span class="text-sm font-bold text-blue-600" id="completionRate">0%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full transition-all duration-500" id="completionBar"
                                style="width: 0%"></div>
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="mb-6">
                        <h4 class="text-sm font-semibold text-gray-700 mb-3">Categories</h4>
                        <div class="space-y-2" id="categoryStats">
                            <!-- Category stats will be rendered here -->
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="space-y-2">
                        <h4 class="text-sm font-semibold text-gray-700 mb-3">Quick Actions</h4>
                        <button id="exportDataBtn"
                            class="w-full px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors text-sm">
                            Export Data
                        </button>
                        <button id="clearAllBtn"
                            class="w-full px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors text-sm">
                            Clear All Tasks
                        </button>
                    </div>

                    <!-- Keyboard Shortcuts -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <h4 class="text-sm font-semibold text-gray-700 mb-3">Keyboard Shortcuts</h4>
                        <div class="space-y-1 text-xs text-gray-600">
                            <div><kbd class="px-1 py-0.5 bg-gray-100 rounded">Ctrl+N</kbd> New task</div>
                            <div><kbd class="px-1 py-0.5 bg-gray-100 rounded">Ctrl+F</kbd> Search</div>
                        </div>
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

    <!-- Edit Task Modal -->
    <div id="editModal" class="fixed inset-0 z-[60] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div id="editModalOverlay" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-xl font-bold text-gray-900 mb-6" id="modal-title">Edit Task</h3>
                    <form id="editTaskForm" class="space-y-4">
                        <input type="hidden" id="editTaskId">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <input type="text" id="editTaskInput" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                   required>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Priority</label>
                                <select id="editTaskPriority"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                    <option value="">None</option>
                                    <option value="high">High</option>
                                    <option value="medium">Medium</option>
                                    <option value="low">Low</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                                <select id="editCategoryList"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                    <option value="">None</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Due Date</label>
                            <input type="date" id="editDueDate"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        </div>
                    </form>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" id="saveEditBtn"
                            class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Save Changes
                    </button>
                    <button type="button" id="cancelEditBtn"
                            class="mt-3 w-full inline-flex justify-center rounded-lg border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Load main JavaScript -->
    <script>
        // Global State
        let tasks = [];
        let currentFilter = 'all';
        let categories = [];
        let currentPage = 1;
        let pageSize = 5;
        let totalTasks = 0;
        let selectedDate = null;
        let currentCalendarDate = new Date();
        let globalStats = null;

        // Fetch Chains (No async)
        function loadTasks() {
            const url = new URL('api/tasks', window.location.href);
            url.searchParams.append('page', currentPage);
            url.searchParams.append('limit', pageSize);
            if (selectedDate) url.searchParams.append('due_date', selectedDate);
            if (currentFilter !== 'all') url.searchParams.append('filter', currentFilter);

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    tasks = data.tasks.map(task => ({
                        ...task,
                        completed: typeof task.completed === 'boolean' ? task.completed : !!parseInt(task.completed),
                        isFlagged: typeof task.is_flagged === 'boolean' ? task.is_flagged : !!parseInt(task.is_flagged),
                        category: task.category_name || task.category,
                        dueDate: task.due_date
                    }));
                    totalTasks = data.total;
                    globalStats = data.stats;
                    renderTasks();
                    updateStats();
                    updateFilterButtons();
                })
                .catch(error => console.error('Error loading tasks:', error));
        }

        function loadCategories(callback) {
            fetch('api/categories')
                .then(response => response.json())
                .then(data => {
                    categories = data.length > 0 ? data : [
                        { id: '1', name: 'Work', color: '#FC8181' },
                        { id: '2', name: 'Personal', color: '#68D391' },
                        { id: '3', name: 'Shopping', color: '#F6E05E' },
                        { id: '4', name: 'Health', color: '#63B3ED' }
                    ];
                    renderCategories();
                    if (callback) callback();
                })
                .catch(error => console.error('Error loading categories:', error));
        }

        function addTask() {
            const description = document.getElementById('taskInput').value;
            const priority = document.getElementById('taskPriority').value;
            const category = document.getElementById('categoryList').value;
            const dueDate = document.getElementById('dueDate').value;

            if (!description.trim()) return;

            const id = Date.now().toString();
            const createdAt = new Date().toISOString();

            fetch('api/tasks', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id, description, priority, category, dueDate, createdAt })
            })
            .then(res => {
                if (res.ok) {
                    document.getElementById('taskInput').value = '';
                    currentPage = 1;
                    loadTasks();
                    animateTaskAdd();
                }
            })
            .catch(error => console.error('Error adding task:', error));
        }

        function completeTask(taskId) {
            const task = tasks.find(t => t.id == taskId);
            if (!task) return;
            
            fetch(`api/tasks/${taskId}`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ completed: !task.completed })
            })
            .then(res => {
                if (res.ok) {
                    loadTasks();
                    animateTaskComplete(taskId);
                }
            })
            .catch(error => console.error('Error completing task:', error));
        }

        function deleteTask(taskId) {
            if (!confirm('Are you sure?')) return;
            fetch(`api/tasks/${taskId}`, { method: 'DELETE' })
            .then(res => {
                if (res.ok) {
                    animateTaskDelete(taskId);
                    setTimeout(() => loadTasks(), 300);
                }
            })
            .catch(error => console.error('Error deleting task:', error));
        }

        function toggleFlag(taskId) {
            const task = tasks.find(t => t.id == taskId);
            if (!task) return;

            fetch(`api/tasks/${taskId}`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ is_flagged: !task.isFlagged })
            })
            .then(res => { if (res.ok) loadTasks(); })
            .catch(error => console.error('Error flagging task:', error));
        }

        function completeAllTasks() {
            fetch('api/tasks/complete-all', { method: 'PUT' })
            .then(res => { if (res.ok) loadTasks(); })
            .catch(error => console.error('Error completing all:', error));
        }

        function clearCompleted() {
            fetch('api/tasks/completed', { method: 'DELETE' })
            .then(res => { if (res.ok) loadTasks(); })
            .catch(error => console.error('Error clearing completed:', error));
        }

        function clearAll() {
            if (!confirm('Delete all tasks?')) return;
            fetch('api/tasks/all', { method: 'DELETE' })
            .then(() => loadTasks())
            .catch(error => console.error('Error clearing all:', error));
        }

        function saveEdit() {
            const taskId = document.getElementById('editTaskId').value;
            const data = {
                description: document.getElementById('editTaskInput').value,
                priority: document.getElementById('editTaskPriority').value,
                category: document.getElementById('editCategoryList').value,
                dueDate: document.getElementById('editDueDate').value
            };

            fetch(`api/tasks/${taskId}`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            })
            .then(res => {
                if (res.ok) {
                    closeEditModal();
                    loadTasks();
                }
            })
            .catch(error => console.error('Error saving edit:', error));
        }

        // Modal Functions
        function openEditModal(taskId) {
            const task = tasks.find(t => t.id == taskId);
            if (task) {
                document.getElementById('editTaskId').value = task.id;
                document.getElementById('editTaskInput').value = task.description;
                document.getElementById('editTaskPriority').value = task.priority || '';
                document.getElementById('editCategoryList').value = task.category || '';
                document.getElementById('editDueDate').value = task.dueDate || '';
                document.getElementById('editModal').classList.remove('hidden');
                document.getElementById('editTaskInput').focus();
            }
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        // Render Functions
        function renderTasks() {
            const container = document.getElementById('taskList');
            if (!container) return;
            container.innerHTML = '';

            if (tasks.length === 0) {
                container.innerHTML = `<div class="text-center py-12 text-gray-500"><p>No tasks found</p></div>`;
                renderPagination();
                return;
            }

            tasks.forEach(task => { container.appendChild(createTaskElement(task)); });
            renderPagination();
        }

        function createTaskElement(task) {
            const div = document.createElement('div');
            const priorityClass = task.priority ? `priority-${task.priority}` : '';
            div.className = `task-item bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-3 ${task.completed ? 'opacity-60' : ''} ${priorityClass}`;
            div.dataset.taskId = task.id;

            const category = categories.find(c => c.name === task.category);
            const categoryColor = category ? category.color : '#E2E8F0';

            div.innerHTML = `
                <div class="flex items-center justify-between">
                    <div class="flex items-center flex-1">
                        <input type="checkbox" ${task.completed ? 'checked' : ''} 
                               data-task-id="${task.id}" data-action="complete"
                               class="mr-3 h-5 w-5 text-blue-600 rounded">
                        <div class="flex-1">
                            <div class="flex items-center">
                                <p class="task-description ${task.completed ? 'line-through' : ''} cursor-pointer" 
                                   data-task-id="${task.id}" data-action="edit">${task.description}</p>
                                <button data-task-id="${task.id}" data-action="flag" 
                                        class="ml-2 ${task.isFlagged ? 'text-yellow-500' : 'text-gray-300'}">★</button>
                            </div>
                            <div class="flex items-center mt-2 space-x-2 text-xs">
                                ${task.category ? `<span class="category-tag" style="background-color: ${categoryColor}">${task.category}</span>` : ''}
                                ${task.dueDate ? `<span>${task.dueDate}</span>` : ''}
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button data-task-id="${task.id}" data-action="edit" title="Edit Task" class="p-1 text-gray-400 hover:text-blue-500 transition-colors">
                            <svg class="h-5 w-5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </button>
                        <button data-task-id="${task.id}" data-action="delete" title="Delete Task" class="p-1 text-gray-400 hover:text-red-500 transition-colors">
                            <svg class="h-5 w-5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-11V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>`;
            return div;
        }

        function renderPagination() {
            document.getElementById('startIndex').textContent = totalTasks > 0 ? (currentPage - 1) * pageSize + 1 : 0;
            document.getElementById('endIndex').textContent = Math.min(currentPage * pageSize, totalTasks);
            document.getElementById('totalCount').textContent = totalTasks;
            document.getElementById('prevPage').disabled = currentPage === 1;
            document.getElementById('nextPage').disabled = currentPage >= Math.ceil(totalTasks / pageSize);
        }

        function renderCategories() {
            const lists = [document.getElementById('categoryList'), document.getElementById('editCategoryList')];
            lists.forEach(list => {
                if (!list) return;
                list.innerHTML = '<option value="">None</option>';
                categories.forEach(c => {
                    const opt = document.createElement('option');
                    opt.value = c.name;
                    opt.textContent = c.name;
                    list.appendChild(opt);
                });
            });
        }

        function updateStats() {
            if (!globalStats) return;
            document.getElementById('totalTasks').textContent = globalStats.total;
            document.getElementById('completedTasks').textContent = globalStats.completed;
            document.getElementById('activeTasks').textContent = globalStats.active;
            const rate = globalStats.total > 0 ? Math.round((globalStats.completed / globalStats.total) * 100) : 0;
            document.getElementById('completionRate').textContent = rate + '%';
            if (window.updateCompletionBar) window.updateCompletionBar();
        }

        function updateFilterButtons() {
            document.querySelectorAll('.filter-btn').forEach(btn => {
                if (btn.dataset.filter === currentFilter) {
                    btn.classList.add('bg-blue-500', 'text-white');
                    btn.classList.remove('bg-gray-200');
                } else {
                    btn.classList.remove('bg-blue-500', 'text-white');
                    btn.classList.add('bg-gray-200');
                }
            });
        }

        function renderCalendar() {
            const monthEl = document.getElementById('calendarMonth');
            const daysEl = document.getElementById('calendarDays');
            if (!monthEl || !daysEl) return;
            daysEl.innerHTML = '';
            const year = currentCalendarDate.getFullYear();
            const month = currentCalendarDate.getMonth();
            const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            monthEl.textContent = `${monthNames[month]} ${year}`;

            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();

            for (let i = 0; i < firstDay; i++) daysEl.appendChild(document.createElement('div'));
            for (let d = 1; d <= daysInMonth; d++) {
                const day = document.createElement('div');
                day.className = 'calendar-day';
                day.textContent = d;
                const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(d).padStart(2, '0')}`;
                if (dateStr === selectedDate) day.classList.add('selected');
                day.dataset.date = dateStr;
                daysEl.appendChild(day);
            }
        }

        // Initialization & Event Observers
        document.addEventListener('DOMContentLoaded', () => {
            loadCategories(() => {
                renderCalendar();
                loadTasks();
            });

            // Form Observer
            document.getElementById('addTaskForm').addEventListener('submit', (e) => {
                e.preventDefault();
                addTask();
            });

            // Global Click Observer (Delegation)
            document.addEventListener('click', (e) => {
                const target = e.target;
                const taskId = target.dataset.taskId;
                const action = target.dataset.action;

                // Task actions
                if (taskId) {
                    if (action === 'delete') deleteTask(taskId);
                    if (action === 'flag') toggleFlag(taskId);
                    if (action === 'edit') openEditModal(taskId);
                }

                // Header actions
                if (target.id === 'clearCompletedBtn') clearCompleted();
                if (target.id === 'completeAllTasksBtn') completeAllTasks();
                if (target.id === 'exportDataBtn') exportData();
                if (target.id === 'clearAllBtn') clearAll();

                // Modal actions
                if (target.id === 'saveEditBtn') saveEdit();
                if (target.id === 'cancelEditBtn' || target.id === 'editModalOverlay') closeEditModal();

                // Navigation
                if (target.classList.contains('filter-btn')) {
                    currentFilter = target.dataset.filter;
                    currentPage = 1;
                    loadTasks();
                }
                if (target.id === 'prevPage') { if (currentPage > 1) { currentPage--; loadTasks(); } }
                if (target.id === 'nextPage') { if (currentPage * pageSize < totalTasks) { currentPage++; loadTasks(); } }

                // Calendar
                if (target.id === 'prevMonth') { currentCalendarDate.setMonth(currentCalendarDate.getMonth() - 1); renderCalendar(); }
                if (target.id === 'nextMonth') { currentCalendarDate.setMonth(currentCalendarDate.getMonth() + 1); renderCalendar(); }
                if (target.classList.contains('calendar-day') && target.dataset.date) {
                    selectedDate = (selectedDate === target.dataset.date) ? null : target.dataset.date;
                    currentPage = 1;
                    renderCalendar();
                    loadTasks();
                }
            });

            // Global Change Observer
            document.addEventListener('change', (e) => {
                const target = e.target;
                if (target.dataset.action === 'complete' && target.dataset.taskId) {
                    completeTask(target.dataset.taskId);
                }
            });

            if (window.setupParticleBackground) window.setupParticleBackground();
            if (window.initAnimations) window.initAnimations();
        });

        // Visual Helpers (Keep them procedural)
        function initAnimations() {
            if (typeof anime !== 'undefined') {
                anime({
                    targets: '.task-item',
                    opacity: [0, 1],
                    translateY: [20, 0],
                    delay: anime.stagger(100),
                    duration: 600,
                    easing: 'easeOutQuart'
                });
            }
        }

        function animateTaskAdd() {
            if (typeof anime !== 'undefined') {
                setTimeout(() => {
                    const newTask = document.querySelector('.task-item');
                    if (newTask) {
                        anime({
                            targets: newTask,
                            opacity: [0, 1],
                            scale: [0.8, 1],
                            duration: 400,
                            easing: 'easeOutBack'
                        });
                    }
                }, 50);
            }
        }

        function animateTaskComplete(taskId) {
            if (typeof anime !== 'undefined') {
                const el = document.querySelector(`[data-task-id="${taskId}"]`);
                if (el) anime({ targets: el, scale: [1, 0.95, 1], duration: 300, easing: 'easeInOutQuad' });
            }
        }

        function animateTaskDelete(taskId) {
            if (typeof anime !== 'undefined') {
                const el = document.querySelector(`[data-task-id="${taskId}"]`);
                if (el) anime({ targets: el, opacity: [1, 0], scale: [1, 0.8], duration: 300, easing: 'easeInQuart' });
            }
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
                        for (let i = 0; i < 50; i++) {
                            particles.push({
                                x: p.random(p.width),
                                y: p.random(p.height),
                                vx: p.random(-0.5, 0.5),
                                vy: p.random(-0.5, 0.5),
                                size: p.random(2, 6),
                                alpha: p.random(0.1, 0.3)
                            });
                        }
                    };
                    p.draw = () => {
                        p.clear();
                        particles.forEach(particle => {
                            p.fill(113, 128, 150, particle.alpha * 255);
                            p.noStroke();
                            p.ellipse(particle.x, particle.y, particle.size);
                            particle.x += particle.vx;
                            particle.y += particle.vy;
                            if (particle.x < 0 || particle.x > p.width) particle.vx *= -1;
                            if (particle.y < 0 || particle.y > p.height) particle.vy *= -1;
                        });
                    };
                    p.windowResized = () => { p.resizeCanvas(p.windowWidth, p.windowHeight) };
                });
            }
        }

        function exportData() {
            fetch('api/tasks?limit=1000')
                .then(res => res.json())
                .then(data => {
                    const blob = new Blob([JSON.stringify(data, null, 2)], { type: 'application/json' });
                    const url = URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = `todo-backup-${new Date().toISOString().split('T')[0]}.json`;
                    a.click();
                    URL.revokeObjectURL(url);
                })
                .catch(error => console.error('Error exporting:', error));
        }
    </script>

    <!-- Additional initialization -->
    <script>
        // Update completion bar when stats change
        function updateCompletionBar() {
            const rate = document.getElementById('completionRate');
            const bar = document.getElementById('completionBar');
            if (rate && bar) {
                const percentage = parseInt(rate.textContent) || 0;
                bar.style.width = percentage + '%';
            }
        }

        // Override the updateStats method to include completion bar update
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                if (window.todoApp) {
                    const originalUpdateStats = window.todoApp.updateStats;
                    window.todoApp.updateStats = function () {
                        originalUpdateStats.call(this);
                        updateCompletionBar();
                    };

                    // Initial call to set the completion bar
                    window.todoApp.updateStats();
                }
            }, 100);
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Auto-focus on task input when page loads
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                const taskInput = document.getElementById('taskInput');
                if (taskInput) {
                    taskInput.focus();
                }
            }, 500);
        });
    </script>
</body>

</html>