# Simple Laravel Shop

## Project Description

This web application, implemented using Laravel 9, is designed to manage products and orders. The project encompasses:

- **Product Management:** Features include creating, editing, deleting, viewing lists, and detailed information of products.
- **Order Management:** Allows for the creation of orders (selecting products and specifying quantities), viewing order lists, detailed order information with status update capabilities.
- **Category Management:** Enables the creation and initial population of categories (e.g., light, fragile, heavy) for product association.
- **REST API:** Provides endpoints for interacting with products and orders, including filtering, pagination, and error handling.
- **Authentication:** Implemented via Laravel Sanctum to secure the API.
- **Logging:** Records operations such as creation, updates, and deletions.
- **Testing:** Incorporates functional and unit tests to ensure application reliability.

## Technologies

- **PHP 8+**
- **Laravel 9**
- **MySQL** (for the database)
- **Laravel Sanctum** (for API authentication)
- **Monolog** (for logging)
- **PHPUnit** (for testing)

## Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/Dimiqhz/Simple-Laravel-Shop.git
   cd Simple-Laravel-Shop
   ```

2. **Install dependencies:**

   ```bash
   composer install
   ```

3. **Copy the example environment file and modify it as needed:**

   ```bash
   cp .env.example .env
   ```

4. **Generate an application key:**

   ```bash
   php artisan key:generate
   ```

5. **Set up the database:**

   - Ensure your MySQL server is running.
   - Create a new database.
   - Update the `.env` file with your database credentials.

6. **Run migrations to set up database tables:**

   ```bash
   php artisan migrate
   ```

7. **Seed the database with initial data (optional):**

   ```bash
   php artisan db:seed
   ```

8. **Serve the application:**

   ```bash
   php artisan serve
   ```

   The application will be accessible at `http://localhost:8000`.

## Usage

- **Accessing the Application:**

  Navigate to `http://localhost:8000` to access the application.

- **API Endpoints:**

  - **Products:**
    - `GET /api/products` - Retrieve a list of products.
    - `POST /api/products` - Create a new product.
    - `GET /api/products/{id}` - Retrieve a specific product.
    - `PUT /api/products/{id}` - Update a specific product.
    - `DELETE /api/products/{id}` - Delete a specific product.

  - **Orders:**
    - `GET /api/orders` - Retrieve a list of orders.
    - `POST /api/orders` - Create a new order.
    - `GET /api/orders/{id}` - Retrieve a specific order.
    - `PUT /api/orders/{id}` - Update a specific order.
    - `DELETE /api/orders/{id}` - Delete a specific order.

- **Authentication:**

  Use Laravel Sanctum to authenticate API requests. Ensure you include the authentication token in your API requests.

## Testing

To run tests, execute:

```bash
php artisan test
```

This command will run both unit and feature tests to ensure the application functions correctly.

## Contributing

Contributions are welcome! Please fork the repository and create a pull request with your changes.

## License

This project is open-source and available under the [GNU License](LICENSE).
