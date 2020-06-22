This document will outline the project and its requirements.
The project started on May 6th 2020.

1. This project is for a job portal.

Users:
1. There will be two types of users, normal users and admin users.

Users can do the following things:
1. User can register an account
2. A user can login
3. User can update profile
4. A user can change the password
5. A user can apply for a job
6. A user can edit and delete the job application
7. A user can create a job post
8. A user can edit and delete a job post.

Admin users can do the following things:
1. Admin users can control data from the admin panel
2. Admin users can manage users

Databases
1. The application will have the following databases: 
- users table
- jobs table
- application table
- category table
- jobs category table

Users table
- id int(11)
- username varchar(256)
- email varchar(256)
- role enum('Admin', 'user')
- password varchar(255)
- profile_pic varchar(255)
- created_at timestamp
- updated_at timestamp

Jobs table
- id int(11)
- user_id int(11) foreign key: users table -> id
- title varchar(255)
- body text
- location varchar(255) (external table)?
- pay (external database)?
- currency (external database)>
- published tinyint(1)
- created_at timestamp
- updated_at timestamp

Application table
- id int(11)
- user_id int(11) foreign key: users table -> id
- jobs_id int(11) foreign key: jobs table -> id
- body text
- created_at timestamp
- updated_at timestamp

Categories table
- id int(11)
- name varchar(255)
- slug varchar(255)

Jobs category table
- id int(11)
- jobs_id int(11) foreing key: jobs table -> id
- category_id int(11) foreign key: categories table -> id

Pages 
- index.php
- login.php
- register.php
- user_dashboard.php
- users.php
- admin_dashboard.php
- jobsposts.php
- jobs.php
- category_list.php
- category.php
- FAQ.php
- Termsandconditions.php

Index.php
- Welcome message - showcase section
- Why us section
- User stories
- Latest jobs

login.php
- Login form

register.php
- Register form

user_dashboard.php
- User information with a form to update the user information
- Latest jobs posts
- Users latest applications
- Users latest jobs posts
- Button to create a jobs post

admin_dashboard.php
- User information with a form to update the admin user information
- Button to create a new/edit/delete users
- Button to create a new admin user
- Button to edit/delete a job post
- Button to edit/delete an application
- Pull a list of users
- Create a new category

jobsposts.php
- List of jobs (clickable)

jobs.php
- List all information about the post
- if creator, be able to edit or delete and see applications
- if user, read and apply
- if admin, be able to edit or delete

category_list.php
- List of categories (clickable)

category.php
- List all jobs within that category
- If admin edit/delete category

users.php
- A list of all users
- if normal user, see basic information about user
- if Admin user, edit/delete user
