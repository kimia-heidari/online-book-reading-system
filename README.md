# Online Book Reading System

A REST API for managing a personal digital library and reading books online. Built with [Apiato](https://apiato.io) (Laravel + Porto SAP), it supports user authentication, adding books to a library, opening a book for reading, and turning pages while tracking progress.

---

## Overview

Users can register, authenticate via OAuth2, add books to their library, open a book to start or resume reading, and turn pages. The system tracks each user's reading position (`last_page`), which book is currently active, and when they last read.

Book metadata and page content are cached for performance. Cache entries are invalidated automatically when books or pages are updated.

---

## Tech Stack

| Layer | Technology |
|-------|------------|
| Framework | [Apiato](https://apiato.io) 8.x on [Laravel](https://laravel.com) 10 |
| Language | PHP 8.1+ |
| Database | MySQL |
| Authentication | Laravel Passport (OAuth2) |
| Architecture | [Porto SAP](https://mahmoudz.github.io/Porto/) (container-based) |

---

## Features

- **User authentication** — Register, login, logout, password reset (Apiato Authentication container)
- **Personal library** — Add books to a user's library
- **Reading session** — Open a book and resume from the last saved page
- **Page turning** — Advance through pages; returns the next page number or `null` at the end
- **Reading progress** — Tracks `last_page`, active book, font size, and `last_read_at`
- **Book caching** — Books and pages are cached with automatic invalidation via observers
- **Sample data** — Seeder creates books with paginated content for development and testing

---

## Project Structure

Custom containers for the reading system live under `app/Containers/AppSection/`:

| Container | Purpose |
|-----------|---------|
| **Book** | Book and page models, migrations, caching, seeders |
| **Library** | Add books to a user's library (`user_book_libraries`) |
| **UserBook** | Open books and turn pages; tracks reading state (`user_books`) |
| **Category** | Admin web UI for book categories |
| **Authentication** | OAuth2 login, registration, password management |
| **Authorization** | Roles and permissions |
| **User** | User profile and account management |

---

## Database Schema

| Table | Description |
|-------|-------------|
| `books` | Title, author, slug, description, `total_pages`, `is_active` |
| `book_pages` | Page content per book (`book_id`, `page_number`, `content`) |
| `user_book_libraries` | Books saved in a user's library |
| `user_books` | Reading progress per user/book (`last_page`, `is_active`, `font_size`, `last_read_at`) |

---

## Getting Started

### Prerequisites

- PHP 8.1+ with extensions: `curl`, `mbstring`, `openssl`, `pdo`, `tokenizer`
- Composer
- MySQL
- [XAMPP](https://www.apachefriends.org/) (or any PHP/MySQL environment)

### Installation

1. **Clone the repository** and install dependencies:

```bash
composer install
```

2. **Configure the environment:**

```bash
cp .env.example .env
php artisan key:generate
```

Update `.env` with your database credentials and URLs:

```env
APP_URL=http://localhost/online%20book%20reading%20system/public
API_URL=http://localhost/online%20book%20reading%20system/public

DB_DATABASE=online_book_reading
DB_USERNAME=root
DB_PASSWORD=
```

3. **Run migrations and seed data:**

```bash
php artisan migrate
php artisan db:seed
php artisan passport:install
```

Copy the generated **Personal access client** ID and secret into `.env`:

```env
CLIENT_WEB_ID=your-client-id
CLIENT_WEB_SECRET=your-client-secret
```

4. **Seed sample books** (optional, for development):

```bash
php artisan apiato:seed-test
```

This creates 10 books, each with pages and sample content.

5. **Serve the application** (if not using XAMPP's Apache):

```bash
php artisan serve
```

---

## API Reference

All endpoints are versioned under `/v1`. Send requests with:

```
Accept: application/json
Content-Type: application/json
```

Protected endpoints require:

```
Authorization: Bearer {access_token}
```

Base URL: `{API_URL}/v1`

---

### Authentication

#### Register

```http
POST /v1/register
```

**Body:**

```json
{
  "email": "reader@example.com",
  "password": "Password1!",
  "name": "Jane Reader"
}
```

#### Login (Web Client Proxy)

```http
POST /v1/clients/web/login
```

**Body:**

```json
{
  "email": "reader@example.com",
  "password": "Password1!"
}
```

**Response:**

```json
{
  "token_type": "Bearer",
  "expires_in": 86400,
  "access_token": "eyJ0eXAiOiJKV1QiLCJhbG...",
  "refresh_token": "def50200..."
}
```

#### Logout

```http
POST /v1/logout
Authorization: Bearer {access_token}
```

#### Refresh Token

```http
POST /v1/clients/web/refresh
```

**Body:**

```json
{
  "refresh_token": "def50200..."
}
```

---

### Library

#### Add Book to Library

Adds a book to the authenticated user's library.

```http
POST /v1/library/books
Authorization: Bearer {access_token}
```

**Body:**

```json
{
  "book_id": 1
}
```

**Success (200):**

```json
{
  "status": "success",
  "message": "Book added successfully."
}
```

**Already in library (409):**

```json
{
  "status": "failed",
  "message": "Book is already in your library."
}
```

---

### Reading

#### Open Book

Opens a book for reading. Deactivates any other active book for the user, activates the selected book, and returns the last saved page.

```http
POST /v1/user/books/open
Authorization: Bearer {access_token}
```

**Body:**

```json
{
  "book_id": 1
}
```

**Success (200):**

```json
{
  "status": "success",
  "last_page": 3
}
```

#### Turn Page

Advances to the next page for the currently active book. The book must be open (active) for the user.

```http
PATCH /v1/user/books/{book_id}/turn-page
Authorization: Bearer {access_token}
```

**Success (200):**

```json
{
  "status": "success",
  "next_page": 4
}
```

When the user reaches the last page, `next_page` is `null`.

**Book not active (500):**

```json
{
  "status": "failed"
}
```

---

### User Profile

```http
GET /v1/profile
Authorization: Bearer {access_token}
```

---

## Typical Reading Flow

```
1. POST /v1/register              → Create account
2. POST /v1/clients/web/login     → Get access token
3. POST /v1/library/books         → Add book to library
4. POST /v1/user/books/open       → Open book, get last_page
5. PATCH /v1/user/books/{id}/turn-page  → Turn pages until next_page is null
```

Only one book can be **active** per user at a time. Opening a new book deactivates the previous one.

---

## Caching

The **Book** container caches book metadata and page content for one day. Observers on `Book` and `BookPage` clear the relevant cache keys when records are created, updated, or deleted.

---

## Running Tests

```bash
php artisan test
```

Or with PHPUnit directly:

```bash
vendor/bin/phpunit
```

---

## Documentation

Apiato can generate API documentation from route annotations:

```bash
php artisan apiato:generate:docs
```

For full Apiato framework documentation, see [apiato.io](https://apiato.io/docs).

---

## License

This project is built on [Apiato](https://github.com/apiato/apiato), which is open-source software licensed under the [MIT license](https://github.com/apiato/apiato/blob/master/LICENSE).
