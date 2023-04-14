[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.com/donate/?business=SAT23GPU7F6AS&no_recurring=1&currency_code=EUR)
# Community Builder profile content plugin

## Description
This plugin allows you to show a CB profile in the content

## Features

- show multiple user in the order that you want
- Resize picture
- Select a CB userlist to show
- change order or randomize
- set number of users to show
- show by username or emailadres
- create own template with every field you want

You can creat an editor button with my [Universal-buttons](https://github.com/Tazzios/Universal-buttons) plugin. 

### Examples
[Demo website](https://marijqg132.132.axc.nl/demo/)

Show CB userlist with id5 in the layout div-avatar
>{cbprofile cblistid=5 layout=div-avatar}

Show CB userlist with the listname: te st 
>{cbprofile cblistname="te st" }

Show the user with username Bert and admin 
>{cbprofile username=Bert|admin}

Show the user with following emailadresses 
>{cbprofile email="bert@example.com|admin@example.com"}

Show the user with username admin and Bert with avatar resized to 20
>{cbprofile username=admin|Bert imagewidth=20 imageheight=20}

Show user with username admin with a small picture and layout intext.
>{cbprofile username=admin imagewidth=20 imageheight=20 layout=intext} 


### Parameters

Use one of these parameters to get an user selection
>username=[username]  
>cblistname="[listname]"  
>cblistid=[number] 

If you want tho change the default list order or even randomize 
>order=[asc|desc|random] orderby=[fieldname]

Show a maximum number of users
>top=[number]
 

Use an other layout then the default set in the plugin configuration
>layout=[layoutfilename]

By default the userprofiles are placed in an fullwidth dynamic grid. With float left/right the text will be around the image and with none the userprofile will be shown on the left side with text around it.
>float=[left|none|right]

avoid that the content plugin gets an div, neccesary to show a user profile in a text.
>intext=[true]

Limit the avatar size
>imagewidth=[number]
>imageheight=[number]


### templates:

You can create your own templates and place them in the 'tmpl' folder.
To use the template you can set a layout=[filename] parameter or set the template as the default in the configuration.
Do not edit the existing ones! You changes will be overwritten when the plugin gets updated.




