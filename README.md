
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
>{cbprofile cblistid=5 layout=default2}

Show the user with username Bert and admin 
>{cbprofile username=Bert|admin}

Show the user with username admin and Bert
>{cbprofile username=admin|Bert}

Show the user with following emailadresses
{cbprofile email="bert@example.com|admin@example.com"}

### templates:


profile picture with mailto link:
```
<?php echo $userprofile['email']; ?>
<a href="<?php echo $userprofile['email']; ?>">
	<img src="<?php echo JURI::base()."/images/comprofiler/".$userprofile['avatar']; ?>" alt='<?php echo $userprofile['username']; ?>' title='<?php echo $userprofile['username']; ?> ' style='float: ghh; margin-left:0px; margin-top:5px; margin-bottom:5px; margin-right:5px;  width:<?php echo $imagesize['width']; ?>px; height:<?php echo $imagesize['height']; ?>px;'>
</a>
``` 

profile picture with link to profile:
``` 
<a href=index.php?option=com_comprofiler&task=userProfile&user=<?php echo $userprofile['id']; ?>>
	<img src="<?php echo JURI::base()."/images/comprofiler/".$userprofile['avatar']; ?>" alt='<?php echo $userprofile['username']; ?>' title='<?php echo $userprofile['username']; ?> ' style='float: ghh; margin-left:0px; margin-top:5px; margin-bottom:5px; margin-right:5px;  width:<?php echo $imagesize['width']; ?>px; height:<?php echo $imagesize['height']; ?>px;'>
</a>
```

