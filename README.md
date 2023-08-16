# Twitch Titles

## About
Twitch Titles was created during the [Lima Major 2023](https://liquipedia.net/dota2/Lima_Major/2023) by me, to solve a simple problem.

On the English Broadcast we have 5 simultaneous streams, and needed to change the title of each channel all the time, but only one PC on the broadcast have all the Twitch accounts logged in, so anytime a new game started, someone needed to go on that PC to change the stream title, and most of the time we weren't able to leave your workstation to change the title, so I've developed this solution to solve this problem, so anyone could manage the stream title from their workstation.

It uses [Twitch API](https://dev.twitch.tv/docs/api/) so you will need to create an application there in order to use this.

## How does this work?

This application will ask to connect to your Twitch Account and by doing this it will generate a token that can be used to manage your channel ([scope](https://dev.twitch.tv/docs/authentication/scopes/): channel:manage:broadcast).

## Requirements

 - Web Server with PHP 7 support and cURL module enabled.
 - MySQL Database
 - A [Twitch Application](https://dev.twitch.tv/console/apps/create) on Twitch Developers
 
## Setup

 1. Clone this respository to your webserver
 2. Create your [Twitch Application](https://dev.twitch.tv/console/apps/create) and set the OAuth Redirect to http://your-server/twitch-titles/twitch-auth.php (considering you had created a folder for the application on your webserver, also take note if you're using HTTP or HTTPS)
 3. Import twitch-titles.sql to your MySQL Database.
 4. Rename *config.php.sample* to *config.php*
 5. Edit *config.php* with all the info needed, it's self-explanatory, but in case you need:
> TWITCH_CLIENT_ID = The Twitch Application's Client ID
> TWITCH_CLIENT_SECRET = The Twitch Application's Client Secret
> TWITCH_REDIRECT_URI = The OAuth Redirect you've defined in step 2
> $twitch_scopes = You don't need to change those, just in case you needed, the channel:read:vips scope is there just for testing purposes 
> MYSQL_HOST = The IP for your MySQL Instance
> MYSQL_USER = The user of your MySQL Instance
> MYSQL_PASSWORD = The user password of your MySQL Instance
> MYSQL_DATABASE = Unless you renamed the database after the import, this must be "twitch-titles"
> date_default_timezone_set = You can use the default or anyone from here: https://www.php.net/manual/en/timezones.php
> DEBUG CONFIG = If you want to activate the Debug mode just set the value to 1

Everything should be working now! :)

## How to use

After you've setup everything just go to http://your-server/twitch-titles/ (assuming you've created a folder for this application) and you will see my awesome front-end skills, also a link to "Connect with Twitch", just click and authorize the Application on your twitch account.
If everything went right you should see the "User Added" message! Do this for all the channels you wish to manage.

To change the Stream Titles just go to http://your-server/twitch-titles/admin/list-channels.php and you will see all the channels that are recorded on the database. Just click on the Edit link and you will be able to change the stream title.

You can use http://your-server/twitch-titles/admin/online-channels.php also, but I don't recommend using it because sometimes Twitch API will not consider the channel online, therefore will not show on this list.

## Wait, the Admin doesn't have a password?

Yes, since it we were using this internally I didn't have time to setup an authentication module (and was also trusting no one on the team would leak the URL). But if you need a more secure solution, I will be specifying this on the **["Premium Edition"](#premium-edition)**.

## Need helping installing your own Instance?

Well, if you don't have the skills to setup your own instance, you can pay me (or someone else) to do it for you!
Just send me an email and let's talk: felipe.magosso@gmail.com

## Premium Edition

A Premium Version will be developed with an Authentication Module and *possibly other features*, but it will be distributed as a Software as a Service for live events and will be charged by events, channel numbers, etc.
If you have a live event happening and are interested, let's talk: felipe.magosso@gmail.com

## Contributions

You're more than welcome to contribute to this code, fork it, create a branch, commit your changes and create a Pull Request! :)

## License

Twitch Titles is available under a MIT License, please read the License File for more information.
