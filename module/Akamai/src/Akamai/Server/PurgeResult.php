<?php
/**
 * @version $Revision: 3 $
 * @author Vasiuddin Mohamed
 * @category Akamai Mock
 * @package Akamai
 * @license MIT
 */

namespace Akamai\Server;

/**
 * Purge result
 */
class PurgeResult
{
    /**
     * Indicates success or failure of removal request.
     *
     * @var int
     */
    public $resultCode;

    /**
     * Explains result code.
     *
     * @var string
     */
    public $resultMsg;

    /**
     * Unique ID assigned to the removal request.
     *
     * @var string
     */
    public $sessionID;

    /**
     * Estimated time.
     *
     * Indicates the estimated time for the request to be processed, in seconds.
     * A value of -1 indicates that there is no estimated time, usually
     * appearing when the request fails.
     *
     * @var int
     */
    public $estTime;

    /**
     * If the request fails because of a bad ARL/URL, this identifies the index
     * of the first failed ARL/URL in the array. A value of -1 indicates there
     * were no bad ARLs/URLs, or that an error occurred before the ARLs/URLs
     * were parsed.
     *
     * @var int
     */
    public $uriIndex;

    /**
     * @var array
     */
    public $modifiers = array();

    /**
     * @return bool
     */
    public function isSucccess()
    {
        return 99 < $this->resultCode && 200 > $this->resultCode;
    }

    /**
     * @return bool
     */
    public function isWarning()
    {
        return 199 < $this->resultCode && 300 > $this->resultCode;
    }

    /**
     * @return bool
     */
    public function isInvalid()
    {
        return 299 < $this->resultCode && 400 > $this->resultCode;
    }

    /**
     * @return bool
     */
    public function isUnknown()
    {
        return 399 < $this->resultCode && 500 > $this->resultCode;
    }
}