<?php

require_once('ushahidiapi.php');

$url = "http://demo.ushahidi.com/api";
$debug = true;
$timeout = 30;
$ushahidi_api = new UshahidiApi($url,$debug,$timeout);

print "##### GET METHODS #####<br />";

/*print "#### Map Api Keys api ####<br />";
$map_api_keys_obj = $ushahidi_api->map_api_keys_tasks()->get_google_api_key();

print $map_api_keys_obj->get_domain()."<br />";

print $map_api_keys_obj->get_message()."<br />";

foreach( $map_api_keys_obj->get_items() as $service ) 
{
    print $service->service->id."<br />";
    print $service->service->apikey."<br /><br />";
}

print "##### Categories api #####<br />";

print "## Get all categories ##<br />";
$categories_obj = $ushahidi_api->categories_tasks()->get_all_categories();

print $categories_obj->get_domain()."<br />";

print $categories_obj->get_message()."<br />";

foreach( $categories_obj->get_items() as $category ) 
{
    print $category->category->id."<br />";
    print $category->category->parent_id."<br />";
    print $category->category->category_title."<br />";
    print $category->category->category_description."<br />";
    print $category->category->category_color."<br />";
    print $category->category->category_position."<br /><br />";
}

print "## Get categories by id ##<br />";
$categories_obj = $ushahidi_api->categories_tasks()->get_categories_by_id(1);

print $categories_obj->get_domain()."<br />";

print $categories_obj->get_message()."<br />";

foreach( $categories_obj->get_items() as $category ) 
{
    print $category->category->id."<br />";
    print $category->category->parent_id."<br />";
    print $category->category->category_title."<br />";
    print $category->category->category_description."<br />";
    print $category->category->category_color."<br />";
    print $category->category->category_position."<br /><br />";
}

print "## Get all countries ##<br />";
$countries_obj = $ushahidi_api->countries_tasks()->get_all_countries();

/** check server return error message **
if (($countries_obj->get_code() > 0))
{
    print $countries_obj->get_code();
    print $countries_obj->get_message();
}
else
{
    foreach( $countries_obj->get_items() as $country ) 
    {
        print $country->country->id."<br />";
        print $country->country->iso."<br />";
        print $country->country->name."<br />";
        print $country->country->capital."<br />";
    }

}

print "## Get countries by iso ##<br />";
$countries_obj = $ushahidi_api->countries_tasks()->get_countries_by_iso('ae');

/** check for errors from the server **
if (($countries_obj->get_code() > 0))
{
    print $countries_obj->get_code();
    print $countries_obj->get_message();
}
else
{
    foreach( $countries_obj->get_items() as $country ) 
    {
        print $country->country->id."<br />";
        print $country->country->iso."<br />";
        print $country->country->name."<br />";
        print $country->country->capital."<br />";
    }

}*/

/**
print "## Get all locations ##<br />";
$locations_obj = $ushahidi_api->locations_tasks()->get_all_locations();

/** check for errors from the server **
if (($locations_obj->get_code() > 0))
{
    print $locations_obj->get_code();
    print $locations_obj->get_message();
}
else
{
    foreach( $locations_obj->get_items() as $location ) 
    {
        print $location->location->id."<br />";
        print $location->location->name."<br />";
        print $location->location->country_id."<br />";
        print $location->location->latitude."<br />";
        print $location->location->longitude."<br />";
    }

}

 */

print "## Get all incidents ##<br />";
$incidents_obj = $ushahidi_api->incidents_tasks()->get_all_incidents();
print_r($incidents_obj);
?>
