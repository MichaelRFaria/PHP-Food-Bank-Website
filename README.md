## Community Table Food Bank Website
This project is an extension of [this project](https://github.com/MichaelRFaria/HTML-Food-Bank-Website).

A fully functional, interactive webservice created for a fictional food bank aiming to present their business to the public. The project focused on producing a well structured website with clear semantics and appropriate styling, that is accessible and responsible.

This project was my first experience working within a Docker container and with PHP and MySQL.

# Gallery
<p align="center">
  <img width="640" height="360" alt="home page" src="https://github.com/user-attachments/assets/b31150cf-1cd6-49d7-8072-323dbe35055c" />
  <br>
  <em>Home page</em>
</p>
<hr/>
<p align="center">
  <img width="640" height="360" alt="testimonials page" src="https://github.com/user-attachments/assets/4b5ac154-ffd0-4ed7-93e5-bf0f1cca4c79" />
  <br>
  <em>Testimonials page</em>
</p>
<hr/>
<p align="center">
<img width="640" height="360" alt="contact us page" src="https://github.com/user-attachments/assets/d83b92b5-811c-46c2-9dbe-d0511b86f244" />
  <br>
  <em>Contact us page</em>
</p>
<hr/>
<p align="center">
  <img width="640" height="360" alt="gallery page" src="https://github.com/user-attachments/assets/217c6614-6ba6-47ed-bbd7-23633a9f08bc" />
  <br>
  <em>Gallery page</em>
</p>
<hr/>
<p align="center">
  <img width="640" height="360" alt="opening times page (logged out)" src="https://github.com/user-attachments/assets/286edef0-9d16-4ccc-8aee-1057dce815b3" />
  <br>
  <em>Opening times page (when logged out)</em>
</p>
<hr/>
<p align="center">
<img width="640" height="360" alt="opening times page (logged in) png" src="https://github.com/user-attachments/assets/cfdc8f84-252b-4b30-95a3-43edd4163f7f" />
  <br>
  <em>Opening times page (when logged in)</em>
</p>
<hr/>
<p align="center">
<img width="640" height="360" alt="volunteer shifts page (logged in) png" src="https://github.com/user-attachments/assets/96d3216f-0e4e-45f4-9b6a-8d31686f0ef7" />
  <br>
  <em>Volunteer shifts page</em>
</p>

## Structure
The website utilises a MVC (Model-View-Controller) model, providing organised, maintainable and extendable code.

The website utilises TWIG templates to generalise and simplify the different views presented to the user.

The website utilises PHP combined with a MySQL database for authentication, different user roles and other backend logic.

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

Created as part of my "Web Development" university module. I recieved 75 out of 100 marks on this coursework.
