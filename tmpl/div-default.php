<?php
/*
* @copyright   2022
* @author      Tazzios 
* @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/* Check if there is an approved avatar else use the nophoto image*/
if ($userprofile['avatarapproved']=1 and strlen($userprofile['avatar'])>0 ){
	$avatarsource= JURI::base().'images/comprofiler/'. $userprofile['avatar'];
}
else {
	$avatarsource= JURI::base().'components/com_comprofiler/plugin/templates/default/images/avatar/tnnophoto_n.png';
}

?>


<Div class="cbprofile-userprofile" style="vertical-align: top;display: inline-block;overflow-wrap: break-word;padding: 5px;width: <?php echo $imagesize['width']; ?>px;">
<a href=<?php echo JURI::base();?>index.php?option=com_comprofiler&task=userProfile&user=<?php echo $userprofile['id']; ?>>
	 <img src="<?php echo $avatarsource; ?>" alt='<?php echo $userprofile['name']; ?>' title='<?php echo $userprofile['name']; ?> ' class="cbprofile-avatar" width="<?php echo $imagesize['width']; ?>" height="<?php echo $imagesize['height']; ?>">
	<br> <?php echo $userprofile['name']; ?>
</a>
</div> 				
