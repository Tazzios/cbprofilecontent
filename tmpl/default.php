<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Content.vote
 *
 * @copyright   (C) 2016 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;


/* Examples

profile picture with mailto link:
<?php echo $userprofile['email']; ?>
<a href="<?php echo $userprofile['email']; ?>">
	<img src="<?php echo JURI::base()."/images/comprofiler/".$userprofile['avatar']; ?>" alt='<?php echo $userprofile['username']; ?>' title='<?php echo $userprofile['username']; ?> ' style='float: ghh; margin-left:0px; margin-top:5px; margin-bottom:5px; margin-right:5px;  width:<?php echo $imagesize['width']; ?>px; height:<?php echo $imagesize['height']; ?>px;'>
</a>

profile picture with link to profile:
<a href=index.php?option=com_comprofiler&task=userProfile&user=<?php echo $userprofile['id']; ?>>
	<img src="<?php echo JURI::base()."/images/comprofiler/".$userprofile['avatar']; ?>" alt='<?php echo $userprofile['username']; ?>' title='<?php echo $userprofile['username']; ?> ' style='float: ghh; margin-left:0px; margin-top:5px; margin-bottom:5px; margin-right:5px;  width:<?php echo $imagesize['width']; ?>px; height:<?php echo $imagesize['height']; ?>px;'>
</a>

*/



//echo  $link;
?>


<a href=index.php?option=com_comprofiler&task=userProfile&user=<?php echo $userprofile['id']; ?>>
	<img src="<?php echo JURI::base()."/images/comprofiler/".$userprofile['avatar']; ?>" alt='<?php echo $userprofile['username']; ?>' title='<?php echo $userprofile['username']; ?> ' style='float: ghh; margin-left:0px; margin-top:5px; margin-bottom:5px; margin-right:5px;  width:<?php echo $imagesize['width']; ?>px; height:<?php echo $imagesize['height']; ?>px;'>
</a>
						

