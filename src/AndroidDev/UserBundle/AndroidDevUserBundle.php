<?php
// src/AndroidDev/UserBundle/AndroidDevUserBundle.php
 
namespace AndroidDev\UserBundle;
 
use Symfony\Component\HttpKernel\Bundle\Bundle;
 
class AndroidDevUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}