---
description: How to run the Job Portal System
---

To get the application up and running on your local machine, follow these steps:

1. **Install Dependencies** (if not already done):
   ```powershell
   composer install
   npm install
   ```

2. **Environment Setup**:
   Ensure your `.env` file is configured. The project is currently set up to use **SQLite**.
   ```powershell
   cp .env.example .env
   php artisan key:generate
   ```

3. **Database Migration & Seeding**:
   Run the migrations to create tables and seed them with initial categories.
   ```powershell
   php artisan migrate:fresh --seed
   ```

4. **Link Storage**:
   Enable file uploads (resumes/avatars) by linking the storage folder.
   // turbo
   ```powershell
   php artisan storage:link
   ```

5. **Start the Development Servers**:
   You need two terminals running:
   
   **Terminal 1: Laravel Server**
   // turbo
   ```powershell
   php artisan serve
   ```
   
   **Terminal 2: Vite (Asset Bundling)**
   // turbo
   ```powershell
   npm run dev
   ```

6. **Access the App**:
   Open your browser and navigate to `http://127.0.0.1:8000`.
