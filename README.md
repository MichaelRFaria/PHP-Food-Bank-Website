## Community Table Food Bank Website
A fully functional, interactive webservice created for a fictional food bank aiming to present their business to the public. The project focused on producing a well structured website with clear semantics and appropriate styling, that is accessible and responsible.

## Structure
The website utilises a MVC (Model-View-Controller) model, providing organised, maintainable and extendable code.

The website utilises TWIG templates to generalise and simplify the different views presented to the user.

The website utilises a database, that can be constructed through running the `database.sql` script, on an existing database called `foodbank`.
The website access this database through a `config.ini` file stored at the following location on the server `/var/www/private/config.ini`. This file appears as follows:
```
[database]
servername = database
username = webdev
password = W3bD£velopment
dbname = foodbank
```

## Outputs
The website consist of the following separate pages:
- index.html - the main page, guiding the user and displaying general information on the business.
- contact_us.html - a page for sending an e-mail with any inquiries to the food bank.
- gallery.html - a page displaying a gallery of volunteers and marketing images.
- testimonials.html - a page displaying testimonials from the community.
- openingTimes.html - a page displaying the opening times of the food bank, which can also be modified by a user signed in on a staff account.
- register.html - a page for registering an account, allowing the user to access volunteering opportunities.
- login.html - a page for logging in with an account, allowing the user to either book shifts, or modify the opening times, based on the account privileges.
- shiftTimes.html - a page for booking volunteering shifts, if logged in with a volunteer account.
