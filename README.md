# Employee Attendance Recording System

This project is an Employee Attendance Recording System built in PHP with MySQL. It allows users to manage departments, employees, and attendance records efficiently. The project consists of six main pages with functionality for adding, editing, and deleting records, as well as tracking attendance by employee or date range.

## Table of Contents
* Features
* Project Structure
* Setup
* Usage
* Database Structure
* Pages Overview
  
## **Features**
* **Department Management**: Add, edit, delete, and view departments.
* **Employee Management**: Add, edit, delete, and view employees.
* **Attendance Recording**: Record attendance and view attendance logs.
* **Attendance Monitoring by Employee**: Track attendance for individual employees with total hours and salary.
* **Attendance Monitoring by Date Range**: Filter attendance records by date range.

## Project Structure
The project is organized as follows:
```
.
├── index.php                   # Main menu page
├── departments.php             # Department Management page
├── employees.php               # Employee Management page
├── attendance_recording.php    # Attendance Recording page
├── attendance_monitoring_employee.php  # Attendance Monitoring by Employee
├── attendance_monitoring_date.php      # Attendance Monitoring by Date Range
├── database.php                # Contains reusable database functions
└── actions.php                 # Handles form submissions for CRUD actions
```

## Setup
1. **Clone the Repository**
```
git clone https://github.com/yourusername/employee-attendance-system.git
cd employee-attendance-system
```
2. **Database Setup**
* Create a MySQL database named `employee_attendance`.
* Import the SQL file provided in the repo (e.g., `database.sql`) to set up the necessary tables.
* Update the database connection details in `db.php` if needed.

3. **Run the Application**
* Start your local server (e.g., XAMPP or WAMP).
* Place the project folder in the server's `htdocs` directory.
* Access the application in your browser at `http://localhost/employee-attendance-system`.

## Usage
1. Access the Main Menu: Open index.php to access the options for Department Management, Employee Management, Attendance Recording, and Attendance Monitoring.
2. Perform CRUD Operations:
* Each page includes buttons to add, edit, or delete records.
* Use the modals on each page to perform these actions.
3. Monitor Attendance:
* Track employee attendance by ID or by date range in the respective monitoring pages.
* View total hours worked and calculate salary based on hourly rate.

## Database Structure
Here are the key tables used in this project:
### Departments Table
| **Column**   | **Type**         | **Description**              |
|--------------|------------------|------------------------------|
| **depCode**  | INT              | **Department Code (Primary Key)** |
| **depFName** | VARCHAR(50)      | **Department Name**          |
| **depHead**  | VARCHAR(50)      | **Department Head**          |
| **depTelNo** | VARCHAR(20)      | **Department Telephone No.** |

### Employees Table
| **Column**   | **Type**         | **Description**              |
|--------------|------------------|------------------------------|
| **empID**    | INT              | **Employee ID (Primary Key)**|
| **depCode**  | INT              | **Foreign Key to Departments** |
| **empLName** | VARCHAR(50)      | **Employee Last Name**       |
| **empFName** | VARCHAR(50)      | **Employee First Name**      |
| **empRPH**   | DECIMAL(10,2)    | **Employee Rate Per Hour**   |

### Attendance Table
| **Column**       | **Type**         | **Description**              |
|------------------|------------------|------------------------------|
| **attPIN**       | INT              | **Attendance Record Number** |
| **empID**        | INT              | **Employee ID (Foreign Key)**|
| **attDate**      | DATE             | **Date of Attendance**       |
| **attTimeIn**    | TIME             | **Time In**                  |
| **attTimeOut**   | TIME             | **Time Out**                 |


## Pages Overview
1. Menu (`index.php`)
* The main menu page with links to all sections of the application.

2. Department Management (`departments.php`)
* View, add, edit, and delete departments.
* Table columns: Code, Name, Head, Tel. No., Actions (Edit, Delete).
* Modal forms are used for adding, editing, and deleting departments.

3. Employee Management (`employees.php`)
* View, add, edit, and delete employees.
* Table columns: ID, Dept, Last Name, First Name, Rate/Hour, Actions (Edit, Delete).
* Modal forms are used for adding, editing, and deleting employees.

4. Attendance Recording (`attendance_recording.php`)
* Record attendance with options to add or cancel attendance entries.
* Table columns: Record #, Emp. ID, Date Time In, Date Time Out, Actions (Cancel).

5. Attendance Monitoring by Employee (`attendance_monitoring_employee.php`)
* Filter and view attendance records for an individual employee.
* Table columns: Record #, Emp ID, DateTime In, DateTime Out, Total.
* Displays total hours worked and calculates salary based on hourly rate.

6. Attendance Monitoring by Date Range (`attendance_monitoring_date.php`)
* Filter attendance records by date range.
* Table columns: Record #, Emp ID, DateTime In, DateTime Out, Total (hours).
* Displays total hours worked in the selected date range.


