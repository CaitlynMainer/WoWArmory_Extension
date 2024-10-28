<?php
use MediaWiki\MediaWikiServices;
require_once ('Client.php');
if (!defined('MEDIAWIKI'))
{
    die('This file is a MediaWiki extension, it is not a valid entry point');
}

class WoWArmory
{
    static private $excuse = NULL;

    public static function WoWArmoryExcuse(&$parser)
    {
        $parser->setHook('wowcharacter', 'WoWArmory::renderWoWCharacter');
        $parser->setHook('wowguild', 'WoWArmory::renderWoWGuild');
        $parser->setHook('wowcharrep', 'WoWArmory::renderWoWCharRep');
        $parser->setHook('wowchartalents', 'WoWArmory::renderWoWCharTalents');
        return true;
    }

    public static function onBeforePageDisplay(OutputPage & $out, Skin & $skin)
    {
        $out->addHTML("");
    }

    public static function renderWoWCharacter($input, $params, $parser, $frame)
    {

        global $wgWoWArmory_ClientID;
        global $wgWoWArmory_ClientSecret;
		
		foreach ($params as $x => $value)
        {
            $params[$x] = $parser->recursiveTagParse($value, $frame);
        }
		
		$servername = strtolower($params["server"]);
		$charname = strtolower($params["name"]);
        // see https://develop.battle.net/documentation/guides/regionality-and-apis for these settings
        $region = 'US';
        // al https://develop.battle.net/documentation/guides/regionality-and-apis for avail locals
        $locale = 'en_US';
        $redirect_uri = '';

        // init the auth system client_id, client_secret, region, local all required
        $client = new Client($wgWoWArmory_ClientID, $wgWoWArmory_ClientSecret, $region, $locale, $redirect_uri);
        //die();
        

        $token = $client->access_token;

        $parser->getOutput()->updateCacheExpiry(0);
		//$parser->recursiveTagParse($sometext, $frame)

$avatarlookup = "https://us.api.blizzard.com/profile/wow/character/" . $servername . "/" . $charname . "/character-media?namespace=profile-us&locale=en_US";

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $avatarlookup);

// Set the Authorization header with the token
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $token"
]);

$result = curl_exec($ch);
curl_close($ch);

$json = json_decode($result, true);

$avatarurl = "";
$fullsizeAvatar = "";

foreach ($json["assets"] as $asset) {
    if ($asset["key"] === "main-raw") {
        $avatarurl = "https://wow.praesidium.productions/avatar.php?url=" . str_replace("https://render.worldofwarcraft.com/us/character/", "", $asset["value"]);
        $fullsizeAvatar = $asset["value"];
        break;
    }
}

