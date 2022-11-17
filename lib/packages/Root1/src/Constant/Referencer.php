<?php

class Root1_Constant_Referencer extends Root2_Empty_Empty
// Removing the extends clause will cause preloading to succeed
// Changing the extends clause to Root1_Constant_Empty will cause preloading to succeed
// Changing the extends clause to a non-existent class will continue causing preloading to segfault
{
    protected $propertyReferencingAnExternalConstant = Root1_Constant_Definer::CONSTANT;
    // Removing this line will cause preloading to succeed
    // Changing this to a hardcoded value will cause preloading to succeed
}
