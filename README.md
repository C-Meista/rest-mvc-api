**README Plan**

1. Project Title + One-Sentence Purpose  
- Name: REST MVC API  
- One sentence: what it does (users/products CRUD with MVC + REST)

2. Why This Project Exists  
- 2-4 bullets with learning goals:
- MVC separation
- Generic vs specific methods
- REST endpoint design
- PDO + SQL basics

3. Tech Stack  
- PHP
- MySQL
- Apache/XAMPP (or your runtime)
- URL rewriting via .htaccess

4. Folder Structure  
- Show the current tree and short explanations for:
- index.php
- DB.php
- Controllers/Controller.php
- Controllers/UserController.php
- Controllers/ProductController.php
- Models/Model.php
- Models/UserModel.php
- Models/ProductModel.php
- Models/sqlMVC.sql

5. Architecture Rules (Most Important Section)  
- Base Controller: only generalized methods
- Base Model: only generalized methods
- User/Product controller: specific create/modify logic
- User/Product model: specific DB field handling
- Router in index.php decides controller by resource

6. Method Contract Table  
- One table with:
- Class
- Method
- Purpose
- Input
- Output / Status code
- Include generalized methods and specific methods clearly separated

7. Setup Instructions  
- Clone/open project
- Create DB with Models/sqlMVC.sql
- Configure connection in DB.php
- Start Apache + MySQL
- Ensure rewrite rules are active

8. API Endpoints  
- List all routes for users/products:
- GET list
- GET by id
- POST create
- PUT modify
- DELETE remove
- Add expected JSON body examples for POST/PUT

9. Validation and Error Handling  
- Required fields per resource
- Invalid id behavior
- Status code policy (200/201/400/404/405)

10. Current Status + Next Refactor Steps  
- Short “Current state” bullets
- Short “Next steps” bullets aligned with your architecture goal

11. Testing Guide  
- How to test quickly with Postman/curl
- Minimal happy-path + error-path checklist

12. Contribution Notes (Optional but clean)  
- Naming conventions
- Where to add new resources
- Keep generic logic in base classes, entity logic in entity classes

---