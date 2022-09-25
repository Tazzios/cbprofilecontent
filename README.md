[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.com/donate/?business=SAT23GPU7F6AS&no_recurring=1&currency_code=EUR)
# Community Builder profile content plugin

## Description
This plugin allows you to show a CB profile in the content

## Features

- show multiple user in the order that you want
- Resize picture
- Select a CB userlist to show
- show by username or emailadres
- create own template with every field you want

### Examples

Show CB userlist with id5 in the layout default2
>{cbprofile cblistid=5 layout=intext}

Show CB userlist with the listname: te st 
>{cbprofile cblistname="te st" }

Show the user with username Bert and admin 
>{cbprofile username=Bert|admin}

Show the user with username admin and Bert
>{cbprofile username=admin|Bert}

Show the user with following emailadresses 
>{cbprofile email="bert@example.com|admin@example.com"}

Show the user with username admin and Bert with mas profilepicture width 20
>{cbprofile username=admin|Bert imagewidth=20 imageheight=20}

Show user with username admin with a small picture and layout intext.
>{cbprofile username=admin imagewidth=20 imageheight=20 layout=intext} 


### templates:

You can create your own templates and place them in the 'tmpl' folder
To use the template you can set a layout=[filename] parameter or set the template as the default in the configuration.


profile picture with link to profile: (default)
``` 
<a href=index.php?option=com_comprofiler&task=userProfile&user=<?php echo $userprofile['id']; ?>>
	<img src="<?php echo JURI::base()."/images/comprofiler/".$userprofile['avatar']; ?>" alt='<?php echo $userprofile['username']; ?>' title='<?php echo $userprofile['username']; ?> ' style='float: ghh; margin-left:0px; margin-top:5px; margin-bottom:5px; margin-right:5px;  width:<?php echo $imagesize['width']; ?>px; height:<?php echo $imagesize['height']; ?>px;'>
</a>
```
Name with picture: (intext)
``` 

<a href=index.php?option=com_comprofiler&task=userProfile&user=<?php echo $userprofile['id']; ?>>
	 <?php echo $userprofile['username']; ?>
	 <img src="<?php echo JURI::base()."/images/comprofiler/".$userprofile['avatar']; ?>" alt='<?php echo $userprofile['username']; ?>' title='<?php echo $userprofile['username']; ?> ' style='float: ghh; margin-left:0px; margin-top:5px; margin-bottom:5px; margin-right:5px;  width:<?php echo $imagesize['width']; ?>px; height:<?php echo $imagesize['height']; ?>px;'>
</a>
```
profile picture with mailto link:
```
<a href="<?php echo $userprofile['email']; ?>">
	<img src="<?php echo JURI::base()."/images/comprofiler/".$userprofile['avatar']; ?>" alt='<?php echo $userprofile['username']; ?>' title='<?php echo $userprofile['username']; ?> ' style='float: ghh; margin-left:0px; margin-top:5px; margin-bottom:5px; margin-right:5px;  width:<?php echo $imagesize['width']; ?>px; height:<?php echo $imagesize['height']; ?>px;'>
</a>
``` 



