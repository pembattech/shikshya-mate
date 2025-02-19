# Shikshya Mate

Shikshya Mate is a **school management system** built using **Laravel** as the backend API and **Blade** for the frontend. It helps manage various aspects of a school, including student management, attendance tracking, exam scheduling, and more. The system integrates real-time notifications for updates on assignments, attendance, and grades.

---

## Features

- **Student Management**: Add, update, and manage student records through the API.
- **Teacher Management**: Manage teacher profiles, schedules, and assignments.
- **Attendance Tracking**: Real-time attendance tracking via API endpoints.
- **Exam Scheduling**: Schedule exams, manage question papers, and monitor results.
- **Notifications**: Receive real-time updates for attendance, grades, assignments, and other important announcements via API.
- **Authentication**: Secure login and registration using **Laravel Sanctum** with API authentication.
- **Real-Time Features**: Use **Laravel Echo** for broadcasting real-time events (optional, can be added based on requirements).

---

## Installation

### Steps

1. **Clone the repository**:
   ```bash
   git clone https://github.com/your-username/shikshya-mate.git
   ```

2. **Navigate to the project directory**:
   ```bash
   cd shikshya-mate
   ```

3. **Install PHP dependencies**:
   ```bash
   composer install
   ```

4. **Set up the environment**:
   Copy `.env.example` to `.env`:
   ```bash
   cp .env.example .env
   ```

5. **Generate the application key**:
   ```bash
   php artisan key:generate
   ```

6. **Set up the database**:
   - Update your `.env` file with your database credentials.
   - Run the migrations to create the necessary tables:
     ```bash
     php artisan migrate
     ```

7. **Install frontend dependencies**:
   If you're using **TailwindCSS** or other frontend tools:
   ```bash
   npm install
   npm run dev
   ```

8. **Run the application**:
   You can now run the Laravel development server:
   ```bash
   php artisan serve
   ```

   The application API will be accessible at `http://127.0.0.1:8000/api`.

---

## Usage

### Authentication

Use **Laravel Sanctum** to authenticate users (students, teachers, admin) via API. You can log in and manage user records using API endpoints. To authenticate, send a **POST request** to `/api/login` with the required credentials and receive a token for further requests.

### API Endpoints

- **Students**:
   - `GET /api/students`: List all students.
   - `POST /api/students`: Add a new student.
   - `PUT /api/students/{id}`: Update student information.
   - `DELETE /api/students/{id}`: Remove a student.

- **Teachers**:
   - `GET /api/teachers`: List all teachers.
   - `POST /api/teachers`: Add a new teacher.
   - `PUT /api/teachers/{id}`: Update teacher information.
   - `DELETE /api/teachers/{id}`: Remove a teacher.

- **Attendance**:
   - `GET /api/attendance`: List all attendance records.
   - `POST /api/attendance`: Mark attendance for students.
   - `PUT /api/attendance/{id}`: Update attendance record.

- **Exams**:
   - `GET /api/exams`: List all exams.
   - `POST /api/exams`: Schedule a new exam.
   - `PUT /api/exams/{id}`: Update exam details.
   - `DELETE /api/exams/{id}`: Remove an exam.

### Real-Time Notifications

If real-time updates are required, you can use **Laravel Echo** with **Pusher** or **WebSockets**. This allows you to send notifications about important events like attendance updates, exam results, or assignments, directly to the frontend.

### Admin Panel

The **Admin** has full access to manage the school records. The admin can manage student profiles, teacher schedules, attendance, and exam data through the **API**.
