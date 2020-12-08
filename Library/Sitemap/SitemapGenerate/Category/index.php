<?php
    define('RootPath', '../../../../');
    if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) {
        $HeaderSecureType = "https://";
    }else{
        $HeaderSecureType = "http://";
    }
    define("DomainName",  $HeaderSecureType.$_SERVER['HTTP_HOST']);

    include "../php-sitemap-generator-master/php-sitemap-generator-master/src/SitemapGenerator.php";

// Setting the current working directory to be output directory
// for generated sitemaps (and, if needed, robots.txt)
// The output directory setting is optional and provided for demonstration purpose.
// By default output is written to current directory. 
$outputDir = getcwd();

$generator = new \Icamys\SitemapGenerator\SitemapGenerator(DomainName, $outputDir);

// will create also compressed (gzipped) sitemap
$generator->toggleGZipFileCreation();

// determine how many urls should be put into one file;
// this feature is useful in case if you have too large urls
// and your sitemap is out of allowed size (50Mb)
// according to the standard protocol 50000 is maximum value (see http://www.sitemaps.org/protocol.html)
$generator->setMaxURLsPerSitemap(50000);

// sitemap file name
$generator->setSitemapFileName("sitemap.xml");

// sitemap index file name
$generator->setSitemapIndexFileName("sitemap-index.xml");

// alternate languages
$alternates = [
    ['hreflang' => 'de', 'href' => DomainName."/Pages"],
];

// adding url `loc`, `lastmodified`, `changefreq`, `priority`, `alternates`
$generator->addURL(DomainName, new DateTime(), 'always', 0.8, $alternates);

// generate internally a sitemap
$generator->createSitemap();

// write early generated sitemap to file(s)
$generator->writeSitemap();

// update robots.txt file in output directory or create a new one
$generator->updateRobots();

// submit your sitemaps to Google, Yahoo, Bing and Ask.com
$generator->submitSitemap();
?>