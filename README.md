API Documentation: Roles & Capabilities

This document outlines the different user roles in this API, what each role can do, and the endpoints they have access to.

The application is built around three main user roles:

#Admin: The super-user with full system-wide control.

#Manager: A school-specific administrator who manages their assigned school's data.

#User: The general public user (e.g., student, parent) who can rate and comment on schools.

1. Admin

The Admin is the highest-level entity, responsible for setting up the core data of the application.

Authentication

#Login: POST /api/admin/login

Uses phone_number and password for credentials.

Key Responsibilities & Endpoints

Admins have system-wide Create, Read, Update, and Delete (CRUD) privileges on the foundational models:

#Manage Schools:

#POST /api/admin/schools (Create a new school)

#GET /api/admin/schools (View all schools)

#GET /api/admin/schools/{school} (View a specific school)

#PUT /api/admin/schools/{school} (Update a school)

#DELETE /api/admin/schools/{school} (Delete a school)

#Manage Managers:

#POST /api/admin/managers (Create a new manager and assign them to a school)

#GET /api/admin/managers (View all managers)

#GET /api/admin/managers/{manager} (View a specific manager)

#PUT /api/admin/managers/{manager} (Update a manager)

#DELETE /api/admin/managers/{manager} (Delete a manager)

#Manage Teachers:

#POST /api/admin/teachers (Create a new teacher in the system)

#GET /api/admin/teachers (View all teachers)

#GET /api/admin/teachers/{teacher} (View a specific teacher)

#PUT /api/admin/teachers/{teacher} (Update a teacher)

#DELETE /api/admin/teachers/{teacher} (Delete a teacher)

#View School Success:

#GET /api/admin/school-success-rate (Read-only access to see all success ratings)

#2. Manager

The Manager is a mid-level entity responsible for managing the day-to-day data of a single, specific school they are assigned to.

Authentication

#Login: POST /api/manager/login

Uses phone_number and password for credentials.

Key Responsibilities & Endpoints

Managers manage the entities related to their assigned school:

Manage Grades:

#POST /api/manager/grades (Create a new grade level, e.g., "Grade 10")

#GET /api/manager/grades (View all grades)

#GET /api/manager/grades/{grade} (View a specific grade)

#PUT /api/manager/grades/{grade} (Update a grade)

#DELETE /api/manager/grades/{grade} (Delete a grade)

#Manage School Fees:

#POST /api/manager/fees (Set a fee for a specific grade at their school)

#GET /api/manager/fees (View all fees for their school)

#GET /api/manager/fees/{fee} (View a specific fee)

#PUT /api/manager/fees/{fee} (Update a fee)

#DELETE /api/manager/fees/{fee} (Delete a fee)

#Manage Teacher Assignments:

#POST /api/manager/schools/{school}/teachers (Assign an existing teacher to their school and a specific grade)

#GET /api/manager/schools/{school}/teachers (View all teachers assigned to their school)

#PUT /api/manager/schools/{school}/teachers/{teacher} (Update a teacher's assignment, e.g., change their grade)

#DELETE /api/manager/schools/{school}/teachers/{teacher} (Remove a teacher from their school)

#Manage School Success Ratings:

#POST /api/manager/success-ratings (Create/Report a new success rating for their school for a given year)

#GET /api/manager/success-ratings (View all success ratings for their school)

#GET /api/manager/success-ratings/{rating} (View a specific rating)

#PUT /api/manager/success-ratings/{rating} (Update a rating)

#DELETE /api/manager/success-ratings/{rating} (Delete a rating)

#3. User (Public)

The User is the public-facing entity (e.g., parent, student) who can register, login, and provide feedback on schools.

Authentication

R#egister: POST /api/user/register

Uses name, email, and password.

#Login: POST /api/user/login

Uses email and password.

Key Responsibilities & Endpoints

Users can view school data and contribute their own opinions via ratings and comments:

#Manage Ratings:

#POST /api/user/ratings (Create a new rating for a school)

#GET /api/user/ratings (View all ratings)

#GET /api/user/ratings/{rating} (View a specific rating)

#PUT /api/user/ratings/{rating} (Update their own rating)

#DELETE /api/user/ratings/{rating} (Delete their own rating)

#Manage Comments:

#POST /api/user/comments (Create a new comment for a school)

#GET /api/user/comments (View all comments)

#GET /api/user/comments/{comment} (View a specific comment)

#PUT /api/user/comments/{comment} (Update their own comment)

#DELETE /api/user/comments/{comment} (Delete their own comment)
