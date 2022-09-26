<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Content.vote
 *
 * @copyright   (C) 2016 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>


<a href=index.php?option=com_comprofiler&task=userProfile&user=<?php echo $userprofile['id']; ?>>
	<img src="<?php echo JURI::base()."/images/comprofiler/".$userprofile['avatar']; ?>" alt='<?php echo $userprofile['name']; ?>' title='<?php echo $userprofile['name']; ?> ' width="<?php echo $imagesize['width']; ?>" height="<?php echo $imagesize['height']; ?>" style='margin-left:0px; margin-top:5px; margin-bottom:5px; margin-right:5px;'>
</a>
						

