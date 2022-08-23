# index.php

it contains php as well as javascript/jquery code
it should run on every request

# ajax.php

it is simply an ajax request handler
it handles both cases
update screen size
update time spent on page

# traffic-info.php

it will display a table with following fields
IP Address, Screen Size(width x height), Visited URL, Visited At(date & time), Time Spent

# database

you can find it under database directory.

# Little Explanation

inc/core.php file has only four line of code
it start session and require basic functionality

Database class and Session classes you can replace both of them and use whatever you use in your project for database and session functionality.

helper file simply contains 3 functions we need for the solution.
