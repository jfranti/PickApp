###Developers
Geoff Winner, Reid Baldwin, Brett Moore, John Franti

###Date
March 31, 2015<br />

###Description
Use Composer to install [PHPUnit](https://phpunit.de/), [Silex](http://silex.sensiolabs.org/), and [Twig](http://twig.sensiolabs.org/).

###APP
PickApp
Allows users to check upcoming events in real-time. Locally created events.

###Preparing the database
1. Run psql in the terminal.
2. Type in "CREATE DATABASE 'pickapp';" in the terminal.
3. Type in "\c 'pickapp'" in the terminal.
4. Type in "CREATE TABLE events (id serial PRIMARY KEY, id int, name varchar, location varchar, time timestamp, reqs varchar, description text, skill_level varchar);" in the terminal.
5. Type in "CREATE TABLE categories (id serial PRIMARY KEY, name varchar);" in your terminal.
5. Type in "CREATE TABLE users (id serial PRIMARY KEY, name varchar, description varchar);" in your terminal.
6. Type in "CREATE TABLE events_categories (id serial PRIMARY KEY, store_id int, brand_id int);" in your terminal.
Type in "CREATE TABLE events_users (id serial PRIMARY KEY, email citext, password varchar);" in your terminal.
6. Make sure you are accessing psql while in your project folder.
7. JOIN THE FUN!


###Copyright (c) 2015 Geoff Winner

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
