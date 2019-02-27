<?php

namespace Tractorcow\CampaignMonitor;

use CS_REST_Wrapper_Result;
use SilverStripe\View\ViewableData;

/**
 * Base class for Campaign Monitor objects
 *
 * @author Damian Mooyman
 */
abstract class CMBase extends ViewableData
{
    /**
     * The API key used for future requests
     *
     * @var string
     */
    protected $apiKey = null;

    public function __construct($apiKey = null)
    {
        parent::__construct();
        $this->apiKey = $apiKey;
    }

    /**
     * Checks that a result is successful
     *
     * @param CS_REST_Wrapper_Result $result
     * @return bool
     * @throws CMError
     */
    protected function checkResult($result)
    {
        if (!$result->was_successful()) {
            throw new CMError($result->response->Message, $result->http_status_code);
        }

        return true;
    }

    /**
     * Safely extracts results from a CM API call
     *
     * @param CS_REST_Wrapper_Result $result
     * @return mixed
     * @throws CMError
     */
    protected function parseResult($result)
    {
        $this->checkResult($result);

        return $result->response;
    }
}
