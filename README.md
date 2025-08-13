# Maple
**PHP Static Site Generator**
#### Video Demo:  *coming*
#### Description:
A streamlined static site generator written in PHP. Suitable for smaller sites, all content is stored in .md files and published to .html pages without needing a database.

## Key Features
* Static Site Generator with no database needed
* Easy to install PHP files with minimal setup required
* Secure login to manage content, templates and images in your web browser
* Create and save text content in .md files
* Publish content to static .html files
* Edit templates for headers, footers, and styles for all pages
* View and upload images used on the site
* Track logins, edits, and file uploads
* Rename Maple folder or change paths for files, templates and images as needed
* Remove Maple for sites that no longer need to be frequently updated while keeping all your static .html, .md, and image content

## Setup

- Clone this repository, or upload the Maple folder to your website's root folder
- Create the following folders and files (or update /maple/mplconf.php to change names and paths)
    - /templates/header.html
    - /templates/footer.html
    - /md/
    - /css/style.css
- Save a password as a [Hash](https://bcrypt.online) in a file above the website root folder (not publicly viewable) called password.txt
- Visit [yoursite]/maple/ to login

### Credits

This software uses the following open source packages:
* [Parsedown - Better Markdown Parser in PHP](https://github.com/erusev/parsedown)

## Disclaimer
*This code is provided **as is** without warranty of any kind, either express or implied, including any implied warranties of fitness for a particular purpose, merchantability, or non-infringement.*

## CS50

Thanks to David J. Malan, Yuliia Zhukovets, Brian Yu, Doug Llyod and the rest of the CS50 staff at Harvard University.