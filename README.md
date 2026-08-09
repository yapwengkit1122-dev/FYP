# Student Attendance Management System

A web-based student attendance management system developed as my Final Year Project (FYP).

The system provides separate access for teachers and students. Teachers can manage student and attendance records, while students can access their own information.

## Technologies

* HTML5
* CSS3
* JavaScript
* PHP
* MySQL
* Bootstrap

## Features

### Authentication
* Username and password login
* Session-based authentication
* Login protection for restricted pages
* Logout functionality

### Role-Based Access Control
* Separate dashboards based on user roles
* Admin-only page protection
* Restricted access for unauthorized users

### Student Management
* Add student records
* Edit student records
* Delete student records
* Search student records

### Attendance Management
* Add attendance records
* Edit attendance records
* Delete attendance records
* Search attendance records

### Attendance Prediction
* Attendance rate calculation
* Attendance prediction feature

### API
* Student data API
* Attendance data API
* JSON-formatted responses

### User Interface
* Responsive web interface
* Bootstrap-based design

## System Workflow

1. User logs in with their username and password.
2. The system verifies the login information.
3. The user's role is checked.A
4. Teachers are redirected to the teacher dashboard.
5. Students are redirected to the student dashboard.
6. Teacher-only functions are restricted from student accounts.

## Database

The system uses MySQL to store student, attendance, and user information.

### Student API
Retrieves student information and returns the data in JSON format.

### Attendance API
Retrieves attendance records and returns the data in JSON format.

## Future Improvements

* Improve the attendance prediction feature
* Add more attendance analytics
* Improve system security and validation
* Add attendance report export functionality
* Improve the user interface
