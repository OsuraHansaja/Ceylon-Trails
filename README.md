<h1 align="center" style="font-family: 'Orbitron', sans-serif;">Ceylon Trails</h1>

<p align="center">
  Ceylon Trails is a dynamic tourism platform designed to assist travelers in exploring the beautiful island of Sri Lanka. The platform offers a variety of features aimed at enhancing the user experience, from discovering attractions and events to creating custom itineraries and saving favorite places. Built using the TALL stack (Tailwind CSS, Alpine.js, Laravel, Livewire), Ceylon Trails offers both tourists and hosts an intuitive and engaging interface.
</p>

---

## Features

- **Fan Management**: Keep track of fans, their interests, and engagement.
- **News and Updates**: Post and share the latest news and content with fans.
- **Team Pages**: Showcase information about your esports teams.
- **Forums and Discussions**: Engage with fans through interactive forums.
- **Merchandise Shop**: Sell and manage esports merchandise.
- **Shopping Cart**: Buy and save esports merchandise into personal carts.
- **Sponsor Management**: Highlight team sponsors and their contributions.

---

## Tech Stack

- **Backend**: [Laravel 11](https://laravel.com/)
- **Frontend**: Blade, Tailwind CSS, Alpine.js
- **Database**: MySQL
- **Tools**: Jetstream, Livewire, Laravel Forge

---

## Screenshots

### Homepage
![Homepage](public/images/readme%20screenshots/Home%20Page.png)
![Homepage - Part 2](public/images/readme%20screenshots/Home%20Page%20p2.png)

### Shop Section
![Shop Page](public/images/readme%20screenshots/Shop%20Page.png)
![Shop Item Page](public/images/readme%20screenshots/Shop%20Item%20Page.png)
![Shop Cart Page](public/images/readme%20screenshots/Shop%20Cart%20Page.png)

### Team Pages
![Team Page](public/images/readme%20screenshots/Team%20Page.png)

### News Section
![News Page](public/images/readme%20screenshots/News%20Page.png)

### Admin Dashboard
![Admin Dashboard](public/images/readme%20screenshots/admin%20dashboard.png)
![Admin Dashboard - Part 2](public/images/readme%20screenshots/admin%20dashboard%20p2.png)

### Admin Shop Management
![Admin Shop](public/images/readme%20screenshots/admin%20shop.png)

### Admin News Management
![Admin News](public/images/readme%20screenshots/admin%20news.png)
![Admin News Creation](public/images/readme%20screenshots/admin%20news%20create.png)

---

## Installation

```bash
git clone https://github.com/OsuraHansaja/Origin-eSports-CRM.git
cd Origin-eSports-CRM
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm run dev
php artisan serve
