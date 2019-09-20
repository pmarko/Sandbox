<?php


namespace Lift\Acl;

use Zend\Permissions\Acl\Acl as ZendAcl;

class ConfigAcl extends ZendAcl
{
    public function __construct($config)
    {
        foreach ($config['roles'] as $key => $role){
            if(is_array($role)){
                $this->addRole($key, $role);
            }else{
                $this->addRole($role);
            }
        }

        foreach ($config['resources'] as $key => $resource){
            if(is_array($resource)){
                $this->addResource($key, $resource);
            }else{
                $this->addResource($resource);
            }
        }

        foreach ($config['allow'] as $key => $allow){
            $this->allow($key, $allow);
        }

        foreach ($config['deny'] as $key => $deny){
            $this->deny($key, $deny);
        }
    }

    public function getDefaultRole()
    {
        return 'guest';
    }
}