# BiolaCSCI
Remaking the outdated Biola University CSCI website



#### Directory Structure:

img — All your image files.  
css — All your css files.  
js — All your javascript files.  
config.php — Main configuration file. Should store site wide settings.  
library — Central location for all custom and third party libraries.  
templates — Reusable components that make up your layout.  


#### Installation of CSCI website

Requirements:
- CentOS 7 x86
- Internet Connectivity and Dedicated IP Mapped to eth0
- Machine is up to date with current yum update patches
- Wget or similar file download tool is available and the user knows how to utilize it
- The user currently active is in the sudo file and is able to sudo


Steps:

1. Open up a terminal or SSH into the server the CSCI website is going to reside on.
2. Download the installation script: wget https://s3-us-west-1.amazonaws.com/csci-webfiles/installer.sh
3. Set installation Permissions: chmod 755 installer.sh
4. Run the installer and follow the instructions on screen: ./installer.sh
5. Done!
