<?php
  
	$plugin_info = array(
		'pi_name'			=> 'FLV Media Player Plugin',
		'pi_version'		=> '4.0',
		'pi_author'			=> 'John Henry Donovan',
		'pi_author_url'		=> 'http://www.5pieces.com/',
		'pi_description'	=> 'An easy and flexible way to add video and audio to your website.',
		'pi_usage'			=> FLVplugin::usage()
	);
	class FLVplugin
	{
	var $return_data = "";
	var $flv = "";
		function flvplugin()
		{
			global $TMPL;
			
			
			/////SWFOBJECT VARIABLES
			$playerid = $TMPL->fetch_param('playernumber');	
			$playerpath = $TMPL->fetch_param('playerpath');
			$flashversion = ($TMPL->fetch_param('flashversion')) ? $TMPL->fetch_param('flashversion') : "9.0.0";
			$wmode = ($TMPL->fetch_param('wmode')) ? "wmode: '".$TMPL->fetch_param('wmode')."',\n" : "wmode: 'opaque',\n";
			$allowfullscreen = ($TMPL->fetch_param('allowfullscreen')) ? "allowfullscreen: '".$TMPL->fetch_param('allowfullscreen')."',\n" : "allowfullscreen: 'true',\n";
			$allowscriptaccess = ($TMPL->fetch_param('allowscriptaccess')) ? "allowscriptaccess: '".$TMPL->fetch_param('allowscriptaccess')."',\n" : "allowscriptaccess: 'always'\n";
			$bgcolor = ($TMPL->fetch_param('bgcolor')) ? "bgcolor: #".$TMPL->fetch_param('bgcolor')."',\n" : "bgcolor: '#CCCCCC',\n";
			
			/////File properties
			$author = ($TMPL->fetch_param('author')) ? "author: '".$TMPL->fetch_param('author')."',\n" : '';
			$date = ($TMPL->fetch_param('date')) ? "date: '".$TMPL->fetch_param('date')."',\n" : '';
			$description = ($TMPL->fetch_param('description')) ? "description: '".$TMPL->fetch_param('description')."',\n" : '';
			$duration = ($TMPL->fetch_param('duration')) ? "duration: '".$TMPL->fetch_param('duration')."',\n" : '';
			$file = ($TMPL->fetch_param('file')) ? "file: '".$TMPL->fetch_param('file')."',\n" : '';
			$image = ($TMPL->fetch_param('image')) ? "image: '".$TMPL->fetch_param('image')."',\n" : '';
			$link = ($TMPL->fetch_param('link')) ? "link: '".$TMPL->fetch_param('link')."',\n" : '';
			$start = ($TMPL->fetch_param('start')) ? "start: '".$TMPL->fetch_param('start')."',\n" : '';
			$tags = ($TMPL->fetch_param('tags')) ? "tags: '".$TMPL->fetch_param('tags')."',\n" : '';
			$title = ($TMPL->fetch_param('title')) ? "title: '".$TMPL->fetch_param('title')."',\n" : '';
			$type = ($TMPL->fetch_param('type')) ? "type: '".$TMPL->fetch_param('type')."',\n" : '';

			/////Colors
			$backcolor = ($TMPL->fetch_param('backcolor')) ? "backcolor: '".$TMPL->fetch_param('backcolor')."',\n" : '';	
			$frontcolor = ($TMPL->fetch_param('frontcolor')) ? "frontcolor: '".$TMPL->fetch_param('frontcolor')."',\n" : '';
			$lightcolor = ($TMPL->fetch_param('lightcolor')) ? "lightcolor: '".$TMPL->fetch_param('lightcolor')."',\n" : '';
			$screencolor = ($TMPL->fetch_param('screencolor')) ? "screencolor: '".$TMPL->fetch_param('screencolor')."',\n" : '';
			
			/////Layout
			$controlbar = ($TMPL->fetch_param('controlbar')) ? "controlbar: '".$TMPL->fetch_param('controlbar')."',\n" : '';
			$controlbarsize = ($TMPL->fetch_param('controlbarsize')) ? "controlbarsize: '".$TMPL->fetch_param('controlbarsize')."',\n" : '';
			$height = $TMPL->fetch_param('height');
			$playlist = ($TMPL->fetch_param('playlist')) ? "playlist: '".$TMPL->fetch_param('playlist')."',\n" : '';
			$playlistsize = ($TMPL->fetch_param('playlistsize')) ? "playlistsize: '".$TMPL->fetch_param('playlistsize')."',\n" : '';
			$skin = ($TMPL->fetch_param('skin')) ? "skin: '".$TMPL->fetch_param('skin')."',\n" : '';
			$width = $TMPL->fetch_param('width');
			
			/////Behaviour
			$autostart = ($TMPL->fetch_param('autostart')) ? "autostart: '".$TMPL->fetch_param('autostart')."',\n" : '';
			$bufferlength = ($TMPL->fetch_param('bufferlength')) ? "bufferlength: '".$TMPL->fetch_param('bufferlength')."',\n" : '';
			$displayclick = ($TMPL->fetch_param('displayclick')) ? "displayclick: '".$TMPL->fetch_param('displayclick')."',\n" : '';
			$icons = ($TMPL->fetch_param('icons')) ? "icons: '".$TMPL->fetch_param('icons')."',\n" : '';
			$item = ($TMPL->fetch_param('item')) ? "item: '".$TMPL->fetch_param('item')."',\n" : '';
			$logo = ($TMPL->fetch_param('logo')) ? "logo: '".$TMPL->fetch_param('logo')."',\n" : '';
			$mute = ($TMPL->fetch_param('mute')) ? "mute: '".$TMPL->fetch_param('mute')."',\n" : '';
			$quality = ($TMPL->fetch_param('quality')) ? "quality: '".$TMPL->fetch_param('quality')."',\n" : '';
			$repeat = ($TMPL->fetch_param('repeat')) ? "repeat: '".$TMPL->fetch_param('repeat')."',\n" : '';
			$resizing = ($TMPL->fetch_param('resizing')) ? "resizing: '".$TMPL->fetch_param('resizing')."',\n" : '';
			$shuffle = ($TMPL->fetch_param('shuffle')) ? "shuffle: '".$TMPL->fetch_param('shuffle')."',\n" : '';
			$state = ($TMPL->fetch_param('state')) ? "state: '".$TMPL->fetch_param('state')."',\n" : '';
			$stretching = ($TMPL->fetch_param('stretching')) ? "stretching: '".$TMPL->fetch_param('stretching')."',\n" : '';
			$volume = ($TMPL->fetch_param('volume')) ? "volume: '".$TMPL->fetch_param('volume')."',\n" : '';

			/////External 
			$abouttext = ($TMPL->fetch_param('abouttext')) ? "abouttext: '".$TMPL->fetch_param('abouttext')."',\n" : '';
			$aboutlink = ($TMPL->fetch_param('aboutlink')) ? "aboutlink: '".$TMPL->fetch_param('aboutlink')."',\n" : '';
			$client = ($TMPL->fetch_param('client')) ? "client: '".$TMPL->fetch_param('client')."',\n" : '';
			$id = ($TMPL->fetch_param('id')) ? "id: ".$TMPL->fetch_param('id')."',\n" : "id: '".$playerid."'\n";

			$linktarget = ($TMPL->fetch_param('linktarget')) ? "linktarget: '".$TMPL->fetch_param('linktarget')."',\n" : '';
			$plugins = ($TMPL->fetch_param('plugins')) ? "plugins: '".$TMPL->fetch_param('plugins')."',\n" : '';
			$streamer = ($TMPL->fetch_param('streamer')) ? "streamer: '".$TMPL->fetch_param('streamer')."',\n" : '';
			$tracecall = ($TMPL->fetch_param('tracecall')) ? "tracecall: '".$TMPL->fetch_param('tracecall')."',\n" : '';
			$version = ($TMPL->fetch_param('version')) ? "version: '".$TMPL->fetch_param('version')."',\n" : '';

			/////Player code

			$flv = "<!--
** FLV Media Player Plugin v4.0 ** 
An easy and flexible way to add video and audio to your website.
See: http://www.5pieces.com/blog/flv-player-plugin-v4/ for more information.
-->\n";
			$flv .= "<script type='text/javascript'>\n";
			$flv .= "var flashvars = {\n";
  			$flv .= $author;
			$flv .= $date;
			$flv .= $description;
			$flv .= $duration;
			$flv .= $image;
			$flv .= $link;
			$flv .= $start;
			$flv .= $tags;
			$flv .= $title;
			$flv .= $type;
			
			$flv .= $backcolor;
			$flv .= $frontcolor;
			$flv .= $lightcolor;
			$flv .= $screencolor;
			
			$flv .= $controlbar;
			$flv .= $controlbarsize;
			$flv .= $playlist;
			$flv .= $playlistsize;
			$flv .= $skin;
			
			$flv .= $autostart;
			$flv .= $bufferlength;
			$flv .= $displayclick;
			$flv .= $icons;
			$flv .= $item;
			$flv .= $logo;
			$flv .= $mute;
			$flv .= $quality;
			$flv .= $repeat;
			$flv .= $resizing;
			$flv .= $shuffle;
			$flv .= $state;
			$flv .= $stretching;
			$flv .= $volume;
			
			$flv .= $abouttext;
			$flv .= $aboutlink;
			$flv .= $client;
			
			$flv .= $linktarget;
			$flv .= $plugins;
			$flv .= $streamer;
			$flv .= $tracecall;
			$flv .= $version;
			
			
			$flv .= $file;
			$flv .= $id;
			$flv .= "};\n";
			
			$flv .= "var params = {\n";
			$flv .= $wmode;
			$flv .= $bgcolor;
			$flv .= $allowfullscreen;
			$flv .= $allowscriptaccess;
			
			$flv .= "};\n";


			$flv .= "swfobject.embedSWF('".$playerpath."', 'player".$playerid."','".$width."','".$height."', '".$flashversion."','expressInstall.swf', flashvars, params);\n";
			$flv .= "</script>\n";
		

			
			
			
			
			$this->return_data = $flv;
		}
		
// ----------------------------------------
//  Plugin Usage
// ----------------------------------------

// This function describes how the plugin is used.
//  Make sure and use output buffering

function usage()
{
ob_start(); 
?>

//////////////////START

The FLV Media Player Plugin in combination with the JW FLV Player is an easy and flexible way to add video and audio to your website. It supports playback of any format the Adobe Flash Player can handle (FLV, MP4, MP3, AAC, JPG, PNG and GIF). It also supports RTMP, HTTP and live streaming, various playlists formats, a wide range of settings and an extensive javascript API.


Download the player package from over at <a href="http://www.jeroenwijering.com/?item=JW_FLV_Media_Player" title="Flash Video Player">JeroenWijering.com</a>
Unzip the package and copy the file 'player.swf' to your server. Copy the file 'yt.swf if you intend using youTube videos.



//////////////////Single Entry Example

{exp:flvplugin playerpath="player.swf" file="{custom_video_field}"  playernumber="{entry_id}" width="400" height="302"}<div id="player{entry_id}"></div>



//////////////////YouTube Example
{exp:flvplugin playerpath="player.swf" file="http://www.youtube.com/watch%3Fv%3D{youtube_id}"  playernumber="{entry_id}" width="400" height="302" skin="overlay.swf"  frontcolor="ffffff" lightcolor="cc9900" controlbar="over" icons="false" wmode="transparent" image="video-default.png"}<div id="player{entry_id}"></div>



//////////////////Playlist Example

{exp:flvplugin playerpath="player.swf" file="http://gdata.youtube.com/feeds/api/standardfeeds/recently_featured" playlist="bottom" playernumber="1" width="470" height="470" skin="overlay.swf"  frontcolor="ffffff" lightcolor="cc9900" icons="false" controlbar="over" stretching="fill"}




//////////////////PLUGIN PARAMETERS

SWFobject properties

    * wmode (opaque):Possible values: window, opaque, transparent. .
    * allowfullscreen (true):Allows fullscreen viewing. Flash Player ver 9 and above .
    * allowscriptaccess (always): For the protectection of HTML pages from untrusted SWF files
    * bgcolor (CCCCCC): [ hexadecimal RGB value] in the format RRGGBB . Specifies the background color of the movie. Default is grey #CCCCCC
    * flashversion (9.0.0): Flash version number
    * playernumber (undefined): unique number which should match flash content layer ID


File properties 

    * author (undefined): author of the video, shown in the display or playlist.
    * date (undefined): publish date of the media file.
    * description (undefined): text description of the file.
    * duration (0): duration of the file in seconds.
    * file (undefined): location of the mediafile or playlist to play.
    * image (undefined): location of a preview image; shown in display and playlist.
    * link (undefined): url to an external page the display, controlbar and playlist can link to.
    * start (0): position in seconds where playback has to start.
    * tags (undefined): keywords associated with the media file.
    * title (undefined): title of the video, shown in the display or playlist.
    * type (undefined): type of file, can be sound, image, video, youtube, camera, http or rtmp. Use this to override auto-detection. 

The player checks the extension of the file, and if no suiteable extension is found it presumes a playlist is loaded. This file has all supported extensions listed. If you are loading a single file without a supported extension, you can still force the player by setting the type flashvar.

Colors 

    * backcolor (undefined): background color of the controlbar and playlist. This is white with the default skin.
    * frontcolor (undefined): color of all icons and texts in the controlbar and playlist.
    * lightcolor (undefined): color of an icon or text when you rollover it with the mouse. If you set this, also set the frontcolor, so the rollovers also have a rollout.
    * screencolor (undefined): background color of the display. 

All these colors are in so-called hexadecimal values as is common for web colors. 

Layout 

    * controlbar (bottom): position of the controlbar. Can be set to bottom, over and none.
    * controlbarsize (20): height of the controlbar in pixels.
    * height (400): height of the display (not the entire player!) in pixels.
    * playlist (none): position of the playlist. Can be set to bottom, over, right or none.
    * playlistsize (180): size of the playlist. When below or above, this refers to the height, when right, this refers to the width of the playlist.
    * skin (undefined): location of a SWF file with the player graphics. 
    * width (280): width of the display (not the entire player!) in pixels. 

Behaviour 

    * autostart (false): automatically start the player on load.
    * bufferlength (1): number of seconds of the file that has to be loaded before starting. Set this to a low value to enable instant-start and to a high value to get less mid-stream buffering.
    * displayclick (play): what to do when one clicks the display. Can be play, link, fullscreen, none, mute, next. When set to none, the handcursor is also not shown.
    * icons (true): set this to false to hide the play button and buffering icon in the middle of the video.
    * item (0): playlistitem that should start to play. Use this to set a specific start-item.
    * logo (undefined): location of an external jpg, png or gif image to show in a corner of the display. With the default skin, this is top-right, but every skin can freely place the logo.
    * mute (false): mute all sounds on startup.
    * quality (true): enables high-quality playback. This sets the smoothing of videos on/off, the deblocking of videos on/off and the dimensions of the camera small/large.
    * repeat (none): set to list to play the entire playlist once and to always to continously play the song/video/playlist. There's no option to repeat a single entry in a playlist yet.
    * resizing (true): by default, the player will resize itself to fill the entire canvas. Set this to false if you don't want the player to resize (e.g. when you load the player in a Flash / Flex application).
    * shuffle (false): shuffle playback of playlist items.
    * state (IDLE): current playback state of the player. Can be IDLE (no file loaded), BUFFERING (loading a file), PLAYING (playing a file), PAUSED (pausing playback; loading continues), COMPLETED (same as IDLE, but the file is player and loaded completely).
    * stretching (uniform): defines how to resize images in the display. Can be none (no stretching), exactfit (disproportionate), uniform (stretch with black borders) or fill (uniform, but completely fill the display).
    * volume (90): startup volume of the player. 

External 

    * abouttext (undefined): text to show in the rightclick menu. Please do not change this if you don't have a commercial license! When undefined it shows the player version.
    * aboutlink (http://www.jeroenwijering.com/?page=about): url to link to from the rightclick menu. Do not change this if you don't have a commercial license!
    * client (Flash MAC X,0,XXX,0): Version and platform of the Flash client plugin. Useful to check for e.g. MP4 playback or fullscreen capabilities.
    * id (ply): ID of the player within the javascript DOM. Useful for javascript interaction.
    * linktarget (_blank): browserframe where the links from display are opened in. Some possibilities are '_self' (same frame) , '_blank' (new browserwindow) or 'none' (links are ignored in the player, so javascript can handle it).
    * plugins (undefined): a powerful new feature, this is a comma-separated list of swf plugins to load (e.g. yousearch,viral). Each plugin has a unique ID and resides at plugins.longtailvideo.com. Go to the LongTailVideo AddOns section to find and add plugins.
    * streamer (undefined): location of a server to use for streaming. Can be an RTMP application (here's an example) or external PHP/ASP file to use for HTTP streaming. If set to lighttpd, the player presumes a Lighttpd server is used to stream videos.
    * tracecall (undefined): name of a javascript function that can be used for tracing the player activity. All events from the view, model and controller are sent there.
    * version (4.x.rrr): exact major release, minor release and revision number of the player. sent to javascript with every call. The revision number is always upped no matter the release, so 4.2.51 is the revision right after 4.1.50. 



//////////////////NOTES:

The plugin is built using Jeroen Wijerings Flash Video Player Version 4 at http://www.jeroenwijering.com/?item=JW_FLV_Media_Player

This script is licensed under a Creative Commons "BY-NC-SA" license.
You must buy a commercial license if:

   1. Your site has any ads (AdSense, display banners, etc.)
   2. You want to remove the players' attribution (eliminate the right-click link)
   3. You are a corporation (governmental or nonprofit use is free)

For more info and instant ordering, please advance to his online order page at http://www.jeroenwijering.com/?page=order



//////////////////ETC

For tutorials, support and bugs head to http://www.5pieces.com

<?php
$buffer = ob_get_contents();
	
ob_end_clean(); 

return $buffer;
}
// END		
		
		
	}
?>