<?php

namespace Controllers;


abstract class PublicController implements IController
{
    protected $name = "";
    /**
     * Public Controller Base Constructor
     */
    public function __construct()
    {
        $this->name = get_class($this);
        if (\Utilities\Security::isLogged()){
            if(\Utilities\Security::isAdmin()){
                $layoutFile = \Utilities\Context::getContextByKey("ADMIN_LAYOUT");
            }else{
                $layoutFile = \Utilities\Context::getContextByKey("PRIVATE_LAYOUT");
            }
            if ($layoutFile !== "") {
                \Utilities\Context::setContext(
                    "layoutFile",
                    $layoutFile
                );
                \Utilities\Nav::setNavContext();
            }
        }
    }
    /**
     * Return name of instantiated class
     *
     * @return string
     */
    public function toString() :string
    {
        return $this->name;
    }
    /**
     * Returns if http method is a post or not
     *
     * @return bool
     */
    protected function isPostBack()
    {
        return $_SERVER["REQUEST_METHOD"] == "POST";
    }

}

?>
