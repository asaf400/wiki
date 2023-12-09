<?php

if(getenv('WIKI_ENV') == "Dev") {
    ini_set("error_reporting", E_ALL & ~E_DEPRECATED);
    ini_set( 'display_errors', 1 );
    $wgShowExceptionDetails = true;
}

# This file was automatically generated by the MediaWiki 1.38.4
# installer. If you make manual changes, please keep track in case you
# need to recreate them later.
#
# See docs/Configuration.md for all configurable settings
# and their default values, but don't forget to make changes in _this_
# file, not there.
#
# Further documentation for configuration settings may be found at:
# https://www.mediawiki.org/wiki/Manual:Configuration_settings

# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
	exit;
}
## Uncomment this to disable output compression
# $wgDisableOutputCompression = true;

$wgSitename = "Repair Wiki";
$wgMetaNamespace = "RepairWiki";

## The URL base path to the directory containing the wiki;
## defaults for all runtime URL paths are based off of this.
## For more information on customizing the URLs
## (like /w/index.php/Page_title to /wiki/Page_title) please see:
## https://www.mediawiki.org/wiki/Manual:Short_URL
$wgScriptPath = "";

# Article path
$wgArticlePath = "/w/$1";

#pathinfo
$wgUsePathInfo = true;

## The protocol and server name to use in fully-qualified URLs
$wgServer = getenv('FULL_URL');

## The URL path to static resources (images, scripts, etc.)
$wgResourceBasePath = $wgScriptPath;

$wgUploadDirectory = "/var/www/html/images/";

$wgLogos = [
	'1x' => "$wgResourceBasePath/images/repair_preservation_group.svg",
	'icon' => "$wgResourceBasePath/images/repair_preservation_group.svg",
];

$wgShowDebug = false;
$wgDevelopmentWarnings = false;

## UPO means: this is also a user preference option

$wgEnableEmail = true;
$wgEnableUserEmail = true; # UPO

$wgEmergencyContact = "webmaster@repair.wiki";
$wgPasswordSender = "no-reply@repair.wiki";

$wgEnotifUserTalk = false; # UPO
$wgEnotifWatchlist = false; # UPO
$wgEmailAuthentication = true;

## Database settings
$wgDBtype = getenv('DB_TYPE');
$wgDBserver = getenv('DB_SERVER');
$wgDBname = getenv('DB_NAME');;
$wgDBuser = getenv('DB_USER');
$wgDBpassword = getenv('DB_PASSWORD');

# MySQL specific settings
$wgDBprefix = "";

# MySQL table options to use during installation or update
$wgDBTableOptions = "ENGINE=InnoDB, DEFAULT CHARSET=binary";

# Shared database table
# This has no effect unless $wgSharedDB is also set.
$wgSharedTables[] = "actor";

## Shared memory settings
$wgMainCacheType = CACHE_ACCEL;
$wgMemCachedServers = [];

## To enable image uploads, make sure the 'images' directory
## is writable, then set this to true:
$wgEnableUploads = true;
$wgUseImageMagick = true;
$wgImageMagickConvertCommand = "/usr/bin/convert";

# InstantCommons allows wiki to use images from https://commons.wikimedia.org
$wgUseInstantCommons = false;

# Periodically send a pingback to https://www.mediawiki.org/ with basic data
# about this MediaWiki instance. The Wikimedia Foundation shares this data
# with MediaWiki developers to help guide future development efforts.
$wgPingback = false;

# Site language code, should be one of the list in ./languages/data/Names.php
$wgLanguageCode = "en";

# Time zone
$wgLocaltimezone = "UTC";

## Set $wgCacheDirectory to a writable directory on the web server
## to make your wiki go slightly faster. The directory should not
## be publicly accessible from the web.
#$wgCacheDirectory = "$IP/cache";

$wgSecretKey = getenv("MEDIAWIKI_SECRET");

# Changing this will log out all existing sessions.
$wgAuthenticationTokenVersion = "1";

