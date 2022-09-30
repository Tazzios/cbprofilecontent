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
>cblistname="[all users]"
>cblistid=[number]

By default the userprofiles are placed in an dynamic grid.
>float=[left:none:right]

avoid that the content plugin gets an div, neccesary to show a user profile in a text.
>intext=[true]

Limit the avatar size
>imagewidth=[number]
>imageheight=[number]



### templates:

You can create your own templates and place them in the 'tmpl' folder.
To use the template you can set a layout=[filename] parameter or set the template as the default in the configuration.
Do not edit the existing ones! You changes will be overwritten when the plugin gets updated.




