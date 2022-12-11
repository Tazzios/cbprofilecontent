<?php

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Categories\CategoryNode;
//use Joomla\CMS\Categories\Categories; // needed for retrieving full file pathfor pdfimage


require_once( dirname(__FILE__) . '/cblisthelper.php' );
/**
 * Plug-in to enable loading cb profile files into content (e.g. articles)
 * This uses the {cbprofile} syntax
 * Licensed under the GNU General Public License version 2 or later; see LICENSE.txt
 */
class PlgContentcbprofile extends JPlugin
{
	protected static $modules = array();

	protected static $mods = array();

	public function onContentPrepare($context, &$article, &$params, $page = 0)
	{
		// Don't run this plugin when the content is being indexed
		if ($context == 'com_finder.indexer')
		{
			return true;
		}
		
		// Simple performance check to determine whether bot should process further
		if (strpos($article->text, 'loadposition') === false && strpos($article->text, 'cbprofile') === false)
		{
			return true;
		}

		// Expression to search for (positions)
		$regex		= '/{\s*cbprofile\s*(.*?)}/i';

		// Expression to search for(modules)
		$regexmod	= '/{\s*cbprofile\s*(.*?)}/i';
		//$stylemod	= $this->params->def('style', 'none');

		// Find all instances of plugin and put in $matches 
		// $matches[0] is full pattern match, $matches[1] is the id
		preg_match_all($regex, $article->text, $matches, PREG_SET_ORDER);
		
		
		// No matches, skip this
		if ($matches) {
					
			foreach ($matches as $match) {
				
				$output= ''; //clear to avoid placing a cbprofile double if the tag parameter are incorrect after first loop
				
				$matcheslist = explode(',', trim($match[1]));
				
				//Transform  the keys and values from the tag to an array
				
				//Delete space around the = and replace others by , to put then in an array
				$tagparams = preg_replace('/^\p{Z}+|\p{Z}+$/u', '', $match[1]); // remove blank
				$tagparams = strip_tags($tagparams); //Remove htmlcode see
				$tagparams = str_replace(' =','=', $tagparams); //avoid that key and value are seprated
				$tagparams = str_replace('= ','=', $tagparams); //avoid that key and value are seprated
				
								
				// replace space for , if the text is not between qoutes. Special for the linktext
				$tagparams = preg_replace('~\s+(?=([^"]*"[^"]*")*[^"]*$)~',',', $tagparams);			
				
				// replace existing spaces which should only exist between qoutes for %20. Before output it will be changed back
				$tagparams = str_replace(' ','%20', $tagparams); //replace space for dummy space
										
				// create named array for key and values , key to lower case
				preg_match_all("/([^,= ]+)=([^,= ]+)/", $tagparams, $r); 
				$tagparameters = array_combine($r[1], $r[2]);
				$tagparameters = array_change_key_case($tagparameters, CASE_LOWER); //keys to lower to avoid mismatch


				// get the profile ids bij cblistid,username or email
				$where = '';
				$order = '';
				
				/* order for list selects by tagparameter*/
				$order = '';
				//var_dump($tagparameters);
				if (isset($tagparameters['cblistid']) OR isset($tagparameters['cblistname']) ) {
					
					if ( isset($tagparameters['orderby']) AND isset($tagparameters['order']) ) {
						$orderby = $tagparameters['orderby'];
						$tagorder = $tagparameters['order'];
						var_dump(2);
						switch  ($tagorder) {
						   case "desc":
							$order = " ORDER BY ". $orderby . " DESC ";
							break;
						   case "asc":
							$order = " ORDER BY ". $orderby . " ASC ";
							break;
						default:
							// Default way to order
							$order = "";
							break;
						}
						
					}
					elseif(isset($tagparameters['order'])) {
						
						if ($tagparameters['order']=='random'){
							//$order = ' ORDER BY rand()';
							
						}
						
					}
					
				} //end list order 
				
				
			
				
				// get profile ids by cblistid
				if (isset($tagparameters['cblistid']) ) {
					$cblistid = $tagparameters['cblistid'];
					$count = 0;
					foreach (getcblistusers($cblistid,null) as $user) {					
						if ($count==0) {
							$where .= 'user_id in ('. $user['id'];
						} else {
							$where .= ','. $user['id']; 
						}
						$count ++;
					}
					$where .= ')';
				}
				
				// get profile ids by cblistname
				elseif (isset($tagparameters['cblistname']) ) {
					$cblistname = str_replace('%20', ' ' ,trim($tagparameters['cblistname'],'"'))  ;

					$count = 0;
					foreach (getcblistusers(null,$cblistname) as $user) {					
						if ($count==0) {
							$where .= 'user_id in ('. $user['id'];
						} else {
							$where .= ','. $user['id']; 
						}
						$count ++;
					}
					$where .= ')';
					
				}
				
				
				// OR get profile ids by  username
				elseif (isset($tagparameters['username']) ) {	
					$usernamelist = explode('|', trim($tagparameters['username'],'"') );			
					$count = 0;
					
					foreach ($usernamelist as $username) {
						if ($count==0) {
							$where .= 'block  = 0 AND ';
							$order = " ORDER BY FIELD(username,";
						}	else {
							$where .= " OR ";	
							$order .= " , "; 
						}
						$where .=  'username =\'' . $username . '\' ';
						$order .= '\'' . $username . '\' ';
						
						$count ++;
					}
					$order .= ') asc';
				}
				
				// OR get profile ids by  email
				elseif (isset($tagparameters['email']) ) {
					$emaillist = explode('|', trim($tagparameters['email'],'"') );	
					$count = 0;
					
					foreach ($emaillist as $email) {
						if ($count==0) {
							$where .= 'block  = 0 AND ';
							$order = " ORDER BY FIELD(email,";
						}	else {
							$where .= " OR ";	
							$order .= " , "; 
						}									
						$where .=  'email =\'' . $email . '\' ';
						$order .= '\'' . $email . '\' ';
						$count ++;
					}
					$order .= ') asc';
				}
				//var_dump($query . $order );
				//var_dump($where);
				
				if ($where<>'') {
				// Get the users data
				$db = JFactory::getDbo();
				$query = $db->getQuery(true)
					->select(' username, name, email, #__comprofiler.* ')
					->from('#__users', 'users')
					->join('INNER', ' #__comprofiler  ON #__comprofiler.user_id=#__users.id' )
					->where($where);
					//->order($order); // seems like jfacotry does not like FIELD order
				
				$db->setQuery($query . $order );
				$userprofiles = $db->loadAssocList();	
				}
				

				

				$output = '';
				if (!empty($userprofiles)) {

					//check if an layout is given else use contentplugin default
					if (isset($tagparameters['layout']) ) {
						$layout = $tagparameters['layout'];
					} else {
						$layout = $this->params->get('layout');
					}

					//check if an image widht is given else use contentplugin default
					if (isset($tagparameters['imagewidth']) ) {
						$imagesize['width'] = $tagparameters['imagewidth'];
					} else {
						$imagesize['width'] = $this->params->get('imagewidth');
					}
					
					//check if an image height is given else use contentplugin default
					if (isset($tagparameters['imageheight']) ) {
						$imagesize['height'] = $tagparameters['imageheight'];
					} else {
						$imagesize['height'] = $this->params->get('imageheight');
					}
					
					//check if float is given
					if (isset($tagparameters['float']) ) {
						$style = 'float:'.$tagparameters['float'].';';
					} else {
						$style = 'display: grid;grid-template-columns: repeat(auto-fit, minmax('.$imagesize['width'].'px, 1fr));';
					}
					
					// intext block start
					if (!isset($tagparameters['intext']) and $tagparameters['intext']<>'true'  ) {
							$output .=	'<div class="cbprofile-block" style="'. $style.'">';
					} 
					
					// creat html for each profile
					foreach ($userprofiles as $userprofile)  {			
						$output .= createoutput($userprofile, $layout, $imagesize);
					}		
					} else {
						$output = 'No userprofiles found';
					}
					
					// intext block end
					if (!isset($tagparameters['intext']) and $tagparameters['intext']<>'true' ) {
						$output .=	'</div>';										
					}
					
							
				
				//cleanup before next loop
				unset($tagparameters);
				
				
				// We should replace only first occurrence in order to allow positions with the same name to regenerate their content:
				
				//escape username seperator |
				$replace = str_replace('|','\|', $match[0]);
				$article->text = preg_replace("|$replace|", addcslashes($output, '\\$'), $article->text, 1);
			
		} // end foreach matches
			
		} // end matches
	} // end onContentPrepare
}// end class


function getcblistusers($cblistid,$cblistname) {
	
	// call external fucntion which create the select statement
	if (!empty($cblistid)) {
		//$where = 'listid = '. $cblistid
		$cblistqueryArray = createcblistquerycontent($cblistid,null);
	}
	else {
		$cblistqueryArray = createcblistquerycontent(null,$cblistname);
	}

	$query = $cblistqueryArray['cblistselect'] .  " ORDER BY ". $cblistqueryArray['cblistsortby'] . " " . $cblistqueryArray['cblistsortorder'] ;
	
	
	//Obtain a database connection
	$db = JFactory::getDbo();
		
					
	$db->setQuery($query);
	return $db->loadAssocList();
	//return $db->loadAssocList();  //loadAssocList  loadObjectArray loadResult
	
}


function createoutput($userprofile, $layout, $imagesize ) {


		// Get the path for the voting form layout file
		$path = JPluginHelper::getLayoutPath('content', 'cbprofile', $layout);
		
		// Render the layout
		ob_start();
		include $path;
		return ob_get_clean();


		return $html;
}