## For attaching licensing metadata to pages, and displaying an
## appropriate copyright notice / icon. GNU Free Documentation
## License and Creative Commons licenses are supported so far.
$wgRightsPage = ""; # Set to the title of a wiki page that describes your license/copyright
$wgRightsUrl = "https://creativecommons.org/licenses/by-sa/3.0/";
$wgRightsText = "a Creative Commons Attribution-ShareAlike 3.0 License";
$wgRightsIcon = "https://licensebuttons.net/l/by-sa/3.0/88x31.png";
# Path to the GNU diff3 utility. Used for conflict resolution.
$wgDiff3 = "/usr/bin/diff3";

## Default skin: you can change the default skin. Use the internal symbolic
## names, e.g. 'vector' or 'monobook':
$wgDefaultSkin = "citizen";

# Enabled skins.
# The following skins were automatically enabled:
#wfLoadSkin( 'MinervaNeue' );
#wfLoadSkin( 'MonoBook' );
#wfLoadSkin( 'Timeless' );
#wfLoadSkin( 'Vector' );
wfLoadSkin( 'Citizen' );

# End of automatically generated settings.
# Add more configuration options below.

# Extensions

## Mediawiki Default
wfLoadExtension( 'Cite' );
wfLoadExtension( 'CodeEditor' );
wfLoadExtension( 'Gadgets' );
wfLoadExtension( 'ImageMap' );
wfLoadExtension( 'InputBox' );
wfLoadExtension( 'MultimediaViewer' );
wfLoadExtension( 'OATHAuth' );
wfLoadExtension( 'PageImages' );
wfLoadExtension( 'ParserFunctions' );
wfLoadExtension( 'Scribunto' );
wfLoadExtension( 'TemplateData' );
wfLoadExtension( 'TextExtracts' );
wfLoadExtension( 'TitleBlacklist' );
wfLoadExtension( 'VisualEditor' );
wfLoadExtension( 'WikiEditor' );
wfLoadExtension( 'Parsoid', __DIR__ . "/vendor/wikimedia/parsoid/extension.json" );
wfLoadExtensions( [
#    'Thanks',
    'Math',
    'EmbedVideo',
    'DynamicPageList3',
    'NativeSvgHandler',
    'LoginNotify',
] );

## Other
wfLoadExtension( 'Discord' );
wfLoadExtension( 'PageForms' );
wfLoadExtension( 'Popups' );
wfLoadExtension( 'Echo' );
wfLoadExtension( 'TabberNeue' );
wfLoadExtension( 'SemanticMediaWiki' );
wfLoadExtension( 'VisualEditor' );
wfLoadExtension( 'DeleteBatch' );
wfLoadExtension( 'VEForAll' );
wfLoadExtension( 'AbuseFilter' );
wfLoadExtension( 'StopForumSpam' );
wfLoadExtension( 'UploadWizard' );
wfLoadExtension( 'ConfirmAccount' );
wfLoadExtension( 'SimpleBatchUpload' );

# Extension configuration

## Discord Webhook
$wgDiscordWebhookURL = [ getenv('DISCORD_WEBHOOK') ];

## Global User Rights
$wgSharedTables[] = 'global_user_groups';

## VisualEditor
$wgVirtualRestConfig['modules']['parsoid'] = array(
);

## Semantic Mediawki
$smwgConfigFileDir = $IP . "/semantics_config";
enableSemantics(getenv('FULL_URL') . "/id/");

## Popups
$wgPopupsHideOptInOnPreferencesPage = true;
$wgPopupsReferencePreviewsBetaFeature = false;

# Permissions

## ALL
$wgGroupPermissions['*']['skipcaptcha'] = false;
$wgGroupPermissions['*']['writeapi'] = true;
$wgGroupPermissions['*']['viewedittab'] = true;
$wgGroupPermissions['*']['createaccount'] = false; // ConfirmAccount

## User
$wgGroupPermissions['user']['skipcaptcha'] = false;
$wgGroupPermissions['user']['writeapi'] = true;

## AutoConfirmed
$wgGroupPermissions['autoconfirmed']['skipcaptcha'] = false;

## Bot
$wgGroupPermissions['bot']['skipcaptcha'] = true; // registered bots
$wgGroupPermissions['bot']['protect'] = true;

