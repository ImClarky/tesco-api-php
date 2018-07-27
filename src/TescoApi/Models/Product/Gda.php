<?php

namespace ImClarky\TescoApi\Models\Product;

/**
 * Guideline Daily Amounts (GDA) class
 *
 * @author Sean Clark <sean.clark@d3r.com>
 */
class Gda
{
    /**
     * Name of the GDA nutrient
     *
     * @var string
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected $_name;

    /**
     * Values of the GDA nutrient
     *
     * @var array
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected $_values;

    /**
     * Percent of Recommended Daily Intake
     *
     * @var integer
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected $_percent;

    /**
     * L/M/H Rating of the GDA nutrient percentage
     *
     * @var string
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected $_rating;

    const RATING_LOW = 'low';
    const RATING_MEDIUM = 'medium';
    const RATING_HIGH = 'high';

    /**
     * GDA Constructor
     *
     * @param array $dataset
     * @author Sean Clark <sean.clark@d3r.com>
     */
    public function __construct(array $dataset)
    {
        $this->setName($dataset['name']);
        $this->setValues($dataset['values']);
        $this->setPercent((int) $dataset['percent']);

        if (isset($dataset['rating'])) {
            $this->setRating($dataset['rating']);
        }
    }

    /**
     * Set the name of the GDA
     *
     * @param string $name
     * @return void
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected function setName(string $name)
    {
        $this->_name = $name;
    }

    /**
     * Set the Values of the GDA
     *
     * @param array $values
     * @return void
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected function setValues(array $values)
    {
        $this->_values = $values;
    }

    /**
     * Set the Daily Reference Percentage
     *
     * @param integer $percent
     * @return void
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected function setPercent(int $percent)
    {
        $this->_percent = $percent;
    }

    /**
     * Set the Percentage Rating
     *
     * @param string $rating
     * @return void
     * @author Sean Clark <sean.clark@d3r.com>
     */
    protected function setRating(string $rating)
    {
        $this->_rating = $rating;
    }
}
