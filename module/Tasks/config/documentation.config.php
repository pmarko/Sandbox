<?php
return array(
    'Tasks\\V1\\Rest\\User\\Controller' => array(
        'description' => 'Managing user related information',
        'collection' => array(
            'GET' => array(
                'response' => '{
   "_links": {
       "self": {
           "href": "/user"
       },
       "first": {
           "href": "/user?page={page}"
       },
       "prev": {
           "href": "/user?page={page}"
       },
       "next": {
           "href": "/user?page={page}"
       },
       "last": {
           "href": "/user?page={page}"
       }
   }
   "_embedded": {
       "user": [
           {
               "_links": {
                   "self": {
                       "href": "/user[/:user_id]"
                   }
               }
              "user_name": "",
              "first_name": "",
              "last_name": "",
              "password": ""
           }
       ]
   }
}',
                'description' => 'Lists all the users.',
            ),
            'description' => 'Users',
            'POST' => array(
                'description' => 'Create a user.',
                'request' => '{
   "user_name": "sample_user",
   "first_name": "Sample",
   "last_name": "User",
   "password": "password"
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/user[/:user_id]"
       }
   }
   "user_name": "",
   "first_name": "",
   "last_name": "",
   "password": ""
}',
            ),
        ),
    ),
);
