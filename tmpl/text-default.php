<?php
/*
* @copyright   2022
* @author      Tazzios 
* @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;


/*no avatar check just show nothing*/

?>


<a href=<?php echo JURI::base();?>index.php?option=com_comprofiler&task=userProfile&user=<?php echo $userprofile['id']; ?>>
	 <?php echo $userprofile['name']; ?>
	 <img src="<?php echo JURI::base()."/images/comprofiler/".$userprofile['avatar']; ?>" alt="<?php echo $userprofile['name']; ?>" title="<?php echo $userprofile['name']; ?>" class="cbprofile-avatar" width="<?php echo $imagesize['width']; ?>" height="<?php echo $imagesize['height']; ?>">
	</a>
						
