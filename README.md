[![License](https://github.com/Stokoe0990/wikivel/blob/master/mit.svg)](https://github.com/Stokoe0990/wikivel)

![WikiVel](https://github.com/Stokoe0990/wikivel/blob/master/wikivel.png)

# Wikivel

A markdown-based, laravel-powered Wiki system.

Currently built for a single organisation but plans are being made to allow for multi-tenency.

This project is still very much a work-in-progress but will happily accept Pull Requests and new issues!
(Definitely don't go into production until after some serious testing)

# Current Features
 * Wiki > Space > Page structure (Wiki is a top-level entity in my head, then there are spaces within a wiki, and pages in each space).
 * Favorite Wikis/Spaces/Pages
 * Comments system (With reply chains)
 * Algolia Search (Search Wikis, Spaces, Pages and Users)
 * MARKDOWN based editing (All Wikis, Spaces and Pages have a content field which is stored as markdown and parsed by the backend into HTML to display to the user)
 * Activity Log on homepage (Shows Wiki/Space/Page events)
 * User profiles
 * User display pictures
 * More to come.

# Planned Features
 * Live demo
 * Automated tests
 * Modular plugin system 
 * Live chat system (A real-time chat application with group chat support)
 * Invite new users
 * Image uploading & storage
 * Localisation
 

# Installation

Clone the repo, execute `composer install` and `yarn` or `npm install`.

Create .env: `cp .env.example .env`.

Generate App key: `php artisan key:generate`.

Compile front-end assets: `npm run dev` or `npm run prod`.

Migrate databases with `php artisan migrate`.

# Test data

There are some seeds to allow you to fill your wiki with test data.

`php artisan wikivel:demo` is what I've been using for development.

# Developing

If you wish to contribute to the project, I encourage you to fork the project and create some Pull Requests.

Ideally, the planned features would be your first point of call when looking for something to add to the project, but if you have a good idea and think it should be part of Wikivel, feel free to add it and create a PR.
