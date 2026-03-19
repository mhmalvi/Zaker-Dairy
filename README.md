# Zaker Dairy

An e-commerce platform for dairy products built with Laravel 8. The application features a full shopping experience with product catalog, shopping cart, checkout, customer accounts, and social login integration, all containerized with Docker for easy deployment.

## Features

- **Product Catalog** -- Browse dairy products with categories, images, slugs, and detailed descriptions
- **Shopping Cart** -- Add, update, and remove items with real-time cart management
- **Checkout System** -- Streamlined checkout flow with order processing
- **Customer Accounts** -- User registration, login, profile management, and order history
- **Social Login** -- Sign in with Google and Facebook via Laravel Socialite
- **Admin Dashboard** -- Manage products, categories, orders, and customers from a centralized panel
- **Contact Form** -- Customer inquiry form with email notifications via Mailables
- **SEO-Friendly URLs** -- Automatic slug generation with Eloquent Sluggable
- **Image Management** -- Product image upload and processing with Intervention Image
- **Docker Support** -- Full Docker Compose setup with MySQL for local development and deployment

## Tech Stack

- **Backend:** PHP 7.3+ / 8.0, Laravel 8
- **Frontend:** Blade templates, Tailwind CSS, Laravel Mix
- **Database:** MySQL
- **Authentication:** Laravel Breeze, Laravel Socialite (Google, Facebook)
- **Image Processing:** Intervention Image
- **SEO:** Eloquent Sluggable
- **Containerization:** Docker, Docker Compose

## Prerequisites

- PHP >= 7.3
- Composer
- MySQL 5.7+
- Node.js & npm
- Docker & Docker Compose (optional)

## Setup

### Standard Setup

1. **Clone the repository**
   ```bash
   git clone https://github.com/mhmalvi/Zaker-Dairy.git
   cd Zaker-Dairy
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Configure environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Update `.env`** with your database credentials and social login API keys (Google, Facebook).

5. **Run migrations and seeders**
   ```bash
   php artisan migrate --seed
   ```

6. **Build frontend assets**
   ```bash
   npm run dev
   ```

7. **Start the development server**
   ```bash
   php artisan serve
   ```

### Docker Setup

```bash
docker-compose up -d
```

This starts the application on port `9000` and MySQL on port `7930`.

| Service | Port |
|---------|------|
| Web App | 9000 |
| MySQL   | 7930 |

## Project Structure

```
app/
  Http/Controllers/
    Admin/              # Admin panel controllers
    Auth/               # Authentication controllers
    CartController.php  # Shopping cart logic
    CheckOutController.php
    ProductsController.php
    ShopController.php
  Models/               # Eloquent models
routes/
  web.php               # Web routes
resources/              # Blade views and frontend assets
Dockerfile              # Docker image definition
docker-compose.yml      # Multi-container setup
```

## License

MIT
