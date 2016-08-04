<?php

namespace Ups\Entity\Tradeability;

class LandedCostRequest
{

    /**
     * @var QueryRequest
     */
    private $queryRequest;

    /**
     * @var mixed
     */
    private $estimateRequest;

    /**
     * @return QueryRequest
     */
    public function getQueryRequest()
    {
        return $this->queryRequest;
    }

    /**
     * @param QueryRequest $queryRequest
     * @return LandedCostRequest
     */
    public function setQueryRequest($queryRequest)
    {
        $this->queryRequest = $queryRequest;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEstimateRequest()
    {
        return $this->estimateRequest;
    }

    /**
     * @param mixed $estimateRequest
     *
     * @return LandedCostRequest
     */
    public function setEstimateRequest($estimateRequest)
    {
        $this->estimateRequest = $estimateRequest;

        return $this;
    }
}
