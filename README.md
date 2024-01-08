# Web Shop

## Project Overview:

Enhance user experience and functionality:

1. Authentication View Pages:
	- Implement user authentication and create view pages for login, registration, password reset, etc.

2. Shopping Cart View Pages:
	- Create pages to manage a user's shopping cart, allowing them to add, remove, and view items in the cart.
	- Implement the logic for handling cart items and interactions.

3. Display Products View Page:
	- Enhance the products page to display a list of available products.
	- Include features such as sorting, pagination, and filtering to make it easy for users to navigate through products.

4. Display Single Product View Page:
	- Create a detailed view page for individual products.
	- Include product details, images, and any relevant information.

5. Filter Products by Criteria:
	- Implement functionality to filter products based on criteria such as category, price range, or any other relevant attributes.
	- Allow users to customize their product search experience.

Additional features:

1. User Profiles:
	- Allow users to have profiles where they can view and manage their account details.

2. Order History:
	- Implement a feature that allows users to view their order history.

3. Checkout Process:
	- Create a smooth checkout process with multiple steps (address, payment, confirmation).

4. Admin Panel:
	- If applicable, consider creating an admin panel to manage products, orders, and user accounts.

5. Responsive Design:
	- Ensure your website is responsive and works well on various devices.

## Technologies:

This application uses the following technologies:

	- PHP
	- Node
	- Laravel framework

## Prerequisites:

These are prerequisites in order to run the project locally on your machine:

	- Code editor (VS Code, Sublime Text)
	- Git
	- PHP
	- Composer
	- Docker or XAMPP

## Installation:

Clone the repository and change the directory to the project folder.

```sh
	# Clone the repository
	git clone https://www.github.com/tricko93/webshop

	# Change directory
	cd webshop
```

Install the dependencies using Composer.

```sh
	# Install dependencies
	composer install --prefer-dist
```

Copy the config file and edit the database name and password.

```sh
	# Copy config file
	copy .env.example .env

	# Edit database name and password 
	# For Visual Studio Code (VS Code) users
	code .env

	# For Sublime Text users
	subl .env
```

Start the database container using Docker Compose.

```sh
	# Start the database container
	docker compose up
```

## Tailwind CSS Installation:

Install Tailwind CSS.

```sh
	npm install -D tailwindcss postcss autoprefixer
```

Install Tailwind form plugin.

```sh
	npm install -D @tailwindcss/forms
```

## Run the project:

Start your build process.

```sh
	# Start the build process (in a separate terminal tab)
	npm run dev

	# Alternatively, you can run this command in the main terminal tab
	npm run build
```

Run the application using PHP Artisan.

```sh
	# Generate the unique application key
	php artisan key:generate

	# Run the database migrations
	php artisan migrate --seed

	# Run the application
	php artisan serve
```

Open http://localhost:8000 in a Web browser.

## Adminer Login Credentials:

Open database in adminer (web interface).

	1. Open http://localhost:8080 in a Web browser.

	2. Enter your login credentials in the fields provided. The default values are:
		- Server: mysql
		- User:	root
		- Password:	root

	3. Click on the "Login" button to access the adminer interface.