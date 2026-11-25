# BedrockForge Geotech — Laravel 13 + Filament 3 Website, ERP & AI

Production-ready SME platform for a Seattle / Puget Sound **geotechnical services** firm: public marketing site, Filament admin ERP, knowledge base, and AI assistants for chat, content, automation ideas, and troubleshooting.

## Features
- 🏠 Premium public site (hero, services, about, dashboard preview, contact)
- 🪨 Service detail pages for foundations, slopes, retaining walls, pavement, seismic & observation
- 📰 Blog / knowledge content with seeded posts
- 📬 Contact form that stores leads in the database
- 💬 Floating WhatsApp button + public AI chatbot widget
- 🗂️ Filament ERP at `/admin` (customers, projects/investigations, inventory, invoices, payments, appointments)
- 👥 Roles: Admin, Manager, Staff
- 📊 Reports dashboard with stats + charts
- ⚙️ Settings page for company phone, WhatsApp, tax rate, and more
- 🤖 Admin AI Studio (blog/descriptions, automation suggestions, troubleshooting)
- 📚 Knowledge base: common issues, guides, admin manual, troubleshooting
- 🌱 Realistic demo seeders for a full walkthrough

## Tech Stack
- Laravel 13
- Filament 3
- Livewire + Alpine.js
- Tailwind-friendly public CSS (custom BedrockForge theme)
- MySQL or SQLite
- Spatie Laravel Permission
- OpenAI API with Gemini fallback keys (demo FAQ mode when keys are empty)

## Installation
```bash
git clone https://github.com/imranbru99/geotechnical-services.git
cd geotechnical-services
composer install
copy .env.example .env   # Windows
php artisan key:generate
# Ensure database/database.sqlite exists for SQLite demo
php artisan migrate --seed
php artisan serve
```

Admin ERP: `http://localhost:8000/admin` — `admin@example.com` / `password`

Optional AI keys in `.env`: `OPENAI_API_KEY` or `GEMINI_API_KEY`.

## Screenshots / Visual Dashboard
![BedrockForge hero](https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&w=1400&q=80)
![BedrockForge field](https://images.unsplash.com/photo-1581094794329-c8112a89af12?auto=format&fit=crop&w=1400&q=80)
![BedrockForge detail](https://images.unsplash.com/photo-1541888946425-d81bb19240f5?auto=format&fit=crop&w=1400&q=80)
![BedrockForge ops](https://images.unsplash.com/photo-1590496793929-36417d3117b4?auto=format&fit=crop&w=1400&q=80)

## Live Demo
Placeholder — deploy to your preferred host (Forge, Vapor, shared PHP) and update this section with the public URL.

## SEO-optimized repo description
```
BedrockForge Geotech — Laravel 13 + Filament 3 website, ERP & AI for a Seattle geotechnical services SME (foundations, slopes, seismic, chatbot).
```

---

## 🤝 Let's Connect & Collaborate
I am open to Senior Remote Full-Stack Roles, AI Platform Architecture Contracts, and Enterprise Technical Advisory.
Timezone: UTC+6 (Dhaka / Rangpur, Bangladesh) — Flexible overlap with US, UK, and European business hours.
Delivery Mode: Async-ready, Slack, Discord, Jira, GitHub, and production-first accountability.

| Channel | Address / Handle | Quick Action |
|---------|------------------|--------------|
| 🌐 Primary Portfolio | imrandev.bd | Visit Site ↗ |
| 📦 Packagist Packages | packagist.org/packages/imrandevbd/ | View Packages ↗ |
| 💼 LinkedIn Profile | linkedin.com/in/imranbru99 | Connect ↗ |
| 🐙 GitHub Profile | github.com/imranbru99 | Follow ↗ |
| 💬 WhatsApp Direct | +880 1576-918420 | Chat Now ↗ |
| 📧 Direct Email | me@imrandev.bd | Send Email ↗ |
| 🐦 X (Twitter) | @imrandev_bd | Follow ↗ |
| 📺 YouTube Tech | @ImranDevBD | Subscribe ↗ |