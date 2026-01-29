<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Laravel-Pet

## О проекте
`laravel-pet` — учебный проект для изучения Laravel 12 с нуля, реализующий базовую функциональность API:  
- Авторизация и аутентификация пользователей  
- Создание, получение и обновление задач (Tasks)  
- Ограничение доступа к задачам по пользователю  
- Использование Eloquent ORM и ресурсов  
- Пагинация результатов  

Проект поднимается полностью в Docker с PHP 8.3 и MySQL 8.0, что позволяет тренироваться с современным стеком Laravel.

# Инструкция по запуску проекта Laravel Pet

## Требования

- Docker (>= 20.10)
- Docker Compose (>= 2.0)
- PHP 8.3
- MySQL 8.0

> Laravel 12 с использованием Sanctum для авторизации и Docker для контейнеризации.

---

## 1. Клонируем проект

```bash
git clone <URL_репозитория> laravel-pet
cd laravel-pet
```
## 2. Сборка и запуск Docker-контейнеров
```bash
docker compose up --build
```

## Стек
- **Backend:** PHP 8.3, Laravel 12, Eloquent ORM, Sanctum (API tokens)
- **База данных:** MySQL 8.0
- **Контейнеризация:** Docker, Docker Compose
- **Дополнительно:** Composer, Artisan, TaskResource (API Resources)

## Архитектура Docker
| PHP контейнер       | MySQL контейнер     |

# API Документация - Laravel Pet

Базовый URL: `http://localhost:8000/api`

---

## Эндпоинты

| Метод | URL | Headers | Body | Описание | Ответ | Ошибки |
|-------|-----|---------|------|----------|-------|--------|
| GET | `/ping` | — | — | Проверка, что сервер работает | `{ "message": "pong" }` | — |
| POST | `/users` | — | `{ "name": "User Name", "email": "user@example.com", "password": "password123" }` | Регистрация нового пользователя, возвращает токен | `{ "token": "your-api-token" }` | `{ "error": "somethin went wrong while creating user" }` |
| POST | `/login` | — | `{ "email": "user@example.com", "password": "password123" }` | Авторизация пользователя | `{ "token": "your-api-key" }` | `{ "error": "Invalid-credentials" }` |
| POST | `/tasks` | `Authorization: Bearer <token>` | `{ "text": "Текст задачи", "img_url": "https://example.com/image.png" }` | Создание новой задачи для пользователя | `123` (ID задачи) | `{ "error": "somethin went wrong while creating task" }` |
| GET | `/tasks` | `Authorization: Bearer <token>` | — | Получение всех задач пользователя с пагинацией (10 на страницу) | `{ "data": [...], "links": {...}, "meta": {...} }` | `{ "error": "somethin went wrong while getting tasks" }` |
| GET | `/tasks/{id}` | `Authorization: Bearer <token>` | — | Получение конкретной задачи по ID | `{ "id": 1, "text": "Текст", "img_url": "...", "created_at": "...", "updated_at": "..." }` | `{ "error": "somethin went wrong while getting tasks" }` |
| PUT / PATCH | `/tasks/{id}` | `Authorization: Bearer <token>` | `{ "text": "Обновленный текст", "img_url": "https://example.com/new.png" }` | Обновление задачи | `{ "id": 1 }` (или пустой ответ) | `{ "error": "somethin went wrong while updating task" }` |

---

### Примечания

1. Все запросы к `/tasks` требуют **авторизации** через `Bearer Token`.
2. Пагинация `/tasks` по умолчанию возвращает 10 задач на страницу.
3. Ошибки возвращаются в формате JSON с ключом `error`.
4. Для обновления задач можно использовать метод PUT или PATCH.

