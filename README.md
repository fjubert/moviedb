## Overview

<p>This app shows information about the latest and most popular movies and actors, by receiving data from <a href="https://developers.themoviedb.org/3">The Movie DB API</a>.</p>

<p>This app was build using Wordpres with <a href="https://roots.io/bedrock/">Bedrock boilerpalte</a> and using <a href="https://understrap.com/">Understrap</a> as a starter theme.

<p>To collect the data from The Movie DB API I created a plugin named The Movie DB Scrapper, located in this repository.

## Features
<h3>Homepage</h3>

- The homepage shows the next 10 upcoming movies, separated by month and year of release.
- The homepage shows the top 10 most popular actors.
- Each movie displays the following: movie poster, movie title, date of release, and genre.
- Each actor displays the actor’s photo and name.
<h3>Movie list</h3>

- List of all movies ordered by release date with pagination
<h3>Actors list</h3>

- List of all actors with pagination

<h3>Movie Detail</h3>
<p>Every movie should link to its details page.
The detail view should show:</p>

- Movie title
- Movie trailer
- Movie poster
- Movie genre
- Alternative titles
- Overview
- Production companies
- Release date
- Original language
- Cast (Linked to detail page)
- Popularity
- Reviews
- List of similar movies

<h3>Actor Detail</h3>
<p>Every actor should link to their details page.
The detail view should show:</p>

- Photo
- Name
- Birthday
- Place of birth
- Day of death (if applies)
- Website (if applies)
- Popularity
- Bio
- Gallery of images (max 10 items)
- List of movies related to the actor, sorted by date
	
## Instalation
1. On your local environment go to the "app" folder, clone this repository and delete the "public" folder.

2. Enter the repository folder and run to install the dependencies

   ```sh
   $ composer install
   ```

3. Update environment variables in the .env file:
  Rename the .env.example to .env and set the variables:
- `DB_NAME` - Database name
- `DB_USER` - Database user
- `DB_PASSWORD` - Database password
- `WP_HOME` - Your local host URL
- `WP_ENV` - Set to environment (development, staging, production)
- `WP_HOME` - Full URL to WordPress home (https://example.com)
- `WP_SITEURL` - Full URL to WordPress including subdirectory (https://example.com/wp)
- `AUTH_KEY`, `SECURE_AUTH_KEY`, `LOGGED_IN_KEY`, `NONCE_KEY`, `AUTH_SALT`, `SECURE_AUTH_SALT`, `LOGGED_IN_SALT`, `NONCE_SALT`
  - Generate with wp-cli-dotenv-command
  - Generate with our WordPress salts generator

4. Set the document root on your webserver to Bedrock's web folder: /path/to/site/web/ 
For more information go to Bedrock <a href="https://roots.io/docs/bedrock/master/server-configuration">server configuration page</a>

5. Import the SQL database dump files.