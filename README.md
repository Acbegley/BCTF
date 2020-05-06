# BCTF

## Install Instructions
The install script was built for Ubuntu 16.04, but BCTF can be built manually on other distributions provided you find the equivalent packages.

Clone the repo

`git clone https://github.com/Acbegley/BCTF.git`

Naviagte into the repo folder

`cd BCTF`

If not already executable, mark the install script as so

`chmod +x install.sh`

Make sure your machine is up to date

`sudo apt-get update`

Execute the scipt

`./install.sh`

If MySQL server isn't already installed, it will have you set up a password. Make sure you remember that password for your config file later. You'll also need to enter it a couple of times to finish the install.

Naviagte to the html directory

`cd /var/www/html`

Edit the config.php file to have your MySQL password that you set. It is also recommended to set up a new MySQL user other than root and grant permissions on the ctf database for security purposes. This is not required, though. You can also configure any LDAP connections here if you want to authenticate with AD.

The default login is admin:P@ssw0rd, but you can change the password in the profile section.
