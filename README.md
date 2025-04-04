////////////////////////// ECF 2 Website to manage your events \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
SNEEK PEAK 
[!Banner](https://i.imgur.com/FvpfIfu.png)



Setup :
WAMPSERVER64, DB = "localhost"
FIGMA LINK :
https://www.figma.com/design/UqAcpsZE7KS42sHKjWzD4H/ECF-2?node-id=0-1&p=f&t=ftxgpqne5CLhivW4-0

Mandatory Technologies:
BootStrap 5.3.3

Functionalities :

Sign Up Users => With a check of username, email is taken and if the Password and Repeat Password match (Hashage Bcrypt optimized to take only 350ms)
Login Users => Basic login
From User Profile => Update Profile pic (saved locally in the assets/img folder encoding it in webp)
Create an Event => Send it to the DB, and display it in the User HomePage
Delete an Event => Delete it from the DB and update the display
