<?php

namespace Simplisti\Lib\JasperStarter;

trait ParamTrait
{

    /**
     * @var array|null Template parameters 
     */
    private $parameters = [];

    /**
     * Resets all defined parameters and returns new array
     * 
     * @return $this
     */
    public function resetEmptyParameters ()
    {
        return $this->parameters = array_filter($this->parameters);
    }

    /**
     * Returns a defined parameter from the command line.
     * 
     * This does not currently return parameters required by the JRXML template it
     *
     * @param string $name The parameter name
     *
     * @return string
     */
    public function getParameter ($name)
    {
        return $this->parameters[$name];
    }

    /**
     * Sets a defined parameter to pass via the command line.
     * 
     * The parameters passed into the command should match up identically to those
     * expected by the JRXML file.
     *
     * @param string $name The parameter name
     * @param string $value The parameter value - boolean values MUST be enclosed 
     * 											in "quotes" or they may not be interpreted properly by JasperStarter
     *
     * @return $this
     */
    public function setParameter ($name, $value)
    {
        // TODO: Wrap boolean values in quotes

        $this->parameters[$name] = $value;
        return $this;
    }

}