// Use $avatarurl and $fullsizeAvatar as needed


        $url = "https://us.api.blizzard.com/profile/wow/character/" . $servername . "/" . $charname . "?namespace=profile-us&locale=en_US";
		//echo $url;

		unset($params["server"]);
        unset($params["name"]);


		$classes["Human"]["male"]["height"] = "6'1\"";
		$classes["Human"]["female"]["height"] = "5'8\"";
		$classes["Human"]["male"]["weight"] = "lbs";
		$classes["Human"]["female"]["weight"] = "lbs";

		$classes["Dwarf"]["male"]["height"] = "4'8\"";
		$classes["Dwarf"]["female"]["height"] = "4'6";
		$classes["Dwarf"]["male"]["weight"] = "lbs";
		$classes["Dwarf"]["female"]["weight"] = "lbs";

		$classes["night elf"]["male"]["height"] = "7'3\"";
		$classes["night elf"]["female"]["height"] = "6'9\"";
		$classes["night elf"]["male"]["weight"] = "lbs";
		$classes["night elf"]["female"]["weight"] = "lbs";

		$classes["draenei"]["male"]["height"] = "7'5'\"";
		$classes["draenei"]["female"]["height"] = "7'0\"";
		$classes["draenei"]["male"]["weight"] = "lbs";
		$classes["draenei"]["female"]["weight"] = "lbs";

		$classes["worgen"]["male"]["height"] = "7'8\"";
		$classes["worgen"]["female"]["height"] = "7'0\"";
		$classes["worgen"]["male"]["weight"] = "lbs";
		$classes["worgen"]["female"]["weight"] = "lbs";

		$classes["pandaren"]["male"]["height"] = "7'1\"";
		$classes["pandaren"]["female"]["height"] = "6'6\"";
		$classes["pandaren"]["male"]["weight"] = "260lbs";
		$classes["pandaren"]["female"]["weight"] = "180lbs";

		$classes["dracthyr"]["male"]["height"] = "1'1\"";
		$classes["dracthyr"]["female"]["height"] = "1'1\"";
		$classes["dracthyr"]["male"]["weight"] = "lbs";
		$classes["dracthyr"]["female"]["weight"] = "lbs";

		$classes["orc"]["male"]["height"] = "6'10\"";
		$classes["orc"]["female"]["height"] = "6'0\"";
		$classes["orc"]["male"]["weight"] = "lbs";
		$classes["orc"]["female"]["weight"] = "lbs";

		$classes["undead"]["male"]["height"] = "6'2\"";
		$classes["undead"]["female"]["height"] = "5'8\"";
		$classes["undead"]["male"]["weight"] = "lbs";
		$classes["undead"]["female"]["weight"] = "lbs";

		$classes["tauren"]["male"]["height"] = "9'0\"";;
		$classes["tauren"]["female"]["height"] = "8'1\"";
		$classes["tauren"]["male"]["weight"] = "lbs";
		$classes["tauren"]["female"]["weight"] = "lbs";

		$classes["troll"]["male"]["height"] = "8'4\"";
		$classes["troll"]["female"]["height"] = "7'1\"";
		$classes["troll"]["male"]["weight"] = "lbs";
		$classes["troll"]["female"]["weight"] = "lbs";

		$classes["blood elf"]["male"]["height"] = "6'2'\"";
		$classes["blood elf"]["female"]["height"] = "5'9\"";
		$classes["blood elf"]["male"]["weight"] = "160lbs";
		$classes["blood elf"]["female"]["weight"] = "120lbs";

		$classes["goblin"]["male"]["height"] = "3'10\"";
		$classes["goblin"]["female"]["height"] = "4'1\"";
		$classes["goblin"]["male"]["weight"] = "lbs";
		$classes["goblin"]["female"]["weight"] = "lbs";

		$classes["void elf"]["male"]["height"] = "6'2'\"";
		$classes["void elf"]["female"]["height"] = "5'9\"";
		$classes["void elf"]["male"]["weight"] = "lbs";
		$classes["void elf"]["female"]["weight"] = "lbs";

		$classes["lightforged draenei"]["male"]["height"] = "7'5\"";
		$classes["lightforged draenei"]["female"]["height"] = "7'0\"";
		$classes["lightforged draenei"]["male"]["weight"] = "lbs";
		$classes["lightforged draenei"]["female"]["weight"] = "lbs";

		$classes["dark iron dwarf"]["male"]["height"] = "4'8\"";
		$classes["dark iron dwarf"]["female"]["height"] = "4'6\"";
		$classes["dark iron dwarf"]["male"]["weight"] = "lbs";
		$classes["dark iron dwarf"]["female"]["weight"] = "lbs";

		$classes["kul tiran"]["male"]["height"] = "7'9\"";
		$classes["kul tiran"]["female"]["height"] = "7'2\"";
		$classes["kul tiran"]["male"]["weight"] = "lbs";
		$classes["kul tiran"]["female"]["weight"] = "lbs";

		$classes["mechagnome"]["male"]["height"] = "3'5\"";
		$classes["mechagnome"]["female"]["height"] = "3'3\"";
		$classes["mechagnome"]["male"]["weight"] = "7lbs";
		$classes["mechagnome"]["female"]["weight"] = "lbs";

		$classes["nightborne"]["male"]["height"] = "7'3\"";
		$classes["nightborne"]["female"]["height"] = "6'9\"";
		$classes["nightborne"]["male"]["weight"] = "lbs";
		$classes["nightborne"]["female"]["weight"] = "lbs";

		$classes["highmountain tauren"]["male"]["height"] = "9'0\"";
		$classes["highmountain tauren"]["female"]["height"] = "8'0\"";
		$classes["highmountain tauren"]["male"]["weight"] = "lbs";
		$classes["highmountain tauren"]["female"]["weight"] = "lbs";

		$classes["mag'har"]["male"]["height"] = "6'10\"";
		$classes["mag'har"]["female"]["height"] = "6'0\"";
		$classes["mag'har"]["male"]["weight"] = "lbs";
		$classes["mag'har"]["female"]["weight"] = "lbs";

		$classes["zandalari troll"]["male"]["height"] = "8'4\"";
		$classes["zandalari troll"]["female"]["height"] = "8'2\"";
		$classes["zandalari troll"]["male"]["weight"] = "lbs";
		$classes["zandalari troll"]["female"]["weight"] = "lbs";

		$classes["vulpera"]["male"]["height"] = "3'11\"";
		$classes["vulpera"]["female"]["height"] = "3'11\"";
		$classes["vulpera"]["male"]["weight"] = "lbs";
		$classes["vulpera"]["female"]["weight"] = "lbs";

        //  Initiate curl
        $ch = curl_init();
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL, $url);
		// Set the Authorization header with the token
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			"Authorization: Bearer $token"
		]);
        // Execute
        $result = curl_exec($ch);
        // Closing
        curl_close($ch);
        $json = json_decode($result, true);
        if ($json["faction"]["name"] == "Alliance")
        {
            $output .= "{{HeroBox";
        }
        else
        {
            $output .= "{{HeroBox";
        }
        $output .= "| image = <span class=\"plainlinks\">[$fullsizeAvatar $avatarurl]</span>";
        $output .= "| name = " . $json["name"];
        $output .= "| gender = " . $json["gender"]["name"];
        $output .= "| class = [[" . $json["character_class"]["name"] . "]]";
        $output .= "| specialization = " . $json["active_spec"]["name"];
        $output .= "| level = " . $json["level"];
        $output .= "| server = [[" . $json["realm"]["name"] . "]]";
        $output .= "| faction = [[" . $json["faction"]["name"] . "]]";
        $output .= "| guild = [[" . $json["guild"]["name"] . "]]";
        $output .= "| species = [[" . $json["race"]["name"] . "]]";
        $output .= "| height = " . $classes[strtolower($json["race"]["name"])][strtolower($json["gender"]["name"])]["height"];
        $output .= "| weight = " . $classes[strtolower($json["race"]["name"])][strtolower($json["gender"]["name"])]["weight"];

        foreach ($params as $x => $value)
        {
            $output .= "| " . $x . " = " . $value;
        }

        $output .= "|}}";
		//$output .= "<repeat table=\"".str_replace(" ", "", $json["race"]["name"])."\"></repeat>";
        $output .= "[[Category:Character]]";
        $output .= "[[Category:".$json["character_class"]["name"]."]]";
        $output .= "[[Category:".$json["race"]["name"]."]]";

        $output .= "
			{| class=\"wikitable\" style=\"margin-left: auto; margin-right: auto; border: none;\"
			|-
			| [[File:" . $json["race"]["name"] . " Crest.png|300px|frameless]] || [[File:" . $json["character_class"]["name"] . " Crest.png|300px|frameless]]
			|}";
        //$output .= print_r($json, true);
        //$title = $parser->getTitle();
        //$options = $parser->Options();
        //$options->enableLimitReport(false);
        //$parser = $parser->getFreshParser();
        //return [$parser->parse($output, $title, $options)->getText(), 'noparse' => false, 'isHtml' => true];
        return array(
            $parser->recursiveTagParse($output) ,
            'noparse' => true,
            'isHTML' => true
        );

    }

    public static function getWoWClass($classID)
    {
        global $wgWoWArmory_ClientID;
        global $wgWoWArmory_ClientSecret;

        // see https://develop.battle.net/documentation/guides/regionality-and-apis for these settings
        $region = 'US';
        // al https://develop.battle.net/documentation/guides/regionality-and-apis for avail locals
        $locale = 'en_US';
        $redirect_uri = '';

        // init the auth system client_id, client_secret, region, local all required
        $client = new Client($wgWoWArmory_ClientID, $wgWoWArmory_ClientSecret, $region, $locale, $redirect_uri);
        //die();
        

        $token = $client->access_token;
		//https://us.api.blizzard.com/data/wow/playable-class/7?namespace=static-us&locale=en_US&access_token=
        $classapiurl = "https://us.api.blizzard.com/data/wow/playable-class/" . $classID . "?namespace=static-us&locale=en_US";
		//  Initiate curl
        $ch = curl_init();
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL, $classapiurl);
		// Set the Authorization header with the token
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			"Authorization: Bearer $token"
		]);
        // Execute
        $result = curl_exec($ch);
        // Closing
        curl_close($ch);
        $json = json_decode($result, true);
		return $json;
    }

    public static function getWoWRace($raceID)
    {
        global $wgWoWArmory_ClientID;
        global $wgWoWArmory_ClientSecret;

        // see https://develop.battle.net/documentation/guides/regionality-and-apis for these settings
        $region = 'US';
        // al https://develop.battle.net/documentation/guides/regionality-and-apis for avail locals
        $locale = 'en_US';
        $redirect_uri = '';

        // init the auth system client_id, client_secret, region, local all required
        $client = new Client($wgWoWArmory_ClientID, $wgWoWArmory_ClientSecret, $region, $locale, $redirect_uri);
        //die();
        

        $token = $client->access_token;
		//https://us.api.blizzard.com/data/wow/playable-race/2?namespace=static-us&locale=en_US&access_token=
        $raceapiurl = "https://us.api.blizzard.com/data/wow/playable-race/" . $raceID . "?namespace=static-us&locale=en_US";

		//  Initiate curl
        $ch = curl_init();
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL, $raceapiurl);
		// Set the Authorization header with the token
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			"Authorization: Bearer $token"
		]);
        // Execute
        $result = curl_exec($ch);
        // Closing
        curl_close($ch);
        $json = json_decode($result, true);
		return $json;
    }

    public static function renderWoWGuild($input, $params, $parser, $frame)
    {
        $parser->getOutput()->updateCacheExpiry(0);
        global $wgWoWArmory_ClientID;
        global $wgWoWArmory_ClientSecret;

        // see https://develop.battle.net/documentation/guides/regionality-and-apis for these settings
        $region = 'US';
        // al https://develop.battle.net/documentation/guides/regionality-and-apis for avail locals
        $locale = 'en_US';
        $redirect_uri = '';

        // init the auth system client_id, client_secret, region, local all required
        $client = new Client($wgWoWArmory_ClientID, $wgWoWArmory_ClientSecret, $region, $locale, $redirect_uri);
        //die();

		foreach ($params as $x => $value)
        {
            $params[$x] = $parser->recursiveTagParse($value, $frame);
        }
		
		$servername = strtolower($params["server"]);
		$charname = strtolower($params["name"]);

        $token = $client->access_token;
        $guildapiurl = "https://us.api.blizzard.com/data/wow/guild/" . $servername . "/" . $charname . "/roster?namespace=profile-us&locale=en_US";

        $classes = array(
            1 => "Warrior",
            2 => "Paladin",
            3 => "Hunter",
            4 => "Rogue",
            5 => "Priest",
            6 => "Death Knight",
            7 => "Shaman",
            8 => "Mage",
            9 => "Warlock",
            10 => "Monk",
            11 => "Druid",
            12 => "Demon Hunter",
            13 => "Evoker"
        );
				
		$races = [
			"races" => [
				["name" => "Human", "id" => 1],
				["name" => "Troll", "id" => 8],
				["name" => "Draenei", "id" => 11],
				["name" => "Blood Elf", "id" => 10],
				["name" => "Night Elf", "id" => 4],
				["name" => "Dwarf", "id" => 3],
				["name" => "Pandaren", "id" => 25],
				["name" => "Tauren", "id" => 6],
				["name" => "Undead", "id" => 5],
				["name" => "Orc", "id" => 2],
				["name" => "Gnome", "id" => 7],
				["name" => "Goblin", "id" => 9],
				["name" => "Kul Tiran", "id" => 32],
				["name" => "Zandalari Troll", "id" => 31],
				["name" => "Lightforged Draenei", "id" => 30],
				["name" => "Highmountain Tauren", "id" => 28],
				["name" => "Nightborne", "id" => 27],
				["name" => "Worgen", "id" => 22],
				["name" => "Dark Iron Dwarf", "id" => 34],
				["name" => "Vulpera", "id" => 35],
				["name" => "Mag\'har Orc", "id" => 36],
				["name" => "Pandaren", "id" => 24],
				["name" => "Pandaren", "id" => 26],
				["name" => "Void Elf", "id" => 29],
				["name" => "Mechagnome", "id" => 37],
			],
		];
        //  Initiate curl
        $ch = curl_init();
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL, $guildapiurl);
		// Set the Authorization header with the token
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			"Authorization: Bearer $token"
		]);
        // Execute
        $result = curl_exec($ch);
        // Closing
        curl_close($ch);
        $json = json_decode($result, true);

        $output .= "Guild Name: " . $json["guild"]["name"];
        $output .= " Realm: " . $json["guild"]["realm"]["name"];
        $output .= " Faction: " . $json["guild"]["faction"]["name"];
        $output .= "{{GuildMemberTableHeadBlue}}";
        foreach ($json["members"] as $key => $innerObject)
        {
            $name   = $json["members"][$key]["character"]["name"];
			
            $needle   = "".$json["members"][$key]["character"]["playable_race"]["id"];
			foreach($races["races"] as &$value) {
			    if($needle == $value['id']) {
			        $race = $value['name'];
			    }
			}
			
            $class  = $classes[($json["members"][$key]["character"]["playable_class"]["id"])];
            $level  = $json["members"][$key]["character"]["level"];
            $output .= "{{GuildMemberTableBodyBlue|" . $name . "|" . $race . "|" . $class . "|" . $level . "}}";
        }
        $output .= "{{GuildMemberTableFooterBlue}}";
        $output .= "[[Category:Guild]]";

        return array(
            $parser->recursiveTagParse($output) ,
            'noparse' => true,
            'isHTML' => true
        );

    }
	
	public static function renderWoWCharRep($input, $params, $parser, $frame)
    {
        $parser->getOutput()->updateCacheExpiry(0);
        global $wgWoWArmory_ClientID;
        global $wgWoWArmory_ClientSecret;

        // see https://develop.battle.net/documentation/guides/regionality-and-apis for these settings
        $region = 'US';
        // al https://develop.battle.net/documentation/guides/regionality-and-apis for avail locals
        $locale = 'en_US';
        $redirect_uri = '';

        // init the auth system client_id, client_secret, region, local all required
        $client = new Client($wgWoWArmory_ClientID, $wgWoWArmory_ClientSecret, $region, $locale, $redirect_uri);
        //die();
        
		foreach ($params as $x => $value)
        {
            $params[$x] = $parser->recursiveTagParse($value, $frame);
        }
		
		$servername = strtolower($params["server"]);
		$charname = strtolower($params["name"]);

        $token = $client->access_token;
        $charrepapiurl = "https://us.api.blizzard.com/profile/wow/character/" . $servername . "/" . $charname . "/reputations?namespace=profile-us&locale=en_US";

        //  Initiate curl
        $ch = curl_init();
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL, $charrepapiurl);
		// Set the Authorization header with the token
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			"Authorization: Bearer $token"
		]);
        // Execute
        $result = curl_exec($ch);
        // Closing
        curl_close($ch);
        $json = json_decode($result, true);
		//die(print_r($json));
        $output .= "{{ReputationTableHeader}}";
        foreach ($json["reputations"] as $key => $innerObject)
        {
            $name   = $json["reputations"][$key]["faction"]["name"];
			
            $level  = $json["reputations"][$key]["standing"]["name"];
            $points  = $json["reputations"][$key]["standing"]["value"];
			$rankup = $json["reputations"][$key]["standing"]["max"];
            $output .= "{{ReputationTableBody|" . $name . "|" . $level . "|" . $points . "|" . $rankup . "}}";
        }
        $output .= "{{ReputationTableFooter}}";
		return array(
            $parser->recursiveTagParse($output) ,
            'noparse' => true,
            'isHTML' => true
        );
	}
	
	public static function renderWoWCharTalents($input, $params, $parser, $frame)
    {
        $parser->getOutput()->updateCacheExpiry(0);
        global $wgWoWArmory_ClientID;
        global $wgWoWArmory_ClientSecret;

        // see https://develop.battle.net/documentation/guides/regionality-and-apis for these settings
        $region = 'US';
        // al https://develop.battle.net/documentation/guides/regionality-and-apis for avail locals
        $locale = 'en_US';
        $redirect_uri = '';

        // init the auth system client_id, client_secret, region, local all required
        $client = new Client($wgWoWArmory_ClientID, $wgWoWArmory_ClientSecret, $region, $locale, $redirect_uri);

		foreach ($params as $x => $value)
        {
            $params[$x] = $parser->recursiveTagParse($value, $frame);
        }
		
		$servername = strtolower($params["server"]);
		$charname = strtolower($params["name"]);

        $token = $client->access_token;
        $chartalentapiurl = "https://us.api.blizzard.com/profile/wow/character/" . $servername . "/" . $charname . "/specializations?namespace=profile-us&locale=en_US";

        //  Initiate curl
        $ch = curl_init();
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL, $chartalentapiurl);
		// Set the Authorization header with the token
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			"Authorization: Bearer $token"
		]);
        // Execute
        $result = curl_exec($ch);
        // Closing
        curl_close($ch);
        $json = json_decode($result, true);
		//die(print_r($json["specializations"][0]["talents"][0]["talent"]["name"]));
        $output .= "{{TalentsTableHeader}}";
		$i = 15;
        foreach ($json["specializations"][0]["talents"] as $key => $innerObject)
        {
            $name   = $json["specializations"][0]["talents"][$key]["talent"]["name"];

            $level  = $i;
            $output .= "{{TalentsTableBody|" . $level . "|" . $name . "}}";
			if ($i == 15) {
				$i = $i + 10;
			} else {
				$i = $i + 5;
			}
        }
        $output .= "{{TalentsTableFooter}}";
		
		//die(print_r($json["specializations"][0]["pvp_talent_slots"]));
		$output .= "{{PvPTalentsTableHeader}}";
		$i = 15;
        foreach ($json["specializations"][0]["pvp_talent_slots"] as $key => $innerObject)
        {
            $name   = $json["specializations"][0]["pvp_talent_slots"][$key]["selected"]["talent"]["name"];

            $level  = $i;
            $output .= "{{PvPTalentsTableBody|" . $level . "|" . $name . "}}";
			$i = $i + 10;

        }
        $output .= "{{PvPTalentsTableFooter}}";
		return array(
            $parser->recursiveTagParse($output) ,
            'noparse' => true,
            'isHTML' => true
        );
	}
}
?>
