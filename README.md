# Khempion

Khempion helps you achieve any goal you set by providing AI-generated helpful tips and running follow-ups to ensure you're on track. - test

## Table of Contents

- [Introduction](#introduction)
- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
<!-- - [Configuration](#configuration) -->
<!-- - [Testing](#testing) -->
<!-- - [Deployment](#deployment) -->
<!-- - [Contributing](#contributing) -->
<!-- - [License](#license) -->
<!-- - [Credits](#credits) -->

## Introduction

Khempion is designed to assist users in achieving their goals. By leveraging AI, Khempion offers personalized tips and regular follow-ups, ensuring users stay motivated and on track to reach their objectives.

## Features

- Breeze & Socialite Authentication
- AI-generated tips for goal achievement
- Regular follow-ups to track progress
- Customizable goal-setting
- User-friendly interface

## Installation

### Prerequisites

- PHP >= 8.0
- Node.js >= 18.0.0
- NPM >= 8.0.0
- Composer
- SQLite or any other database

### Steps

1. Clone the repository:
   ```sh
   git clone https://github.com/kh3mb1le/khempion.git
   cd khempion
   ```

2. Install dependencies:
    ```sh
    composer install
    npm install
    npm run build
    ```
3. Copy the example environment file and modify it to your needs:
    ```sh
    cp .env.example .env
    ```
4. Generate an application key:
    ```sh
    php artisan key:generate
    ```
5. Run the migrations:
    ```sh
    php artisan migrate
    ```

## Usage
Provide examples and explanations on how to use the project. This can include:

- Running the development server:
    ```sh
    php artisan serve
    ```
- Accessing the application in a browser, we recommend set up your local site as
    ```sh
    khempion.site
    // or you can access directly at
    http://localhost:8000
    ```