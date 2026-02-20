# Focus Todo App

Focus is a modern, feature-rich to-do list application built with Laravel and vanilla JavaScript. It is designed for visual clarity, productivity, and ease of use, featuring a premium design with smooth animations and productivity tracking.

## 🚀 Key Features

- **Smart Task Management**: Add, edit, and organize tasks with priority levels (High, Medium, Low), categories, and due dates.
- **Dynamic Categorization**: Create and manage custom categories with unique colors to organize your workflow.
- **Productivity Analytics**: Visualize your progress with detailed charts, completion rates, and daily productivity trends powered by ECharts.
- **Immersive User Experience**: 
  - **Dynamic Backgrounds**: Procedural particle systems using p5.js.
  - **Micro-animations**: Smooth transitions and effects powered by Anime.js.
  - **Dark Mode**: Seamless toggle between light and dark themes.
- **Advanced Controls**:
  - **Event Delegation**: Centralized event handling for high performance.
  - **Keyboard Shortcuts**: Speed up your workflow with power-user shortcuts.
  - **Data Management**: Export and import your data as JSON for backup and portability.
- **Help & Documentation**: Built-in comprehensive guide and FAQ system.

## 🛠️ Tech Stack

- **Backend**: Laravel 8 (PHP)
- **Frontend**: 
  - Blade Templating Engine
  - Vanilla JavaScript (Procedural & Event-Driven)
  - Tailwind CSS (Styling)
  - Anime.js (Animations)
  - p5.js (Particle Backgrounds)
  - ECharts (Data Visualization)
  - Splide.js (Carousels)

## 📦 Installation

1. **Clone the repository**:
   ```bash
   git clone <repository-url>
   cd todo-laravel
   ```

2. **Install dependencies**:
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Configuration**:
   Update your `.env` file with your database credentials, then run:
   ```bash
   php artisan migrate
   ```

5. **Run the application**:
   ```bash
   php artisan serve
   ```

## 🏗️ Project Structure

- `resources/views/`: Contains the main application views (`index`, `analytics`, `settings`, `help`).
- `app/Http/Controllers/`: Backend logic for tasks and categories.
- `app/Models/`: Eloquent models for data persistence.
- `routes/api.php`: API endpoints for AJAX interactions.
- `public/`: Assets and the main entry point.

## 📄 License

The Focus Todo App is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
