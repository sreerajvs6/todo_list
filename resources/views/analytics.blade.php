<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics - Focus Todo App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.4.0/echarts.min.js"></script>
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

        .stats-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(226, 232, 240, 0.3);
            transition: all 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
        }

        .chart-container {
            background: rgba(255, 255, 255, 0.95);
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

        .metric-icon {
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .trend-up {
            color: #10B981;
        }

        .trend-down {
            color: #EF4444;
        }

        .trend-neutral {
            color: #6B7280;
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
                <a href="{{ url('/analytics') }}" class="text-blue-600 font-medium border-b-2 border-blue-600 pb-1">Analytics</a>
                <a href="{{ url('/settings') }}" class="text-gray-600 hover:text-gray-800 transition-colors">Settings</a>
                <a href="{{ url('/help') }}" class="text-gray-600 hover:text-gray-800 transition-colors">Help</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section pt-24 pb-12">
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Productivity Analytics</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Track your progress, identify patterns, and optimize
                    your productivity with detailed insights.</p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-6 pb-12">
        <!-- Key Metrics -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="stats-card rounded-xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Tasks</p>
                        <p class="text-3xl font-bold text-gray-900" id="totalTasksMetric">0</p>
                    </div>
                    <div class="metric-icon bg-blue-100 text-blue-600">
                        📝
                    </div>
                </div>
                <div class="mt-4 flex items-center">
                    <span class="trend-neutral">↗</span>
                    <span class="text-sm text-gray-600 ml-1">All time</span>
                </div>
            </div>

            <div class="stats-card rounded-xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Completed</p>
                        <p class="text-3xl font-bold text-green-600" id="completedTasksMetric">0</p>
                    </div>
                    <div class="metric-icon bg-green-100 text-green-600">
                        ✅
                    </div>
                </div>
                <div class="mt-4 flex items-center">
                    <span class="trend-up">↗</span>
                    <span class="text-sm text-gray-600 ml-1">+12% from last week</span>
                </div>
            </div>

            <div class="stats-card rounded-xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Completion Rate</p>
                        <p class="text-3xl font-bold text-blue-600" id="completionRateMetric">0%</p>
                    </div>
                    <div class="metric-icon bg-purple-100 text-purple-600">
                        📊
                    </div>
                </div>
                <div class="mt-4 flex items-center">
                    <span class="trend-up">↗</span>
                    <span class="text-sm text-gray-600 ml-1">+5% improvement</span>
                </div>
            </div>

            <div class="stats-card rounded-xl p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Current Streak</p>
                        <p class="text-3xl font-bold text-orange-600" id="streakMetric">0</p>
                    </div>
                    <div class="metric-icon bg-orange-100 text-orange-600">
                        🔥
                    </div>
                </div>
                <div class="mt-4 flex items-center">
                    <span class="trend-neutral">→</span>
                    <span class="text-sm text-gray-600 ml-1">days in a row</span>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Daily Completion Chart -->
            <div class="chart-container rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Daily Task Completion</h3>
                <div id="dailyChart" style="height: 300px;"></div>
            </div>

            <!-- Category Breakdown -->
            <div class="chart-container rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Tasks by Category</h3>
                <div id="categoryChart" style="height: 300px;"></div>
            </div>
        </div>

        <!-- Weekly Trend and Priority Distribution -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Weekly Trend -->
            <div class="chart-container rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Weekly Productivity Trend</h3>
                <div id="weeklyChart" style="height: 300px;"></div>
            </div>

            <!-- Priority Distribution -->
            <div class="chart-container rounded-xl p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Priority Distribution</h3>
                <div id="priorityChart" style="height: 300px;"></div>
            </div>
        </div>

        <!-- Insights and Recommendations -->
        <div class="chart-container rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Insights & Recommendations</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-blue-50 rounded-lg p-4">
                    <div class="flex items-center mb-2">
                        <span class="text-2xl mr-2">💡</span>
                        <h4 class="font-semibold text-blue-800">Peak Performance</h4>
                    </div>
                    <p class="text-sm text-blue-700">You're most productive on Tuesdays and Thursdays. Consider
                        scheduling important tasks on these days.</p>
                </div>

                <div class="bg-green-50 rounded-lg p-4">
                    <div class="flex items-center mb-2">
                        <span class="text-2xl mr-2">🎯</span>
                        <h4 class="font-semibold text-green-800">Focus Areas</h4>
                    </div>
                    <p class="text-sm text-green-700">Work tasks have the highest completion rate. Consider breaking
                        down personal tasks into smaller steps.</p>
                </div>

                <div class="bg-purple-50 rounded-lg p-4">
                    <div class="flex items-center mb-2">
                        <span class="text-2xl mr-2">⚡</span>
                        <h4 class="font-semibold text-purple-800">Optimization</h4>
                    </div>
                    <p class="text-sm text-purple-700">Setting due dates increases completion rate by 34%. Try adding
                        deadlines to your tasks.</p>
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

    <!-- Analytics specific JavaScript -->
    <script>
        // Global state
        let tasks = [];
        let categories = [];
        let dailyChart, categoryChart, weeklyChart, priorityChart;

        function loadMetrics() {
            Promise.all([
                fetch('api/tasks?limit=1000').then(res => res.json()),
                fetch('api/categories').then(res => res.json())
            ]).then(([data, categoriesData]) => {
                categories = categoriesData;
                tasks = (data.tasks || []).map(task => ({
                    ...task,
                    completed: typeof task.completed === 'boolean' ? task.completed : !!parseInt(task.completed),
                    category: task.category_name || task.category,
                    createdAt: task.created_at,
                    completedAt: task.completed_at,
                    dueDate: task.due_date
                }));

                updateMetrics();
                renderCharts();
            }).catch(error => console.error('Error loading analytics:', error));
        }

        function updateMetrics() {
            const total = tasks.length;
            const completed = tasks.filter(t => t.completed).length;
            const rate = total > 0 ? Math.round((completed / total) * 100) : 0;

            document.getElementById('totalTasksMetric').textContent = total;
            document.getElementById('completedTasksMetric').textContent = completed;
            document.getElementById('completionRateMetric').textContent = rate + '%';
            document.getElementById('streakMetric').textContent = calculateStreak();
        }

        function calculateStreak() {
            const sortedDates = [...new Set(tasks
                .filter(t => t.completed && t.completedAt)
                .map(t => new Date(t.completedAt).toDateString())
            )].sort((a, b) => new Date(b) - new Date(a));

            if (sortedDates.length === 0) return 0;
            let streak = 0;
            const today = new Date();
            for (let i = 0; i < sortedDates.length; i++) {
                const date = new Date(sortedDates[i]);
                const diff = Math.floor((today - date) / (1000 * 60 * 60 * 24));
                if (diff === i) streak++; else break;
            }
            return streak;
        }

        function renderCharts() {
            if (!dailyChart) {
                dailyChart = echarts.init(document.getElementById('dailyChart'));
                categoryChart = echarts.init(document.getElementById('categoryChart'));
                weeklyChart = echarts.init(document.getElementById('weeklyChart'));
                priorityChart = echarts.init(document.getElementById('priorityChart'));
            }

            renderDailyChart();
            renderCategoryChart();
            renderWeeklyChart();
            renderPriorityChart();
        }

        function renderDailyChart() {
            const last7Days = [...Array(7)].map((_, i) => {
                const d = new Date(); d.setDate(d.getDate() - i);
                return d.toDateString();
            }).reverse();

            const data = last7Days.map(dateStr => ({
                day: new Date(dateStr).toLocaleDateString('en-US', { weekday: 'short' }),
                completed: tasks.filter(t => t.completed && t.completedAt && new Date(t.completedAt).toDateString() === dateStr).length,
                created: tasks.filter(t => new Date(t.createdAt).toDateString() === dateStr).length
            }));

            dailyChart.setOption({
                tooltip: { trigger: 'axis' },
                legend: { data: ['Created', 'Completed'] },
                xAxis: { type: 'category', data: data.map(d => d.day) },
                yAxis: { type: 'value' },
                series: [
                    { name: 'Created', type: 'bar', data: data.map(d => d.created), itemStyle: { color: '#63B3ED' } },
                    { name: 'Completed', type: 'bar', data: data.map(d => d.completed), itemStyle: { color: '#68D391' } }
                ]
            });
        }

        function renderCategoryChart() {
            const dist = {};
            tasks.forEach(t => { const c = t.category || 'Uncategorized'; dist[c] = (dist[c] || 0) + 1; });
            const data = Object.entries(dist).map(([name, value]) => {
                const cat = categories.find(c => c.name === name);
                return { name, value, itemStyle: { color: cat ? cat.color : '#E2E8F0' } };
            });

            categoryChart.setOption({
                tooltip: { trigger: 'item' },
                series: [{ name: 'Categories', type: 'pie', radius: '70%', data }]
            });
        }

        function renderWeeklyChart() {
            const data = ['Week 4', 'Week 3', 'Week 2', 'Current'].map((label, i) => {
                const now = new Date();
                const start = new Date(now.getFullYear(), now.getMonth(), now.getDate() - (i * 7) - 6);
                const end = new Date(now.getFullYear(), now.getMonth(), now.getDate() - (i * 7));
                const weekTasks = tasks.filter(t => { const d = new Date(t.createdAt); return d >= start && d <= end; });
                const completed = weekTasks.filter(t => t.completed).length;
                return { label, completed, rate: weekTasks.length > 0 ? Math.round((completed / weekTasks.length) * 100) : 0 };
            }).reverse();

            weeklyChart.setOption({
                tooltip: { trigger: 'axis' },
                xAxis: { type: 'category', data: data.map(d => d.label) },
                yAxis: [{ type: 'value', name: 'Tasks' }, { type: 'value', name: 'Rate (%)', max: 100 }],
                series: [
                    { name: 'Tasks Completed', type: 'line', data: data.map(d => d.completed), itemStyle: { color: '#68D391' }, smooth: true },
                    { name: 'Completion Rate (%)', type: 'line', yAxisIndex: 1, data: data.map(d => d.rate), itemStyle: { color: '#63B3ED' }, smooth: true }
                ]
            });
        }

        function renderPriorityChart() {
            const dist = { 'High': 0, 'Medium': 0, 'Low': 0, 'None': 0 };
            tasks.forEach(t => { const p = t.priority ? t.priority.charAt(0).toUpperCase() + t.priority.slice(1) : 'None'; dist[p]++; });
            const colors = { 'High': '#FC8181', 'Medium': '#F6E05E', 'Low': '#68D391', 'None': '#E2E8F0' };
            const data = Object.entries(dist).map(([name, value]) => ({ name, value, itemStyle: { color: colors[name] } }));

            priorityChart.setOption({
                tooltip: { trigger: 'item' },
                series: [{ name: 'Priority', type: 'pie', radius: ['40%', '70%'], data }]
            });
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
                        for (let i = 0; i < 40; i++) {
                            particles.push({
                                x: p.random(p.width), y: p.random(p.height),
                                vx: p.random(-0.3, 0.3), vy: p.random(-0.3, 0.3),
                                size: p.random(3, 8), alpha: p.random(0.1, 0.2)
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

        // Initialize observers
        document.addEventListener('DOMContentLoaded', () => {
            loadMetrics();
            setupParticleBackground();

            // Animate cards
            if (typeof anime !== 'undefined') {
                anime({
                    targets: '.stats-card', opacity: [0, 1], translateY: [30, 0],
                    delay: anime.stagger(100), duration: 800, easing: 'easeOutQuart'
                });
                anime({
                    targets: '.chart-container', opacity: [0, 1], scale: [0.9, 1],
                    delay: anime.stagger(150, { start: 400 }), duration: 600, easing: 'easeOutBack'
                });
            }
        });

        window.addEventListener('resize', () => {
            setTimeout(() => {
                dailyChart?.resize();
                categoryChart?.resize();
                weeklyChart?.resize();
                priorityChart?.resize();
            }, 100);
        });
    </script>
</body>

</html>