## Sysop
$wgGroupPermissions['sysop']['skipcaptcha'] = true;
$wgGroupPermissions['sysop']['userrights-global'] = true;
$wgGroupPermissions['sysop']['renameuser'] = true;

## Bureaucrat
$wgGroupPermissions['bureaucrat']['usermerge'] = true;
$wgGroupPermissions['bureaucrat']['createaccount'] = true;

## No Captcha
$wgGroupPermissions['no-captcha']['skipcaptcha'] = true;

# Email

$wgSMTP = [
    'host'     => getenv("WIKI_EMAIL_HOST"), // could also be an IP address. Where the SMTP server is located. If using SSL or TLS, add the prefix "ssl://" or "tls://".
    'IDHost'   => getenv("WIKI_EMAIL_IDHOST"),      // Generally this will be the domain name of your website (aka mywiki.org)
    'port'     => 587,                // Port to use when connecting to the SMTP server
    'auth'     => true,               // Should we use SMTP authentication (true or false)
    'username' => getenv("WIKI_EMAIL_USER"),     // Username to use for SMTP authentication (if being used)
    'password' => getenv("WIKI_EMAIL_PASSWORD") // Password to use for SMTP authentication (if being used)
];

$wgEmergencyContact = 'team@repair.wiki';
$wgPasswordSender = 'no-reply@repair.wiki';


$wgUpgradeKey = getenv('WIKI_UPGRADE_KEY');

$wgReadOnly = getenv('WIKI_READ_ONLY');

# Captcha

wfLoadExtensions([ 'ConfirmEdit', 'ConfirmEdit/hCaptcha' ]);

$wgHCaptchaSendRemoteIP = true;
$wgHCaptchaSiteKey = getenv('WIKI_CAPTCHA_SITE');
$wgHCaptchaSecretKey = getenv('WIKI_CAPTCHA_KEY');

$wgCaptchaTriggers['edit'] = true;
$wgCaptchaTriggers['create'] = true;
$wgCaptchaTriggers['createtalk'] = true;
$wgCaptchaTriggers['addurl'] = true;
$wgCaptchaTriggers['createaccount'] = true;
$wgCaptchaTriggers['badlogin'] = true;

# StopForumSpam
$wgSFSIPListLocation = 'https://www.stopforumspam.com/downloads/listed_ip_90_ipv46_all.gz';
$wgSFSValidateIPListLocationMD5 = 'https://www.stopforumspam.com/downloads/listed_ip_90_ipv46_all.gz.md5';

# ConfirmAccount
$wgMakeUserPageFromBio = false;
$wgAutoWelcomeNewUsers = false;
$wgConfirmAccountRequestFormItems = [
    'UserName'        => [ 'enabled' => true ],
    'RealName'        => [ 'enabled' => false ],
    'Biography'       => [ 'enabled' => false, 'minWords' => 50 ],
    'AreasOfInterest' => [ 'enabled' => false ],
    'CV'              => [ 'enabled' => false ],
    'Notes'           => [ 'enabled' => true ],
    'Links'           => [ 'enabled' => false ],
    'TermsOfService'  => [ 'enabled' => false ],
];
$wgConfirmAccountContact = "no-reply@repair.wiki";

# UploadWizard
$wgUploadWizardConfig = [
	'debug' => false,
	'autoAdd' => [
	 	'wikitext' => [
			'Uploaded with Wizard.'
			],
	 	'categories' => [],
		], // Should be localised to the language of your wiki instance
	'feedbackLink' => false, // Disable the link for feedback (default: points to Commons)
	'alternativeUploadToolsPage' => false, // Disable the link to alternative upload tools (default: points to Commons)
	'enableFormData' => true, // Enable FileAPI uploads be used on supported browsers
	'enableMultipleFiles' => true,
	'enableMultiFileSelect' => false,
	'tutorial' => [
	 	'skip' => true
		], // Skip the tutorial
	'fileExtensions' => $wgFileExtensions // omitting this may cause errors
	];

    $wgExtensionFunctions[] = function() {
        $GLOBALS['wgUploadNavigationUrl'] = SpecialPage::getTitleFor( 'UploadWizard' )->getLocalURL();
        return true;
    };
// 10kx10k
$wgMaxImageArea = 10e7;
