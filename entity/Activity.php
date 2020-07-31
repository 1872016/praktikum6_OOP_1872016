<?php

/**
 * 
 */
class Activity
{
	
	private $id;
	private $title;
	private $description;
	private $place;
	private $start_date;
	private $end_date;
	private $doc_photo;
	private $faculty_id;

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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * @param mixed $place
     *
     * @return self
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * @param mixed $start_date
     *
     * @return self
     */
    public function setStartDate($start_date)
    {
        $this->start_date = $start_date;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->end_date;
    }

    /**
     * @param mixed $end_date
     *
     * @return self
     */
    public function setEndDate($end_date)
    {
        $this->end_date = $end_date;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDocPhoto()
    {
        return $this->doc_photo;
    }

    /**
     * @param mixed $doc_photo
     *
     * @return self
     */
    public function setDocPhoto($doc_photo)
    {
        $this->doc_photo = $doc_photo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFacultyId()
    {
        return $this->faculty_id;
    }

    /**
     * @param mixed $faculty_id
     *
     * @return self
     */
    public function setFacultyId($faculty_id)
    {
        $this->faculty_id = $faculty_id;

        return $this;
    }
}