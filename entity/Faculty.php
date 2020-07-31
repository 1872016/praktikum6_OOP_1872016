<?php

/**
 * 
 */
class Faculty
{

	private $id;
	private $name;
	private $establish;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEstablish()
    {
        return $this->establish;
    }

    /**
     * @param mixed $establish
     *
     * @return self
     */
    public function setEstablish($establish)
    {
        $this->establish = $establish;

        return $this;
    }
}