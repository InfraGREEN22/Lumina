Used XAMPP to run and test the service on the localhost. Because of the time limit, I decided to not pay attention to the css this time, so the service ended up looking really primitive.
Used: PHP, MySQL, MariaDB, PHPMyAdmin, HTML.

First of all, I've created the index.php file which is the main page of the service. Here all the information about the users' favourite movies is displayed.
In order to use OMDB API, I've installed Composer for managing PHP dependencies and then, using it, installed OMDb API PHP Wrapper for easier access to a movie metadata: https://github.com/rooxie/omdb-php
Then, the add.php file was added to perform managing the users' lists of favourite movies. Here a user is able to add a movie to the list of a user of their choice (using dropdown menu to select a user) and also the user can delete a movie from a list.

Here the user is able to add a single movie to the respective list and delete a single movie from the list, as it was said already. It looks like that I misunderstood the task a little bit and it was required to edit the entire list with comma separated values. However, my solution seems a bit more complex and involves various operations with data.
Anyway, to add a movie to the list, user should select the user name and then insert the imdb id into the text form and click the button. For the deleting feature, I was trying to get all the movies for a selected user from dropdown, but haven't succeed yet. For now, user needs to select the user name and type in the imdb id of the movie to be deleted manually, as in the previous feature.

After either adding or deleting a movie, the user is redirected to the index page where they can see the changes applied.

There is no security yet to prevent XSS and form validation, but it will be added later on.

Also, I tried to leave as much comments as possible in the code to make it more comprehensible.

Database connection credentials:
==========================
username: alex
host: localhost
pswd: 123456789
==========================