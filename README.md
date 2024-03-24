## Wedding Management App

[![Laravel Forge Site Deployment Status](https://img.shields.io/endpoint?url=https%3A%2F%2Fforge.laravel.com%2Fsite-badges%2Fdc3d50e2-1f2f-49ce-a4c8-44a368af86f2%3Fcommit%3D1&style=plastic)](https://forge.laravel.com/servers/758759/sites/2246302)

This app provides a guest-facing front-end, where guests can visit and find information about your wedding, such as the location, date, information on local hotels, the wedding party, the couple, etc.

Guests are also provided with a page to submit an RSVP code, which can be included on their invitations. Using this code, they can access an RSVP form to submit whether or not they're coming, information on their contact info, dietary requirements, their plus one (if they've been given one), and more.

There is also an admin-facing side to the site, which functions as a basic CRM. Here, you can view your guest list, add new guests, edit or delete existing guests, work out your budget, keep track of vendors, and assign hotel rooms.
You can also see an overview of your wedding plan, including how many guests have RSVP'd, how many are outstanding, the total number of meals you will need to pay for, etc.

## Setup

1) Clone the repo
2) Run `composer install` and `npm install`
3) Run `php artisan key:generate`
4) Setup MySQL and create a database, point your `.env` file to this database and add your credentials
