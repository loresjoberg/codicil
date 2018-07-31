Codicil -- A Fluent Query Interface for WordPress
=================================================

Installation
------------

Install using [Composer][composer]:

````
    composer require loresjoberg/codicil
````

Usage
-----


````
   $query = Codicil::query();
   $results = $query->select('posts')->offset(1)->limit(5)->fetch();
   
   foreach ($results as $wpPost) {
     print '<p>' . $wpPost->post_title . ' by ' . $wpPost->post_author . "</p>";
   }
````

