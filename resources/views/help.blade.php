<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help - Focus Todo App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
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
        
        .help-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(226, 232, 240, 0.3);
            transition: all 0.3s ease;
        }
        
        .help-card:hover {
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
        
        .feature-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(226, 232, 240, 0.3);
            transition: all 0.3s ease;
        }
        
        .feature-card:hover {
            transform: scale(1.02);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }
        
        .faq-item {
            border-bottom: 1px solid #E5E7EB;
            transition: all 0.3s ease;
        }
        
        .faq-item:hover {
            background-color: rgba(59, 130, 246, 0.05);
        }
        
        .faq-question {
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .faq-question:hover {
            color: #3B82F6;
        }
        
        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }
        
        .faq-answer.open {
            max-height: 200px;
        }
        
        .splide__arrow {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(226, 232, 240, 0.3);
        }
        
        .splide__arrow:hover {
            background: rgba(255, 255, 255, 1);
        }
        
        .step-number {
            width: 2rem;
            height: 2rem;
            background: #3B82F6;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.875rem;
        }
        
        .search-highlight {
            background-color: #FEF3C7;
            padding: 0.125rem 0.25rem;
            border-radius: 0.25rem;
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
                <a href="{{ url('/settings') }}" class="text-gray-600 hover:text-gray-800 transition-colors">Settings</a>
                <a href="{{ url('/help') }}" class="text-blue-600 font-medium border-b-2 border-blue-600 pb-1">Help</a>
            </div>
        </div>
    </nav>
    
    <!-- Hero Section -->
    <section class="hero-section pt-24 pb-12">
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Help & Documentation</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Learn how to make the most of Focus with our comprehensive guide and tips.</p>
            </div>
        </div>
    </section>
    
    <!-- Search Bar -->
    <section class="max-w-4xl mx-auto px-6 mb-8">
        <div class="help-card rounded-xl p-6">
            <div class="relative">
                <input type="text" id="helpSearch" placeholder="Search help articles..." 
                       class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <svg class="absolute left-3 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>
    </section>
    
    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-6 pb-12">
        <!-- Getting Started Section -->
        <section class="mb-12">
            <h3 class="text-2xl font-bold text-gray-800 mb-8 text-center">Getting Started</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="help-card rounded-xl p-6 text-center">
                    <div class="step-number mx-auto mb-4">1</div>
                    <h4 class="font-semibold text-gray-800 mb-2">Add Your First Task</h4>
                    <p class="text-sm text-gray-600">Click in the input field and type what you need to do. Press Enter or click Add Task.</p>
                </div>
                
                <div class="help-card rounded-xl p-6 text-center">
                    <div class="step-number mx-auto mb-4">2</div>
                    <h4 class="font-semibold text-gray-800 mb-2">Set Priority & Category</h4>
                    <p class="text-sm text-gray-600">Choose priority level and category to organize your tasks effectively.</p>
                </div>
                
                <div class="help-card rounded-xl p-6 text-center">
                    <div class="step-number mx-auto mb-4">3</div>
                    <h4 class="font-semibold text-gray-800 mb-2">Mark Tasks Complete</h4>
                    <p class="text-sm text-gray-600">Click the checkbox next to any task to mark it as completed.</p>
                </div>
                
                <div class="help-card rounded-xl p-6 text-center">
                    <div class="step-number mx-auto mb-4">4</div>
                    <h4 class="font-semibold text-gray-800 mb-2">Track Your Progress</h4>
                    <p class="text-sm text-gray-600">View your completion rate and productivity insights in the Analytics section.</p>
                </div>
            </div>
        </section>
        
        <!-- Features Showcase -->
        <section class="mb-12">
            <h3 class="text-2xl font-bold text-gray-800 mb-8 text-center">Key Features</h3>
            <div class="splide" id="featuresCarousel">
                <div class="splide__track">
                    <ul class="splide__list">
                        <li class="splide__slide">
                            <div class="feature-card rounded-xl p-8 mx-4">
                                <div class="text-center">
                                    <div class="text-6xl mb-4">✅</div>
                                    <h4 class="text-xl font-semibold text-gray-800 mb-4">Smart Task Management</h4>
                                    <p class="text-gray-600 mb-6">Add, edit, and organize tasks with priority levels, categories, and due dates. Everything you need to stay organized.</p>
                                    <div class="bg-blue-50 rounded-lg p-4 text-left">
                                        <p class="text-sm text-blue-800"><strong>Pro Tip:</strong> Use Ctrl+N to quickly add new tasks without clicking!</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        
                        <li class="splide__slide">
                            <div class="feature-card rounded-xl p-8 mx-4">
                                <div class="text-center">
                                    <div class="text-6xl mb-4">📊</div>
                                    <h4 class="text-xl font-semibold text-gray-800 mb-4">Productivity Analytics</h4>
                                    <p class="text-gray-600 mb-6">Track your progress with detailed charts, completion rates, and productivity insights to optimize your workflow.</p>
                                    <div class="bg-green-50 rounded-lg p-4 text-left">
                                        <p class="text-sm text-green-800"><strong>Insight:</strong> Users who track their progress are 40% more likely to achieve their goals!</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        
                        <li class="splide__slide">
                            <div class="feature-card rounded-xl p-8 mx-4">
                                <div class="text-center">
                                    <div class="text-6xl mb-4">🏷️</div>
                                    <h4 class="text-xl font-semibold text-gray-800 mb-4">Custom Categories</h4>
                                    <p class="text-gray-600 mb-6">Create personalized categories with custom colors to organize your tasks by project, context, or any system that works for you.</p>
                                    <div class="bg-purple-50 rounded-lg p-4 text-left">
                                        <p class="text-sm text-purple-800"><strong>Organization Tip:</strong> Use categories like "Work", "Personal", "Health" to separate different life areas!</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        
                        <li class="splide__slide">
                            <div class="feature-card rounded-xl p-8 mx-4">
                                <div class="text-center">
                                    <div class="text-6xl mb-4">⚡</div>
                                    <h4 class="text-xl font-semibold text-gray-800 mb-4">Keyboard Shortcuts</h4>
                                    <p class="text-gray-600 mb-6">Speed up your workflow with powerful keyboard shortcuts for common actions. Work faster without touching your mouse.</p>
                                    <div class="bg-orange-50 rounded-lg p-4 text-left">
                                        <p class="text-sm text-orange-800"><strong>Speed Boost:</strong> Ctrl+F for search, Space to complete tasks, Enter to edit!</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        
                        <li class="splide__slide">
                            <div class="feature-card rounded-xl p-8 mx-4">
                                <div class="text-center">
                                    <div class="text-6xl mb-4">🔍</div>
                                    <h4 class="text-xl font-semibold text-gray-800 mb-4">Smart Search & Filter</h4>
                                    <p class="text-gray-600 mb-6">Quickly find any task with instant search and powerful filtering options. View all tasks, active tasks, or completed tasks.</p>
                                    <div class="bg-teal-50 rounded-lg p-4 text-left">
                                        <p class="text-sm text-teal-800"><strong>Search Power:</strong> Search works across task descriptions and categories!</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        
                        <li class="splide__slide">
                            <div class="feature-card rounded-xl p-8 mx-4">
                                <div class="text-center">
                                    <div class="text-6xl mb-4">💾</div>
                                    <h4 class="text-xl font-semibold text-gray-800 mb-4">Data Backup & Sync</h4>
                                    <p class="text-gray-600 mb-6">Export and import your data for backup or migration. Your tasks are safely stored in your browser's local storage.</p>
                                    <div class="bg-red-50 rounded-lg p-4 text-left">
                                        <p class="text-sm text-red-800"><strong>Backup Reminder:</strong> Regular exports ensure you never lose your tasks!</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        
        <!-- Tips and Best Practices -->
        <section class="mb-12">
            <h3 class="text-2xl font-bold text-gray-800 mb-8 text-center">Productivity Tips</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="help-card rounded-xl p-6">
                    <div class="text-4xl mb-4">🎯</div>
                    <h4 class="font-semibold text-gray-800 mb-3">Start Small</h4>
                    <p class="text-gray-600 text-sm">Break large tasks into smaller, manageable pieces. This makes them less intimidating and easier to start.</p>
                </div>
                
                <div class="help-card rounded-xl p-6">
                    <div class="text-4xl mb-4">⏰</div>
                    <h4 class="font-semibold text-gray-800 mb-3">Time Blocking</h4>
                    <p class="text-gray-600 text-sm">Assign specific time slots for different types of tasks. This helps maintain focus and prevents context switching.</p>
                </div>
                
                <div class="help-card rounded-xl p-6">
                    <div class="text-4xl mb-4">🥇</div>
                    <h4 class="font-semibold text-gray-800 mb-3">Eat the Frog</h4>
                    <p class="text-gray-600 text-sm">Tackle your most important or difficult task first thing in the morning when your energy is highest.</p>
                </div>
                
                <div class="help-card rounded-xl p-6">
                    <div class="text-4xl mb-4">📅</div>
                    <h4 class="font-semibold text-gray-800 mb-3">Set Deadlines</h4>
                    <p class="text-gray-600 text-sm">Even for tasks that don't have natural deadlines. This creates urgency and helps prevent procrastination.</p>
                </div>
                
                <div class="help-card rounded-xl p-6">
                    <div class="text-4xl mb-4">🧹</div>
                    <h4 class="font-semibold text-gray-800 mb-3">Two-Minute Rule</h4>
                    <p class="text-gray-600 text-sm">If a task takes less than two minutes, do it immediately instead of adding it to your todo list.</p>
                </div>
                
                <div class="help-card rounded-xl p-6">
                    <div class="text-4xl mb-4">📈</div>
                    <h4 class="font-semibold text-gray-800 mb-3">Review Regularly</h4>
                    <p class="text-gray-600 text-sm">Spend time each week reviewing your completed tasks and planning for the week ahead.</p>
                </div>
            </div>
        </section>
        
        <!-- FAQ Section -->
        <section class="mb-12">
            <h3 class="text-2xl font-bold text-gray-800 mb-8 text-center">Frequently Asked Questions</h3>
            <div class="help-card rounded-xl p-6">
                <div class="space-y-4" id="faqContainer">
                    <div class="faq-item py-4">
                        <div class="faq-question flex justify-between items-center" data-action="toggle-faq" data-index="0">
                            <h4 class="font-semibold text-gray-800">How do I backup my tasks?</h4>
                            <span class="faq-icon text-gray-500">+</span>
                        </div>
                        <div class="faq-answer mt-3 text-gray-600">
                            <p>Go to Settings → Data Management and click "Export Data". This will download a JSON file containing all your tasks, categories, and settings. Keep this file safe as your backup.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item py-4">
                        <div class="faq-question flex justify-between items-center" data-action="toggle-faq" data-index="1">
                            <h4 class="font-semibold text-gray-800">Can I use Focus on multiple devices?</h4>
                            <span class="faq-icon text-gray-500">+</span>
                        </div>
                        <div class="faq-answer mt-3 text-gray-600">
                            <p>Currently, Focus stores data locally in your browser. To use it on multiple devices, you can export your data from one device and import it on another. Future versions may include cloud sync.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item py-4">
                        <div class="faq-question flex justify-between items-center" data-action="toggle-faq" data-index="2">
                            <h4 class="font-semibold text-gray-800">How do I set up categories?</h4>
                            <span class="faq-icon text-gray-500">+</span>
                        </div>
                        <div class="faq-answer mt-3 text-gray-600">
                            <p>Navigate to Settings → Categories. Enter a category name, choose a color, and click "Add". You can then assign tasks to categories when creating or editing them.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item py-4">
                        <div class="faq-question flex justify-between items-center" data-action="toggle-faq" data-index="3">
                            <h4 class="font-semibold text-gray-800">What keyboard shortcuts are available?</h4>
                            <span class="faq-icon text-gray-500">+</span>
                        </div>
                        <div class="faq-answer mt-3 text-gray-600">
                            <p>Press Ctrl+N to add a new task, Ctrl+F to search, Space to complete a selected task, and Enter to edit. See the Settings page for a complete list of shortcuts.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item py-4">
                        <div class="faq-question flex justify-between items-center" data-action="toggle-faq" data-index="4">
                            <h4 class="font-semibold text-gray-800">How do I view my productivity stats?</h4>
                            <span class="faq-icon text-gray-500">+</span>
                        </div>
                        <div class="faq-answer mt-3 text-gray-600">
                            <p>Click on "Analytics" in the navigation bar. You'll see completion rates, daily trends, category breakdowns, and other insights to help you understand and improve your productivity.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item py-4">
                        <div class="faq-question flex justify-between items-center" data-action="toggle-faq" data-index="5">
                            <h4 class="font-semibold text-gray-800">Can I customize the appearance?</h4>
                            <span class="faq-icon text-gray-500">+</span>
                        </div>
                        <div class="faq-answer mt-3 text-gray-600">
                            <p>Yes! Go to Settings → Appearance to enable dark mode, adjust font size, toggle animations, and switch to a compact view for more tasks on screen.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item py-4">
                        <div class="faq-question flex justify-between items-center" data-action="toggle-faq" data-index="6">
                            <h4 class="font-semibold text-gray-800">How do I set due dates for tasks?</h4>
                            <span class="faq-icon text-gray-500">+</span>
                        </div>
                        <div class="faq-answer mt-3 text-gray-600">
                            <p>When adding a new task, click on the "Due Date" field and select a date from the calendar picker. Tasks with due dates will show visual indicators when they're overdue or due soon.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item py-4">
                        <div class="faq-question flex justify-between items-center" data-action="toggle-faq" data-index="7">
                            <h4 class="font-semibold text-gray-800">Is my data secure?</h4>
                            <span class="faq-icon text-gray-500">+</span>
                        </div>
                        <div class="faq-answer mt-3 text-gray-600">
                            <p>Your data is stored locally in your browser and never sent to external servers. This means you have full control and privacy, but you should regularly export backups to prevent data loss.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Contact and Support -->
        <section>
            <h3 class="text-2xl font-bold text-gray-800 mb-8 text-center">Need More Help?</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="help-card rounded-xl p-6 text-center">
                    <div class="text-4xl mb-4">📧</div>
                    <h4 class="font-semibold text-gray-800 mb-3">Contact Support</h4>
                    <p class="text-gray-600 text-sm mb-4">Have a question that's not answered here? Get in touch with our support team.</p>
                    <button class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Send Email
                    </button>
                </div>
                
                <div class="help-card rounded-xl p-6 text-center">
                    <div class="text-4xl mb-4">💬</div>
                    <h4 class="font-semibold text-gray-800 mb-3">Community Forum</h4>
                    <p class="text-gray-600 text-sm mb-4">Join the conversation with other Focus users and share tips and tricks.</p>
                    <button class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                        Join Forum
                    </button>
                </div>
            </div>
        </section>
    </main>
    
    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 py-8">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="text-gray-600 text-sm">© 2025 Focus Todo App. Designed for productivity and peace of mind.</p>
        </div>
    </footer>
    
    <!-- Load main JavaScript -->
    <!-- Removing main.js reference as requested -->
    
    <!-- Help page specific JavaScript -->
    <script>
        // Help page functions
        function setupCarousel() {
            if (typeof Splide !== 'undefined') {
                new Splide('#featuresCarousel', {
                    type: 'loop', perPage: 1, perMove: 1, gap: '2rem',
                    autoplay: true, interval: 5000, pauseOnHover: true,
                    breakpoints: { 768: { perPage: 1 } }
                }).mount();
            }
        }

        function setupSearch() {
            const searchInput = document.getElementById('helpSearch');
            const faqItems = document.querySelectorAll('.faq-item');
            searchInput.addEventListener('input', (e) => {
                const query = e.target.value.toLowerCase();
                faqItems.forEach(item => {
                    const question = item.querySelector('.faq-question h4').textContent.toLowerCase();
                    const answer = item.querySelector('.faq-answer p').textContent.toLowerCase();
                    if (question.includes(query) || answer.includes(query)) {
                        item.style.display = 'block';
                        if (query) highlightText(item, query); else removeHighlight(item);
                    } else item.style.display = 'none';
                });
            });
        }

        function highlightText(element, query) {
            const walker = document.createTreeWalker(element, NodeFilter.SHOW_TEXT, null, false);
            const textNodes = [];
            let node;
            while (node = walker.nextNode()) textNodes.push(node);
            textNodes.forEach(tn => {
                const text = tn.textContent;
                const regex = new RegExp(`(${query})`, 'gi');
                if (regex.test(text)) {
                    const wrapper = document.createElement('span');
                    wrapper.innerHTML = text.replace(regex, '<span class="search-highlight">$1</span>');
                    tn.parentNode.replaceChild(wrapper, tn);
                }
            });
        }

        function removeHighlight(element) {
            element.querySelectorAll('.search-highlight').forEach(h => { h.outerHTML = h.innerHTML; });
        }

        function setupParticleBackground() {
            if (typeof p5 !== 'undefined') {
                new p5((p) => {
                    let particles = [];
                    p.setup = () => {
                        const canvas = p.createCanvas(p.windowWidth, p.windowHeight);
                        canvas.parent('particle-bg');
                        canvas.style('position', 'fixed'); canvas.style('top', '0');
                        canvas.style('z-index', '-1'); canvas.style('pointer-events', 'none');
                        for (let i = 0; i < 45; i++) {
                            particles.push({
                                x: p.random(p.width), y: p.random(p.height),
                                vx: p.random(-0.3, 0.3), vy: p.random(-0.3, 0.3),
                                size: p.random(2, 6), alpha: p.random(0.1, 0.2)
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

        function toggleFAQ(index) {
            const faqItems = document.querySelectorAll('.faq-item');
            faqItems.forEach((item, i) => {
                const answer = item.querySelector('.faq-answer');
                const icon = item.querySelector('.faq-icon');
                if (i === parseInt(index)) {
                    const isOpen = answer.classList.contains('open');
                    answer.classList.toggle('open', !isOpen);
                    icon.textContent = isOpen ? '+' : '−';
                } else {
                    answer.classList.remove('open');
                    icon.textContent = '+';
                }
            });
        }

        // Initialize & Observers
        document.addEventListener('DOMContentLoaded', () => {
            setupCarousel();
            setupSearch();
            setupParticleBackground();

            // Animate cards
            if (typeof anime !== 'undefined') {
                anime({
                    targets: '.help-card', opacity: [0, 1], translateY: [30, 0],
                    delay: anime.stagger(100), duration: 800, easing: 'easeOutQuart'
                });
            }

            // Global Click Observer
            document.addEventListener('click', (e) => {
                const target = e.target.closest('[data-action]');
                if (!target) {
                   // Handle contact buttons (no data-action yet)
                   if (e.target.textContent === 'Send Email') {
                       alert('Contact feature coming soon! Reach us at support@focus-app.com');
                   } else if (e.target.textContent === 'Join Forum') {
                       alert('Community forum coming soon!');
                   }
                   return;
                }
                
                const action = target.dataset.action;
                if (action === 'toggle-faq') {
                    toggleFAQ(target.dataset.index);
                }
            });
        });
    </script>
</body>
</html>