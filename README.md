# CarRentalInc
This project is designed for a car rental company based in Tirana. It helps the compay reduce working time by making the process simple for the user to book/reserve a car.
A reservation will be able to be made with or without an account. The advantage for the the log in is a history and discounts aswell.

Week 1: Discussion of the project idea and design.
Week 2: Started implementing the schemas like use cases and user stories, and starting the website.
Week 3: Implementing additional functions like log in, reservation and inquiries. Also adding additional schemas.
Week 4: Creating sessions, and logs on what is done on the website.
Week 5: Implemented search bar to show reserved cars.

JustValidate library

<script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
<script src="clientSideValidation.js" defer></script>
Jquery library

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
Ionicons for the small icon images

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script> <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
Some notes: Since while testing you cannot check if emails are sent to an email address i left it as an inquirey and logged them in the database Sending emails could have easely been done by including <script src="https://smtpjs.com/v3/smtp.js">. A .htaccess has been set where we can be redirected to other pages without the need to know the file extention(.hmtl, .php) and also it wont show in the url. Images are stored in the database, used the blob type variable.

Some accounts for testing purposes.
Admin

.

